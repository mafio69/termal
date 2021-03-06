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
// Registration Routes...
//    Route::get('register', ['as' => 'register', 'uses' => 'Auth\RegisterController@showRegistrationForm']);
//    Route::post('register', ['as' => 'register.post', 'uses' => 'Auth\RegisterController@register']);
//Auth::routes();


// Login Routes...
Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
Route::post('login', ['as' => 'login.post', 'uses' => 'Auth\LoginController@login']);
Route::post('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);


// Password Reset Routes...
Route::get('password/reset', ['as' => 'password.reset', 'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm']);
Route::post('password/email', ['as' => 'password.email', 'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);
Route::get('password/reset/{token}', ['as' => 'password.reset.token', 'uses' => 'Auth\ResetPasswordController@showResetForm']);
Route::post('password/reset', ['as' => 'password.reset.post', 'uses' => 'Auth\ResetPasswordController@reset']);




//Grupa osób z przypisanymi rolami wszyscy
Route::group([
    'middleware' => 'role',
    'role' => ['admin', 'moderator', 'user']
], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/home-teraz', 'HomeController@teraz')->name('home-teraz');
    Route::resource('/klienci', 'CustomersController', ['except' => ['destroy', 'index']]);
    Route::get('/search', 'SearchController@customers')->name('search.customers');
    Route::resource('/notes', 'NotesController', ['except' => ['create', 'destroy']]);
//Route::get('/notes/{id}/edit','NotesController@edit');
//Route::get('/notes/{customer_id}/create','NotesController@create');
    Route::get('/notes/{customer_id}/list', 'NotesController@roster');
    Route::get('/notes/{customer_id}/create', ['as' => 'notes.customer_id.create', 'uses' => 'NotesController@create']);
//Route::resource('/users','UsersController')->middleware('role');

    Route::get('/klienci-status/{status_id?}', [
        'uses' => 'CustomersController@index',
        'as' => 'customer.status_id'
    ]);
    Route::get('/zdarzenie-dodaj/{cunsumer_id?}', [
        'uses' => 'EventsController@create',
        'as' => 'events-create.consumer_id'
    ]);
    Route::post('/zdarzenie/store', [
        'uses' => 'EventsController@store',
        'as' => 'events.store'
    ]);
    Route::get('/zdarzenie/{id}/edit', [
        'uses' => 'EventsController@edit',
        'as' => 'zdarzenie.id.edit'
    ]);
    Route::put('/zdarzenie/{id}', [
        'uses' => 'EventsController@update',
        'as' => 'zdarzenie.update'
    ]);
     Route::post('/zdarzenie/na-dzien', [
        'uses' => 'EventsController@showdate',
        'as' => 'zdarzenie.showdate'
    ]);
       Route::get('/zdarzenie/jutro', [
        'uses' => 'EventsController@tomorrow',
        'as' => 'zdarzenie.tomorrow'
    ]);
    Route::get('/zdarzenie', [
        'uses' => 'EventsController@index',
        'as' => 'zdarzenie.index'
    ]);
    Route::post('/zdarzenie/wylacz/{id}',[
        'uses' => 'EventsController@off',
        'as' => 'zdarzenie.wylacz'
    ]);
    Route::post('/zdarzenie/edit/{id}',[
        'uses' => 'EventsController@update_description',
        'as' => 'zdarzenie.edit'
    ]);
     Route::get('/zdarzenie/{customer_id}/create/{project_id}', [
        'uses' => 'EventsController@createProject',
        'as' => 'event.customer_id.create.project_id'
    ]);
    Route::get('/projekt', [
        'uses' => 'ProjectsController@index',
        'as' => 'project.index'
    ]);
    Route::get('/projekt/{customer_id}/create', [
        'uses' => 'ProjectsController@create',
        'as' => 'project.customer_id.create'
    ]);
    Route::get('/projekt/{id}', [
        'uses' => 'ProjectsController@show',
        'as' => 'project.show'
    ]);
   
    Route::post('/projekt/store', [
        'uses' => 'ProjectsController@store',
        'as' => 'projects.store'
    ]);
    Route::put('/projekt/{id}', [
        'uses' => 'ProjectsController@update',
        'as' => 'project.update'
    ]);
    Route::post('/projekt/wylacz/{id}',[
        'uses' => 'ProjectsController@off',
        'as' => 'project.wylacz'
    ]);

    Route::get('/osoba/{customer_id}/create', [
        'uses' => 'PersonController@create',
        'as' => 'person.customer_id.create'
    ]);
    Route::post('/osoba/store', [
        'uses' => 'PersonController@store',
        'as' => 'person.store'
    ]);
    Route::get('/osoba/{id}/edit', [
        'uses' => 'PersonController@edit',
        'as' => 'osoba.edit'
    ]);
    Route::put('/osoba/{id}', [
        'uses' => 'PersonController@update',
        'as' => 'osoba.update'
    ]);
    Route::get('/osoba/{id}', [
        'uses' => 'PersonController@show',
        'as' => 'osoba.show'
    ]);
    Route::get('/osoba', [
        'uses' => 'PersonController@index',
        'as' => 'osoba'
    ]);

});
////////////////////////////////////Grupa dostępu admina
Route::group([
    'middleware' => 'role',
    'role' => 'admin'
], function () {

    Route::get('users', [
        'uses' => 'UsersController@index',
        'as' => 'users'
    ]);

    Route::get('users/create', [
        'uses' => 'UsersController@create',
        'as' => 'users.create'
    ]);

    Route::post('users/store', [
        'uses' => 'UsersController@store',
        'as' => 'users.store'
    ]);

    Route::get('users/{id}/edit', [
        'uses' => 'UsersController@edit',
        'as' => 'users.edit'
    ]);

    Route::put('users/{id}', [
        'uses' => 'UsersController@update',
        'as' => 'users.update'
    ]);

    Route::delete('users/{id}', [
        'uses' => 'UsersController@destroy',
        'as' => 'users.delete'
    ]);
    Route::delete('notes/{id}', [
        'uses' => 'NotesController@destroy',
        'as' => 'notes.delete'
    ]);
    Route::delete('klienci/{id}', [
        'uses' => 'CustomersController@destroy',
        'as' => 'Customers.delete'
    ]);
    Route::delete('osoba/{id}', [
        'uses' => 'PersonController@destroy',
        'as' => 'osoba.delete'
    ]);

});