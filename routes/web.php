<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('home', 'HomeController@index')->name('home');

Route::get('post', 'PostController@index');
Route::post('addPost', 'PostController@add');
Route::post('editPost', 'PostController@edit_post');
Route::get('/post-view/{post_id}', 'PostController@view');
Route::get('/post-edit/{post_id}', 'PostController@edit');
Route::post('delete-post', 'PostController@delete');

Route::get('profile', 'ProfileController@index');
Route::post('UpdateProfile', 'ProfileController@update_profile');

Route::get('category', 'CategoryController@index');
Route::post('addCategory', 'CategoryController@add_category');

