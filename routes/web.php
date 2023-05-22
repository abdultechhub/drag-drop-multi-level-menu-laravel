<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\MenuController;

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

Route::resource('menu', MenuController::class);
Route::get('manage-menus/{id}',[MenuItemController::class,'index'])->name('menu.menu');

//Route::post('update-menu', [MenuItemController::class,'updateMenu'])->name('menu.update');	
Route::post('create-menu', [MenuItemController::class, 'create_menu'])->name('menu.create_menu');	
Route::post('menu/add_custom_link', [MenuItemController::class,'add_custom_link'])->name('menu.add_custom_link');	
Route::post('/menu/order_change', [MenuItemController::class, 'menu_order_change'])->name('post.order_change');
Route::post('/menu/change_menu_location/{id}', [MenuItemController::class, 'change_menu_location'])->name('menu.change_menu_location');
Route::post('/menu/add_page_to_menu', [MenuItemController::class, 'add_page_to_menu'])->name('menu.add_page_to_menu');
Route::post('/menu/add_category_to_menu', [MenuItemController::class, 'add_category_to_menu'])->name('menu.add_category_to_menu');



Route::delete('/delete_menu/{id}', [MenuItemController::class, 'delete_menu'])->name('menu.delete_menu');

Route::POST('menu/change_parent_menu', [MenuItemController::class, 'change_parent_menu'])->name('change_parent_menu');



