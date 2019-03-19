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
Route::group(['namespace'=> 'Backend', 'prefix'=>'ebook-admin'], function(){
    route::any('/', 'DashboardController@index')->name('dashboard');
    route::get('/banner', 'DashboardController@banner')->name('banner');
    route::post('/createbanner', 'DashboardController@createbanner')->name('banner.store');
    route::delete('/dropbanner/{id}', 'DashboardController@dropbanner')->name('banner.drop');
    route::get('/homesection', 'DashboardController@homesection')->name('section');//user home title and description for begining, middle and end
    route::post('/createsection', 'DashboardController@createsection')->name('section.store');
    route::get('/section', 'DashboardController@showsection')->name('section.show');
    route::get('/editsection/{id}', 'DashboardController@editsection')->name('section.edit');
    route::put('/updatesection/{id}', 'DashboardController@updatesection')->name('section.update');
    route::delete('/dropsection/{id}', 'DashboardController@dropsection')->name('section.destroy');
    route::resource('/books', 'BookController');
    route::resource('/admins', 'UserController');
    route::get('/add/maincategory', 'CategoryController@get_main_category')->name('main.category');
    route::post('/add/maincategory', 'CategoryController@add_main_category')->name('main.store');
    route::get('/add/subcategory', 'CategoryController@get_sub_category')->name('sub.category');
    route::post('/add/subcategory', 'CategoryController@add_sub_category')->name('sub.store');
    route::get('/add/minicategory', 'CategoryController@get_mini_category')->name('mini.category');
    route::post('/add/minicategory', 'CategoryController@add_mini_category')->name('mini.store');
    route::get('/subcategory/{id}', 'BookController@getsubcategory');
    route::get('/minicategory/{id}', 'BookController@getminicategory');







});

Route::group(['namespace'=> 'Frontend', 'prefix'=>'/'], function(){
    route::any('/', 'PageController@index');
    route::get('/{slug}', 'PageController@index');
    route::get('/bookbycategory/{id}', 'PageController@getbookorderbycate');
    route::get('/{slug}/{id}', 'PageController@index');

});
