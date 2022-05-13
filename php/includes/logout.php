<?php

session_start();
session_destroy();
header('location: ../../php/validar-login.php');