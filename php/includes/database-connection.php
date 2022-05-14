<?php

//Casa Vini
$DB_HOST = 'DESKTOP-8P375TU\\SQLEXPRESS';
$DB_DRIVER = 'sqlsrv';
$DB_NAME = 'BookComments';
$DB_USER = 'sa';
$DB_PASS = 'SL-221B-VAS';

$pdoConfig  = "$DB_DRIVER:Server=$DB_HOST;Database=$DB_NAME";

$database = new PDO($pdoConfig,$DB_USER,$DB_PASS);



//Senac
/*
$DB_HOST = '10.135.0.53\\sqledutsi';
$DB_DRIVER = 'sqlsrv';
$DB_NAME = 'ONU';
$DB_USER = 'ALUNO';
$DB_PASS = 'aluno';

$pdoConfig  = "$DB_DRIVER:Server=$DB_HOST;Database=$DB_NAME";

$database = new PDO($pdoConfig,$DB_USER,$DB_PASS);
*/