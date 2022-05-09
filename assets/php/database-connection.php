<?php

$DB_HOST = 'DESKTOP-8P375TU\\SQLEXPRESS';
$DB_DRIVER = 'sqlsrv';
$DB_NAME = 'BookComments4';
$DB_USER = 'sa';
$DB_PASS = 'SL-221B-VAS';

$pdoConfig  = "$DB_DRIVER:Server=$DB_HOST;Database=$DB_NAME";

$database = new PDO($pdoConfig,$DB_USER,$DB_PASS);