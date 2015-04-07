<?php
$autoLoader = realpath(
    __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.
    'vendor'.DIRECTORY_SEPARATOR.'autoload.php'
);

/** @noinspection PhpIncludeInspection */
require $autoLoader;

\Slim\Slim::registerAutoloader();

// Load server specific configuration data.  Should
// check an environment variable load the appropriate
// server configuration file.
require 'config.php';

$app = new \Slim\Slim(
    $config['app']['slim-config']
);

$app->get('/',function (){
	echo "this is a test";
});

$app->group('/api',function () use ($app){
    $app->post('/auth',function () use ($app){
        $body = $app->request()->getBody();
        echo $_POST['username'];
        echo $_POST['password'];
        echo $body;
    });
});

//require file that defined the API.

$app->run();
