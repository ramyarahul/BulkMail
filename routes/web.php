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

Route::get('/','AuthenticationController@login')->name('login');
Route::post('user-login','AuthenticationController@UserLogin')->name('user.login');
Route::group(['middleware'=>'user_auth'],function(){
    Route::get('mail','MailController@Mail')->name('mail');
    Route::get('create-mail','MailController@CreateMail')->name('create.mail');
    Route::post('store-mail','MailController@StoreMail')->name('store.mail');
    Route::get('destroy-mail/{mail_id}','MailController@DestroyMail')->name('destroy.mail');
    Route::get('content','MailController@Content')->name('content');
    Route::post('image-upload', 'MailController@upload')->name('image.upload');
    Route::post('content-send', 'MailController@ContentSend')->name('content.send');
    Route::get('logout', 'AuthenticationController@Logout')->name('logout');

});
