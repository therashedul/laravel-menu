<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HitlogController;
use App\Http\Controllers\CustomAuthController;


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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/frontendindex',[App\Http\Controllers\frontController::class,'index']);
Route::get('/footer',[App\Http\Controllers\frontController::class,'footer']);
Route::get('/sidebar',[App\Http\Controllers\frontController::class,'sidebar']);


// Menu

Route::get('manage-menus/{id?}',[App\Http\Controllers\menuController::class,'index']);
Route::post('create-menu',[App\Http\Controllers\menuController::class,'store']);	
Route::get('add-categories-to-menu',[App\Http\Controllers\menuController::class,'addCatToMenu']);
Route::get('add-page-to-menu',[App\Http\Controllers\menuController::class,'addPaseToMenu']);
Route::get('add-post-to-menu',[App\Http\Controllers\menuController::class,'addPostToMenu']);
Route::get('add-custom-link',[App\Http\Controllers\menuController::class,'addCustomLink']);	
Route::get('save-menu',[App\Http\Controllers\menuController::class,'saveMenu']);
Route::get('update-menu',[App\Http\Controllers\menuController::class,'updateMenu']);	
Route::post('update-menuitem/{id}',[App\Http\Controllers\menuController::class,'updateMenuItem']);
Route::get('delete-menuitem/{id}/{key}/{in?}',[App\Http\Controllers\menuController::class,'deleteMenuItem']);
Route::get('delete-menu/{id}',[App\Http\Controllers\menuController::class,'destroy']);	

// category
Route::group(['prefix' => 'category'], function (){ 
		Route::get('/', [App\Http\Controllers\CategoryController::class, 'index'])->name('category/index');
		Route::get('/create', [App\Http\Controllers\CategoryController::class, 'create'])->name('category/create');
		Route::post('/store', [App\Http\Controllers\CategoryController::class, 'store'])->name('category/store');
		Route::get('/edit/{id}', [App\Http\Controllers\CategoryController::class, 'edit'])->name('category/edit');
		Route::post('/update', [App\Http\Controllers\CategoryController::class, 'update'])->name('category/update');
		Route::get('/delete/{id}', [App\Http\Controllers\CategoryController::class, 'destroy'])->name('category/delete');
		Route::get('/{category}', [App\Http\Controllers\CategoryController::class, 'categoryName'])->name('category');;
 });
 // post
Route::group(['prefix' => 'post'], function (){ 
		Route::get('/', [App\Http\Controllers\PostController::class, 'index'])->name('post/index');
		Route::get('/create', [App\Http\Controllers\PostController::class, 'create'])->name('post/create');
		Route::post('/store', [App\Http\Controllers\PostController::class, 'store'])->name('post/store');
		Route::get('/edit/{id}', [App\Http\Controllers\PostController::class, 'edit'])->name('post/edit');
		Route::post('/update', [App\Http\Controllers\PostController::class, 'update'])->name('post/update');
		Route::get('/delete/{id}', [App\Http\Controllers\PostController::class, 'destroy'])->name('post/delete');
		Route::get('/publish/{id}', [App\Http\Controllers\PostController::class, 'publish'])->name('post/publish');
		Route::get('/unpublish/{id}', [App\Http\Controllers\PostController::class, 'unpublish'])->name('post/unpublish');
		Route::post('/multipledelete', [App\Http\Controllers\PostController::class, 'multipledelete'])->name('post/multipledelete');
		Route::get('/search', [App\Http\Controllers\PostController::class, 'search']);
		Route::get('/{post}', [App\Http\Controllers\PostController::class, 'postName'])->name('posts');;
 });
 // page
Route::group(['prefix' => 'page'], function (){ 
		Route::get('/', [App\Http\Controllers\PageController::class, 'index'])->name('page/index');
		Route::get('/create', [App\Http\Controllers\PageController::class, 'create'])->name('page/create');
		Route::post('/store', [App\Http\Controllers\PageController::class, 'store'])->name('page/store');
		Route::get('/edit/{id}', [App\Http\Controllers\PageController::class, 'edit'])->name('page/edit');
		Route::post('/update', [App\Http\Controllers\PageController::class, 'update'])->name('page/update');
		Route::get('/publish/{id}', [App\Http\Controllers\PageController::class, 'publish'])->name('page/publish');
		Route::get('/unpublish/{id}', [App\Http\Controllers\PageController::class, 'unpublish'])->name('page/unpublish');
		Route::get('/delete/{id}', [App\Http\Controllers\PageController::class, 'destroy'])->name('page/delete');;
		Route::post('/multipledelete', [App\Http\Controllers\PageController::class, 'multipledelete'])->name('page/multipledelete');
		Route::get('/search', [App\Http\Controllers\PageController::class, 'search']);
		Route::get('/{page}', [App\Http\Controllers\PageController::class, 'pagesName'])->name('pages');;
 });
