<?php

namespace Domain;

use Exception;
use Pkg\Request\Transaction\StoreTransactionRequest;
use Pkg\Request\Transaction\UpdateTransactionRequest;

class Transaction {
    const PENDING = 2;
    const PAID = 1;
    const FAILED = 0;

    public int $amount;
    public string
        $id,
        $invoiceID,
        $referencesID,
        $merchantID,
        $numberVA,
        $itemName,
        $customerName,
        $paymentType;
    public mixed $status = 2;

    /**
     * @throws Exception
     */
    public function setStatus(string $status) : string
    {
        return match (strtolower($status)) {
            'Paid' => $this->status = self::PAID,
            'Failed' => $this->status = self::FAILED,
            'Pending' => $this->status = self::PENDING,
            default => throw new Exception('Unexpected match value'),
        };
    }

    public function getStatus() : string
    {
        return match ($this->status) {
            self::PAID => 'Paid',
            self::FAILED => 'Failed',
            self::PENDING => 'Pending',
        };
    }
}

interface TransactionUsecase {
    public function storeTransaction(StoreTransactionRequest $transactionRequest): Transaction;
    public function retrieveTransaction(string $referencesID, string $merchantID): Transaction;
    public function updateTransaction(UpdateTransactionRequest $transactionRequest, string $referencesID): bool;
}

interface TransactionRepository {
    public function storeTransaction(Transaction $transaction): Transaction;
    public function retrieveTransaction(string $referencesID, string $merchantID): Transaction;
    public function updateTransaction(string $referencesID, string $status): bool;
}