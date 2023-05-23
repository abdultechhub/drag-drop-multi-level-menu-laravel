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

Route::resource('admin/menu', MenuController::class);
Route::get('manage-menus/{id}',[MenuItemController::class,'index'])->name('menu.menu');

//Route::post('update-menu', [MenuItemController::class,'updateMenu'])->name('menu.update');	
Route::post('admin/create-menu-item', [MenuItemController::class, 'create_menu'])->name('menu.create_menu_item');	
Route::post('admin/menu/add_custom_link', [MenuItemController::class,'add_custom_link'])->name('menu.add_custom_link');	
Route::post('admin/menu_item/order_change', [MenuItemController::class, 'menu_order_change'])->name('menu_item.order_change');

Route::post('admin/menu/change_menu_location/{id}', [MenuItemController::class, 'change_menu_location'])->name('menu.change_menu_location');

Route::post('admin/menu/add_page_to_menu', [MenuItemController::class, 'add_page_to_menu'])->name('menu.add_page_to_menu');
Route::post('admin/menu/add_category_to_menu', [MenuItemController::class, 'add_category_to_menu'])->name('menu.add_category_to_menu');



Route::delete('/delete_menu/{id}', [MenuItemController::class, 'delete_menu'])->name('menu.delete_menu_item');

Route::POST('admin/menu/change_parent_menu_item_item', [MenuItemController::class, 'change_parent_menu_item'])->name('change_parent_menu_item');



