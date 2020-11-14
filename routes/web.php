<?php

use Illuminate\Support\Facades\Route;
//use App\Http\Livewire\LivewireInline;

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


Route::resource('articles', 'ArticleController');

Route::middleware('auth')->group(function() {
	Route::get('/post/trashindex', 'PostController@trashindex')->name('posts.trashindex');
	Route::resource('posts', 'PostController');
	Route::delete('/post/forcedelete/{post}', 'PostController@forceDelete')->name('posts.forceDelete');
	Route::get('/post/restore/{post}', 'PostController@restore')->name('posts.restore');
	Route::get('/export_excel', 'PostController@exportIntoExcel');
	Route::get('/export_csv', 'PostController@exportIntoCsv');
	Route::get('/download_pdf', 'PostController@downloadPDF');
	Route::get('/test', 'PostController@getAllPosts');
	

	Route::get('/import_form', 'PostController@importForm');
	Route::post('/import', 'PostController@import')->name('import');

	Route::get('/imgResize', 'ImageController@ImageForm');
	Route::post('/imgResize', 'ImageController@ImageStore')->name('images.store');

	Route::get('/dropzone', 'DropzoneController@index');
	Route::post('/dropzone', 'DropzoneController@store')->name('dropzone.store');

	Route::get('/lazyload', 'LazyloadController@gallary');

	Route::resource('employees', 'EmployeeController');

	Route::get('/search', 'EmployeeController@search');

	Route::get('autocomplete', 'EmployeeController@autocomplete');

	Route::get('/zip', 'ZipController@zipCreateAndDownload');


	Route::get('lang/{lang}', function($lang){
		session()->has('lang') ? session()->forget('lang') : '';
		if($lang == "ar"){
			session()->put('lang', 'ar');
		}else{
			session()->put('lang', 'en');
		}
		return back();
	});
});

Route::get('/livewire', function(){
	return view('livewire');
});

//Route::get('/inline', LivewireInline::class);




Route::get('/', function(){
	return view('welcome');
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::delete('deleteall', 'PostController@DeleteAll')->name('posts.deleteall');

