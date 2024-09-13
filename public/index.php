<?php
require '../vendor/autoload.php';
require '../app/Config/define_database.php';
require '../app/Config/define_path.php';
require '../app/Config/define_pagination.php';

session_start();

$app = new Core\App();
