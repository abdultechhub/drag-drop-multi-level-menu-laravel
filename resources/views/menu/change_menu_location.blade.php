<form action="{{ route('menu.change_menu_location', $id) }}" method="post">
    @csrf
    <div class="card mt-5">

        <div class="card-body">
            <h4>Change Menu Location</h4>
            @if (!empty($menu_single))
                <div class="mb-3 form-check">
                    <input type="radio" class="form-check-input" name="menu_location" value="header" id="menu_location_h"
                        {{ $menu_single->location == 'header' ? 'checked' : '' }}>
                    <label class="form-check-label" for="menu_location_h">Header Menu</label>
                </div>
                <div class="mb-3 form-check">
                    <input type="radio" class="form-check-input" name="menu_location" value="footer"
                        id="menu_location_f" {{ $menu_single->location == 'footer' ? 'checked' : '' }}>
                    <label class="form-check-label" for="menu_location_f">Footer Menu</label>
                </div>
                <div class="mb-3 form-check">
                    <input type="radio" class="form-check-input" name="menu_location" value="sidebar"
                        id="menu_location_s" {{ $menu_single->location == 'sidebar' ? 'checked' : '' }}>
                    <label class="form-check-label" for="menu_location_s">Sidebar Menu</label>
                </div>
            @endif

        </div>
        <div class="card-footer text-end">
            <button class="btn btn-primary">Save Menu Location</button>
        </div>

    </div>
</form>
