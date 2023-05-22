@extends('layout.master')
@section('content')
    <div class="container p-3">
        <div class="row">


            <div class="col-md-12">

                <div class="card">
                    <div class="card-header with-border ">
                        @include('menu.create_menu_modal')
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <div id="example1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12">

                                        <table class="table border table-striped table-hover">
                                            <thead>
                                                <tr class="bg-light">
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Mange Menu Items</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($menu as $item)
                                                    <tr>
                                                        <td>{{ $loop->index }}</td>
                                                        <td>{{ $item->title }}</td>
                                                        <td>
                                                            <a href="{{ route('menu.menu', $item) }}"
                                                                class="btn btn-primary btn-sm" title="Edit Data">Manage
                                                                items</a>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('menu.edit', $item) }}"
                                                                class="btn edit_button" title="Edit Data"><i
                                                                    class="fa fa-pencil"></i></a>
                                                            <form action="{{ route('menu.destroy', $item) }}" method="POST"
                                                                onsubmit="return confirm('Are you sure you want to delete this post?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn delete_button ms-3"><i
                                                                        class="fa-solid fa-trash"></i></button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>

                                        </table>


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
