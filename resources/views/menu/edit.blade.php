@extends('layout.master')
@section('content')
    <div class="container p-3">
        <div class="row">


            <div class="col-md-12">

                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <div id="example1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12">

                                        <h3>Edit Menu</h3>

                                        <form action="{{ route('menu.update', $menu) }}" method="post">
                                            @csrf
                                            @method('PUT')

                                            <div class="mb-3">
                                                <label for="menu_name" class="form-label">Menu Name</label>
                                                <input type="text" class="form-control" name="menu_name" required
                                                    value="{{ $menu->title ?? '' }}">
                                            </div>
                                            <h4 class="mt-4">Change location</h4>
                                            <div class="mb-3 form-check">
                                                <input type="radio" class="form-check-input" name="menu_location"
                                                    value="header" id="menu_location_h"
                                                    {{ $menu->location == 'header' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="menu_location_h">Header Menu</label>
                                            </div>
                                            <div class="mb-3 form-check">
                                                <input type="radio" class="form-check-input" name="menu_location"
                                                    value="footer" id="menu_location_f"
                                                    {{ $menu->location == 'footer' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="menu_location_f">Footer Menu</label>
                                            </div>
                                            <div class="mb-3 form-check">
                                                <input type="radio" class="form-check-input" name="menu_location"
                                                    value="sidebar" id="menu_location_s"
                                                    {{ $menu->location == 'sidebar' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="menu_location_s">Sidebar Menu</label>
                                            </div>

                                            <button type="submit" class="btn btn-primary">Update Menu</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>

    </div>
@endsection

@section('custom_js')
@endsection
