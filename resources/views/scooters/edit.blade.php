@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-12">
            <h1>{{ __('messages.edit_scooter') }}</h1>
            <a href="{{ route('scooters.show', $scooter) }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> {{ __('messages.back_to_scooter') }}
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('scooters.update', $scooter) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('messages.name') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $scooter->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="brand" class="form-label">{{ __('messages.brand') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('brand') is-invalid @enderror" id="brand" name="brand" value="{{ old('brand', $scooter->brand) }}" required>
                                    @error('brand')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="model" class="form-label">{{ __('messages.model') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('model') is-invalid @enderror" id="model" name="model" value="{{ old('model', $scooter->model) }}" required>
                                    @error('model')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="year" class="form-label">{{ __('messages.year') }} <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('year') is-invalid @enderror" id="year" name="year" value="{{ old('year', $scooter->year) }}" min="1900" max="{{ date('Y') + 1 }}" required>
                                    @error('year')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="color" class="form-label">{{ __('messages.color') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('color') is-invalid @enderror" id="color" name="color" value="{{ old('color', $scooter->color) }}" required>
                                    @error('color')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="stock" class="form-label">{{ __('messages.stock') }} <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" value="{{ old('stock', $scooter->stock) }}" min="0" required>
                                    @error('stock')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">{{ __('messages.price') }} (€) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', $scooter->price) }}" min="0" required>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">{{ __('messages.description') }} <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5" required>{{ old('description', $scooter->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('messages.current_photos') }}</label>
                            <div class="row">
                                @if($scooter->hasPhotos())
                                    @foreach($scooter->photos as $photo)
                                        <div class="col-md-4 mb-3">
                                            <div class="card">
                                                <img src="{{ asset('storage/' . $photo->path) }}" alt="{{ $scooter->name }}" class="card-img-top" style="height: 150px; object-fit: cover;">
                                                <div class="card-body p-2">
                                                    <div class="form-check mb-2">
                                                        <input type="radio" class="form-check-input" id="primary_photo_{{ $photo->id }}" name="primary_photo" value="{{ $photo->id }}" {{ $photo->is_primary ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="primary_photo_{{ $photo->id }}">{{ __('messages.primary_photo') }}</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="delete_photo_{{ $photo->id }}" name="delete_photos[]" value="{{ $photo->id }}">
                                                        <label class="form-check-label" for="delete_photo_{{ $photo->id }}">{{ __('messages.delete_photo') }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-12">
                                        <div class="alert alert-info">
                                            {{ __('messages.no_photos_yet') }}
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="photos" class="form-label">{{ __('messages.add_photos') }}</label>
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
                            <div class="form-text">Ondersteunde bestandsformaten: JPEG, PNG, GIF, PDF, DOC, DOCX, XLS, XLSX (max 5MB)</div>
                            @error('photos.*')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="featured" name="featured" value="1" {{ old('featured', $scooter->featured) ? 'checked' : '' }}>
                            <label class="form-check-label" for="featured">{{ __('messages.mark_as_featured') }}</label>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> {{ __('messages.update_scooter') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <i class="fas fa-info-circle"></i> {{ __('messages.information') }}
                </div>
                <div class="card-body">
                    <p>{{ __('messages.scooter_edit_info') }}</p>
                    <ul>
                        <li>{{ __('messages.all_fields_required') }}</li>
                        <li>{{ __('messages.image_update_optional') }}</li>
                        <li>{{ __('messages.featured_explanation') }}</li>
                    </ul>
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
