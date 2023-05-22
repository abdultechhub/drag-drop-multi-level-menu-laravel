<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function child_menu()
    {
        return $this->hasMany('App\Models\MenuItem', 'parent_id', 'id')->orderBy('position', 'asc');
    }

    public function isDescendantOf($parentMenu)
    {
        $ancestors = $this->getAncestors();

        return $ancestors->contains('id', $parentMenu->id);
    }

    public function getAncestors()
    {
        $ancestors = collect([]);
        $menu = $this;

        while ($menu->parent_id !== 0) {
            $parentMenu = MenuItem::find($menu->parent_id);
            $ancestors->push($parentMenu);
            $menu = $parentMenu;
        }

        return $ancestors->reverse();
    }
}
