<?php

namespace Transaction\Repository\MySQL;

require_once 'domain/Transaction.php';

use Domain\Transaction;
use Domain\TransactionRepository as TransactionRepoInterface;
use PDO;

class TransactionRepository implements TransactionRepoInterface
{
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
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