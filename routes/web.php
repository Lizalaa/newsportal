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



//auth 
Auth::routes();


Route::prefix('admin')->group(function() {

	
	Route::get('login', 'Admin\Auth\AdminLoginController@showLoginForm')->name('admin.login');
	Route::post('login', 'Admin\Auth\AdminLoginController@login')->name('admin.login.submit');
	Route::get('logout', 'Admin\Auth\AdminLoginController@logout')->name('admin.logout');


	Route::post('password/email', 'Admin\Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
	Route::get('password/reset', 'Admin\Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
	Route::post('password/reset', 'Admin\Auth\AdminResetPasswordController@reset');
	Route::get('password/reset/{token}', 'Admin\Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
});

Route::get('admin/home', 'Admin\HomeController@index')->name('home');
	
//news route
Route::get('/admin/news', 'Admin\NewsController@index');
Route::get('/admin/usernews', 'Admin\NewsController@get_user_news');
Route::get('/admin/news/create', 'Admin\NewsController@create');
Route::post('/admin/news/store','Admin\NewsController@store');
Route::get('/admin/news/edit/{id}', 'Admin\NewsController@edit');
Route::post('/admin/news/update/{id}', 'Admin\NewsController@update');
Route::delete('/admin/news/{id}', 'Admin\NewsController@destroy');
Route::get('/admin/news/publish_news/{id}', 'Admin\NewsController@publish_news');
Route::get('/admin/news/unpublish_news/{id}', 'Admin\NewsController@unpublish_news');
Route::get('/admin/news/publish_user_news/{id}', 'Admin\NewsController@publish_user_news');
Route::get('/admin/news/unpublish_user_news/{id}', 'Admin\NewsController@unpublish_user_news');
Route::get('/admin/news/get_sub_category','Admin\NewsController@get_sub_category');
Route::get('/admin/news/edit/{id}/get_sub_category','Admin\NewsController@get_sub_category');


//admin route
Route::get('/admin', 'Admin\AdminController@index');
Route::get('/admin/create', 'Admin\AdminController@create');
Route::post('/admin/store','Admin\AdminController@store');
Route::get('/admin/edit/{id}', 'Admin\AdminController@edit');
Route::post('/admin/update/{id}', 'Admin\AdminController@update');
Route::delete('/admin/{id}', 'Admin\AdminController@destroy');
Route::get('/admin/verification/{token}', 'Admin\AdminController@verification');
Route::get('/admin/profile', 'Admin\AdminController@profile');





//category route
Route::get('/admin/category', 'Admin\CategoryController@index');
Route::get('/admin/category/create', 'Admin\CategoryController@create');
Route::post('/admin/category/store','Admin\CategoryController@store');
Route::get('/admin/category/edit/{id}', 'Admin\CategoryController@edit');
Route::post('/admin/category/update/{id}', 'Admin\CategoryController@update');
Route::delete('/admin/category/{id}', 'Admin\CategoryController@destroy');
Route::get('/admin/category/publish_category/{id}', 'Admin\CategoryController@publish_category');
Route::get('/admin/category/unpublish_category/{id}', 'Admin\CategoryController@unpublish_category');

//ad route
Route::get('/admin/ad', 'Admin\AdController@index');
Route::get('/admin/ad/create', 'Admin\AdController@create');
Route::post('/admin/ad/store','Admin\AdController@store');
Route::get('/admin/ad/edit/{id}', 'Admin\AdController@edit');
Route::post('/admin/ad/update/{id}', 'Admin\AdController@update');
Route::delete('/admin/ad/{id}', 'Admin\AdController@destroy');
Route::get('/admin/ad/publish_ad/{id}', 'Admin\AdController@publish_ad');
Route::get('/admin/ad/unpublish_ad/{id}', 'Admin\AdController@unpublish_ad');

//gallery route
Route::get('/admin/gallery', 'Admin\GalleryController@index');
Route::get('/admin/gallery/create', 'Admin\GalleryController@create');
Route::post('/admin/gallery/store','Admin\GalleryController@store');
Route::get('/admin/gallery/edit/{id}', 'Admin\GalleryController@edit');
Route::post('/admin/gallery/update/{id}', 'Admin\GalleryController@update');
Route::delete('/admin/gallery/{id}', 'Admin\GalleryController@destroy');
Route::delete('/admin/gallery/delete_folder/{id}', 'Admin\GalleryController@destroy_folder');


//setting route
Route::get('/admin/settings', 'Admin\SettingController@index');
Route::post('/admin/settings/update/{id}', 'Admin\SettingController@update');

Route::get('admin/roles', 'Admin\RolesAndPermissionsController@index');
	Route::get('admin/role/add', 'Admin\RolesAndPermissionsController@create');
	Route::post('admin/role/add', 'Admin\RolesAndPermissionsController@store');
	Route::get('admin/role/edit/{role}', 'Admin\RolesAndPermissionsController@edit');
	Route::post('admin/role/edit/{role}', 'Admin\RolesAndPermissionsController@update');
	Route::get('admin/role/delete/{role}', 'Admin\RolesAndPermissionsController@destroy');
	Route::get('admin/roles/assign/{role}', 'Admin\RolesAndPermissionsController@assign');
	Route::post('admin/roles/assign/{role}', 'Admin\RolesAndPermissionsController@assignPermissions');

	Route::get('admin/permissions', 'Admin\RolesAndPermissionsController@permissions');
	Route::get('admin/permission/add', 'Admin\RolesAndPermissionsController@createPermission');
	Route::post('admin/permission/add', 'Admin\RolesAndPermissionsController@storePermission');
	Route::get('admin/permission/edit/{permission}', 'Admin\RolesAndPermissionsController@editPermission');
	Route::post('admin/permission/edit/{permission}', 'Admin\RolesAndPermissionsController@updatePermission');
	Route::get('admin/permission/delete/{permission}', 'Admin\RolesAndPermissionsController@destroyPermission');
	Route::get('admin/permission/delete/{permission}', 'Admin\RolesAndPermissionsController@destroyPermission');
	//site route
Route::get('/', 'Site\SiteController@index');
Route::get('index_load', 'Site\SiteController@index_load');
Route::get('count_view', 'Site\SiteController@count_view');
Route::get('category/count_view', 'Site\SiteController@count_view');
Route::get('detail/count_view', 'Site\SiteController@count_view');
Route::get('site/detail/count_view', 'Site\SiteController@count_view');
Route::get('detail/{permalink}', 'Site\SiteController@detail');
Route::get('category/{permalink}', 'Site\SiteController@category');
Route::get('gallery', 'Site\SiteController@gallery');
Route::get('gallery_image/{cover_id}', 'Site\SiteController@gallery_name');



Route::prefix('user')->group(function()
{
	Route::get('dashboard', 'User\UserDashboardController@index');
	Route::get('login-check', 'User\Auth\UserLoginController@login');
	Route::post('login', 'User\Auth\UserLoginController@login');
	Route::get('logout', 'User\Auth\UserLoginController@logout');
	
	Route::get('news', 'User\PostNewsController@index');
	Route::get('news/create', 'User\PostNewsController@create');
	Route::post('news/store','User\PostNewsController@store');	
	Route::post('profile/update/{id}','User\UserProfileController@update');	
	Route::get('profile','User\UserProfileController@index');		
	Route::get('news/detail/{permalink}','User\PostNewsController@detail_news');	
	
	Route::get('/verification/{token}', 'User\UserController@verification');
	Route::get('news/get_sub_category', 'User\PostNewsController@get_sub_category');

	Route::post('password/email', 'User\Auth\UserForgotPasswordController@sendResetLinkEmail')->name('user.password.email');
	Route::get('password/reset', 'User\Auth\UserForgotPasswordController@showLinkRequestForm')->name('user.password.request');
	Route::post('password/reset', 'User\Auth\UserResetPasswordController@reset');
	Route::get('password/reset/{token}', 'User\Auth\UserResetPasswordController@showResetForm')->name('user.password.reset');
});


Route::get('sign-up', 'User\UserController@index')->name('sign-up');
Route::post('sign-up', 'User\UserController@store')->name('signup');