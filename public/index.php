<?php

// Use this namespace
use photographics\Route;

// Session
session_start();

// Include class
include '../model/class/Route.php';
include '../model/class/env.php';

// Define a global basepath
define('BASEPATH', '/');

// This function is used to make the elements of the main page
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

// Base Route
Route::add('/', function () {
  head();
  gallery(false);
  foot();
});

Route::add('/([0-9]*)', function ($id) {
  head();
  include_once('../view/see.html');
  foot();
});

Route::add('/about', function () {
  head();
  include_once('../view/about.html');
  foot();
});

Route::add('/privacy', function () {
  head();
  include_once('../view/privacy.php');
  foot();
});

Route::add('/contact', function () {
  head();
  include_once('../view/contact.html');
  foot();
});


// Admin route
Route::add('/admin', function () {
  include_once('../model/class/Admin.php');
  include_once('../model/dao/AdminDAO.php');

  head();
  include_once('../view/admin/index.php');
  foot();
});

Route::add('/admin/login', function () {
  head();
  include_once('../view/admin/login.php');
  foot();
});

Route::add('/admin/log', function () {
  include_once('../model/class/Admin.php');
  include_once('../model/dao/AdminDAO.php');

  $adminDAO = new AdminDAO;
  $adminDAO->login($_POST);
}, 'post');

Route::add('/admin/add', function () {
  include_once('../model/class/Admin.php');
  include_once('../model/dao/AdminDAO.php');
  include_once('../model/class/Role.php');
  include_once('../model/dao/RoleDAO.php');

  head();
  include_once('../view/admin/addPoeple.php');
  foot();
});

Route::add('/admin/add/new', function () {
  include_once('../model/class/Admin.php');
  include_once('../model/dao/AdminDAO.php');

  $adminDAO = new AdminDAO;
  $adminDAO->store($_POST);
}, 'post');








































































//SECTION ERROR
// ANCHOR 404 not found route
Route::pathNotFound(function ($path) {
  head();
  include('../view/error/404.html');
  echo '<p>The requested path </p><span>"' . $path . '"</span><p> was not found!</p></div></main>';

  foot();
});

// ANCHOR 405 method not allowed route
Route::methodNotAllowed(function ($path, $method) {
  head();
  include('../view/error/405.html');
  echo '<p>The requested path "' . $path . '" exists. But the request method "</p><span>' . $method . '"</span><p> is not allowed on this path!</p></div></main>';
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