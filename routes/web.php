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

    route::get('/homesection', 'DashboardController@homesection')->name('section');
    route::post('/createsection', 'DashboardController@createsection')->name('section.store');
    route::get('/section', 'DashboardController@showsection')->name('section.show');
    route::get('/editsection/{id}', 'DashboardController@editsection')->name('section.edit');
    route::put('/updatesection/{id}', 'DashboardController@updatesection')->name('section.update');
    route::delete('/dropsection/{id}', 'DashboardController@dropsection')->name('section.destroy');

    route::get('/vendor-section', 'DashboardController@vendorsection')->name('vendor');
    route::Post('/vendor-section/store', 'DashboardController@vendorsection_store')->name('vendor.section.store');
    route::get('/vendor-section/show', 'DashboardController@vendorsection_show')->name('vendor.section.show');
    route::delete('/vendor-section/{id}', 'DashboardController@vendorsection_delete')->name('vendorsection.delete');
    route::get('/vendor-section/{id}/edit', 'DashboardController@vendorsection_edit')->name('vendorsection.edit');
    route::put('/vendor-section/{id}/update', 'DashboardController@vendorsection_update')->name('vendorsection.update');







    route::resource('/books', 'BookController');
    route::resource('/admins', 'UserController');

    route::get('/add/maincategory', 'CategoryController@get_main_category')->name('main.category');
    route::post('/add/maincategory', 'CategoryController@add_main_category')->name('main.store');
    route::put('/status/maincategory/{id}', 'CategoryController@status_main_category')->name('main.conform');
    route::get('/edit/maincategory/{id}', 'CategoryController@edit_main_category')->name('main.edit');
    route::put('/update/maincategory/{id}', 'CategoryController@update_main_category')->name('main.update');
    route::delete('/delete/maincategory/{id}', 'CategoryController@delete_main_category')->name('main.delete');

    route::get('/add/subcategory', 'CategoryController@get_sub_category')->name('sub.category');
    route::post('/add/subcategory', 'CategoryController@add_sub_category')->name('sub.store');
    route::put('/status/subcategory/{id}', 'CategoryController@status_sub_category')->name('sub.conform');
    route::get('/edit/subcategory/{id}', 'CategoryController@edit_sub_category')->name('sub.edit');
    route::put('/update/subcategory/{id}', 'CategoryController@update_sub_category')->name('sub.update');
    route::delete('/delete/subcategory/{id}', 'CategoryController@delete_sub_category')->name('sub.delete');

    route::get('/add/minicategory', 'CategoryController@get_mini_category')->name('mini.category');
    route::post('/add/minicategory', 'CategoryController@add_mini_category')->name('mini.store');
    route::put('/status/minicategory/{id}', 'CategoryController@status_mini_category')->name('mini.conform');
    route::get('/edit/minicategory/{id}', 'CategoryController@edit_mini_category')->name('mini.edit');
    route::put('/update/minicategory/{id}', 'CategoryController@update_mini_category')->name('mini.update');
    route::delete('/delete/minicategory/{id}', 'CategoryController@delete_mini_category')->name('mini.delete');


    route::get('/subcategory/{id}', 'BookController@getsubcategory');
    route::get('/minicategory/{id}', 'BookController@getminicategory');

    route::get('/costomers', 'CustomerController@customer')->name('customer');
    route::get('/costomer/{id}', 'CustomerController@getcustomer')->name('customer.show');

    route::get('/role', 'RoleController@index')->name('role');
    route::post('/role/upload', 'RoleController@store')->name('role.store');
    route::delete('/role/delete/{id}', 'RoleController@delete')->name('role.delete');
    route::get('/role/edit/{id}', 'RoleController@edit')->name('role.edit');
    route::put('/role/update/{id}', 'RoleController@update')->name('role.update');

    route::get('/icon', 'IconController@index')->name('icon');
    route::post('/icon/upload', 'IconController@store')->name('icon.store');
    route::delete('/icon/delete/{id}', 'IconController@delete')->name('icon.delete');

    route::get('/contact_info', 'DashboardController@Contactinfo')->name('contact.info');
    route::post('/contact_info/store', 'DashboardController@Contact_store')->name('contact.store');
    route::get('/contact/show', 'DashboardController@showcontact')->name('contact.show');
    route::get('/contact/edit/{id}', 'DashboardController@editcontact')->name('contact.edit');

    route::get('/about', 'DashboardController@about')->name('aboutus');


    route::post('/about/upload', 'DashboardController@about_store')->name('about.store');
    route::delete('/about/delete/{id}', 'DashboardController@about_delete')->name('about.delete');
    route::get('/about/edit/{id}', 'DashboardController@about_edit')->name('about.edit');
    route::put('/about/update/{id}', 'DashboardController@about_update')->name('about.update');

    route::get('/tag', 'DashboardController@tag')->name('tag');
    route::post('/tag/upload', 'DashboardController@tag_store')->name('tag.store');
    route::delete('/tag/delete/{id}', 'DashboardController@tag_delete')->name('tag.delete');
    route::get('/tag/edit/{id}', 'DashboardController@tag_edit')->name('tag.edit');
    route::put('/tag/update/{id}', 'DashboardController@tag_update')->name('tag.update');

    route::get('/demo', 'DashboardController@demo')->name('demo');
    route::post('/demo/store', 'DashboardController@demo_store')->name('demo.store');
    route::delete('/demo/delete/{id}', 'DashboardController@demo_delete')->name('demo.delete');










    route::get('/contact_messages', 'DashboardController@contact_message')->name('contact.message');



});




Route::group(['namespace'=> 'Frontend', 'prefix'=>'/'], function(){

    route::get('/', 'PageController@index')->name('books');
    route::get('/book_show/{id}/', 'PageController@show')->name('book.show');
    route::get('/pending', 'PageController@pending')->name('pending');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/library/{id}', 'libraryController@add_to_library')->name('add.library');
    Route::get('/show', 'libraryController@Productcount');
    Route::get('/delete/book/{id}', 'libraryController@delete_library')->name('delete.library');
    Route::get('/profile', 'PageController@profile')->name('user.profile');
    Route::get('/billing', 'PageController@billing')->name('billing');
    Route::get('/expire/book', 'PageController@expire')->name('expire');
    Route::get('/user/setting', 'PageController@setting')->name('user.setting');

    Route::post('/upload', 'PageController@userpic')->name('upload.pic');
    Route::put('/update/pic/{id}', 'PageController@updatepic')->name('update.pic');
    Route::get('/payment', 'OrderController@payment')->name('user.pay');
    Route::get('/mylibrary', 'PageController@mylibrary')->name('user.library');
    Route::get('/mylibrary/{id}/', 'PageController@openbook')->name('user.book');

    Route::get('/contact', 'HomePageController@contact')->name('Contact');
    Route::post('/sent/message', 'HomePageController@message')->name('message.contact');

    Route::get('/about_us', 'HomePageController@aboutus')->name('about.us');
    route::get('/plan&policy', 'HomePageController@Plan')->name('Plan');
    route::get('/term&condition', 'HomePageController@Term')->name('Term');
    route::get('/privacy&policy', 'HomePageController@Privacy')->name('Privacy');

    route::get('/search', 'HomePageController@search')->name('search');


    Route::get('/category/{id}', 'HomePageController@maincategory')->name('get.maincategorys');
    Route::get('/Category/{id}', 'HomePageController@minicategory')->name('get.minicategory');


    Route::get('/my-category', 'PageController@folder')->name('my.category');
    Route::get('/mimi-category', 'PageController@mini_folder')->name('mini.category');

    Route::get('/buy-category', 'PageController@archive')->name('buy.category');
    Route::get('/sub-category/{id}', 'PageController@archive_subcategory')->name('archive.sub');
    Route::get('/sub-category/buy/{id}', 'OrderController@payment_subcategory')->name('sub.pay');
    Route::get('/sub-category/read/{id}', 'PageController@open_sub_book')->name('sub.read');


    Route::get('/mini-category/{id}', 'PageController@archive_mimicategory')->name('archive.mini');
    Route::get('/mini-category/buy/{id}', 'OrderController@payment_minicategory')->name('mini.pay');
    Route::get('/mini-category/read/{id}', 'PageController@open_mini_book')->name('mini.read');

    Route::get('/user/sell-book', 'PageController@sell_book')->name('user.book.sell');
    Route::Post('/user/book/store', 'HomeController@vendor_book')->name('user.book.store');

    Route::get('/vendor-book/show/{id}', 'HomepageController@show_book_vendor')->name('vendor.book.show');
    Route::get('/vendor-book/cart/{id}', 'libraryController@add_vendor_cart')->name('vendor.book.cart');
    Route::get('/vendor-book/remove/{id}', 'libraryController@delete_vendor')->name('vendor.remove');








    Route::get('/demo', 'PageController@demo')->name('demo.show');

    Route::put('/user/update/{id}', 'HomeController@update')->name('user.update');















});
Auth::routes();
Route::post('/user/login', 'Auth\UserloginController@login')->name('user.login');
Route::get('/admin', 'Auth\AdminloginController@index')->name('admin.form');
Route::post('/admin/login', 'Auth\AdminloginController@login')->name('admin.login');
