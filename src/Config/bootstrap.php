<?php
$autoLoader = realpath(
    __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.
    'vendor'.DIRECTORY_SEPARATOR.'autoload.php'
);

/** @noinspection PhpIncludeInspection */
require $autoLoader;

//these headers may or may not be useful
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Max-Age: 1000');

\Slim\Slim::registerAutoloader();

// Load server specific configuration data.  Should
// check an environment variable load the appropriate
// server configuration file.
require 'config.php';

$app = new \Slim\Slim(
    $config['app']['slim-config']
);

$app->get('/',function (){
	echo "this is a test!";
});

$app->group('/api',function () use ($app){
    $app->post('/auth',function () use ($app){
        $body = $app->request()->getBody();
        $jsonObj = json_decode($body);
        //echo "username: ".$jsonObj->{'username'}."<br/>";
        //echo "password: ".$jsonObj->{'password'};
        $authSQLite = new SQLiteAuth();
        if ($authSQLite->authentcate($jsonObj->{'username'}, $jsonObj->{'password'}) == FALSE)
           $app->response->setStatus(401);
        else
           $app->response->setStatus(200);
    });
});

$app->run();
