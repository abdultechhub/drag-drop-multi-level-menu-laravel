@extends('layout.master')
@section('content')
    <div class="container p-3">
        <div class="row">

            <div class="col-md-12 mb-4 admin_menu_header">
                <div class="row">
                    <div class="col-md-3  ">
                        <select name="select_menu" class="form-select m-0" onchange="select_menu(this.value)">
                            <option value=""> Select Menu</option>
                            @if (!empty($all_menu))
                                @foreach ($all_menu as $menu)
                                    <option value="{{ $menu->id }}" {{ $menu->id == $id ? 'selected' : '' }}>
                                        {{ $menu->title }}</option>
                                @endforeach
                            @endif

                        </select>
                    </div>
                    <div class="col-md-3 ">
                        @include('menu.create_menu_modal')
                        <a href="{{ route('menu.index') }}" class="btn btn-info ms-3">Manage Menu</a>
                    </div>
                </div>

            </div>
            @if (count($all_menu) > 0)
                <div class="col-md-3">
                    <div class="accordion" id="add_menu_accordion">
                        <form action="{{ route('menu.add_custom_link') }}" method="post">
                            @csrf
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#add_custom_menu_acc" aria-expanded="false"
                                        aria-controls="add_custom_menu_acc">
                                        Add Custom Menu {{ count($all_menu) }}
                                    </button>
                                </h2>
                                <div id="add_custom_menu_acc" class="accordion-collapse collapse show"
                                    aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">

                                        <input type="hidden" name="menu_id" value="{{ $id }}">
                                        <div class="mb-3">
                                            <label for="menu_label" class="form-label">Label</label>
                                            <input type="text" class="form-control" name="menu_label" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="menu_link" class="form-label">Link</label>
                                            <input type="text" class="form-control" name="menu_link" required>
                                        </div>
                                        <div class="mb-3 form-check">
                                            <input type="checkbox" class="form-check-input" name="menu_target"
                                                value="_blank">
                                            <label class="form-check-label" for="menu_target">Open New Tab</label>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Add menu</button>

                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="accordion-item mt-3">
                            <form action="{{ route('menu.add_page_to_menu') }}" method="post" id="add_page_form">
                                @csrf
                                <input type="hidden" name="menu_id" value="{{ $id }}">
                                <div class="accordion-header" id="headingOne">
                                    Add Page
                                    <button type="submit" class="btn btn-primary btn-sm">Add to menu</button>
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#add_page_acc" aria-expanded="true" aria-controls="add_page_acc">

                                    </button>
                                </div>
                                <div id="add_page_acc" class="accordion-collapse  collapse" aria-labelledby="headingOne"
                                    data-bs-parent="#add_menu_accordion">
                                    <div class="accordion-body">

                                        <ul class="page_list">
                                            @foreach ($page as $item)
                                                <li>
                                                    <div class="mb-1 form-check">
                                                        <input type="checkbox" class="form-check-input" name="page_id[]"
                                                            value="{{ $item->id }}"
                                                            id="menu_location_{{ $item->id }}">
                                                        <label class="form-check-label"
                                                            for="menu_location_{{ $item->id }}">{{ $item->title }}</label>
                                                    </div>

                                                </li>
                                            @endforeach

                                        </ul>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="accordion-item mt-3">
                            <form action="{{ route('menu.add_category_to_menu') }}" method="post" id="add_page_form">
                                @csrf
                                <input type="hidden" name="menu_id" value="{{ $id }}">
                                <div class="accordion-header" id="headingTwo">
                                    Add Category
                                    <button type="submit" class="btn btn-primary btn-sm">Add to menu</button>
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#add_category_acc" aria-expanded="false"
                                        aria-controls="add_category_acc">
                                    </button>
                                </div>
                                <div id="add_category_acc" class="accordion-collapse collapse"
                                    aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">

                                        <ul class="page_list">
                                            @foreach ($blog_category as $item)
                                                <li>
                                                    <div class="mb-1 form-check">
                                                        <input type="checkbox" class="form-check-input" name="cat_id[]"
                                                            value="{{ $item->id }}"
                                                            id="menu_location_c_{{ $item->id }}">
                                                        <label class="form-check-label"
                                                            for="menu_location_c_{{ $item->id }}">{{ $item->title }}</label>
                                                    </div>
                                                </li>
                                            @endforeach

                                        </ul>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>

                <div class="col-md-9">

                    <div class="card">
                        <div class="card-header with-border ">
                            Edit : <strong> {{ $menu_single->title ?? '' }} </strong>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <div id="example1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                    <div class="row">
                                        <div class="col-sm-12">

                                            <ul id="post_sortable" class="post_list_ul post_sortable accordion">
                                                @foreach ($parent_menu_item as $p_menu_item)
                                                    <li data-id="{{ $p_menu_item->id }}" class="accordion-item">
                                                        <div class="accordion-header" id="headingOne">
                                                            <div class="header_left">
                                                                {{ $p_menu_item->name }}
                                                                <select name="change_parent"
                                                                    class="form-select form-select-sm"
                                                                    onchange="change_parent(this.value,{{ $p_menu_item->id }})">
                                                                    <option value=""> Select Parent Menu</option>
                                                                    <option value="0"> No parent</option>
                                                                    @foreach ($all_menu_item as $menu_item)
                                                                        @if ($menu_item->id != $p_menu_item->id && !$menu_item->isDescendantOf($p_menu_item))
                                                                            <option value="{{ $menu_item->id }}">
                                                                                {{ $menu_item->name }}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <form
                                                                action="{{ route('menu.delete_menu_item', $p_menu_item->id) }}"
                                                                method="POST"
                                                                onsubmit="return confirm('Are you sure you want to delete this post?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn delete_button"><i
                                                                        class="fa-solid fa-trash"></i></button>
                                                            </form>
                                                            <button class="accordion-button" type="button"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#collapse_{{ $p_menu_item->id }}"
                                                                aria-expanded="false" aria-controls="collapseOne">

                                                            </button>
                                                        </div>
                                                        <div id="collapse_{{ $p_menu_item->id }}"
                                                            class="accordion-collapse collapse"
                                                            aria-labelledby="headingThree"
                                                            data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <form action="{{ route('menu.add_custom_link') }}"
                                                                    method="post">
                                                                    @csrf
                                                                    <input type="hidden" name="menu_id" value="1">
                                                                    <div class="mb-3">
                                                                        <label for="menu_label"
                                                                            class="form-label">Label</label>
                                                                        <input type="text" class="form-control"
                                                                            name="menu_label"
                                                                            value="{{ $menu_item->name ?? '' }}">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="menu_link"
                                                                            class="form-label">Link</label>
                                                                        <input type="text" class="form-control"
                                                                            name="menu_link"
                                                                            value="{{ $menu_item->slug ?? '' }}">
                                                                    </div>
                                                                    <div class="mb-3 form-check">
                                                                        <input type="checkbox" class="form-check-input"
                                                                            name="menu_target"
                                                                            value="{{ $menu_item->target ?? '' }}"
                                                                            {{ $menu_item->target == '_balnk' ? 'checked' : '' }}>
                                                                        <label class="form-check-label"
                                                                            for="menu_target">Open
                                                                            New Tab</label>
                                                                    </div>
                                                                    <button type="submit" class="btn btn-primary">Update
                                                                        menu</button>
                                                                </form>
                                                            </div>
                                                        </div>

                                                        @if (count($p_menu_item->child_menu))
                                                            @include('menu.child_menu', [
                                                                'child_menus' => $p_menu_item->child_menu,
                                                                'parent_menu_item' => $p_menu_item,
                                                                'all_menu_item' => $all_menu_item,
                                                            ])
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>

                    @include('menu.change_menu_location')



                </div>

        </div>
        @endif

    </div>
@endsection

@section('custom_js')
    <script>
        function select_menu(value) {
            if (value) {
                // Redirect to the URL with the selected ID
                window.location.href = "{{ url('manage-menus') }}/" + value;
            }
        }

        function change_parent(parent_id, id) {
            console.log(parent_id);
            $.ajax({
                type: "POST",
                dataType: "json",
                url: '/admin/menu/change_parent_menu_item_item',
                data: {
                    'id': id,
                    'parent_id': parent_id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(data) {
                    toastr.success(data.message);
                    location.reload();
                }
            });
        }


        $(document).ready(function() {
            $(".post_sortable").sortable({
                placeholder: "ui-state-highlight",
                // connectWith: ".post_sortable",
                update: function(event, ui) {
                    //var data = $(this).sortable('toArray');

                    var post_order_ids = new Array();
                    $('.post_sortable li').each(function() {
                        post_order_ids.push($(this).data("id"));
                    });

                    console.log(post_order_ids);
                    $.ajax({
                        type: "POST",
                        url: "{{ route('menu_item.order_change') }}",
                        dataType: "json",
                        data: {
                            order: post_order_ids,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            toastr.success(response.message);
                            $('.post_sortable li').each(function(index) {
                                $(this).find('.pos_num').text(index + 1);

                                //console.log(index);
                            });

                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                        }
                    });
                }
            });
        });
    </script>

    <script>
        const form = document.getElementById('add_page_form');
        const checkboxes = form.querySelectorAll('input[type="checkbox"]');

        form.addEventListener('submit', function(event) {
            let checked = false;

            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    checked = true;
                    return;
                }
            });

            if (!checked) {
                event.preventDefault();
                alert('Please select at least one page.');
            }
        });
    </script>
@endsection
