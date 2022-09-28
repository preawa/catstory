<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Vendor;
use Illuminate\Support\Facades\Input;
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


Route::get('/map', 'MapController@index')->name('map');
Route::get('/map1', 'MapController@index1')->name('map1');
Route::get('/map2', 'MapController@index2')->name('map2');

// Route::get('/catowner', 'CatownerController@index')->name('catowner');

// Route::get('/pending', 'CatownerController@pending')->name('pending');
// Route::get('changeStatus', 'CatownerController@changeStatus')->name('change.status');
// Route::put('/pending/{id}/approve', 'CatownerController@approval')->name('catowner.approve');

Route::get('/chat', 'ChatController@index')->name('chat');
Route::get('/message/{id}', 'ChatController@getMessage')->name('message');
Route::post('message', 'ChatController@sendMessage');

Route::get('posts', 'PostController@index')->name('post.index');
Route::get('post/{slug}', 'PostController@details')->name('post.details');


Route::get('/category/{slug}', 'PostController@postByCategory')->name('category.posts');
Route::get('/tag/{slug}', 'PostController@postByTag')->name('tag.posts');

Route::get('profile/{username}', 'AuthorController@profile')->name('author.profile');


Route::get('/search', 'SearchController@search')->name('search');


Auth::routes();


Route::group(['middleware' => ['auth']], function () {
    Route::post('favorite/{post}/add', 'FavoriteController@add')->name('post.favorite');
    Route::post('comment/{post}', 'CommentController@store')->name('comment.store');
});


Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {

    Route::get('dashboard', 'DashboardController@index')->name('dashboard');

    Route::resource('map', 'CatController');
    Route::get('/location/map', 'CatController@location')->name('map.location');
    Route::get('/pending/map', 'CatController@pending')->name('map.pending');
    Route::put('/map/{id}/approve', 'CatController@approval')->name('map.approve');

    Route::resource('totelmap', 'CatownerController');
    Route::resource('catowner', 'CatownerController');
    Route::get('/pending/catowner', 'CatownerController@pending')->name('catowner.pending');
    Route::put('/catowner/{id}/approve', 'CatownerController@approval')->name('catowner.approve');

    Route::resource('form', 'FormController');

    Route::get('settings', 'SettingsController@index')->name('settings');
    Route::put('profile-update', 'SettingsController@updateProfile')->name('profile.update');
    Route::put('password-update', 'SettingsController@updatePassword')->name('password.update');

    Route::resource('tag', 'TagController');
    Route::resource('category', 'CategoryController');
    Route::resource('post', 'PostController');

    Route::get('/pending/post', 'PostController@pending')->name('post.pending');
    Route::put('/post/{id}/approve', 'PostController@approval')->name('post.approve');

    Route::get('/favorite', 'FavoriteController@index')->name('favorite.index');

    Route::get('authors', 'AuthorController@index')->name('author.index');
    Route::delete('authors/{id}', 'AuthorController@destroy')->name('author.destroy');

    Route::get('comments', 'CommentController@index')->name('comment.index');
    Route::delete('comments/{id}', 'CommentController@destroy')->name('comment.destroy');

    Route::get('forms', 'FormController@index')->name('form.index');
});

Route::group(['as' => 'author.', 'prefix' => 'author', 'namespace' => 'Author', 'middleware' => ['auth', 'author']], function () {

    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('/dashboard1', 'DashboardController@index1')->name('dashboard1');

    Route::resource('map', 'MapController');

    Route::resource('catowner', 'CatController');
    // Route::get('catowner/show', 'CatController@show')->name('catowner.show');
    Route::get('catowner/duplicate', 'CatController@populatecats');
    Route::get('catowner/populatecats', 'CatController@populatecats')->name('catowner.populatecats');
    // Route::get('catowner/duplicate', 'CatController@duplicate')->name('catowner.duplicate');
    Route::get('catowner/booking/{id}', 'CatController@booking')->name('catowner.booking');

    Route::get('/pending/catowner', 'CatownerController@pending')->name('catowner.pending');
    Route::put('/catowner/{id}/approve', 'CatownerController@approval')->name('catowner.approve');
    Route::get('/location/catowner', 'CatController@location')->name('catowner.location');
    // Route::delete('/{id}/catowner', 'CatownerController@destroy')->name('catowner.destroy');
    Route::delete('dashboard/{id}', 'DashboardController@destroy')->name('dashboard.destroy');
    Route::post('/catowner/{cat}', 'CatController@delete_duplicate')->name('catowner.delcat');

    // Route::post('/catowner/{cat}', 'CatownerController@delete_dash')->name('catowner.delcat');

    Route::resource('adopt', 'AdoptController');

    Route::get('comments', 'CommentController@index')->name('comment.index');
    Route::delete('comments/{id}', 'CommentController@destroy')->name('comment.destroy');

    Route::get('settings', 'SettingsController@index')->name('settings');
    Route::put('profile-update', 'SettingsController@updateProfile')->name('profile.update');
    Route::put('password-update', 'SettingsController@updatePassword')->name('password.update');

    Route::resource('post', 'PostController');
    // Route::get('post/{post}', function ($post) {
    //     return 'post' . $post;
    // });


    // Route::get('/edit/post', 'PostController@edit')->name('dashboard');
    // Route::get('post/{post}/edit', 'PostController@edit')->name('post.edit');
    Route::get('/favorite', 'FavoriteController@index')->name('favorite.index');


    Route::resource('customers', 'CustomerController');
    Route::get('customers/{id}/edit/', 'CustomerController@edit');
});

View::composer('layouts.frontend.partial.footer', function ($view) {
    $categories = App\Category::all();
    $view->with('categories', $categories);
});
