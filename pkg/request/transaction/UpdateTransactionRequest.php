<?php

namespace Pkg\Request\Transaction;

require_once 'domain/Transaction.php';

use Domain\Transaction;

class UpdateTransactionRequest
{
    public array $allowedStatus = ['paid', 'pending', 'failed'];
    private string $referencesId, $status;

    public function __construct(string $referencesId, string $status)
    {
        $this->referencesId = $referencesId;
        $this->status = $status;
    }

    public function getReferencesId() : string
    {
        return $this->referencesId;
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

        if (empty($this->referencesId))
            $errors[] = "References ID must be filled.";

        if (empty($this->status)) {
            $errors[] = "Invoice ID must be filled.";
        } else if (!in_array(strtolower($this->status), $this->allowedStatus)) {
            $errors[] = "Invalid Status value. Only accept pending, paid, and failed.";
        }

        return $errors;
    }
}