<?php

namespace Domain;

class Transaction {
    private int $amount;
    public string $id, $referencesID, $merchantID, $itemName, $customerName, $paymentType, $status;
}

interface TransactionUsecase {
    public function storeTransaction(Transaction $transaction): Transaction;
    public function retrieveTransaction(string $referencesID, string $merchantID): Transaction;
    public function updateTransaction(string $referencesID, string $status): Transaction;
}

interface TransactionRepository {
    public function storeTransaction(Transaction $transaction): Transaction;
    public function retrieveTransaction(string $referencesID, string $merchantID): Transaction;
    public function updateTransaction(string $referencesID, string $status): Transaction;
}