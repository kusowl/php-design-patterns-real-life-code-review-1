<?php
session_start();
include __DIR__.'/vendor/autoload.php';
use App\Core\Config;
use App\Controllers\HomeController;
use App\Controllers\UserController;
use App\Core\DB;
use App\Core\Router;

$router = Router::init();
$router->get('/', HomeController::class, 'show');
$router->get('login', HomeController::class, 'showRegisterForm');

$host = Config::getValue('db_host');
$db = Config::getValue('db_name');
$username = Config::getValue('db_user');
$password = Config::getValue('db_pass');

DB::init($host, $db, $username, $password);
try {
    $db = DB::getInstance();
} catch (Exception $e) {
    die('Database connection failed: ' . $e->getMessage());
}
$dbHandle = $db->getConnection();

//TODO: Create Router class and make improvements

$route = str_replace('', "", $_SERVER['REQUEST_URI']);
$route = explode('/', $route);

$router->resolve('GET', $route[1]);
//
//switch ($route[1]??'') {
//
//    case '':
//    case 'home':
//    case 'index.php':
//       HomeController::show();
//        break;
//
//    case 'login':
//        HomeController::showLoginForm();
//        break;
//
//    case 'logout':
//        UserController::logout();
//        break;
//
//    case 'results':
//        HomeController::showResults();
//        break;
//
//    case 'register':
//        HomeController::showRegisterForm();
//        break;
//
//    case 'registerUser':
//        $user = new UserController($dbHandle);
//        $user->register();
//        break;
//
//    case 'loginUser':
//        $user = new UserController($dbHandle);
//        $user->login();
//        break;
//
// case 'search':
//        $user = new UserController($dbHandle);
//        $user->findUser();
//        break;
//
//    default:
//        include 'Views/404.php';
//        break;
//
//}
