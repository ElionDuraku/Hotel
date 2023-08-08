<?php

use Admin\Libs\Session;

require_once("autoloader.php");
$session = new Session();
$session->logout();
header("location:index.php");
