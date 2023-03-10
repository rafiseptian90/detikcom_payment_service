<?php

namespace Transaction\Usecase;

require_once 'domain/Transaction.php';

use Domain\Transaction;
use Domain\TransactionUsecase as TransactionUsecaseInterface;
use Domain\TransactionRepository;

class TransactionUsecase implements TransactionUsecaseInterface
{
    private TransactionRepository $transactionRepo;

    public function __construct(TransactionRepository $transactionRepo)
    {
        $this->transactionRepo = $transactionRepo;
    }

    public function storeTransaction(Transaction $transaction): Transaction
    {
        // TODO: Implement storeTransaction() method.
        return new Transaction();
    }

    public function retrieveTransaction(string $referencesID, string $merchantID): Transaction
    {
        // TODO: Implement retrieveTransaction() method.
        return new Transaction();
    }

    public function updateTransaction(string $referencesID, string $status): Transaction
    {
        // TODO: Implement updateTransaction() method.
        return new Transaction();
    }
}
