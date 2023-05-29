<ul class="@if (isset($is_mega_menu)) {{ $is_mega_menu }} @endif">
    @foreach ($child_menus as $child)
        <li id="menu_id_{{ $child->id }}"
            class="@if (isset($level) && $level === 2) sub-mega-menu sub-mega-menu-width-22 @endif">
            <a href="index.html" class="@if (isset($level) && $level === 2) menu-title @endif">
                {{ $child->name }}
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
