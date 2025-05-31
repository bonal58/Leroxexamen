@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="mb-4">
        <a href="{{ route('parts.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> {{ __('messages.back_to_parts') }}
        </a>
    </div>

    <div class="row">
        <div class="col-md-5">
            <div class="card shadow-sm mb-4">
                @if($part->hasPhotos())
                    <!-- Hoofdafbeelding -->
                    <img src="{{ asset('storage/' . $part->primaryPhoto()->path) }}" class="card-img-top" alt="{{ $part->name }}" id="main-photo">
                    
                    <!-- Miniatuurafbeeldingen -->
                    @if($part->photos->count() > 1)
                        <div class="card-body p-2">
                            <div class="row">
                                @foreach($part->photos as $photo)
                                    <div class="col-3 mb-2">
                                        <img src="{{ asset('storage/' . $photo->path) }}" 
                                             class="img-thumbnail thumbnail-photo {{ $photo->is_primary ? 'border-primary' : '' }}" 
                                             alt="{{ $part->name }}" 
                                             style="cursor: pointer; height: 60px; object-fit: cover;"
                                             data-photo-path="{{ asset('storage/' . $photo->path) }}">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @else
                    <img src="{{ asset('images/placeholders/part-placeholder.svg') }}" class="card-img-top" alt="{{ $part->name }}">
                @endif
            </div>
        </div>
        <div class="col-md-7">
            <h1 class="mb-3">{{ $part->name }}</h1>
            
            <div class="mb-4">
                <h5 class="text-primary">{{ __('messages.price') }}</h5>
                <p class="fs-4 fw-bold">€{{ number_format($part->price, 2, ',', '.') }}</p>
            </div>
            
            <div class="mb-4">
                <h5 class="text-primary">{{ __('messages.availability') }}</h5>
                <p>
                    <span class="badge {{ $part->stock > 0 ? 'bg-success' : 'bg-danger' }} p-2">
                        {{ $part->stock > 0 ? __('messages.in_stock') : __('messages.out_of_stock') }}
                    </span>
                    @if($part->stock > 0)
                    <span class="ms-2">{{ __('messages.stock') }}: {{ $part->stock }}</span>
                    @endif
                </p>
            </div>
            
            <div class="mb-4">
                <h5 class="text-primary">{{ __('messages.description') }}</h5>
                <p>{{ $part->description }}</p>
            </div>
            
            @if($part->compatibleScooters->count() > 0)
            <div class="mb-4">
                <h5 class="text-primary">{{ __('messages.compatible_with') }}</h5>
                <ul class="list-group">
                    @foreach($part->compatibleScooters as $scooter)
                    <li class="list-group-item">
                        <a href="{{ route('scooters.show', $scooter) }}">
                            {{ $scooter->brand }} {{ $scooter->name }} ({{ $scooter->year }})
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif
            
            <div class="d-grid gap-2 d-md-flex mt-4">
                @auth
                    @if(auth()->user()->role === 'admin')
                    <a href="{{ route('parts.edit', $part) }}" class="btn btn-outline-primary me-md-2">
                        <i class="bi bi-pencil"></i> {{ __('messages.edit') }}
                    </a>
                    <form action="{{ route('parts.destroy', $part) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger" onclick="return confirm('{{ __('messages.confirm_delete') }}')">
                            <i class="bi bi-trash"></i> {{ __('messages.delete') }}
                        </button>
                    </form>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Maak alle miniatuurafbeeldingen klikbaar
        const thumbnails = document.querySelectorAll('.thumbnail-photo');
        const mainPhoto = document.getElementById('main-photo');
        
        thumbnails.forEach(function(thumbnail) {
            thumbnail.addEventListener('click', function() {
                // Verwijder de border van alle thumbnails
                thumbnails.forEach(t => t.classList.remove('border-primary'));
                
                // Voeg border toe aan de geselecteerde thumbnail
                this.classList.add('border-primary');
                
                // Update de hoofdafbeelding
                mainPhoto.src = this.getAttribute('data-photo-path');
            });
        });
    });
</script>
@endsection
