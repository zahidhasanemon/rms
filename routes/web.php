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

Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');

Auth::routes();

//get subcategory list when adding product using ajax
Route::get('/get-sub-category/{id}', 'ProductController@getSubCategory');

//supplier search via select2
Route::get('supplier-autocomplete-search','SupplierController@autocompletesearch')->name('supplier-autocomplete-search');

//product search via select2
Route::get('product-autocomplete-search','ProductController@autocompletesearch')->name('product-autocomplete-search');

//component search via select2
Route::get('component-autocomplete-search','ComponentController@autocompletesearch')->name('component-autocomplete-search');

//unit search via select2
Route::get('unit-autocomplete-search','UnitController@autocompletesearch')->name('unit-autocomplete-search');

//show requisition assignment page
Route::get('requisition/assignment/{id}', 'RequisitionController@assignmentForm');

//store requisition assignment
Route::post('requisition/assignment/store', 'RequisitionController@assignmentStore');

Route::group(['middleware' => ['auth']], function() {
	Route::get('/home', 'HomeController@index')->name('home');
	Route::resource('settings', 'SettingController');
	Route::resource('category', 'CategoryController');
	Route::resource('sub-category', 'SubCategoryController');
	Route::resource('user', 'UserController');
	Route::resource('requisition', 'RequisitionController');
	Route::resource('product', 'ProductController');
	Route::resource('store', 'StoreController');
	Route::resource('supplier', 'SupplierController');
	Route::resource('component', 'ComponentController');
	Route::resource('lab', 'LabController');
	Route::resource('unit', 'UnitController');
});
