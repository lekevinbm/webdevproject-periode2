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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    //user Routes
    Route::get('/user', 'UserController@index');
    Route::get('/user/edit', 'UserController@openEditPage');
    Route::post('/user/edit', 'UserController@edit');
    Route::get('/user/delete', 'UserController@delete');

    //auctions Routes
    Route::get('/auctions/myauctions','AuctionController@openMyAuctionsPage');
    Route::get('/auctions/new','AuctionController@newAuction');
    Route::post('/auctions/add','AuctionController@addAuction');
    Route::get('/auctions/open/{id}','AuctionController@openAuction');

    //watchlist Routes
    Route::get('/watchlist/add/{id}','WatchlistController@addToWatchlist');

});
