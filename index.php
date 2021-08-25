<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require __DIR__ . '/vendor/autoload.php';

$loader = new FilesystemLoader('templates');
$view = new Environment($loader);

function session(){
    session_start();
    if($_SESSION['user']) {
        header('Location: profile.php');
    }
}


if ($_SESSION['message']){
    echo '<p class="msg"> ' . $_SESSION['message'] . '</p>';
}

unset($_SESSION['message']);



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
    $body = $view->render('login.twig', [
        'session' => session(),
        'session2' => '<p class="msg">'.$_SESSION['msg'].'</p>'

    ]);
    $response->getBody()->write($body);
    return $response;
});



$app->run();