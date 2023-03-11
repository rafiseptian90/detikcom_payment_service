<?php

namespace Pkg\Request\Transaction;

require_once 'domain/Transaction.php';

use Domain\Transaction;

class UpdateTransactionRequest
{
    public array $allowedStatus = ['paid', 'pending', 'failed'];
    private string $status;

    public function __construct(string $status)
    {
        $this->status = $status;
    }

    public function getStatus() : int
    {
        return match (strtolower($this->status)) {
            'paid' => $this->status = Transaction::PAID,
            'failed' => $this->status = Transaction::FAILED,
            'pending' => $this->status = Transaction::PENDING,
        };
    }

    public function validate() : array
    {
        $errors = [];

        if (empty($this->status)) {
            $errors[] = "Invoice ID must be filled.";
        } else if (!in_array($this->status, $this->allowedStatus)) {
            $errors[] = "Invalid Status value. Only accept pending, paid, and failed.";
        }

        return $errors;
    }
}