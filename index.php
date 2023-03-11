<?php

require_once 'config/Connection.php';

require_once 'transaction/repository/mysql/TransactionRepository.php';
require_once 'transaction/usecase/TransactionUsecase.php';
require_once 'transaction/delivery/http/TransactionHandler.php';

use Config\MySQLConnection;
use Transaction\Repository\MySQL\TransactionRepository;
use Transaction\Usecase\TransactionUsecase;
use Transaction\Delivery\Http\TransactionHandler;

$connection = MySQLConnection::init();

$transactionRepo = new TransactionRepository($connection);
$transactionUsecase = new TransactionUsecase($transactionRepo);
$transactionHandler = new TransactionHandler($transactionUsecase);