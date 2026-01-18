<?php

// 1. Load Composer autoloader FIRST
require __DIR__ . '/../vendor/autoload.php';

use Jenssegers\Blade\Blade;

// 2. Blade paths
$views = __DIR__ . '/../app/views';
$cache = __DIR__ . '/../cache/views';

// 3. Create Blade instance
$blade = new Blade($views, $cache);

// 4. Load Controller
require __DIR__ . '/../app/controllers/StudentController.php';

// 5. Create controller object
$controller = new StudentController($blade);

// 6. Simple routing
$page = $_GET['page'] ?? 'index';
$id   = $_GET['id'] ?? null;

switch ($page) {

    case 'create':
        $controller->create();
        break;

    case 'store':
        $controller->store();
        break;

    case 'edit':
        $controller->edit($id);
        break;

    case 'update':
        $controller->update($id);
        break;

    case 'delete':
        $controller->delete($id);
        break;

    default:
        $controller->index();
        break;
}
