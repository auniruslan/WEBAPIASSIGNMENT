<?php

use Slim\Http\Request;
use Slim\Http\Response;
use \Firebase\JWT\JWT;

    //hello route
    require __DIR__ . '/../src/Controllers/hello.php';

    // employees route
    require __DIR__ . '/../src/Controllers/employees.php';