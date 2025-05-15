<div class="container py-5">
    <h1 class="mb-4">Media Gallery</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        @foreach ($mediaItems as $media)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card h-100">
                    @if ($media->mime_type === 'image/jpeg' || $media->mime_type === 'image/png' || $media->mime_type === 'image/gif')
                        <img src="{{ $media->getUrl() }}" class="card-img-top" alt="{{ $media->name }}"
                            style="height: 200px; object-fit: cover;">
                    @elseif($media->mime_type === 'video/mp4')
                        <video controls style="height: 200px; width: 100%; object-fit: cover;">
                            <source src="{{ $media->getUrl() }}" type="video/mp4">
                        </video>
                    @else
                        <div class="d-flex align-items-center justify-content-center"
                            style="height: 200px; background: #f8f9fa;">
                            <i class="fas fa-file fa-3x text-secondary"></i>
                        </div>
                    @endif

                    <div class="card-body">
                        <h6 class="card-title text-truncate">{{ $media->name }}</h6>
                        <p class="card-text small text-muted mb-1">
                            {{ $media->mime_type }} ({{ $media->human_readable_size }})
                        </p>
                        <p class="card-text small text-muted">
                            Uploaded: {{ $media->created_at->format('M d, Y') }}
                        </p>
                    </div>

                    <div class="card-footer bg-white">
                        <div class="d-flex justify-content-between">
                            <a href="{{ $media->getUrl() }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-eye"></i> View
                            </a>
                            <form action="{{ route('gallery.destroy', $media->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                    onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $mediaItems->links() }}
    </div>
</div>
