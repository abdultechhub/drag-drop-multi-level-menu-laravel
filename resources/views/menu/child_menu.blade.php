<ul class="example post_sortable">
    @foreach ($child_menus as $child)
        <li data-id="{{ $child->id }}" data-parentid="{{ $parent_menu_item->parent_id }}"
            data-position="{{ $child->position }}">

            <div class="accordion-header" id="headingOne">
                <div class="header_left">
                    {{ $child->name }}

                    <select name="change_parent" onchange="change_parent(this.value, {{ $child->id }})"
                        class="form-select form-select-sm">
                        <option value=""> Select Parent Menu</option>
                        <option value="0"> No parent</option>
                        @foreach ($all_menu_item as $menu_item)
                            @if ($menu_item->id != $child->id && !$menu_item->isDescendantOf($child))
                                <option value="{{ $menu_item->id }}">{{ $menu_item->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <form action="{{ route('menu.delete_menu', $child->id) }}" method="POST"
                    onsubmit="return confirm('Are you sure you want to delete this post?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn delete_button"><i class="fa-solid fa-trash"></i></button>
                </form>
                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapse_{{ $child->id }}" aria-expanded="false" aria-controls="collapseOne">

                </button>
            </div>
            <div id="collapse_{{ $child->id }}" class="accordion-collapse collapse" aria-labelledby="headingThree"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <form action="{{ route('menu.add_custom_link') }}" method="post">
                        @csrf
                        <input type="hidden" name="menu_id" value="1">
                        <div class="mb-3">
                            <label for="menu_label" class="form-label">Label</label>
                            <input type="text" class="form-control" name="menu_label"
                                value="{{ $menu_item->name ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label for="menu_link" class="form-label">Link</label>
                            <input type="text" class="form-control" name="menu_link"
                                value="{{ $menu_item->slug ?? '' }}">
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" name="menu_target"
                                value="{{ $menu_item->target ?? '' }}"
                                {{ $menu_item->target == '_balnk' ? 'checked' : '' }}>
                            <label class="form-check-label" for="menu_target">Open New Tab</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Update
                            menu</button>
                    </form>
                </div>
            </div>

            @if (count($child->child_menu))
                @include('menu.child_menu', [
                    'child_menus' => $child->child_menu,
                    'parent_menu_item' => $child,
                    'all_menu_item' => $all_menu_item,
                ])
            @endif
        </li>
    @endforeach
</ul>
