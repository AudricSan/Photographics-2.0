<?php

// Use this namespace

use photographics\Admin;
use photographics\Route;

// Session
session_start();

// HUM
define('SITE_ROOT', realpath(dirname(__FILE__)));

// Include class
include '../model/class/Route.php';
include '../model/class/env.php';

// Admin Class & DAO
include_once('../model/class/Admin.php');
include_once('../model/dao/AdminDAO.php');

// Role Class & DAO
include_once('../model/class/Role.php');
include_once('../model/dao/RoleDAO.php');

// Tag Class & DAO
include_once('../model/class/Tag.php');
include_once('../model/dao/TagDAO.php');

// Picture Class & DAO
include_once('../model/class/Picture.php');
include_once('../model/dao/PictureDAO.php');

// PictureTag Class & DAO
include_once('../model/class/PictureTag.php');
include_once('../model/dao/PictureTagDAO.php');

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

function IsConnected()
{
  if (!isset($_SESSION['logged'])) {
    return false;
  } else {
    $adminDAO = new AdminDAO;
    $adminConnected = $adminDAO->fetch($_SESSION['logged']);

    if (!$adminConnected) {
      return false;
    } else {
      return true;
    }
  }
}

// Base Route
Route::add('/', function () {
  head();
  include_once('../view/index.php');
  foot();
});

Route::add('/see/([0-9]*)', function ($id) {
  head();
  include_once('../view/see.php');
  foot();
});

Route::add('/tag/([0-9]*)', function ($tagID) {
  head();
  include_once('../view/index.php');
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

Route::add('/admin/newpic', function () {

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
  if (IsConnected()) {
    head();
    include_once('../view/admin/doc.php');
    foot();
  } else {
    header('location: /');
  }
});

Route::add('/admin/disconnect', function () {
  if (IsConnected()) {
    $adminDAO = new AdminDAO;
    $adminDAO->disconnect();
  } else {
    header('location: /');
  }
});

// Admin edition Route
Route::add('/admin/log', function () {
    $adminDAO = new AdminDAO;
    $adminDAO->login($_POST);
}, 'post');

Route::add('/admin/adduser', function () {
  if (IsConnected()) {
    $adminDAO = new AdminDAO;
    $adminDAO->store($_POST);
  } else {
    header('location: /');
  }
}, 'post');

Route::add('/admin/edituser', function () {
  if (IsConnected()) {
    $adminDAO = new AdminDAO;
    $adminDAO->update($_POST['id'], $_POST);
  } else {
    header('location: /');
  }
}, 'post');

Route::add('/admin/deluser', function () {
  if (IsConnected()) {
    $adminDAO = new AdminDAO;
    $adminDAO->delete($_GET['user']);
  } else {
    header('location: /');
  }
}, 'get');

// Tag edition Route
Route::add('/admin/addtag', function () {
  if (IsConnected()) {
    $tagDAO = new TagDAO;
    $tagDAO->store($_POST);
  } else {
    header('location: /');
  }
}, 'post');

Route::add('/admin/edittag', function () {
  if (IsConnected()) {
    $tagDAO = new TagDAO;
    $tagDAO->update($_POST['id'], $_POST);
  } else {
    header('location: /');
  }
}, 'post');

Route::add('/admin/deltag', function () {
  if (IsConnected()) {
    $tagDAO = new TagDAO;
    $tagDAO->delete($_GET['tag']);
  } else {
    header('location: /');
  }
}, 'get');

// Picture edition Route
Route::add('/admin/addpic', function () {
  if (IsConnected()) {
    $pictureDAO = new PictureDAO;
    $pictureDAO->store($_POST);
  } else {
    header('location: /');
  }
}, 'post');

Route::add('/admin/editpic', function () {
  if (IsConnected()) {
    $pictureDAO = new PictureDAO;
    $pictureDAO->update($_POST['id'], $_POST);
  } else {
    header('location: /');
  }
}, 'post');

Route::add('/admin/delpic', function () {
  if (IsConnected()) {
    $pictureDAO = new PictureDAO;
    $pictureDAO->delete($_GET['pic']);
  } else {
    header('location: /');
  }
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