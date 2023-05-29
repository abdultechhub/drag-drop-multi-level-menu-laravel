<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuItem;
use App\Models\Menu;
use App\Models\Page;
use App\Models\BLogCategory;

class MenuItemController extends Controller
{
    public function index($id){
        $parent_menu_item = MenuItem::where('parent_id', 0)->where('menu_id', $id)->orderBy('position', 'asc')->get();
        $all_menu_item = MenuItem::orderBy('position', 'asc')->where('menu_id', $id)->get();
        $all_menu = Menu::orderBy('id', 'asc')->get();

        $menu_single = Menu::find($id);
        $page = Page::get();
        $blog_category = BLogCategory::get();
        
       // dd($parent_menu_item);
        return view ('menu.menu', compact('parent_menu_item', 'all_menu_item', 'all_menu', 'id', 'menu_single', 'page', 'blog_category'));
    }

    public function update_menu(Request $request, $id){
        $count = MenuItem::count();
        $menu_item = MenuItem::find($id);
        $menu_item->update([
            'name' => $request->input('menu_label'),
            'slug' => $request->input('menu_link'),
            'target' => $request->input('menu_target'),
            'is_mega_menu' => $request->input('is_mega_menu'),
        ]);

        $notification = [
            'message' => 'Menu Updated  Successfully!!',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }

    public function add_custom_link(Request $request){
        $count = MenuItem::count();
        MenuItem::create([
            'name' => $request->input('menu_label'),
            'slug' => $request->input('menu_link'),
            'menu_id' => $request->input('menu_id'),
            'parent_id' => 0,
            'type' => 'custom',
            'target' => $request->input('menu_target'),
            'position' => $count + 1,
        ]);

        $notification = [
            'message' => 'Menu added  Successfully!!',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);

   
    }
    public function create_menu(Request $request){
        $menu = new Menu;
        $menu::create([
            'title' => $request->input('menu_name'),
            'location' => $request->input('menu_location'),
        ]);

        $notification = [
            'message' => 'Menu added  Successfully!!',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);

   
    }

    public function add_page_to_menu(Request $request){
        $count = MenuItem::count();

        $ids = $request->input('page_id');
        foreach($ids as $id){
            MenuItem::create([
                'name' => Page::where('id',$id)->value('title'),
                'slug' => Page::where('id',$id)->value('slug'),
                'menu_id' => $request->input('menu_id'),
                'parent_id' => 0,
                'type' => 'page',
                'position' => $count + 1,
            ]);
        }

        $notification = [
            'message' => 'Menu added  Successfully!!',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }
    public function add_category_to_menu(Request $request){
        $count = MenuItem::count();

        $ids = $request->input('cat_id');
        foreach($ids as $id){
            MenuItem::create([
                'name' => BLogCategory::where('id',$id)->value('title'),
                'slug' => BLogCategory::where('id',$id)->value('slug'),
                'menu_id' => $request->input('menu_id'),
                'parent_id' => 0,
                'type' => 'page',
                'position' => $count + 1,
            ]);
        }

        $notification = [
            'message' => 'Menu added  Successfully!!',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }

    public function change_menu_location(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);
    
        // Get the selected menu locations
        $menu_location = $request->input('menu_location');
    
        // Update the menu_single record
        $menu->location = $menu_location;
        $menu->save();
    
        $notification = [
            'message' => 'Menu locations updated successfully!',
            'alert-type' => 'success'
        ];
    
        return redirect()->back()->with($notification);
    }

    public function updateMenu(Request $request){
        $data  = $request->data;
        $new_data = $data[0];
        // $this->saveMenu($new_data, 0);
    }
    public function change_parent_menu_item(Request $request){
        //dd($request->all());

        $parent_id = MenuItem::findOrFail($request->id);

        $parent_id->parent_id = $request->parent_id;

        $parent_id->save();
        return  response()->json([
            'message' => 'Post status change successfully.',
            'alert-type' => 'success'
        ]);
    }

    public function delete_menu($id)
{
    $menu_item = MenuItem::findOrFail($id);

    // Check if the menu item has children
    if ($menu_item->child_menu->count() > 0) {
        // If it has children, update the parent ID of the children
        $children = $menu_item->child_menu;
        foreach ($children as $child) {
            $child->parent_id = $menu_item->parent_id;
            $child->save();
        }
    }

    $menu_item->delete();

    $notification = [
        'message' => 'Menu Item deleted permanently!',
        'alert-type' => 'success'
    ];

    return redirect()->back()->with($notification);
}

    public function getOptions($parent_id = null, $exclude_id = null)
        {
            $options = [];

            $items =MenuItem::
                 where('parent_id', $parent_id)
                ->where('id', '<>', $exclude_id)
                ->get();

            foreach ($items as $item) {
                $options[$item->id] = $prefix . $item->name;
                $options += $this->getOptions($item->id, $exclude_id);
            }

            return $options;
        }

    public function saveMenu($menu, $parentId = null)
    {
        foreach ($menu as $index => $item) {
            //echo $item['id'];
            if (!isset($item['id'])) {
                continue;
                $menuItem = MenuItem::find($item['id']);
                $menuItem->parent_id = $parentId ?? 0; // set parent_id to 0 if there is no parent
                $menuItem->position = $index + 1;
                $menuItem->save();

            // echo $item[$index]['children'];

            //print_r(count($item['children']));
                
                if (isset($item['children']) && count($item['children'])) {
                    // pass 0 as parentId if $parentId is null
                    // echo $parentId;
                    $this->saveMenu($item['children'], $parentId ?? 0);
                }
            }
        }
    }


        public function menu_order_change(Request $request)
        {
        $data = $request->input('order');
            foreach ($data as $index => $id) {
                MenuItem::where('id', $id)->update(['position' => $index]);
            }
            return  response()->json([

                'message' => 'Post Order changed successfully.',

                'alert-type' => 'success'

            ]);
        //return response()->json(['success' => $data]);
        }

    
}
