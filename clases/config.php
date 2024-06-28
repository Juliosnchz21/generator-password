<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();

define("DB_HOST","localhost");
define("DB_USER","root");
define("DB_PASS","");
define("DB_DATABASE","shieldpass");

define("SHA2_LONG",32);
define("CIFRADO","AES-128-CBC");
?>