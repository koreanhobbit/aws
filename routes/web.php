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

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');



Route::get('/', 'HomeController@index')->name('home.index');

//route for contact
Route::post('/contact', 'HomeController@contact')->name('home.contact');

Route::group(['prefix' => 'admin' ,'middleware' => 'auth'], function() {

	//route for products
	Route::put('/product/{product}', 'ProductController@update')->name('product.update');
	Route::post('/product/reloadfi', 'ProductController@reloadFeaturedImageList')->name('product.reloadfi');
	Route::post('/product/reloadgi', 'ProductController@reloadGalleryImageList')->name('product.reloadgi');
	Route::get('/product/create', 'ProductController@create')->name('product.create');
	Route::get('/product/{product}/edit', 'ProductController@edit')->name('product.edit');
	Route::post('/product', 'ProductController@store')->name('product.store');
	Route::get('/product', 'ProductController@index')->name('product.index');
	Route::delete('/product/{product}', 'ProductController@destroy')->name('product.destroy');
	Route::put('/product/publish/{product}', 'ProductPublishController@toggleProduct')->name('product.publish');

	//route for setting
	Route::put('/setting/{set}', 'SettingController@update')->name('setting.update')->middleware('can:super-admin');
	Route::post('/setting/icon', 'SettingController@reloadIconList')->name('setting.icon');
	Route::post('/setting/logo', 'SettingController@reloadLogoList')->name('setting.logo');
	Route::get('/setting', 'SettingController@index')->name('setting.index');
	
	// resource route for blog
	Route::post('/blog/reloadfi', 'BlogpostController@reloadFeaturedImage')->name('blog.reloadfi');
	Route::post('/blog/reloadgi', 'BlogpostController@reloadGalleryImage')->name('blog.reloadgi'); 
	Route::resource('/blog','BlogpostController');

	//route for teamprofile
	Route::get('/teamprofile/{tp}/myprofile', 'TeamProfileController@myprofile')->name('teamprofile.myprofile');
	Route::get('/teamprofile/{tp}/edit', 'TeamProfileController@edit')->name('teamprofile.edit')->middleware('can:super-admin');
	Route::put('/teamprofile/{tp}', 'TeamProfileController@update')->name('teamprofile.update');
	Route::delete('/teamprofile/{tp}', 'TeamProfileController@destroy')->name('teamprofile.destroy')->middleware('can:super-admin');
	Route::post('/teamprofile/reload', 'TeamProfileController@reloadImageList')->name('teamprofile.reload')->middleware('can:super-admin');
	Route::post('/teamprofile', 'TeamProfileController@store')->name('teamprofile.store')->middleware('can:super-admin');
	Route::get('/teamprofile/create', 'TeamProfileController@create')->name('teamprofile.create')->middleware('can:super-admin');
	Route::get('/teamprofile', 'TeamProfileController@index')->name('teamprofile.index');

	//route for category blog
	Route::get('/category/{cat}/edit', 'CategoryController@edit')->name('category.edit');
	Route::put('/category/{cat}', 'CategoryController@update')->name('category.update');
	Route::delete('/category/{cat}', 'CategoryController@destroy')->name('category.destroy');
	Route::post('/category', 'CategoryController@store')->name('category.store');
	Route::get('/category', 'CategoryController@index')->name('category.index');

	//route for images
	Route::post('/image/modal', 'ImageController@ajaxForModal')->name('image.modal');
	Route::resource('/image','ImageController', ['except'=>[
				'show', 'edit', 'update'
		]]);

	//route for portfolios

	Route::post('/portfolio/reload/gallery', 'PortfolioController@reloadGallery')->name('portfolio.reload.gallery');
	Route::post('/portfolio/reload', 'PortfolioController@reload')->name('portfolio.reload');
	Route::get('/portfolio/{pf}/edit', 'PortfolioController@edit')->name('portfolio.edit');
	Route::put('/portfolio/{pf}', 'PortfolioController@update')->name('portfolio.update');
	Route::delete('/portfolio/{pf}', 'PortfolioController@destroy')->name('portfolio.destroy');
	Route::get('/portfolio/create', 'PortfolioController@create')->name('portfolio.create');
	Route::post('/portfolio', 'PortfolioController@store')->name('portfolio.store');
	Route::get('/portfolio', 'PortfolioController@index')->name('portfolio.index');

	//route for dashboard
	
	Route::put('/dashboard/{rp}', 'DashboardController@updateContact')->name('dashboard.update');
	Route::get('/dashboard/messages/{rp}/reply', 'DashboardController@reply')->name('dashboard.reply');
	Route::delete('/dashboard/{cr}', 'DashboardController@destroyContact')->name('dashboard.delete')->middleware('can:super-admin');
	Route::get('/dashboard/messages', 'DashboardController@allMessages')->name('dashboard.messages');
	Route::get('/', 'DashboardController@index')->name('dashboard.index');
});

