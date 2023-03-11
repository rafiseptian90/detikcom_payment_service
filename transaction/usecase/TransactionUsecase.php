<?php

namespace Transaction\Usecase;

require_once 'domain/Transaction.php';
require_once 'helpers/Randomize.php';
require_once 'pkg/request/transaction/StoreTransactionRequest.php';
require_once 'pkg/request/transaction/UpdateTransactionRequest.php';

use Domain\TransactionUsecase as TransactionUsecaseInterface;
use Domain\Transaction;
use Domain\TransactionRepository;
use Helpers\Randomize;
use Pkg\Request\Transaction\StoreTransactionRequest;
use Pkg\Request\Transaction\UpdateTransactionRequest;

class TransactionUsecase implements TransactionUsecaseInterface
{
    private TransactionRepository $transactionRepo;

    public function __construct(TransactionRepository $transactionRepo)
    {
        $this->transactionRepo = $transactionRepo;
    }

    /**
     * @param StoreTransactionRequest $transactionRequest
     * @return Transaction
     * @throws \Exception
     */
    public function storeTransaction(StoreTransactionRequest $transactionRequest): Transaction
    {
        $errors = $transactionRequest->validate();
        if (!empty($errors))
            throw new \InvalidArgumentException(json_encode($errors));

        try {
            $transaction = new Transaction();
            $transaction->referencesID = "demo_" . Randomize::generateRandomNumber(13);
            $transaction->invoiceID = $transactionRequest->getInvoiceID();
            $transaction->merchantID = $transactionRequest->getMerchantID();
            $transaction->customerName = $transactionRequest->getCustomerName();
            $transaction->itemName = $transactionRequest->getItemName();
            $transaction->amount = $transactionRequest->getAmount();
            $transaction->customerName = $transactionRequest->getCustomerName();
            $transaction->paymentType = $transactionRequest->getPaymentType();

            if ($transaction->paymentType === 'credit_card') {
                $transaction->numberVA = (int) Randomize::generateRandomNumber(16);
            } else if($transaction->paymentType === 'virtual_account') {
                $transaction->numberVA = "va-" . Randomize::generateRandomNumber(13);
            }

            $newTransaction = $this->transactionRepo->storeTransaction($transaction);
        } catch(\PDOException $e) {
            throw new \PDOException("Failed to create a new transaction. " . $e->getMessage());
        }

        return $newTransaction;
    }

    public function retrieveTransaction(string $referencesID, string $merchantID): Transaction
    {
        // TODO: Implement retrieveTransaction() method.
        return new Transaction();
    }

    public function updateTransaction(UpdateTransactionRequest $transactionRequest, string $referencesID): bool
    {
        // TODO: Implement updateTransaction() method.
        return true;
    }
}
