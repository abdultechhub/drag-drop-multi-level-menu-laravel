<ul class="dropdown">
    @foreach ($child_menus as $child)
        <li id="menu_id_{{ $child->id }}" class="@if (count($child->child_menu)) menu-item-has-children @endif">
            <a href="index.html"> {{ $child->name }}
                @if (count($child->child_menu))
                    <i class="fi-rs-angle-right"></i>
                @endif
            </a>

            @if (count($child->child_menu))
                @include('front.mobile_child_menu', [
                    'child_menus' => $child->child_menu,
                    'parent_menu_item' => $child,
                    'all_menu_item' => $all_menu_item,
                    'level' => isset($level) ? $level + 1 : 2,
                ])
            @endif
        </li>
    @endforeach
</ul>
