<!-- Add in your layout's <head> -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<div class="container mt-5">
    <div class="card shadow rounded">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Update Banner</h4>
        </div>
        <div class="card-body">
            {{-- Success Message --}}
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            {{-- Error Messages --}}
            @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> Please fix the following errors:
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="row">
                {{-- Left Column: Upload Form --}}
                <div class="col-md-6 border-end">
                    <form action="{{ route('banner.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="mb-3">
                            <label for="banner_image" class="form-label">Upload New Banner Image:</label>
                            <input type="file" name="banner_image" id="banner_image" class="form-control" accept="image/*" onchange="previewBanner(this)" required>
                            <div class="form-text">Only JPG, PNG, JPEG, GIF files allowed (max 2MB).</div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-upload me-1"></i> Update Banner
                            </button>
                        </div>
                    </form>
                </div>

                {{-- Right Column: Preview --}}
                <div class="col-md-6 d-flex flex-column align-items-center justify-content-center">
                    <label class="mb-2 fw-bold">Preview:</label>
                    <img id="preview-image"
                        src="{{ $banner && $banner->banner_url ? $banner->banner_url : '#' }}"
                        alt="Preview will appear here"
                        style="max-width: 100%; max-height: 300px; {{ $banner && $banner->banner_url ? '' : 'display:none;' }}"
                        class="border rounded shadow-sm">
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Preview Script --}}
<script>
    function previewBanner(input) {
        const preview = document.getElementById('preview-image');
        const file = input.files[0];
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            preview.src = '#';
            preview.style.display = 'none';
        }
    }
</script>
