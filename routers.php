<?php
		
	if(isset($_SESSION['userlevel']) && $_SESSION['userlevel'] == 1):
		Router::get('/admin', 'DashboardController@index');
		Router::post('/admin/password', 'AkunController@ChangePassword');
		Router::get('/admin/password', 'AkunController@Password');
		Router::get('/admin/getGraph', 'DashboardController@getGraph');
		Router::resource('/admin/account', 'AkunController');

		Router::resource('/admin/article', 'ArtikelController');
		Router::resource('/admin/product', 'ProductController');
		Router::post('/admin/product/:id/stock', 'ProductController@Stock');
		Router::resource('/admin/category', 'KategoriController', ['except' => ['Status']]);

		Router::resource('/admin/comment', 'KomentarController', ['only' => ['Index', 'Destroy', 'Filter', 'Status']]);

		Router::resource('/admin/transaction', 'TransaksiController', ['only' => ['Index', 'Status', 'Filter', 'Destroy']]);
		Router::get('/admin/transaction/:id/detail', 'TransaksiController@Detail');

		Router::resource('/admin/confirmation', 'KonfirmasiController', ['only' => ['Index', 'Filter', 'Status', 'Destroy']]);
		Router::resource('/admin/report', 'ReportController', ['only' => ['Index', 'Filter']]);
		Router::get('/admin/report/product/getGraph', 'ReportController@getGraph2');
		Router::get('/admin/report/:type/getGraph', 'ReportController@getGraph');
		Router::get('/admin/report/exportOverview', 'ReportController@ExportOverview');
		Router::get('/admin/report/exportProduct', 'ReportController@ExportProduct');

		Router::get('/admin/report/product', 'ReportController@indexProduct');
		Router::get('/admin/report/product/filter', 'ReportController@filterProduct');

		Router::resource('/admin/stock', 'StockController', ['only' => ['Store', 'Add']]);
		Router::resource('/admin/wishlist', 'WishlistController', ['only' => ['Filter', 'Index', 'Destroy']]);
	elseif(strrpos($_SERVER['REQUEST_URI'], 'admin') !== false):
		return App::FillAndRedirect('danger', 'You not have authorized to see that page', '');
	endif;
	
	Router::get('/about', 'SiteController@About');
	Router::get('/faq', 'SiteController@FAQ');
	Router::get('/product/:permalink', 'SiteController@Product');
	Router::get('/article/:permalink', 'SiteController@Article');
	Router::get('/cart', 'TransaksiController@Cart');
	Router::get('/search/?page', 'SiteController@Search');

	Router::post('/comment', 'KomentarController@Insert');
	Router::post('/rating', 'RatingController@Insert');

	Router::post('/transaction/2', 'TransaksiController@InsertTransaction');
	Router::get('/transaction/:step', 'TransaksiController@Step');

	Router::post('/confirm', 'TransaksiController@InsertConfirm');
	Router::get('/confirm', 'TransaksiController@FormConfirm');

	Router::post('/user/login', 'AkunController@Login');
	Router::post('/user/register', 'AkunController@Insert');
	Router::post('/user/view', 'AkunController@UpdateProfile');
	Router::post('/user/password', 'AkunController@ChangePassword');

	Router::get('/user/:view', 'AkunController@UserView');
	Router::post('/ChartAction', 'SiteController@ChartAction');
	Router::post('/ChartActionRev', 'SiteController@ChartActionRev');

	Router::get('/category/:type/:cat/?page', 'SiteController@Category');
	Router::get('/?page', 'SiteController@Home');

	Router::post('/history/filter', 'TransaksiController@Filter');
	Router::get('/history/:id', 'TransaksiController@Detail');

	Router::get('/api/comment/:id/:type/:page/:limit', 'SiteController@getComment');
	Router::get('/api/stok/:id/:warna/:ukuran', 'SiteController@getStok');
	Router::get('/api/kabupaten/:id', 'SiteController@getKabupaten');
	Router::get('/api/kecamatan/:id', 'SiteController@getKecamatan');
	Router::post('/api/priceRegion', 'SiteController@getPrice');
	Router::get('/wishlist/:id/add', 'WishlistController@Add');
	Router::get('/wishlist/:id/destroy', 'WishlistController@Destroy2');


	Response::render404();