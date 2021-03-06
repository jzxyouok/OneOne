<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


$active_multilang = defined('CNF_MULTILANG') ? CNF_LANG : 'en';
\App::setLocale($active_multilang);
if (defined('CNF_MULTILANG') && CNF_MULTILANG == '1') {

    $lang = (\Session::get('lang') != "" ? \Session::get('lang') : CNF_LANG);
    \App::setLocale($lang);
}

Route::get('/',     'HomeController@index');
Route::get('home',  'HomeController@index');


// 用户路由
Route::get('user/profile', 'UserController@getProfile');
Route::get('user/login', 'UserController@getLogin');
Route::get('admin/login', 'UserController@getLogin');
Route::get('admin', 'UserController@getLogin');
Route::get('user/register', 'UserController@getRegister');
Route::post('user/signin', 'UserController@postSignin');
Route::post('user/request', 'UserController@postRequest');
Route::get('user/logout', 'UserController@getLogout');
Route::post('user/create', 'UserController@postCreate');

Route::get('home/lang/{lang?}', 'HomeController@getLang');

// 路由拆分
include('backend/pageRoutes.php');
include('backend/moduleRoutes.php');

Route::get('/restric',function(){
    return view('errors.blocked');

});

Route::group(['middleware' => 'auth'], function()
{

    // 用户

    Route::post('user/saveprofile', 'UserController@postSaveprofile');


    Route::get('core/elfinder', 'Core\ElfinderController@getIndex');
    Route::post('core/elfinder', 'Core\ElfinderController@getIndex');


    Route::get('core/users', 'Core\UsersController@getIndex');
    Route::get('core/logs', 'Core\LogsController@getIndex');
    Route::get('core/pages', 'Core\PagesController@getIndex');
    Route::get('core/groups', 'Core\GroupsController@getIndex');
    Route::get('core/template', 'Core\TemplateController@getIndex');
    Route::get('core/users/blast', 'Core\UsersController@getBlast');

});

Route::group(['middleware' => 'auth'], function()
{

    Route::get('dashboard', 'DashboardController@getIndex');
//    Route::get('admin/index', 'DashboardController@getIndex');
    Route::get('system/info', 'SystemController@getSystemInfo');
    Route::get('system/home', 'SystemController@getHome');

    Route::get('admin/menu', 'Backend\MenuController@getIndex');
    Route::get('admin/menu/index/{id}', 'Backend\MenuController@getIndex');
    Route::get('admin/module', 'Backend\ModuleController@getIndex');


    Route::get('admin/tables', 'Backend\TablesController@getIndex');
    Route::get('admin/code', 'Backend\CodeController@getIndex');
    Route::get('admin/test', 'DashboardController@getIndex');

    Route::get('admin/config', 'Backend\ConfigController@getIndex');
    Route::get('admin/config/email', 'Backend\ConfigController@getEmail');
    Route::get('admin/config/security', 'Backend\ConfigController@getSecurity');
    Route::get('admin/config/translation', 'Backend\ConfigController@getTranslation');
    Route::get('admin/config/log', 'Backend\ConfigController@getLog');
    Route::get('admin/config/clearlog', 'Backend\ConfigController@getClearlog');
    Route::get('admin/config/addtranslation', 'Backend\ConfigController@getAddTranslation');

    // 消息通知
    Route::get('notification', 'NotificationController@getIndex');
    Route::post('notification/delete', 'NotificationController@postDelete');
    Route::get('notification/update', 'NotificationController@getUpdate');
    Route::get('notification/show', 'NotificationController@getShow');
    Route::post('notification/save', 'NotificationController@postSave');
    Route::get('notification/load', 'NotificationController@getLoad');

    // POST
    Route::post('admin/menu/saveorder', 'Backend\MenuController@postSaveorder');
    Route::post('admin/config/save', 'Backend\ConfigController@postSave');
    Route::post('admin/config/email', 'Backend\ConfigController@postEmail');
    Route::post('admin/config/login', 'Backend\ConfigController@postLogin');
    Route::post('admin/config/addtranslation', 'Backend\ConfigController@postAddTranslation');
    Route::post('admin/config/savetranslation', 'Backend\ConfigController@postSavetranslation');
    Route::post('admin/menu/save', 'Backend\MenuController@postSave');

});