@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">{{ __('messages.add_part') }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('parts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('messages.name') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="category" class="form-label">{{ __('messages.category') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('category') is-invalid @enderror" id="category" name="category" value="{{ old('category') }}" required>
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="description" class="form-label">{{ __('messages.description') }} <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="price" class="form-label">{{ __('messages.price') }} (€) <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" min="0" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}" required>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label for="stock" class="form-label">{{ __('messages.stock') }} <span class="text-danger">*</span></label>
                                <input type="number" min="0" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" value="{{ old('stock', 0) }}" required>
                                @error('stock')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="photos" class="form-label">{{ __('messages.photos') }}</label>
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-text">Max photos</span>
                                        <input type="number" class="form-control" id="maxPhotos" min="1" max="10" value="5">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="progress" style="height: 38px;">
                                        <div class="progress-bar" id="photoProgressBar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0/5 photos</div>
                                    </div>
                                </div>
                            </div>
                            <input type="file" class="form-control @error('photos.*') is-invalid @enderror" id="photos" name="photos[]" multiple>
                            <div class="form-text">{{ __('messages.image_requirements') }}</div>
                            <div class="form-text">{{ __('messages.first_photo_primary') }}</div>
                            <div class="form-text" id="photoLimitMessage">You can upload up to 5 photos.</div>
                            @error('photos.*')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="compatible_scooters" class="form-label">{{ __('messages.compatible_scooters') }}</label>
                            <select class="form-select @error('compatible_scooters') is-invalid @enderror" id="compatible_scooters" name="compatible_scooters[]" multiple>
                                @foreach($scooters as $scooter)
                                    <option value="{{ $scooter->id }}" {{ in_array($scooter->id, old('compatible_scooters', [])) ? 'selected' : '' }}>
                                        {{ $scooter->brand }} {{ $scooter->name }} ({{ $scooter->year }})
                                    </option>
                                @endforeach
                            </select>
                            <div class="form-text">{{ __('messages.hold_ctrl_select_multiple') }}</div>
                            @error('compatible_scooters')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('parts.index') }}" class="btn btn-outline-secondary me-md-2">{{ __('messages.cancel') }}</a>
                            <button type="submit" class="btn btn-primary">{{ __('messages.save_part') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const photoInput = document.getElementById('photos');
        const maxPhotosInput = document.getElementById('maxPhotos');
        const progressBar = document.getElementById('photoProgressBar');
        const photoLimitMessage = document.getElementById('photoLimitMessage');
        const form = document.querySelector('form');
        let maxPhotos = parseInt(maxPhotosInput.value);
        let isValidPhotoCount = true;
        
        // Add a hidden input to store the max photos value
        const hiddenMaxPhotos = document.createElement('input');
        hiddenMaxPhotos.type = 'hidden';
        hiddenMaxPhotos.name = 'max_photos';
        hiddenMaxPhotos.value = maxPhotos;
        form.appendChild(hiddenMaxPhotos);
        
        // Update the max photos value when changed
        maxPhotosInput.addEventListener('change', function() {
            maxPhotos = parseInt(this.value);
            hiddenMaxPhotos.value = maxPhotos;
            updatePhotoLimitMessage();
            validateFileCount();
        });
        
        // Update the progress bar and validate when files are selected
        photoInput.addEventListener('change', function() {
            validateFileCount();
        });
        
        // Add form submission validation
        form.addEventListener('submit', function(e) {
            if (!isValidPhotoCount) {
                e.preventDefault();
                alert('Please select ' + maxPhotos + ' photos or fewer before submitting.');
                return false;
            }
            return true;
        });
        
        function validateFileCount() {
            const files = photoInput.files;
            const fileCount = files.length;
            
            // Update progress bar
            const percentage = Math.min(100, (fileCount / maxPhotos) * 100);
            progressBar.style.width = percentage + '%';
            progressBar.textContent = fileCount + '/' + maxPhotos + ' photos';
            progressBar.setAttribute('aria-valuenow', percentage);
            
            // Change color based on count
            if (fileCount > maxPhotos) {
                progressBar.classList.remove('bg-success', 'bg-primary');
                progressBar.classList.add('bg-danger');
                photoLimitMessage.textContent = 'You have selected ' + fileCount + ' photos, but the maximum is ' + maxPhotos + '. Please remove some photos.';
                photoLimitMessage.classList.add('text-danger');
                isValidPhotoCount = false;
            } else if (fileCount === maxPhotos) {
                progressBar.classList.remove('bg-danger', 'bg-primary');
                progressBar.classList.add('bg-success');
                photoLimitMessage.textContent = 'You have selected the maximum number of photos (' + maxPhotos + ').';
                photoLimitMessage.classList.remove('text-danger');
                isValidPhotoCount = true;
            } else {
                progressBar.classList.remove('bg-danger', 'bg-success');
                progressBar.classList.add('bg-primary');
                photoLimitMessage.textContent = 'You can upload up to ' + maxPhotos + ' photos.';
                photoLimitMessage.classList.remove('text-danger');
                isValidPhotoCount = true;
            }
        }
        
        function updatePhotoLimitMessage() {
            photoLimitMessage.textContent = 'You can upload up to ' + maxPhotos + ' photos.';
            photoLimitMessage.classList.remove('text-danger');
            progressBar.textContent = '0/' + maxPhotos + ' photos';
            isValidPhotoCount = true;
        }
    });
</script>
@endsection
