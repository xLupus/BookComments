<?php

session_start();
session_destroy();
header('location: ../../php/user/validar-login.php');