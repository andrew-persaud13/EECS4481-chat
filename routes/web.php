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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/register/anon', 'AnonRegisterController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/chat', 'ChatController@store')->name('makechat');
Route::get('/chat-list', 'ChatController@chat_list');
Route::post('/message-list', 'MsgController@messageList');
Route::post('/message', 'MsgController@store');
Route::post('/new-message-list', 'MsgController@newMessageList');
Route::get('/chat-update', 'ChatController@chatUpdate');

Route::post('/chat/transfer', 'ChatController@transfer');

Route::get('/upload', 'UploadController@getUpload')->name('upload');
Route::post('/upload', 'UploadController@postUpload');
Route::get('/upload_home', 'UploadController@get_upload_home')->name('upload_home');
Route::post('/upload_home', 'UploadController@post_upload_home');




