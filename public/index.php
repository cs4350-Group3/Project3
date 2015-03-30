<?php

require '../vendor/autoload.php';

$app = new \Slim\Slim();

$app->get('/',function (){
	require '../src/view/login.html';
});

$app->get('/hello/:name', function ($name) {
    echo "Hello, $name";
});

$app->post('/auth',function (){
	echo "username: ".$_POST('username')." password: ".$_POST('password');
});

$app->run();