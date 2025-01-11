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

Route::group([ 'namespace' => 'App\Http\Controllers\Admin', 'prefix' => 'admin' ], function(){

    // login routes
    Route::get('login', 'AuthController@login')->name('admin/login');
    Route::post('login', 'AuthController@check_login')->name('admin/check-login');

    Route::get('/lawyers', 'HomeController@lawyers')->name('get/lawyers');
    Route::get('/services', 'HomeController@services')->name('get/services');
    Route::get('/countries', 'HomeController@countries')->name('get/countries');
    Route::get('/country/cities', 'HomeController@country_cities')->name('get/country/cities');
    Route::get('/cities', 'HomeController@cities')->name('get/cities');
    Route::get('/languages', 'HomeController@languages')->name('get/languages');
    Route::get('/sections', 'HomeController@sections')->name('get/sections');
    Route::get('/users', 'HomeController@users')->name('get/users');
    Route::get('/subjects', 'HomeController@subjects')->name('get/subjects');
    Route::get('/legal_fields', 'HomeController@legal_fields')->name('get/legal_fields');

    Route::group(['middleware' => ['adminLogin', 'limitReq']],function(){

        Route::get('/home', 'HomeController@home')->name('admin/index');

        Route::get('logout', 'AuthController@logout')->name('admin/logout');

        // admin routes
        Route::get('admins/info', 'AdminController@info')->name('admin/admins/info');
        Route::post('admins/info-update', 'AdminController@info_update')->name('admin/admins/info-update');
        Route::post('admins/change-password', 'AdminController@change_password')->name('admin/admins/change-password');

        // chat routes
        Route::get('/chats/index', 'ChatController@index')->name('admin/chats/index');
        Route::get('/chats/test', 'ChatController@test')->name('admin/test/index');
        Route::post('/chats/search', 'ChatController@search')->name('admin/chats/search');

        Route::get('admins/index/{offset?}/{limit?}', 'AdminController@index')->name('admin/admins/index');
        Route::get('admins/create', 'AdminController@create')->name('admin/admins/create');
        Route::post('admins/create', 'AdminController@store')->name('admin/admins/store');
        Route::get('admins/activate', 'AdminController@activate')->name('admin/admins/activate');
        Route::get('admins/delete', 'AdminController@delete')->name('admin/admins/delete');
        Route::post('admins/pagination/{offset?}/{limit?}', 'AdminController@pagination')->name('admin/admins/pagination');
        Route::post('admins/search', 'AdminController@search')->name('admin/admins/search');
        Route::post('admins/search/byColumn', 'AdminController@searchByColumn')->name('admin/admins/search/byColumn');
        Route::get('admins/archives/{offset?}/{limit?}', 'AdminController@archives')->name('admin/admins/archives');
        Route::get('admins/back', 'AdminController@back')->name('admin/admins/back');
        Route::post('admins/pagination/archives/{offset?}/{limit?}', 'AdminController@archivesPagination')->name('admin/admins/pagination/archives');
        Route::post('admins/search/archives', 'AdminController@archivesSearch')->name('admin/admins/search/archives');
        Route::post('admins/search/byColumn/archives', 'AdminController@archivesSearchByColumn')->name('admin/admins/search/byColumn/archives');



        // user routes
        Route::get('users/index/{offset?}/{limit?}', 'UserController@index')->name('admin/users/index');
        Route::get('users/create', 'UserController@create')->name('admin/users/create');
        Route::post('users/create', 'UserController@store')->name('admin/users/store');
        Route::get('users/edit/{id?}', 'UserController@edit')->name('admin/users/edit');
        Route::post('users/edit/{id}', 'UserController@update')->name('admin/users/update');
        Route::get('users/activate', 'UserController@activate')->name('admin/users/activate');
        Route::get('users/delete', 'UserController@delete')->name('admin/users/delete');
        Route::post('users/pagination/{offset?}/{limit?}', 'UserController@pagination')->name('admin/users/pagination');
        Route::post('users/search', 'UserController@search')->name('admin/users/search');
        Route::post('users/search/byColumn', 'UserController@searchByColumn')->name('admin/users/search/byColumn');
        Route::get('users/archives/{offset?}/{limit?}', 'UserController@archives')->name('admin/users/archives');
        Route::get('users/back', 'UserController@back')->name('admin/users/back');
        Route::post('users/pagination/archives/{offset?}/{limit?}', 'UserController@archivesPagination')->name('admin/users/pagination/archives');
        Route::post('users/search/archives', 'UserController@archivesSearch')->name('admin/users/search/archives');
        Route::post('users/search/byColumn/archives', 'UserController@archivesSearchByColumn')->name('admin/users/search/byColumn/archives');



        // lawyer routes
        Route::get('lawyers/index/{offset?}/{limit?}', 'LawyerController@index')->name('admin/lawyers/index');
        Route::get('lawyers/create', 'LawyerController@create')->name('admin/lawyers/create');
        Route::post('lawyers/create', 'LawyerController@store')->name('admin/lawyers/store');
        Route::get('lawyers/edit/{id?}', 'LawyerController@edit')->name('admin/lawyers/edit');
        Route::post('lawyers/edit/{id}', 'LawyerController@update')->name('admin/lawyers/update');
        Route::get('lawyers/activate', 'LawyerController@activate')->name('admin/lawyers/activate');
        Route::get('lawyers/delete', 'LawyerController@delete')->name('admin/lawyers/delete');
        Route::post('lawyers/pagination/{offset?}/{limit?}', 'LawyerController@pagination')->name('admin/lawyers/pagination');
        Route::post('lawyers/search', 'LawyerController@search')->name('admin/lawyers/search');
        Route::post('lawyers/search/byColumn', 'LawyerController@searchByColumn')->name('admin/lawyers/search/byColumn');
        Route::get('lawyers/archives/{offset?}/{limit?}', 'LawyerController@archives')->name('admin/lawyers/archives');
        Route::get('lawyers/back', 'LawyerController@back')->name('admin/lawyers/back');
        Route::post('lawyers/pagination/archives/{offset?}/{limit?}', 'LawyerController@archivesPagination')->name('admin/lawyers/pagination/archives');
        Route::post('lawyers/search/archives', 'LawyerController@archivesSearch')->name('admin/lawyers/search/archives');
        Route::post('lawyers/search/byColumn/archives', 'LawyerController@archivesSearchByColumn')->name('admin/lawyers/search/byColumn/archives');



        // country routes
        Route::get('countries/index/{offset?}/{limit?}', 'CountryController@index')->name('admin/countries/index');
        Route::get('countries/create', 'CountryController@create')->name('admin/countries/create');
        Route::post('countries/create', 'CountryController@store')->name('admin/countries/store');
        Route::get('countries/edit/{id?}', 'CountryController@edit')->name('admin/countries/edit');
        Route::post('countries/edit/{id}', 'CountryController@update')->name('admin/countries/update');
        Route::get('countries/activate', 'CountryController@activate')->name('admin/countries/activate');
        Route::get('countries/delete', 'CountryController@delete')->name('admin/countries/delete');
        Route::post('countries/pagination/{offset?}/{limit?}', 'CountryController@pagination')->name('admin/countries/pagination');
        Route::post('countries/search', 'CountryController@search')->name('admin/countries/search');
        Route::post('countries/search/byColumn', 'CountryController@searchByColumn')->name('admin/countries/search/byColumn');
        Route::get('countries/archives/{offset?}/{limit?}', 'CountryController@archives')->name('admin/countries/archives');
        Route::get('countries/back', 'CountryController@back')->name('admin/countries/back');
        Route::post('countries/pagination/archives/{offset?}/{limit?}', 'CountryController@archivesPagination')->name('admin/countries/pagination/archives');
        Route::post('countries/search/archives', 'CountryController@archivesSearch')->name('admin/countries/search/archives');
        Route::post('countries/search/byColumn/archives', 'CountryController@archivesSearchByColumn')->name('admin/countries/search/byColumn/archives');



        // city routes
        Route::get('cities/index/{offset?}/{limit?}', 'CityController@index')->name('admin/cities/index');
        Route::get('cities/create', 'CityController@create')->name('admin/cities/create');
        Route::post('cities/create', 'CityController@store')->name('admin/cities/store');
        Route::get('cities/edit/{id?}', 'CityController@edit')->name('admin/cities/edit');
        Route::post('cities/edit/{id}', 'CityController@update')->name('admin/cities/update');
        Route::get('cities/activate', 'CityController@activate')->name('admin/cities/activate');
        Route::get('cities/delete', 'CityController@delete')->name('admin/cities/delete');
        Route::post('cities/pagination/{offset?}/{limit?}', 'CityController@pagination')->name('admin/cities/pagination');
        Route::post('cities/search', 'CityController@search')->name('admin/cities/search');
        Route::post('cities/search/byColumn', 'CityController@searchByColumn')->name('admin/cities/search/byColumn');
        Route::get('cities/archives/{offset?}/{limit?}', 'CityController@archives')->name('admin/cities/archives');
        Route::get('cities/back', 'CityController@back')->name('admin/cities/back');
        Route::post('cities/pagination/archives/{offset?}/{limit?}', 'CityController@archivesPagination')->name('admin/cities/pagination/archives');
        Route::post('cities/search/archives', 'CityController@archivesSearch')->name('admin/cities/search/archives');
        Route::post('cities/search/byColumn/archives', 'CityController@archivesSearchByColumn')->name('admin/cities/search/byColumn/archives');



        // language routes
        Route::get('languages/index/{offset?}/{limit?}', 'LanguageController@index')->name('admin/languages/index');
        Route::get('languages/create', 'LanguageController@create')->name('admin/languages/create');
        Route::post('languages/create', 'LanguageController@store')->name('admin/languages/store');
        Route::get('languages/edit/{id?}', 'LanguageController@edit')->name('admin/languages/edit');
        Route::post('languages/edit/{id}', 'LanguageController@update')->name('admin/languages/update');
        Route::get('languages/activate', 'LanguageController@activate')->name('admin/languages/activate');
        Route::get('languages/delete', 'LanguageController@delete')->name('admin/languages/delete');
        Route::post('languages/pagination/{offset?}/{limit?}', 'LanguageController@pagination')->name('admin/languages/pagination');
        Route::post('languages/search', 'LanguageController@search')->name('admin/languages/search');
        Route::post('languages/search/byColumn', 'LanguageController@searchByColumn')->name('admin/languages/search/byColumn');
        Route::get('languages/archives/{offset?}/{limit?}', 'LanguageController@archives')->name('admin/languages/archives');
        Route::get('languages/back', 'LanguageController@back')->name('admin/languages/back');
        Route::post('languages/pagination/archives/{offset?}/{limit?}', 'LanguageController@archivesPagination')->name('admin/languages/pagination/archives');
        Route::post('languages/search/archives', 'LanguageController@archivesSearch')->name('admin/languages/search/archives');
        Route::post('languages/search/byColumn/archives', 'LanguageController@archivesSearchByColumn')->name('admin/languages/search/byColumn/archives');



        // about routes
        Route::get('abouts/index/{offset?}/{limit?}', 'AboutController@index')->name('admin/abouts/index');
        Route::get('abouts/create', 'AboutController@create')->name('admin/abouts/create');
        Route::post('abouts/create', 'AboutController@store')->name('admin/abouts/store');
        Route::get('abouts/edit/{id?}', 'AboutController@edit')->name('admin/abouts/edit');
        Route::post('abouts/edit/{id}', 'AboutController@update')->name('admin/abouts/update');
        Route::get('abouts/activate', 'AboutController@activate')->name('admin/abouts/activate');
        Route::get('abouts/delete', 'AboutController@delete')->name('admin/abouts/delete');
        Route::post('abouts/pagination/{offset?}/{limit?}', 'AboutController@pagination')->name('admin/abouts/pagination');
        Route::post('abouts/search', 'AboutController@search')->name('admin/abouts/search');
        Route::post('abouts/search/byColumn', 'AboutController@searchByColumn')->name('admin/abouts/search/byColumn');
        Route::get('abouts/archives/{offset?}/{limit?}', 'AboutController@archives')->name('admin/abouts/archives');
        Route::get('abouts/back', 'AboutController@back')->name('admin/abouts/back');
        Route::post('abouts/pagination/archives/{offset?}/{limit?}', 'AboutController@archivesPagination')->name('admin/abouts/pagination/archives');
        Route::post('abouts/search/archives', 'AboutController@archivesSearch')->name('admin/abouts/search/archives');
        Route::post('abouts/search/byColumn/archives', 'AboutController@archivesSearchByColumn')->name('admin/abouts/search/byColumn/archives');



        // setting routes
        Route::get('settings/index/{offset?}/{limit?}', 'SettingController@index')->name('admin/settings/index');
        Route::get('settings/create', 'SettingController@create')->name('admin/settings/create');
        Route::post('settings/create', 'SettingController@store')->name('admin/settings/store');
        Route::get('settings/edit/{id?}', 'SettingController@edit')->name('admin/settings/edit');
        Route::post('settings/edit/{id}', 'SettingController@update')->name('admin/settings/update');
        Route::get('settings/activate', 'SettingController@activate')->name('admin/settings/activate');
        Route::get('settings/delete', 'SettingController@delete')->name('admin/settings/delete');
        Route::post('settings/pagination/{offset?}/{limit?}', 'SettingController@pagination')->name('admin/settings/pagination');
        Route::post('settings/search', 'SettingController@search')->name('admin/settings/search');
        Route::post('settings/search/byColumn', 'SettingController@searchByColumn')->name('admin/settings/search/byColumn');
        Route::get('settings/archives/{offset?}/{limit?}', 'SettingController@archives')->name('admin/settings/archives');
        Route::get('settings/back', 'SettingController@back')->name('admin/settings/back');
        Route::post('settings/pagination/archives/{offset?}/{limit?}', 'SettingController@archivesPagination')->name('admin/settings/pagination/archives');
        Route::post('settings/search/archives', 'SettingController@archivesSearch')->name('admin/settings/search/archives');
        Route::post('settings/search/byColumn/archives', 'SettingController@archivesSearchByColumn')->name('admin/settings/search/byColumn/archives');



        // section routes
        Route::get('sections/index/{offset?}/{limit?}', 'SectionController@index')->name('admin/sections/index');
        Route::get('sections/create', 'SectionController@create')->name('admin/sections/create');
        Route::post('sections/create', 'SectionController@store')->name('admin/sections/store');
        Route::get('sections/edit/{id?}', 'SectionController@edit')->name('admin/sections/edit');
        Route::post('sections/edit/{id}', 'SectionController@update')->name('admin/sections/update');
        Route::get('sections/activate', 'SectionController@activate')->name('admin/sections/activate');
        Route::get('sections/delete', 'SectionController@delete')->name('admin/sections/delete');
        Route::post('sections/pagination/{offset?}/{limit?}', 'SectionController@pagination')->name('admin/sections/pagination');
        Route::post('sections/search', 'SectionController@search')->name('admin/sections/search');
        Route::post('sections/search/byColumn', 'SectionController@searchByColumn')->name('admin/sections/search/byColumn');
        Route::get('sections/archives/{offset?}/{limit?}', 'SectionController@archives')->name('admin/sections/archives');
        Route::get('sections/back', 'SectionController@back')->name('admin/sections/back');
        Route::post('sections/pagination/archives/{offset?}/{limit?}', 'SectionController@archivesPagination')->name('admin/sections/pagination/archives');
        Route::post('sections/search/archives', 'SectionController@archivesSearch')->name('admin/sections/search/archives');
        Route::post('sections/search/byColumn/archives', 'SectionController@archivesSearchByColumn')->name('admin/sections/search/byColumn/archives');



        // service routes
        Route::get('services/index/{offset?}/{limit?}', 'ServiceController@index')->name('admin/services/index');
        Route::get('services/create', 'ServiceController@create')->name('admin/services/create');
        Route::post('services/create', 'ServiceController@store')->name('admin/services/store');
        Route::get('services/edit/{id?}', 'ServiceController@edit')->name('admin/services/edit');
        Route::post('services/edit/{id}', 'ServiceController@update')->name('admin/services/update');
        Route::get('services/activate', 'ServiceController@activate')->name('admin/services/activate');
        Route::get('services/delete', 'ServiceController@delete')->name('admin/services/delete');
        Route::post('services/pagination/{offset?}/{limit?}', 'ServiceController@pagination')->name('admin/services/pagination');
        Route::post('services/search', 'ServiceController@search')->name('admin/services/search');
        Route::post('services/search/byColumn', 'ServiceController@searchByColumn')->name('admin/services/search/byColumn');
        Route::get('services/archives/{offset?}/{limit?}', 'ServiceController@archives')->name('admin/services/archives');
        Route::get('services/back', 'ServiceController@back')->name('admin/services/back');
        Route::post('services/pagination/archives/{offset?}/{limit?}', 'ServiceController@archivesPagination')->name('admin/services/pagination/archives');
        Route::post('services/search/archives', 'ServiceController@archivesSearch')->name('admin/services/search/archives');
        Route::post('services/search/byColumn/archives', 'ServiceController@archivesSearchByColumn')->name('admin/services/search/byColumn/archives');



        // blog routes
        Route::get('blogs/index/{offset?}/{limit?}', 'BlogController@index')->name('admin/blogs/index');
        Route::get('blogs/create', 'BlogController@create')->name('admin/blogs/create');
        Route::post('blogs/create', 'BlogController@store')->name('admin/blogs/store');
        Route::get('blogs/edit/{id?}', 'BlogController@edit')->name('admin/blogs/edit');
        Route::post('blogs/edit/{id}', 'BlogController@update')->name('admin/blogs/update');
        Route::get('blogs/activate', 'BlogController@activate')->name('admin/blogs/activate');
        Route::get('blogs/sort', 'BlogController@sort')->name('admin/blogs/sort');
        Route::get('blogs/delete', 'BlogController@delete')->name('admin/blogs/delete');
        Route::post('blogs/pagination/{offset?}/{limit?}', 'BlogController@pagination')->name('admin/blogs/pagination');
        Route::post('blogs/search', 'BlogController@search')->name('admin/blogs/search');
        Route::post('blogs/search/byColumn', 'BlogController@searchByColumn')->name('admin/blogs/search/byColumn');
        Route::get('blogs/archives/{offset?}/{limit?}', 'BlogController@archives')->name('admin/blogs/archives');
        Route::get('blogs/back', 'BlogController@back')->name('admin/blogs/back');
        Route::post('blogs/pagination/archives/{offset?}/{limit?}', 'BlogController@archivesPagination')->name('admin/blogs/pagination/archives');
        Route::post('blogs/search/archives', 'BlogController@archivesSearch')->name('admin/blogs/search/archives');
        Route::post('blogs/search/byColumn/archives', 'BlogController@archivesSearchByColumn')->name('admin/blogs/search/byColumn/archives');



        // process routes
        Route::get('process/index/{offset?}/{limit?}', 'ProcessController@index')->name('admin/process/index');
        Route::get('process/create', 'ProcessController@create')->name('admin/process/create');
        Route::post('process/create', 'ProcessController@store')->name('admin/process/store');
        Route::get('process/edit/{id?}', 'ProcessController@edit')->name('admin/process/edit');
        Route::post('process/edit/{id}', 'ProcessController@update')->name('admin/process/update');
        Route::get('process/activate', 'ProcessController@activate')->name('admin/process/activate');
        Route::get('process/delete', 'ProcessController@delete')->name('admin/process/delete');
        Route::post('process/pagination/{offset?}/{limit?}', 'ProcessController@pagination')->name('admin/process/pagination');
        Route::post('process/search', 'ProcessController@search')->name('admin/process/search');
        Route::post('process/search/byColumn', 'ProcessController@searchByColumn')->name('admin/process/search/byColumn');
        Route::get('process/archives/{offset?}/{limit?}', 'ProcessController@archives')->name('admin/process/archives');
        Route::get('process/back', 'ProcessController@back')->name('admin/process/back');
        Route::post('process/pagination/archives/{offset?}/{limit?}', 'ProcessController@archivesPagination')->name('admin/process/pagination/archives');
        Route::post('process/search/archives', 'ProcessController@archivesSearch')->name('admin/process/search/archives');
        Route::post('process/search/byColumn/archives', 'ProcessController@archivesSearchByColumn')->name('admin/process/search/byColumn/archives');



        // procesStep routes
        Route::get('procesSteps/index/{offset?}/{limit?}', 'ProcesStepController@index')->name('admin/procesSteps/index');
        Route::get('procesSteps/create', 'ProcesStepController@create')->name('admin/procesSteps/create');
        Route::post('procesSteps/create', 'ProcesStepController@store')->name('admin/procesSteps/store');
        Route::get('procesSteps/edit/{id?}', 'ProcesStepController@edit')->name('admin/procesSteps/edit');
        Route::post('procesSteps/edit/{id}', 'ProcesStepController@update')->name('admin/procesSteps/update');
        Route::get('procesSteps/activate', 'ProcesStepController@activate')->name('admin/procesSteps/activate');
        Route::get('procesSteps/delete', 'ProcesStepController@delete')->name('admin/procesSteps/delete');
        Route::post('procesSteps/pagination/{offset?}/{limit?}', 'ProcesStepController@pagination')->name('admin/procesSteps/pagination');
        Route::post('procesSteps/search', 'ProcesStepController@search')->name('admin/procesSteps/search');
        Route::post('procesSteps/search/byColumn', 'ProcesStepController@searchByColumn')->name('admin/procesSteps/search/byColumn');
        Route::get('procesSteps/archives/{offset?}/{limit?}', 'ProcesStepController@archives')->name('admin/procesSteps/archives');
        Route::get('procesSteps/back', 'ProcesStepController@back')->name('admin/procesSteps/back');
        Route::post('procesSteps/pagination/archives/{offset?}/{limit?}', 'ProcesStepController@archivesPagination')->name('admin/procesSteps/pagination/archives');
        Route::post('procesSteps/search/archives', 'ProcesStepController@archivesSearch')->name('admin/procesSteps/search/archives');
        Route::post('procesSteps/search/byColumn/archives', 'ProcesStepController@archivesSearchByColumn')->name('admin/procesSteps/search/byColumn/archives');



        // contact routes
        Route::get('contacts/index/{offset?}/{limit?}', 'ContactController@index')->name('admin/contacts/index');
        Route::get('contacts/create', 'ContactController@create')->name('admin/contacts/create');
        Route::post('contacts/create', 'ContactController@store')->name('admin/contacts/store');
        Route::get('contacts/edit/{id?}', 'ContactController@edit')->name('admin/contacts/edit');
        Route::post('contacts/edit/{id}', 'ContactController@update')->name('admin/contacts/update');
        Route::get('contacts/activate', 'ContactController@activate')->name('admin/contacts/activate');
        Route::get('contacts/delete', 'ContactController@delete')->name('admin/contacts/delete');
        Route::post('contacts/pagination/{offset?}/{limit?}', 'ContactController@pagination')->name('admin/contacts/pagination');
        Route::post('contacts/search', 'ContactController@search')->name('admin/contacts/search');
        Route::post('contacts/search/byColumn', 'ContactController@searchByColumn')->name('admin/contacts/search/byColumn');
        Route::get('contacts/archives/{offset?}/{limit?}', 'ContactController@archives')->name('admin/contacts/archives');
        Route::get('contacts/back', 'ContactController@back')->name('admin/contacts/back');
        Route::post('contacts/pagination/archives/{offset?}/{limit?}', 'ContactController@archivesPagination')->name('admin/contacts/pagination/archives');
        Route::post('contacts/search/archives', 'ContactController@archivesSearch')->name('admin/contacts/search/archives');
        Route::post('contacts/search/byColumn/archives', 'ContactController@archivesSearchByColumn')->name('admin/contacts/search/byColumn/archives');



        // subject routes
        Route::get('subjects/index/{offset?}/{limit?}', 'SubjectController@index')->name('admin/subjects/index');
        Route::get('subjects/create', 'SubjectController@create')->name('admin/subjects/create');
        Route::post('subjects/create', 'SubjectController@store')->name('admin/subjects/store');
        Route::get('subjects/edit/{id?}', 'SubjectController@edit')->name('admin/subjects/edit');
        Route::post('subjects/edit/{id}', 'SubjectController@update')->name('admin/subjects/update');
        Route::get('subjects/activate', 'SubjectController@activate')->name('admin/subjects/activate');
        Route::get('subjects/delete', 'SubjectController@delete')->name('admin/subjects/delete');
        Route::post('subjects/pagination/{offset?}/{limit?}', 'SubjectController@pagination')->name('admin/subjects/pagination');
        Route::post('subjects/search', 'SubjectController@search')->name('admin/subjects/search');
        Route::post('subjects/search/byColumn', 'SubjectController@searchByColumn')->name('admin/subjects/search/byColumn');
        Route::get('subjects/archives/{offset?}/{limit?}', 'SubjectController@archives')->name('admin/subjects/archives');
        Route::get('subjects/back', 'SubjectController@back')->name('admin/subjects/back');
        Route::post('subjects/pagination/archives/{offset?}/{limit?}', 'SubjectController@archivesPagination')->name('admin/subjects/pagination/archives');
        Route::post('subjects/search/archives', 'SubjectController@archivesSearch')->name('admin/subjects/search/archives');
        Route::post('subjects/search/byColumn/archives', 'SubjectController@archivesSearchByColumn')->name('admin/subjects/search/byColumn/archives');



        // legalField routes
        Route::get('legalFields/index/{offset?}/{limit?}', 'LegalFieldController@index')->name('admin/legalFields/index');
        Route::get('legalFields/create', 'LegalFieldController@create')->name('admin/legalFields/create');
        Route::post('legalFields/create', 'LegalFieldController@store')->name('admin/legalFields/store');
        Route::get('legalFields/edit/{id?}', 'LegalFieldController@edit')->name('admin/legalFields/edit');
        Route::post('legalFields/edit/{id}', 'LegalFieldController@update')->name('admin/legalFields/update');
        Route::get('legalFields/activate', 'LegalFieldController@activate')->name('admin/legalFields/activate');
        Route::get('legalFields/delete', 'LegalFieldController@delete')->name('admin/legalFields/delete');
        Route::post('legalFields/pagination/{offset?}/{limit?}', 'LegalFieldController@pagination')->name('admin/legalFields/pagination');
        Route::post('legalFields/search', 'LegalFieldController@search')->name('admin/legalFields/search');
        Route::post('legalFields/search/byColumn', 'LegalFieldController@searchByColumn')->name('admin/legalFields/search/byColumn');
        Route::get('legalFields/archives/{offset?}/{limit?}', 'LegalFieldController@archives')->name('admin/legalFields/archives');
        Route::get('legalFields/back', 'LegalFieldController@back')->name('admin/legalFields/back');
        Route::post('legalFields/pagination/archives/{offset?}/{limit?}', 'LegalFieldController@archivesPagination')->name('admin/legalFields/pagination/archives');
        Route::post('legalFields/search/archives', 'LegalFieldController@archivesSearch')->name('admin/legalFields/search/archives');
        Route::post('legalFields/search/byColumn/archives', 'LegalFieldController@archivesSearchByColumn')->name('admin/legalFields/search/byColumn/archives');


      //ROUTEFROMCOMMANDLINE

    });
});
