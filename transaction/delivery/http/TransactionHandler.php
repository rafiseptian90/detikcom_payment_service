<?php

namespace Transaction\Delivery\Http;

require_once 'domain/Transaction.php';
require_once 'pkg/request/transaction/StoreTransactionRequest.php';
require_once 'pkg/request/transaction/UpdateTransactionRequest.php';

use Domain\TransactionUsecase;
use Pkg\Request\Transaction\StoreTransactionRequest;

class TransactionHandler
{
    private TransactionUsecase $transactionUsecase;

    public function __construct(TransactionUsecase $transactionUsecase)
    {
        $this->transactionUsecase = $transactionUsecase;
    }

    public function store(StoreTransactionRequest $request) : string
    {
        try {
            $transaction = $this->transactionUsecase->storeTransaction($request);
        } catch(\InvalidArgumentException $e) {
            die($e->getMessage());
        }

        return json_encode([
            'references_id' => $transaction->referencesID,
            'merchant_id' => $transaction->merchantID,
            'status' => $transaction->getStatus()
        ]);
    }
}