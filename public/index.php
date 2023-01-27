<?php

// Use this namespace

use photographics\Admin;
use photographics\Route;

// Session
session_start();

// Include class
include '../model/class/Route.php';
include '../model/class/env.php';

include_once('../model/class/Admin.php');
include_once('../model/dao/AdminDAO.php');
include_once('../model/class/Role.php');
include_once('../model/dao/RoleDAO.php');

// Define a global basepath
define('BASEPATH', '/');

// This function is used to make the elements of the main page
function head()
{
  include_once('include/header.php');
}

function foot()
{
  include_once('include/footer.php');
}

function gallery($how)
{
  $_GET['id'] = $how;
  include_once('../view/index.php');
}

function adnav()
{
  include_once('include/adnav.php');
}

// Base Route
Route::add('/', function () {
  head();
  gallery(false);
  foot();
});

Route::add('/([0-9]*)', function ($id) {
  head();
  include_once('../view/see.php');
  foot();
});

Route::add('/about', function () {
  head();
  include_once('../view/about.php');
  foot();
});

Route::add('/privacy', function () {
  head();
  include_once('../view/privacy.php');
  foot();
});

Route::add('/contact', function () {
  head();
  include_once('../view/contact.php');
  foot();
});


// Admin page route
Route::add('/admin', function () {
  head();
  include_once('../view/admin/index.php');
  foot();
});

Route::add('/admin/login', function () {
  head();
  include_once('../view/admin/login.php');
  foot();
});

//// User
Route::add('/admin/user', function () {
  head();
  include_once('../view/admin/user.php');
  foot();
});

Route::add('/admin/newuser', function () {
  head();
  include_once('../view/admin/addUser.php');
  foot();
});

//// Picture
Route::add('/admin/picture', function () {
  head();
  include_once('../view/admin/picture.php');
  foot();
});

Route::add('/admin/newpicture', function () {
  head();
  include_once('../view/admin/addPicture.php');
  foot();
});

//// Tags
Route::add('/admin/tag', function () {
  head();
  include_once('../view/admin/tag.php');
  foot();
});

Route::add('/admin/newtag', function () {
  head();
  include_once('../view/admin/addTag.php');
  foot();
});

Route::add('/admin/doc', function () {
  head();
  include_once('../view/admin/doc.php');
  foot();
});

Route::add('/admin/disconnect', function () {
  $adminDAO = new AdminDAO;
  $adminDAO->disconnect();
});

// Admin edition Route
Route::add('/admin/log', function () {
  $adminDAO = new AdminDAO;
  $adminDAO->login($_POST);
}, 'post');

Route::add('/admin/adduser', function () {
  include_once('../model/class/Admin.php');
  include_once('../model/dao/AdminDAO.php');

  $adminDAO = new AdminDAO;
  $adminDAO->store($_POST);
}, 'post');

Route::add('/admin/edituser', function () {
  include_once('../model/class/Admin.php');
  include_once('../model/dao/AdminDAO.php');

  $adminDAO = new AdminDAO;
  $adminDAO->update($_POST['id'], $_POST);
}, 'post');

Route::add('/admin/deluser', function () {
  var_dump($_GET);
  $adminDAO = new AdminDAO;
  $adminDAO->delete($_GET['user']);
}, 'get');

Route::add('/admin/deluser', function () {

}, 'get');








































































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