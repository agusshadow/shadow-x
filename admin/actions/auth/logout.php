<?php

require_once "../../../functions/autoload.php";

Auth::logout();

header('location: ../../../index.php?sec=login');

?>