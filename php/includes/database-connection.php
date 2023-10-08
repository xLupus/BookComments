<?php

//Casa Vini
$DB_HOST   = '';
$DB_DRIVER = '';
$DB_NAME   = '';
$DB_USER   = '';
$DB_PASS   = '';

$pdoConfig = "$DB_DRIVER:Server=$DB_HOST,1433;Database=$DB_NAME";
$database  = new PDO($pdoConfig,$DB_USER,$DB_PASS);

