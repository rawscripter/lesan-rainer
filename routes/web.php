<?php
Auth::routes();
// request for home page
Route::get('/', 'SiteController@index')->name('site.home');
Route::get('/about', 'SiteController@about')->name('about');
Route::get('/contact-us', 'SiteController@contact')->name('contact');
Route::get('/sculptures/{collection}', 'SiteController@showCollection')->name('site.collection');
Route::get('/installations', 'SiteController@showInstallations')->name('site.installations');
Route::get('/archives/collections', 'SiteController@showArchives')->name('site.collection.archives');
Route::get('/art/{art}/details', 'SiteController@artDetailsModal')->name('art.details.modal');
Route::get('/art/{art}/pdf', 'SiteController@pdfGenerator')->name('art.pdf.download');
Route::get('/art/{art}/image', 'SiteController@downloadArtImage')->name('art.image.download');
Route::post('/contact/mail', 'SiteController@contactMail')->name('contact.mail');
Route::get('/installation/{installation}/details', 'SiteController@installationDetailsModal')->name('art.details.modal');
//routes for admin
Route::group(['middleware' => ['auth']], function () {
    Route::get('/admin', 'AdminController@home')->name('admin.home');
    Route::resource('/admin/collections', 'CollectionController');
    Route::resource('/admin/arts', 'ArtController');
    Route::resource('/admin/installations', 'InstallationController');
    Route::get('/admin/archives/arts', 'ArtArchiveController@showAllArchiveArts')->name('admin.archives');
//    for image uploads
    Route::get('/admin/uploads', 'ImageController@index')->name('admin.uploads');
    Route::get('/admin/upload/new/image', 'ImageController@uploadImagesPage')->name('admin.upload.image.page');
    Route::post('/admin/upload/{art}/image', 'ImageController@uploadImage')->name('admin.upload.image');
    Route::delete('/admin/upload/{image}/delete', 'ImageController@deleteImage')->name('admin.upload.image.delete');
//    for archive and restore the logs
    Route::get('/admin/archive/{art}/art', 'ArtArchiveController@archiveArt')->name('admin.archive.art');
    Route::get('/admin/restore/{art}/art', 'ArtArchiveController@restoreArt')->name('admin.restore.art');
    Route::get('/admin/logs', 'AdminController@showAllLogs')->name('admin.logs');
//    routes for Home page and About Page Contents settings
    Route::get('/admin/home/page/settings', 'PageSettingsController@homePageSettings')->name('admin.home.page.settings');
    Route::post('/admin/home/page/settings/update', 'PageSettingsController@updateHomePageSettings')->name('admin.home.page.settings.update');
    Route::get('/admin/about/page/settings', 'PageSettingsController@aboutPageSettings')->name('admin.about.page.settings');
    Route::post('/admin/about/page/settings/update', 'PageSettingsController@updateAboutPageSettings')->name('admin.about.page.settings.update');
});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
