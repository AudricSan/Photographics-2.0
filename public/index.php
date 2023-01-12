<?php

// NOTE Use this namespace
use photographics\Route;

// NOTE Include class
include '../model/class/Route.php';
include '../model/class/env.php';

// NOTE Define a global basepath
define('BASEPATH', '/');

// NOTE This function just renders a simple header
function head()
{
  include_once('include/header.html');
}

function foot()
{
  include_once('include/footer.html');
}

function gallery($how)
{
  $_GET['id'] = $how;
  include_once('../view/index.html');
}

function adnav()
{
  include_once('include/adnav.html');
}

// SECTION Base Route
Route::add('/', function () {
  head();
  gallery(false);
  foot();
});









































































//SECTION ERROR
// ANCHOR 404 not found route
Route::pathNotFound(function ($path) {
  head();
  include('../view/error/404.php');
  echo 'The requested path "' . $path . '" was not found!';
  foot();
});

// ANCHOR 405 method not allowed route
Route::methodNotAllowed(function ($path, $method) {
  head();
  include('../view/error/405.php');
  echo 'The requested path "' . $path . '" exists. But the request method "' . $method . '" is not allowed on this path!';
  foot();
});
//!SECTION

// SECTION This route is for debugging only
// ANCHOR Return all known routes
Route::add('/routes', function () {
  $routes = Route::getAll();
  echo '<ul>';
  foreach ($routes as $route) {
    echo '<li>' . $route['expression'] . ' (' . $route['method'] . ')</li>';
  }
  echo '</ul>';
});
//!SECTION

// ANCHOR Run the Router with the given Basepath
Route::run(BASEPATH);
// ANCHOR Activez le mode sensible à la casse, les barres obliques de fin de ligne et le mode de correspondance multiple en définissant les paramètres à true.
// Route::run(BASEPATH, true, true, true) ;