<?php

require_once 'config/Connection.php';
require_once 'transaction/usecase/TransactionUsecase.php';
require_once 'transaction/repository/mysql/TransactionRepository.php';
require_once 'pkg/request/transaction/UpdateTransactionRequest.php';

use Config\MySQLConnection;
use Transaction\Repository\MySQL\TransactionRepository;
use Transaction\Usecase\TransactionUsecase;
use Pkg\Request\Transaction\UpdateTransactionRequest;

if (count($argv) != 3) {
    echo "Usage: php transaction-cli.php {references_id} {status}\n";
    exit(1);
}

$transactionRepo = new TransactionRepository(MySQLConnection::init());
$transactionUsecase = new TransactionUsecase($transactionRepo);

$referencesId = $argv[1];
$status = $argv[2];

try {
    $transactionRequest = new UpdateTransactionRequest($referencesId, $status);
    $result = $transactionUsecase->updateTransaction($transactionRequest, $referencesId);

    echo "Successfully update a transaction" . PHP_EOL;
} catch(\Exception $e){
    if ($e instanceof \InvalidArgumentException) {
        echo "Invalid argument given : " . join(',', json_decode($e->getMessage(), true)) . PHP_EOL;
    } else {
        echo $e->getMessage() . PHP_EOL;
    }

    exit(1);
}

exit(1);