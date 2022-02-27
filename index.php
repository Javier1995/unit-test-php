<?php



declare(strict_types = 1);
require_once __DIR__.'/vendor/autoload.php';

set_exception_handler([new \App\Exception\ExceptionHandler(), 'handler' ]);

$config = \App\Helpers\Config::getFileContent('dsd');

$applications = new \App\Helpers\App();


var_dump($applications->getServerTime()->format('Y-m-d H:i:s'));