<?php

require_once 'config/Connection.php';

require_once 'transaction/repository/mysql/TransactionRepository.php';
require_once 'transaction/usecase/TransactionUsecase.php';
require_once 'transaction/delivery/http/TransactionHandler.php';
require_once 'pkg/request/transaction/StoreTransactionRequest.php';
require_once 'helpers/ResponseJSON.php';

use Config\MySQLConnection;
use Transaction\Repository\MySQL\TransactionRepository;
use Transaction\Usecase\TransactionUsecase;
use Transaction\Delivery\Http\TransactionHandler;
use Pkg\Request\Transaction\StoreTransactionRequest;
use Helpers\ResponseJSON;

$connection = MySQLConnection::init();

$transactionRepo = new TransactionRepository($connection);
$transactionUsecase = new TransactionUsecase($transactionRepo);
$transactionHandler = new TransactionHandler($transactionUsecase);

switch($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if (preg_match('#^/api/v1/transaction.*$#', $_SERVER['REQUEST_URI'])) {
            if (!isset($_GET['referencesId'])) {
                echo ResponseJSON::badRequest('referencesId must be passed as a query string');
                exit();
            }
            if (!isset($_GET['merchantId'])) {
                echo ResponseJSON::badRequest('merchantId must be passed as a query string');
                exit();
            }

            $referencesId = htmlspecialchars($_GET['referencesId'], ENT_QUOTES, 'UTF-8') ?? '';
            $merchantId = htmlspecialchars($_GET['merchantId'], ENT_QUOTES, 'UTF-8') ?? '';

            echo $transactionHandler->show($referencesId, $merchantId);
        }
        break;

    case 'POST':
        if($_SERVER['REQUEST_URI'] === '/api/v1/transaction') {
            $requestBody = json_decode(file_get_contents("php://input"), true);
            $transactionRequest = new StoreTransactionRequest(
                $requestBody['invoice_id'] ?? '',
                $requestBody['merchant_id'] ?? '',
                $requestBody['customer_name'] ?? '',
                $requestBody['item_name'] ?? '',
                $requestBody['amount'] ?? 0,
                $requestBody['payment_type'] ?? ''
            );

            echo $transactionHandler->store($transactionRequest);
        }
        break;
}