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

Route::any('/', 'HomepageController@index');
Route::get('blog/{post}', 'PostController@show')->name('blog');
Route::get('author/{user}', 'UserController@show')->name('user.show');
Route::get('category/{slug}', 'CategoryController@show')->name('category.show');
Route::get('/{page}', 'PageController@show')->name('page');
Route::get('/inlink', 'MenufeaturedController@show')->name('inlink');
Route::view('demo', 'vendor.laravel-filemanager.demo');
Auth::routes(['register' => false]);
Route::group(['middleware' => ['auth'], 'prefix' => 'manage'], function () {
    Route::get('/dashboard', 'HomeController@index')->name('home.index');
    Route::view('media',  env('DEFAULT_ADMIN').'Media.index')->name('media.index');
    Route::resource('user', 'UserController')->except(['show']);
    Route::resource('role', 'RoleController');
    Route::resource('post', 'PostController')->except(['show']);
    Route::resource('page', 'PageController')->except(['show']);
    Route::resource('menu', 'MenuController');
    Route::resource('slider', 'SliderController');
    Route::resource('widget', 'WidgetController');
    Route::resource('category', 'CategoryController')->except(['show']);
    Route::resource('about', 'AboutController')->except(['show']);
    Route::resource('commentsetting', 'CommentsettingController');
    Route::resource('menufeatured', 'MenufeaturedController')->except(['show']);
    Route::resource('menuitem', 'MenuitemController');
});
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

// CUSTOM AUTH ROUTER
// Authentication Routes...
Route::get('auth/manage', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('auth/manage', 'Auth\LoginController@login');
Route::post('auth/logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
// Route::get('auth/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
// Route::post('auth/register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('auth/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('auth/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('auth/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('auth/password/reset', 'Auth\ResetPasswordController@reset');
