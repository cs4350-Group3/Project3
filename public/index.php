<?php

require '../vendor/autoload.php';

$app = new \Slim\Slim();

$app->get('/',function (){
	echo "I am groot...";
});

$app->get('/hello/:name', function ($name) {
    echo "Hello, $name";
});

$app->post('/auth',function (){
	echo "instantiate your controller here and pass the request object to it...";
});

$app->run();