<?php

namespace Transaction\Delivery\Http;

require_once 'domain/Transaction.php';
require_once 'pkg/request/transaction/StoreTransactionRequest.php';
require_once 'pkg/request/transaction/UpdateTransactionRequest.php';
require_once 'helpers/ResponseJSON.php';

use Domain\TransactionUsecase;
use Pkg\Request\Transaction\StoreTransactionRequest;
use Helpers\ResponseJSON;

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
        } catch(\Exception $e) {
            if ($e instanceof \InvalidArgumentException) {
                return ResponseJSON::unprocessableEntity('Unprocessable Entity', json_decode($e->getMessage()));
            }

            return ResponseJSON::internalServerError('Internal Server Error. ' . $e->getMessage());
        }

        return ResponseJSON::successWithData('New Transaction has been added', [
            'invoice_id' => $transaction->invoiceID,
            'references_id' => $transaction->referencesID,
            'status' => $transaction->getStatus()
        ]);
    }
}