<?php

require('vendor/autoload.php');

if (WOLFF_DEVELOPMENT) {
    error_reporting(-1);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}

(new System\Start)->load();