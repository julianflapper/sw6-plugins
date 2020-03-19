<?php declare(strict_types=1);

namespace DV\FreeCartCheckout\Service;

use Shopware\Core\Checkout\Payment\Cart\PaymentHandler\SynchronousPaymentHandlerInterface;
use Shopware\Core\Checkout\Payment\Cart\SyncPaymentTransactionStruct;
use Shopware\Core\Checkout\Order\Aggregate\OrderTransaction\OrderTransactionStateHandler;
use Shopware\Core\Framework\Validation\DataBag\RequestDataBag;
use Shopware\Core\System\SalesChannel\SalesChannelContext;

class FreeCheckout implements SynchronousPaymentHandlerInterface {
    /**
     * @var OrderTransactionStateHandler
     */
    private $transactionStateHandler;

    public function __construct(OrderTransactionStateHandler $transactionStateHandler) {
        $this->transactionStateHandler = $transactionStateHandler;
    }

    public function pay(SyncPaymentTransactionStruct $transaction, RequestDataBag $dataBag, SalesChannelContext $salesChannelContext): void {
        $context = $salesChannelContext->getContext();
        $this->transactionStateHandler->pay($transaction->getOrderTransaction()->getId(), $context);
    }
}