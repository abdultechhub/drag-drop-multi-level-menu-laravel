<ul class="@if (isset($level) && $level === 3) level-menu level-menu-modify @else sub-menu @endif">
    @foreach ($child_menus as $child)
        <li id="menu_id_{{ $child->id }}">
            <a href="index.html"> {{ $child->name }}
                @if (count($child->child_menu))
                    <i class="fi-rs-angle-right"></i>
                @endif
            </a>

            @if (count($child->child_menu))
                @include('front.child_menu', [
                    'child_menus' => $child->child_menu,
                    'parent_menu_item' => $child,
                    'all_menu_item' => $all_menu_item,
                    'level' => isset($level) ? $level + 1 : 2,
                ])
            @endif
        </li>
    @endforeach
</ul>
