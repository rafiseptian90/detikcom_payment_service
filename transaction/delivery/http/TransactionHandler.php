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
            if ($e instanceof \InvalidArgumentException)
                return ResponseJSON::unprocessableEntity('Unprocessable Entity', json_decode($e->getMessage()));
            if ($e instanceof \PDOException) {
                return ResponseJSON::badRequest("Failed to create new transaction. " . $e->getMessage());
            }

            return ResponseJSON::internalServerError('Internal Server Error. ' . $e->getMessage());
        }

        return ResponseJSON::successWithData('New Transaction has been added', [
            'references_id' => $transaction->referencesID,
            'number_va' => $transaction->numberVA,
            'status' => $transaction->getStatus()
        ]);
    }

    public function show(string $referencesID, string $merchantID) : string
    {
        try {
            $transaction = $this->transactionUsecase->retrieveTransaction($referencesID, $merchantID);
        } catch(\Exception $e) {
            if ($e instanceof \PDOException)
                return ResponseJSON::notFound($e->getMessage());

            return ResponseJSON::internalServerError("Something went wrong happen in server. " . $e->getMessage());
        }

        return ResponseJSON::successWithData('Transaction has been loaded', [
            'references_id' => $transaction->referencesID,
            'invoice_id' => $transaction->invoiceID,
            'status' => $transaction->getStatus()
        ]);
    }
}