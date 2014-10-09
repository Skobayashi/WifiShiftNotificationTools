<?php

defined('ROOT') || define('ROOT', realpath(__DIR__.'/../'));
defined('LIB') || define('LIB', ROOT.'/src');
defined('APP') || define('APP', 'WSN');

$loader = require_once ROOT.'/vendor/autoload.php';
$loader->set('WSN', LIB);


// aws.iniの解析
$ini = parse_ini_file(ROOT.'/data/aws.ini');
putenv(sprintf('AWS_ACCESS_KEY_ID=%s',     $ini['key']));
putenv(sprintf('AWS_SECRET_ACCESS_KEY=%s', $ini['secret']));
putenv(sprintf('AWS_DEFAULT_REGION="%s"',    $ini['region']));

