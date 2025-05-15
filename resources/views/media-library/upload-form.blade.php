<form action="{{ route('media.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="">Name</label>
    <input type="text" name="name">
    <label for="">Size</label>
    <input type="text" name="size">
    <label for="">Type</label>
    <input type="text" name="type">
    <label for="">upload file</label>
    <input type="file" name="images[]" multiple>
    <button type="submit">Upload</button>
</form>


<div class="row mb-4">
    <div class="col-md-6">
        <form action="{{ route('gallery.index') }}" method="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search files..."
                    value="{{ request('search') }}">
                <button class="btn btn-outline-secondary" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form>
    </div>
    <div class="col-md-6">
        <div class="btn-group float-md-end">
            <a href="{{ route('gallery.index') }}"
                class="btn btn-outline-secondary {{ !request('type') ? 'active' : '' }}">All</a>
            <a href="{{ route('gallery.index', ['type' => 'image']) }}"
                class="btn btn-outline-secondary {{ request('type') === 'image' ? 'active' : '' }}">Images</a>
            <a href="{{ route('gallery.index', ['type' => 'video']) }}"
                class="btn btn-outline-secondary {{ request('type') === 'video' ? 'active' : '' }}">Videos</a>
            <a href="{{ route('gallery.index', ['type' => 'document']) }}"
                class="btn btn-outline-secondary {{ request('type') === 'document' ? 'active' : '' }}">Documents</a>
        </div>
    </div>
</div>
