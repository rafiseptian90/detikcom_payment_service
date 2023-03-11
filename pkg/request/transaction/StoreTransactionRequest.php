<?php

namespace Pkg\Request\Transaction;

class StoreTransactionRequest
{
    const INVOICE_ID_MAX_LENGTH = 36;
    const MERCHANT_ID_MAX_LENGTH = 36;
    const ITEM_NAME_MAX_LENGTH = 191;
    const CUSTOMER_NAME_MAX_LENGTH = 191;

    public array $allowedPaymentTypes = ['credit_card', 'virtual_account'];
    private int $amount;
    private string
        $invoiceID,
        $merchantID,
        $itemName,
        $customerName,
        $paymentType;

    public function __construct(string $invoiceID, string $merchantID, string $customerName, string $itemName, int $amount, string $paymentType)
    {
        $this->invoiceID = $invoiceID;
        $this->merchantID = $merchantID;
        $this->customerName = $customerName;
        $this->itemName = $itemName;
        $this->amount = $amount;
        $this->paymentType = $paymentType;
    }

    public function getInvoiceID() : string
    {
        return $this->invoiceID;
    }

    public function getMerchantID() : string
    {
        return $this->merchantID;
    }

    public function getCustomerName() : string
    {
        return $this->customerName;
    }

    public function getItemName() : string
    {
        return $this->itemName;
    }

    public function getAmount() : int
    {
        return $this->amount;
    }

    public function getPaymentType() : string
    {
        return $this->paymentType;
    }

    public function validate() : array
    {
        $errors = [];

        // Validate invoiceID property
        if (empty($this->invoiceID)) {
            $errors[] = "Invoice ID must be filled.";
        } else if (strlen($this->invoiceID) > self::INVOICE_ID_MAX_LENGTH ) {
            $errors[] = sprintf("Invoice ID must be less than %d character.", self::INVOICE_ID_MAX_LENGTH);
        }

        // Validate merchantID property
        if (empty($this->merchantID)) {
            $errors[] = "Merchant ID must be filled.";
        } else if (strlen($this->merchantID) > self::MERCHANT_ID_MAX_LENGTH) {
            $errors[] = sprintf("Merchant ID must be less than %d character.", self::MERCHANT_ID_MAX_LENGTH);
        }

        // Validate customerName property
        if (empty($this->customerName)) {
            $errors[] = "Customer Name must be filled.";
        } else if (!preg_match('/^[a-zA-Z ]+$/', $this->customerName)) {
            $errors[] = "Customer Name must be an alphabet character only.";
        } else if (strlen($this->customerName) > self::CUSTOMER_NAME_MAX_LENGTH) {
            $errors[] = sprintf("Customer Name must be less than %d character.", self::CUSTOMER_NAME_MAX_LENGTH);
        }

        // Validate itemName property
        if (empty($this->itemName)) {
            $errors[] = "Item Name must be filled.";
        } else if (strlen($this->itemName) > self::ITEM_NAME_MAX_LENGTH) {
            $errors[] = sprintf("Item Name must be less than %d character.", self::ITEM_NAME_MAX_LENGTH);
        }

        // Validate amount property
        if (empty($this->amount)) {
            $errors[] = "Amount must be filled.";
        } else if (!preg_match('/^[0-9]+$/', $this->amount)) {
            $errors[] = "Amount must be a numeric character only.";
        }

        // Validate paymentType property
        if (empty($this->paymentType)) {
            $errors[] = "Payment Type must be filled.";
        } else if (!in_array($this->paymentType, $this->allowedPaymentTypes)) {
            $errors[] = "Invalid Payment Type value. Only accept credit_card and virtual_bank";
        }

        return $errors;
    }
}