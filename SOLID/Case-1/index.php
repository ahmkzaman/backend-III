<?php
session_start();
require_once 'src/Auth.php';
require_once 'src/KeywordController.php';
require_once 'src/SearchProvider.php';
require_once 'src/GoogleSearchProvider.php';
require_once 'src/SearchResultRepository.php';
require_once 'src/KeywordService.php';
require_once 'src/Database.php';

$db = new Database('mysql:host=localhost;dbname=database_name', 'root', 'password');
$searchProvider = new GoogleSearchProvider();
$ResultRepo = new SearchResultRepository($db);
$keywordService = new KeywordService($searchProvider, $ResultRepo);
$auth = new Auth($db);
$controller = new KeywordController($keywordService, $auth);

//Routing 

$method = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['REQUEST_URI'];

header('Content-Type: application/json');

if ($method === 'POST' && $path === '/login') {
    echo $auth->login($_POST['username'], $_POST['password']);
} elseif ($method === 'POST' && $path === '/logout') {
    echo $auth->logout();
} elseif ($method === 'POST' && $path === '/upload-keywords') {
    if ($auth->isAuthenticated()) {
        echo $controller->upload($_FILES);
    } else {
        echo json_encode(['error' => 'Unauthorized'], 401);
    }
} else {
    echo json_encode(['error' => 'Not Found'], 404);
}
