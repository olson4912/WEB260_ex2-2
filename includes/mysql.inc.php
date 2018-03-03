<?php

//Set the database access information as constants:
DEFINE('DB_USER', 'caolson');
DEFINE('DB_PASSWORD', 'ChOls0712');
DEFINE('DB_HOST', 'localhost');
DEFINE('DB_NAME', 'web260olso2');

//Make the connection:
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

//Set the character set:
mysqli_set_charset($dbc, 'utf8');
