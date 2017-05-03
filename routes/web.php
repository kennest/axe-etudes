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

//Les etablissements connectés ne peuvent pas accèder à ces pages
Route::group(['middleware' => 'etablissements_guest'], function () {

    Route::get('/', [
        'as' => 'home',
        'uses' => 'Front\FrontController@index'
    ]);

    // Routes Connexion et enregistrements
    Route::get('register', 'Back\RegisterController@showRegistrationForm');
    Route::post('register', [
        'as' => 'dash_register',
        'uses' => 'Back\RegisterController@register'
    ]);
    Route::get('login', [
        'as' => 'dash_login_form',
        'uses' => 'Back\LoginController@showLoginForm'
    ]);

    Route::post('login', [
        'as' => 'dash_login',
        'uses' => 'Back\LoginController@authenticate'
    ]);

    //Routes
    Route::post('search', [
        'as' => 'doSearch',
        'uses' => 'Front\FrontController@search'
    ]);

});

//Seuls les etablissements connectés peuvent accèder à ces pages
Route::group(['prefix' => 'back', 'middleware' => 'etablissements_auth'], function () {
    Route::get('/index/', [
        'as' => 'dash_home',
        'uses' => 'Back\BackController@index'
    ]);
    Route::get('/logout', [
        'as' => 'dash_logout',
        'uses' => 'Back\LoginController@logout'
    ]);
    Route::resource('filiere', 'Back\Actions\FiliereController');
    Route::resource('frais', 'Back\Actions\FraisController');
    Route::resource('dossier', 'Back\Actions\DossierController');
    Route::resource('galerie', 'Back\Actions\GalerieController');
    Route::resource('niveau', 'Back\Actions\NiveauController');
    Route::resource('systeme', 'Back\Actions\SystemeController');


    //VERSEMENT RESOURCE
    Route::get('/createVersement/{id}', [
        'as' => 'versement.create',
        'uses' => 'Back\Actions\FraisController@createVersement'
    ]);
    Route::post('/storeVersement/', [
        'as' => 'versement.store',
        'uses' => 'Back\Actions\FraisController@storeVersement'
    ]);
    Route::get('/editVersement/{id}', [
        'as' => 'versement.edit',
        'uses' => 'Back\Actions\FraisController@editVersement'
    ]);
    Route::put('/updateVersement/', [
        'as' => 'versement.update',
        'uses' => 'Back\Actions\FraisController@updateVersement'
    ]);
    Route::delete('/destroyVersement/{id}', [
        'as' => 'versement.destroy',
        'uses' => 'Back\Actions\FraisController@destroyVersement'
    ]);

    //PHOTO RESOURCE
    Route::get('/createPhoto/', [
        'as' => 'galerie.createPhoto',
        'uses' => 'Back\Actions\GalerieController@createPhoto'
    ]);
    Route::post('/storePhoto/', [
        'as' => 'photo.store',
        'uses' => 'Back\Actions\GalerieController@storePhoto'
    ]);
    Route::get('/editPhoto/{id}', [
        'as' => 'photo.edit',
        'uses' => 'Back\Actions\GalerieController@editPhoto'
    ]);
    Route::put('/updatePhoto/{id}', [
        'as' => 'photo.update',
        'uses' => 'Back\Actions\GalerieController@updatePhoto'
    ]);
    Route::delete('/destroyPhoto/{id}', [
        'as' => 'photo.destroy',
        'uses' => 'Back\Actions\GalerieController@destroyPhoto'
    ]);
    //VIDEO RESOURCE
    Route::get('/listVideos/', [
        'as' => 'galerie.listVideos',
        'uses' => 'Back\Actions\GalerieController@listVideos'
    ]);

    //PROFIL RESOURCE
    Route::get('/ShowProfil/', [
        'as' => 'profil.show',
        'uses' => 'Back\Actions\ProfilController@show'
    ]);
    Route::get('/CreateInfoSup/', [
        'as' => 'profil.createInfoSup',
        'uses' => 'Back\Actions\ProfilController@CreateInfoSup'
    ]);
    Route::post('/StoreInfoSup/', [
        'as' => 'profil.storeInfoSup',
        'uses' => 'Back\Actions\ProfilController@StoreInfoSup'
    ]);
});
