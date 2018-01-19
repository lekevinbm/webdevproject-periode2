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
Route::get('/lang/{locale}', 'HomeController@setLanguage');

Route::get('/', 'HomeController@index')->name('home');
Route::get('/auctions','AuctionController@overview');
Route::get('/auctions/sortby/{option}','FilterController@sortAuctionBy');
Route::get('/auctions/filter/{option}','FilterController@filterAuctions');
Route::get('/auctions/deleteFilter/{option}','FilterController@deleteAFilter');
Route::get('/auctions/deleteAllFilters','FilterController@deleteAllFilters');
Route::get('/auctions/open/{id}','AuctionController@openAuction');

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
    Route::get('/auctions/buy/{id}','AuctionController@buyAuction');

    //watchlist Routes
    Route::get('/watchlist','WatchlistController@showWatchlist');
    Route::get('/watchlist/add/{id}','WatchlistController@addToWatchlist');
    Route::get('/watchlist/remove/{id}','WatchlistController@removeFromWatchlist');
    Route::get('/watchlist/clear','WatchlistController@clearWatchlist');
    Route::post('/watchlist/remove','WatchlistController@removeSelectedFromWatchlist');

    //bids
    Route::post('/bids/add/{id}','BidController@addBid');
    Route::get('/bids/mybids','BidController@showMybids');

});
