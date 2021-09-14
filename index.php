<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

use Blog\LatestPosts;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Blog\PostMapper;


require __DIR__ . '/vendor/autoload.php';

$loader = new FilesystemLoader('templates');
$view = new Environment($loader);

$config = include 'config/database.php';
$dsn = $config['dsn'];
$username = $config['username'];
$password = $config['password'];

try {
    $connect = new PDO($dsn, $username, $password);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connect->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $exception) {
    echo 'Database error: ' . $exception->getMessage();
    die();
}

$app = AppFactory::create();


$app->get('/', function (Request $request, Response $response) use ($view, $connect) {
    $latestPost = new LatestPosts($connect);
    $posts = $latestPost->get(2);
    $body = $view->render('index.twig', [
        'posts' => $posts,
    ]);
    $response->getBody()->write($body);
    return $response;
});

$app->get('/about', function (Request $request, Response $response) use ($view) {
    $body = $view->render('about.twig', [
        'name' => 'Artsiom'
    ]);
    $response->getBody()->write($body);
    return $response;
});

$app->get('/signin', function (Request $request, Response $response) use ($view) {

    session_start();

    if($_SESSION['user']){
       header('Location: /profile');
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

$app->get('/signup', function (Request $request, Response $response) use ($view) {

    session_start();

    if ($_SESSION['user']){
        header('Location: /profile');
        return;
    }

    function message ($pr) {
        if ($_SESSION[$pr]) {
            return '<p class="msg">' . $_SESSION[$pr] . '</p>';
        }
    }

    function off ($pr) {
        unset($_SESSION[$pr]);
    }

    $body = $view->render('register.twig', [
        'session' => '<p>'.message('message').'</p>',
        'session2' => '<p>'.off('message').'</p>'
    ]);
    $response->getBody()->write($body);
    return $response;
});

$app->get('/profile', function (Request $request, Response  $response) use ($view) {
    session_start();

    if(!$_SESSION['user']) {
        header('Location: /signin');
        return;
    }

    $body = $view->render('profile.twig', [
        'session' => $_SESSION['user']['avatar'],
        'session2' => $_SESSION['user']['name'],
        'session3' => $_SESSION['user']['email']
    ]);
    $response->getBody()->write($body);
    return $response;
});

$app->get('/blog[/{page}]', function (Request $request, Response $response, $args) use ($view, $connect){

    $postMapper = new PostMapper($connect);
    //$page = isset($args['page']) ? (int) $args['page'] : 1;
    $limit = 2;

    $page = (int) $args['page'];

    if ($page == 0) {
        $body = $view->render('not-found.twig');
    }else{
        $posts = $postMapper->getList($page, $limit, 'DESC');
        $body = $view->render('blog.twig', [
            'posts' => $posts
        ]);
    }

    $response->getBody()->write($body);
    return $response;
});


$app->redirect('/blog/', '/blog/1');

$app->get('/{url_key}', function (Request $request, Response $response, $args) use ($view, $connect) {
    $postMapper = new PostMapper($connect);
    $post = $postMapper->getBYUrlKey((string) $args['url_key']);

    if (empty($post)) {
        $body = $view->render('not-found.twig');
    } else {
        $body = $view->render('post.twig', [
            'post' => $post,
        ]);
    }

    $response->getBody()->write($body);
    return $response;
});


$app->run();