<?php

namespace Transaction\Delivery\Http;

require_once 'domain/Transaction.php';

use Domain\TransactionUsecase;

class TransactionHandler
{
    private TransactionUsecase $transactionUsecase;

    public function __construct(TransactionUsecase $transactionUsecase)
    {
        $this->transactionUsecase = $transactionUsecase;
    }
}