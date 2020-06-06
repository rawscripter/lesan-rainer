<?php

use App\Http\Controllers\ImageController;

Auth::routes();
// request for home page
Route::get('/', 'SiteController@index')->name('site.home');
Route::get('/user/logout', 'SiteController@logout')->name('site.logout');
Route::get('/about', 'SiteController@about')->name('about');
Route::get('/archives', 'SiteController@archives')->name('site.archives');
Route::get('/articles', 'SiteController@articles')->name('articles');
Route::get('/article/{slug}', 'SiteController@readArticle')->name('read.article');
Route::get('/exhibitions', 'SiteController@exhibitions')->name('exhibitions');
Route::get('/exhibitions/{exhibition}/details', 'SiteController@showExhibitionDetailsModal');
Route::get('/contact-us', 'SiteController@contact')->name('contact');

Route::get('/sculptures/{collection}', 'SiteController@showCollection')->name('site.collection');
Route::get('/sculptures/{collection}/archive', 'SiteController@showArchiveCollection')->name('site.archive.collection');

Route::get('/installations', 'SiteController@showInstallations')->name('site.installations');
Route::get('/archives/collections', 'SiteController@showArchives')->name('site.collection.archives');
Route::get('/art/{art}/details', 'SiteController@artDetailsModal')->name('art.details.modal');
Route::get('/art/{art}/pdf', 'SiteController@pdfGenerator')->name('art.pdf.download');
Route::get('/art/{art}/image', 'SiteController@downloadArtImage')->name('art.image.download');
Route::post('/contact/mail', 'SiteController@contactMail')->name('contact.mail');
Route::get('/installation/{installation}/details', 'SiteController@installationDetailsModal')->name('art.details.modal');
//routes for admin


Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/admin', 'AdminController@home')->name('admin.home');
    Route::resource('/admin/collections', 'CollectionController');
    Route::resource('/admin/arts', 'ArtController');
    Route::resource('/admin/users', 'UserController');
    Route::resource('/admin/installations', 'InstallationController');
    Route::resource('/admin/exhibitions', 'ExhibitionController');
    Route::resource('/admin/articles', 'ArticleController');
    Route::get('/admin/archives/arts', 'ArtArchiveController@showAllArchiveArts')->name('admin.archives');
    Route::get('/admin/archive/{art}/art', 'ArtArchiveController@archiveArt')->name('admin.archive.art');
    Route::get('/admin/restore/{art}/art', 'ArtArchiveController@restoreArt')->name('admin.restore.art');
    Route::get('/admin/logs', 'AdminController@showAllLogs')->name('admin.logs');
    Route::post('/admin/upload/{art}/image', 'ImageController@uploadArtImages')->name('admin.upload.image');
    Route::get('/admin/home/page/settings', 'PageSettingsController@homePageSettings')->name('admin.home.page.settings');
    Route::post('/admin/home/page/settings/update', 'PageSettingsController@updateHomePageSettings')->name('admin.home.page.settings.update');
    Route::get('/admin/about/page/settings', 'PageSettingsController@aboutPageSettings')->name('admin.about.page.settings');
    Route::post('/admin/about/page/settings/update', 'PageSettingsController@updateAboutPageSettings')->name('admin.about.page.settings.update');
});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');


//for clear site cache
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('config:cache');
    return 'cache cleared';
});





