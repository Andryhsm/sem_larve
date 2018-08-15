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


/*=
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your admin. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['namespace' => 'Admin', 'middleware' => []], function () {

    Route::get('/', 'LoginController@index');

    Route::group(['prefix' => 'admin/'],function(){
    //Juste pour la fusion des attributs
        Route::get('fusion','ProductController@fusion');
        /*redactor route*/
        Route::post('/redactor-files/upload', 'FileController@upload');
        Route::post('/redactor-files/images', 'FileController@getImages');

        Route::post('/ckeditor/upload', 'FileController@uploadCKeditor');
        Route::post('/ckeditor/browse', 'FileController@browse');

        Route::get('/', 'LoginController@index');
        Route::get('login', 'LoginController@index')->name('login');
        Route::post('login', 'LoginController@store');
        Route::get('logout', 'LoginController@destroy')->name('logout');
        Route::get('get-state/{country_id}', 'RegionController@getState')->name('get-state');
        Route::post('get-coordinates','StoreController@getCoordinates');

        //Route::post('search_store','searchController@search');
        Route::get('get-brand-by-tag','BrandController@byTag');
        Route::group(['middleware' => ['auth.admin','permission']], function () {

            Route::get('dashboard', 'DashboardController@index')->name('dashboard');
            
            Route::get('sales/{status}', 'SalesController@index')->name('orders');
            Route::get('sales/get-data/{status}', 'SalesController@getData')->name('orders-data');
            Route::get('sales/view/{order_id}', 'SalesController@view')->name('orders_detail');
            Route::delete('sales/{order_id}', 'SalesController@destroy')->name('delete_order');
            Route::post('sales/update-status/{order_id}', 'SalesController@updateStatus')->name('delete_order');
            Route::get('product-billed', 'SalesController@productBilled')->name('product_billed');
            Route::get('product-billed-detail/{id}', 'SalesController@byItemId')->name('item_detail');
            Route::resource('order-status','OrderStatusController');
            Route::resource('page', 'PageController');
            Route::resource('blog-category','BlogCategoryController');
            Route::resource('blog','BlogPostController');
            Route::post('get-blog-tag','BlogTagController@get');
            Route::post('save-blog-tag','BlogTagController@store');
            Route::post('get-post','BlogPostController@getPost');
            Route::resource('tickets/priorities', 'PrioritiesController');
            Route::resource('tickets/statuses','StatusesController');
            Route::resource('tickets/categories', 'CategoriesController');
            Route::resource('tickets/comments', 'CommentController');
            Route::resource('tickets','TicketController');
            Route::get('administrator', 'AdminUserController@index')->name('administrator');
            Route::post('administrator', 'AdminUserController@store')->name('save_administrator');
            Route::post('administrator/{admin_id}', 'AdminUserController@update')->name('update_administrator');
            Route::get('administrator/create', 'AdminUserController@create')->name('add_administrator');
            Route::get('administrator/edit/{admin_id}', 'AdminUserController@edit')->name('edit_administrator');
            Route::delete('administrator/{admin_id}', 'AdminUserController@destroy')->name('delete_administrator');
            Route::get('account', 'AccountController@index')->name('account');
            Route::get('account', 'AccountController@index')->name('account');
            Route::get('account/add', 'AccountController@create')->name('create_account');
            Route::get('account/delete/{merchant_id}', 'UserController@destroy');
            Route::resource('role', 'AdminRoleController');
            Route::get('role/destroy/{role_id}', 'AdminRoleController@destroy')->name('delete_role');
            
            Route::resource('faq','FaqController');
            Route::resource('customer', 'UserController');
            //Route::resource('merchant', 'UserController');
            Route::post('tickets/reopen','TicketController@reOpenTicket');
            Route::post('tickets/selectstatus','TicketController@selectStatus');
            Route::get('system','SystemController@index')->name('setting_list');
            Route::post('system','SystemController@store')->name('update_setting');
            Route::resource('email-template', 'EmailTemplateController');

            Route::get('profile', 'UserController@show')->name('profile');
            Route::patch('update/{id}', ['as' => 'profile.update', 'uses' => 'UserController@update']);




            //--------------- Espace madio be subscribes  ---------------

            Route::get('tickets', 'TicketsController@index')->name('tickets');
            Route::post('tickets/store', 'TicketsController@store');
            Route::post('tickets/add_comment', 'TicketsController@addComment');
            Route::get('ajax_customer_info', 'SubscribeController@ajax_index');                    
            Route::get('get-dashboard', 'SubscribeController@getDashboard');
           // Route::get('customer-informations', 'SubscribeController@getCustomerInformations')->name('customer_informations');
            Route::get('help-faq', 'SubscribeTicketsController@index')->name('help-faq');

            //--------------- End espace madio subscribes ---------------





            // 

        

           
            // Route::resource('banner', 'BannerController');
            // Route::resource('product-rating', 'ProductRatingController');
            // Route::resource('stripe_account', 'StripeAccountController');

            // //Verify exist name
            // Route::post('product/verify-name','ProductController@verifyName')->name('verify-name');

            // Route::post('product/get-data', 'ProductController@getData')->name('product-data');
            // Route::get('product/get-filter', 'ProductController@getFilterList');
            // Route::get('product', 'ProductController@index')->name('product');
            // Route::post('product/attributes', 'ProductController@attributes')->name('get_attribute');
            // Route::post('product', 'ProductController@store')->name('save_product');
            
            // //root new_page
            // Route::resource('new_page/page', 'TrainingController');
            // //end root new_page

            // Route::post('product/upload', 'ProductController@uploadImage')->name('upload_product_media');
            // Route::get('product/edit/{product_id}', 'ProductController@edit')->name('edit_product');
            // Route::delete('product/{product_id}', 'ProductController@destroy')->name('remove_product');
            // Route::post('product/{product_id}', 'ProductController@update')->name('update_product');
            // Route::post('remove-product-image', 'ProductController@removeImage')->name('remove_product_image');
            // Route::get('product/add', 'ProductController@create')->name('create_product');



            // Route::post('get-tag', 'TagController@getAll')->name('tags');
            // Route::post('save-tag', 'TagController@store')->name('save_tag');

            // Route::post('get-brand-tag', 'BrandTagController@getAll')->name('brand_tags');
            // Route::post('save-brand-tag', 'BrandTagController@store')->name('brand_save_tag');
            // Route::post('remove-brand-tag', 'BrandTagController@destroy')->name('brand_remove_tag');
            // Route::get('remove-request-brand/{brand_id}','BrandController@removeRequestBrand');
            // Route::get('brand-tag-translation', 'BrandTagController@index')->name('brand_tag');
            // Route::post('save-brand-tag-french', 'BrandTagController@store_with_translation_fr')->name('brand_save_tag_french');

            // Route::get('attribute', 'AttributeController@index')->name('attribute');
            // Route::post('attribute', 'AttributeController@store')->name('save_attribute');
            // Route::post('attribute/{attribute_id}', 'AttributeController@update')->name('update_attribute');
            // Route::get('attribute/add', 'AttributeController@create')->name('create_attribute');
            // Route::get('attribute/edit/{attribute_id}', 'AttributeController@edit')->name('edit_attribute');
            // Route::delete('attribute/{attribute_id}', 'AttributeController@destroy')->name('delete_attribute');


            // Route::get('attribute-set', 'AttributeSetController@index')->name('attribute_set');
            // Route::post('attribute-set', 'AttributeSetController@store')->name('save_attribute_set');
            // Route::post('attribute-set/{attribute_set_id}', 'AttributeSetController@update')->name('update_attribute_set');
            // Route::get('attribute-set/add', 'AttributeSetController@create')->name('create_attribute_set');
            // Route::get('attribute-set/edit/{attribute_set_id}', 'AttributeSetController@edit')->name('edit_attribute_set');
            // Route::delete('attribute-set/{attribute_set_id}', 'AttributeSetController@destroy')->name('delete_attribute_set');

            // Route::get('brand/get-data', 'BrandController@getData')->name('brand-data');
            // Route::resource('brand', 'BrandController');
            // Route::resource('special-product', 'SpecialProductController');
            // Route::post('get-product','SpecialProductController@getProduct')->name('get_product');

            // Route::get('category', 'CategoryController@index')->name('category');
            // Route::post('category/update-order','CategoryController@updateOrder')->name('category_update_order');
            // Route::post('category', 'CategoryController@store')->name('save_category');
            // Route::post('category/{category_id}', 'CategoryController@update')->name('update_category');
            // Route::get('category/edit/{category_id}', 'CategoryController@edit')->name('edit_category');
            // Route::get('category/destroy/{category_id}', 'CategoryController@destroy')->name('delete_category');

            

            // Route::get('coupon', 'CouponController@index')->name('coupon');
            // Route::get('claim/price-adjustment', 'ClaimController@index')->name('price_adjustment');

            // /*Route::get('affiliate', 'AffiliateController@index')->name('affiliate');
            // Route::get('affiliate/generate', 'AffiliateController@create')->name('create_affiliate');*/
            // Route::resource('affiliate', 'AffiliateController');

            
            // Route::post('search-product','ProductController@searchProduct');

            Route::get('company-account', 'AccountController@index')->name('company_account');
            Route::get('company-account/{id}', 'AccountController@show')->name('company_account_detail');

           
            
            // Route::resource('store','StoreController');
            // Route::get('store/get-html/{index}','StoreController@getHtml');
            // Route::get('brand-json','BrandController@getAllBrands');
            
            Route::resource('epartner','EpartnerController');
            Route::resource('invoice','InvoiceController');
            Route::post('remove-product-tag', 'ProductController@removeTag')->name('product_remove_tag');
            
            Route::get('404',function(){
                return view('admin.404');
            })->name('404');
        });
    });
    

});
Route::group(['namespace' => 'Front', 'middleware' => ['localeSessionRedirect', 'localizationRedirect','language'], 'prefix' => LaravelLocalization::setLocale()], function () {
    // Route::get('/', 'HomeController@index');

//     Route::get('login', ['uses' => 'Auth\AuthController@getLogin', "middleware" => 'guest', 'as' => 'login']);
//     Route::post('login', 'Auth\AuthController@postLogin');

//     Route::get('sign-up', ['uses' => 'Auth\AuthController@getRegister', "middleware" => 'guest', 'as' => 'customer-sign-up']);

//     Route::get('logout', 'Auth\AuthController@destroy')->name('logout');
   
    /*Route::group(['middleware' => ['auth']], function () {
        Route::group(['middleware' => ['customer']], function () {
            
            Route::get('customer', 'CustomerController@index');

            Route::group(['prefix' => 'customer/'], function () {
                Route::get('tickets', 'TicketsController@index')->name('tickets');
                Route::post('tickets/store', 'TicketsController@store');
                Route::post('tickets/add_comment', 'TicketsController@addComment');
                Route::get('ajax_customer_info', 'CustomerController@ajax_index');                    
                Route::get('get-dashboard', 'CustomerController@getDashboard');
                Route::get('customer-informations', 'CustomerController@getCustomerInformations')->name('customer_informations');
                Route::get('help-faq', 'TicketsController@index');
            }); 
            Route::post('manage-account', 'CustomerController@postManageAccount');           
        });
    });*/
    Route::get('/{slug}/{item_id?}', function (Request $request, $slug, $item_id = null) {
        try {
            $value = \App\Url::where('target_url', $slug)->first();

            if ($value == null) {
                return view('front.404');
            }           
            $app = app();
            //dd($value);
            switch ($value->type) {
                case 2:
                    // redirect to BYO page if product's parent category is BYO
                    $controller = $app->make('App\Http\Controllers\Front\ProductController');
                    return $controller->CallAction('index', [$value->target_id]);
                case 1:
                    $controller = $app->make('App\Http\Controllers\Front\CatalogController');
                    return $controller->callAction('index', [$value->target_id]);
                case 3:
                    $controller = $app->make('App\Http\Controllers\Front\PageController');
                    return $controller->callAction('index', [$value->target_id]);
                case 4:
                    $controller = $app->make('App\Http\Controllers\Front\BlogController');
                    return $controller->callAction('show', [$value->target_id]);
            }
        } catch (Exception $e) {
            return view('front.404');
        }
    });
});

