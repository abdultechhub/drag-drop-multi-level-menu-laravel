<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\MenuItem;
use App\Models\Menu;

class IndexController extends Controller
{
    public function header_menu()
    {

        $menu = Menu::where('location', 'header')->get()->first();
        $parent_menu_item = MenuItem::where('parent_id', 0)->where('menu_id', $menu->id)->orderBy('position', 'asc')->get();
        $all_menu_item = MenuItem::orderBy('position', 'asc')->where('menu_id', $menu->id)->get();
        $all_menu = Menu::orderBy('id', 'asc')->get();

       // dd($parent_menu_item);

        return view ('front.index', compact('parent_menu_item', 'all_menu_item', 'all_menu'));

    }

}

