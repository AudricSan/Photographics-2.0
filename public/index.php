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
  include_once('include/header.php');
}

function foot()
{
  include_once('include/footer.php');
}

function gallery($how)
{
  $_GET['id'] = $how;
  include_once('../view/gallery.php');
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

Route::add('/([0-9]*)', function ($id) {
  head();
  gallery($id);
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

Route::add('/admin', function () {
  head();
  adnav();
  include_once('../view/admin/index.php');
});

Route::add('/admin/login', function () {
  head();
  include_once('../view/admin/login.php');
});

Route::add('/admin/logout', function () {
  session_start();
  session_unset();
  header('location: /');
});

Route::add('/admin/log', function () {
  include_once('../model/class/Admin.php');
  include_once('../model/dao/AdminDAO.php');

  $adminDAO = new AdminDAO;
  $adminDAO->login($_POST);
}, 'post');

Route::add('/admin/picture', function () {
  head();
  adnav();
  include_once('../view/admin/gallery.php');
});

Route::add('/admin/picture/add', function () {
  head();
  adnav();
  include_once('../view/admin/addPicture.php');
});

Route::add('/admin/picture/add/([0-9]*)', function ($id) {
  head();
  adnav();
  include_once('../view/admin/addPicture.php');
});

Route::add('/admin/picture/create', function () {

  include_once('../model/class/Picture.php');
  include_once('../model/dao/PictureDAO.php');

  $picture = new PictureDAO;
  $picture = $picture->store($_POST);
}, 'post');

Route::add('/admin/picture/edit', function () {

  include_once('../model/class/Picture.php');
  include_once('../model/dao/PictureDAO.php');

  $picture = new PictureDAO;
  $picture = $picture->update($_POST['picture_id'], $_POST);
}, 'post');

Route::add('/admin/picture/delete/([0-9]*)', function ($id) {
  head();
  adnav();

  include_once('../model/class/Picture.php');
  include_once('../model/dao/PictureDAO.php');

  $picture = new PictureDAO;
  $picture = $picture->delete($id);
});

Route::add('/admin/tag', function () {
  head();
  adnav();
  include_once('../view/admin/tags.php');
});

Route::add('/admin/tag/add/([0-9]*)', function ($id) {
  head();
  adnav();
  include_once('../view/admin/addTag.php');
});

Route::add('/admin/tag/add', function () {
  head();
  adnav();
  include_once('../view/admin/addTag.php');
});

Route::add('/admin/tag/create', function () {

  include_once('../model/class/Tag.php');
  include_once('../model/dao/TagDAO.php');

  $tagDao = new TagDAO;
  $tag = $tagDao->store($_POST);
}, 'post');

Route::add('/admin/tag/edit', function () {

  include_once('../model/class/Tag.php');
  include_once('../model/dao/TagDAO.php');

  $tagDao = new TagDAO;
  $tagDao->update($_POST['tag_id'], $_POST);
}, 'post');

Route::add('/admin/tag/delete/([0-9]*)', function ($id) {
  head();
  adnav();

  include_once('../model/class/Tag.php');
  include_once('../model/dao/TagDAO.php');

  $tagDao = new TagDAO;
  $tagDao->delete($id);
});

Route::add('/see/([0-9]*)', function ($id) {
  head();
  include_once('../view/see.php');
  foot();
});

Route::add('/admin/poeple', function () {
  head();
  adnav();
  include_once('../view/admin/poeple.php');
});

Route::add('/basicinfo/([0-9]*)/edit', function ($id) {
  include_once('../model/class/BasicInfo.php');
  include_once('../model/dao/BasicInfoDAO.php');

  $basicInfoDAO = new BasicInfoDAO;
  $basicInfoDAO->update($id, $_POST);
}, 'post');

Route::add('/basicinfo/([0-9]*)/delete', function ($id) {
  include_once('../model/class/BasicInfo.php');
  include_once('../model/dao/BasicInfoDAO.php');

  $basicInfoDAO = new BasicInfoDAO;
  $basicInfoDAO->delete($id);
});

Route::add('/admin/admin/add/([0-9]*)', function ($id) {
  head();
  adnav();

  include_once('../view/admin/addPoeple.php');
});

Route::add('/admin/admin/add', function () {
  head();
  adnav();
  include_once('../view/admin/addPoeple.php');
});

Route::add('/admin/admin/delete/([0-9]*)', function ($id) {
  include_once('../model/class/Admin.php');
  include_once('../model/dao/AdminDAO.php');

  $adminDAO = new AdminDAO;
  $adminDAO->delete($id);
});

Route::add('/admin/admin/create', function () {
  include_once('../model/class/Admin.php');
  include_once('../model/dao/AdminDAO.php');

  $adminDAO = new AdminDAO;
  $adminDAO->store($_POST);
}, 'post');

Route::add('/admin/admin/edit', function () {
  include_once('../model/class/Admin.php');
  include_once('../model/dao/AdminDAO.php');

  $adminDAO = new AdminDAO;
  $adminDAO->update($_POST['admin_id'], $_POST);
}, 'post');

// IS COMMING
Route::add('/admin/api', function () {
  head();
  adnav();
  include_once('../view/commingsoon.php');
});

Route::add('/admin/doc', function () {
  head();
  adnav();
  include_once('../view/admin/doc.php');
});

Route::add('/email/send', function () {
  include_once('../model/class/Mail.php');
  include_once('../model/dao/MailDAO.php');

  session_start();
  $mail = $_SESSION['basicinfo']['Photographer Mail'];

  $adminDAO = new MailDAO;
  $adminDAO->send($mail, $_POST);
}, 'post');














































































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