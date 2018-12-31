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

Route::get('/', 'FrontendController@index')->name('landing');
Route::get('blog/{slug}', 'FrontendController@detail')->name('detail');
Route::post('add_comment/{id}', 'FrontendController@comment')->name('comment');

Auth::routes();

Route::get('home', 'HomeController@index')->name('home');
Route::get('create-blog', 'BlogController@createBlog')->name('blog.create');
Route::post('store-blog', 'BlogController@storeBlog')->name('blog.store');
Route::get('blog/{slug}/detail', 'BlogController@detailBlog')->name('blog.detail');
Route::get('blog/{slug}/update', 'BlogController@updateBlog')->name('blog.update');
Route::post('update-blog', 'BlogController@saveBlog')->name('blog.save');
Route::post('blog/delete', 'BlogController@deleteBlog')->name('blog.delete');
Route::post('delete-comment', 'BlogController@deleteComment')->name('comment.delete');
