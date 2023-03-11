<?php

namespace Transaction\Repository\MySQL;

require_once 'domain/Transaction.php';

use Domain\Transaction;
use Domain\TransactionRepository as TransactionRepoInterface;
use Exception;
use PDO;

class TransactionRepository implements TransactionRepoInterface
{
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    /**
     * @param Transaction $transaction
     * @return Transaction
     */
    public function storeTransaction(Transaction $transaction): Transaction
    {
        try {
            $stmt = $this->pdo->prepare(
                "INSERT INTO transactions (invoice_id, merchant_id, references_id, number_va, item_name, amount, customer_name, payment_type) 
                    VALUES (:invoice_id, :merchant_id, :references_id, :number_va, :item_name, :amount, :customer_name, :payment_type)"
            );

            $stmt->bindParam(':invoice_id', $transaction->invoiceID);
            $stmt->bindParam(':merchant_id', $transaction->merchantID);
            $stmt->bindParam(':references_id', $transaction->referencesID);
            $stmt->bindParam(':number_va', $transaction->numberVA);
            $stmt->bindParam(':item_name', $transaction->itemName);
            $stmt->bindParam(':amount', $transaction->amount);
            $stmt->bindParam(':customer_name', $transaction->customerName);
            $stmt->bindParam(':payment_type', $transaction->paymentType);

            $stmt->execute();
        } catch(\PDOException $e) {
            throw new \PDOException("Error : {$stmt->errorInfo()[2]}", $stmt->errorInfo()[0], $e);
        }

        return $transaction;
    }

    /**
     * @param string $referencesID
     * @param string $merchantID
     * @return Transaction
     */
    public function retrieveTransaction(string $referencesID, string $merchantID): Transaction
    {
        $stmt = $this->pdo->prepare("SELECT * FROM transactions WHERE references_id = :references_id AND merchant_id = :merchant_id");

        $stmt->bindParam(':references_id', $referencesID);
        $stmt->bindParam(':merchant_id', $merchantID);

        $stmt->execute();
        if (!$result = $stmt->fetch())
            throw new \PDOException("Record not found");

        $transaction = new Transaction();
        $transaction->id = $result->id;
        $transaction->invoiceID = $result->invoice_id;
        $transaction->referencesID = $result->references_id;
        $transaction->merchantID = $result->merchant_id;
        $transaction->numberVA = $result->number_va;
        $transaction->itemName = $result->item_name;
        $transaction->customerName = $result->customer_name;
        $transaction->paymentType = $result->payment_type;
        $transaction->status = $result->status;

        return $transaction;
    }

    /**
     * @param string $referencesID
     * @param string $status
     * @return bool
     * @throws Exception
     */
    public function updateTransaction(string $referencesID, string $status): bool
    {
        $transaction = new Transaction();
        $transaction->setStatus($status);

        $stmt = $this->pdo->prepare("UPDATE transactions SET status = :status WHERE references_id = :references_id");

        $stmt->bindParam(':references_id', $referencesID);
        $stmt->bindParam(':status', $transaction->status);

        $stmt->execute();

        if ($stmt->rowCount() < 1)
            return 0;

        return 1;
    }
}