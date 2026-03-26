<?php
// public/index.php

// Bootstrap
require_once dirname(__DIR__) . '/config/app.php';
require_once dirname(__DIR__) . '/config/database.php';
require_once dirname(__DIR__) . '/core/Database.php';
require_once dirname(__DIR__) . '/core/Model.php';
require_once dirname(__DIR__) . '/core/Controller.php';
require_once dirname(__DIR__) . '/core/Router.php';

// Models (autoload here for simplicity)
require_once dirname(__DIR__) . '/app/models/ProgramModel.php';
require_once dirname(__DIR__) . '/app/models/RekapModel.php';

// Session
session_name(SESSION_NAME);
session_start();

// Init router
$router = new Router();
require_once dirname(__DIR__) . '/routes/web.php';
$router->resolve();
