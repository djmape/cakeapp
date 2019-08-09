<?php
use Cake\Core\Plugin;
use Cake\Routing\Route\DashedRoute;
use Cake\Routing\Router;

Router::defaultRouteClass(DashedRoute::class);

// New route we're adding for our tagged action.
// The trailing `*` tells CakePHP that this action has
// passed parameters.
Router::scope(
    '/articles',
    ['controller' => 'Articles'],
    function ($routes) {
        $routes->connect('/tagged/*', ['action' => 'tags']);
    }
);

Router::scope('/', function ($routes) {
    // Connect the default home and /pages/* routes.
    $routes->connect('/', [
        'prefix' => 'front',
        'controller' => 'home',
        'action' => 'index'
    ]);
    $routes->connect('/pages/*', [
        'controller' => 'Pages',
        'action' => 'display'
    ]);
    $routes->connect('pages/announcement', [
        'controller' => 'Pages',
        'action' => 'announcement'
    ]);

    // front announcement
    $routes->connect('/announcement/', [
        'prefix' => 'front',
        'controller' => 'announcement',
        'action' => 'index'
    ]);

    $routes->connect('/announcement/view/*', [
        'prefix' => 'front',
        'controller' => 'announcement',
        'action' => 'view'
    ]);

    // front events
    $routes->connect('/events/*', [
        'prefix' => 'front',
        'controller' => 'events',
        'action' => 'index'
    ]);

    $routes->connect('/events/view/*', [
        'prefix' => 'front',
        'controller' => 'events',
        'action' => 'view'
    ]);

    // front courses
    $routes->connect('/courses/*', [
        'prefix' => 'front',
        'controller' => 'courses',
        'action' => 'view'
    ]);

    // front organizations
    $routes->connect('/organizations/*', [
        'prefix' => 'front',
        'controller' => 'organizations',
        'action' => 'view'
    ]);

    // front offices
    $routes->connect('/offices/*', [
        'prefix' => 'front',
        'controller' => 'offices',
        'action' => 'index'
    ]);

    $routes->connect('/offices/view/*', [
        'prefix' => 'front',
        'controller' => 'offices',
        'action' => 'view'
    ]);

    // front employees
    $routes->connect('/employees/', [
        'prefix' => 'front',
        'controller' => 'employees',
        'action' => 'index'
    ]);

    // front about
    $routes->connect('/about/', [
        'prefix' => 'front',
        'controller' => 'abouts',
        'action' => 'index'
    ]);

    // front handbook
    $routes->connect('/handbook/', [
        'prefix' => 'front',
        'controller' => 'abouts',
        'action' => 'view'
    ]);

    // front contacts
    $routes->connect('/contacts/', [
        'prefix' => 'front',
        'controller' => 'contacts',
        'action' => 'index'
    ]);

    $routes->connect('/viewEvent/*', [
        'prefix' => 'admin','controller' => 'events','action' => 'view']);

    // Connect the conventions based default routes.
    $routes->fallbacks();
});


Router::prefix('Admin', function ($routes) {
    // All routes here will be prefixed with `/admin`
    // And have the prefix => admin route element added.
    $routes->fallbacks(DashedRoute::class);
    $routes->connect('/', ['controller' => 'Home', 'action' => 'index']);
    $routes->connect('/abouts', ['controller' => 'Abouts', 'action' => 'index']);
    $routes->connect('/employee-positions/edit', ['controller' => 'EmployeePositions', 'action' => 'edit']);
    $routes->connect('/deletes/*', ['controller' => 'ContactNumbers','action' => 'deletes']);
});


Router::prefix('Front', function ($routes) {
    // All routes here will be prefixed with `/admin`
    // And have the prefix => admin route element added.
    $routes->fallbacks(DashedRoute::class);
    $routes->connect('/abouts/handbook', ['controller' => 'Abouts', 'action' => 'view']);
    //$routes->connect('/abouts/contacts', ['controller' => 'Abouts', 'action' => 'add']);
});