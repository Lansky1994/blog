<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require __DIR__ . '/vendor/autoload.php';

$loader = new FilesystemLoader('templates');
$view = new Environment($loader);

$app = AppFactory::create();

$app->get('/', function (Request $request, Response $response, $args) use ($view) {
    $body = $view->render('index.twig');
    $response->getBody()->write($body);
    return $response;
});

$app->get('/about', function (Request $request, Response $response, $args) use ($view) {
    $body = $view->render('about.twig', [
        'name' => 'Artsiom'
    ]);
    $response->getBody()->write($body);
    return $response;
});

$app->get('/signin', function (Request $request, Response $response, $args) use ($view) {

    session_start();

    if($_SESSION['user']){
       header('Location: profile.php');
       return;
    }


    function message ($pr) {
        if ($_SESSION[$pr]){
            return '<p class="msg"> ' . $_SESSION['message'] . '</p>';
        }
    }

    function off ($pr) {
        unset($_SESSION[$pr]);
    }

    $body = $view->render('login.twig', [
        'session3' => '<p>'.message('message').'</p>',
        'session4' => '<p>'.off('message').'</p>'

    ]);
    $response->getBody()->write($body);
    return $response;
});

$app->get('/{url_key}', function (Request $request, Response $response, $args) use ($view) {
    $body = $view->render('post.twig', [
        'url_key' => $args['url_key']
    ]);
    $response->getBody()->write($body);
    return $response;
});

$app->run();