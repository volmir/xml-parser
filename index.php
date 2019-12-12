<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

$loader = require(__DIR__ . '/vendor/autoload.php');

$appication = new \App\XmlParser(
        'https://stylecaster.com/feeds/amazon',
        new \App\AmazonLoader(),
        new \App\AmazonParser(),
        new \App\CsvOutput()
        );
$appication->run();

