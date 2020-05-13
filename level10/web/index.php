<?php

if (session_status()) {
    session_start();
}
require '../niceVarDump.php';
require '../vendor/autoload.php';
//FRONT CONTROLLER

require '../app/start.php';
