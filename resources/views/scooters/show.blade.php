@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="mb-4">
        <a href="{{ route('scooters.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> {{ __('messages.back_to_scooters') }}
        </a>
    </div>

    <div class="row">
        <div class="col-md-5">
            @if($scooter->hasPhotos())
                <!-- Hoofdafbeelding -->
                <div class="mb-3">
                    <img src="{{ asset('storage/' . $scooter->primaryPhoto()->path) }}" class="img-fluid rounded" alt="{{ $scooter->name }}" id="main-photo">
                </div>
                
                <!-- Miniatuurafbeeldingen -->
                @if($scooter->photos->count() > 1)
                    <div class="row">
                        @foreach($scooter->photos as $photo)
                            <div class="col-3 mb-2">
                                <img src="{{ asset('storage/' . $photo->path) }}" 
                                     class="img-thumbnail thumbnail-photo {{ $photo->is_primary ? 'border-primary' : '' }}" 
                                     alt="{{ $scooter->name }}" 
                                     style="cursor: pointer; height: 60px; object-fit: cover;"
                                     data-photo-path="{{ asset('storage/' . $photo->path) }}">
                            </div>
                        @endforeach
                    </div>
                @endif
            @else
                <div class="bg-light d-flex align-items-center justify-content-center rounded" style="height: 300px;">
                    <i class="fas fa-motorcycle fa-5x text-secondary"></i>
                </div>
            @endif
        </div>
        <div class="col-md-7">
            <h1>{{ $scooter->name }}</h1>
            
            @if($scooter->featured)
                <span class="badge bg-warning text-dark mb-3">
                    <i class="fas fa-star"></i> {{ __('messages.featured') }}
                </span>
            @endif
            
            <div class="mb-4">
                <h4 class="text-primary">€{{ number_format($scooter->price, 2, ',', '.') }}</h4>
            </div>
            
            <table class="table">
                <tr>
                    <th width="30%">{{ __('messages.brand') }}</th>
                    <td>{{ $scooter->brand }}</td>
                </tr>
                <tr>
                    <th>{{ __('messages.model') }}</th>
                    <td>{{ $scooter->model }}</td>
                </tr>
                <tr>
                    <th>{{ __('messages.year') }}</th>
                    <td>{{ $scooter->year }}</td>
                </tr>
                <tr>
                    <th>{{ __('messages.color') }}</th>
                    <td>{{ $scooter->color }}</td>
                </tr>
                <tr>
                    <th>{{ __('messages.availability') }}</th>
                    <td>
                        @if($scooter->stock > 0)
                            <span class="text-success">
                                <i class="fas fa-check-circle"></i> {{ __('messages.in_stock') }} ({{ $scooter->stock }})
                            </span>
                        @else
                            <span class="text-danger">
                                <i class="fas fa-times-circle"></i> {{ __('messages.out_of_stock') }}
                            </span>
                        @endif
                    </td>
                </tr>
            </table>
            
            <div class="d-flex gap-2 mt-4">
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('scooters.edit', $scooter) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> {{ __('messages.edit') }}
                        </a>
                        
                        <form action="{{ route('scooters.destroy', $scooter) }}" method="POST" onsubmit="return confirm('{{ __('messages.confirm_delete') }}')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash"></i> {{ __('messages.delete') }}
                            </button>
                        </form>
                    @endif
                @endauth
                
                <a href="#" class="btn btn-success ms-auto">
                    <i class="fas fa-shopping-cart"></i> {{ __('messages.add_to_cart') }}
                </a>
            </div>
        </div>
    </div>
    
    <div class="row mt-5">
        <div class="col-12">
            <h3>{{ __('messages.description') }}</h3>
            <hr>
            <p>{{ $scooter->description }}</p>
        </div>
    </div>
    
    @if($scooter->compatibleParts->count() > 0)
    <div class="row mt-5">
        <div class="col-12">
            <h3>{{ __('messages.compatible_parts') }}</h3>
            <hr>
            <div class="row">
                @foreach($scooter->compatibleParts as $part)
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        @if($part->image)
                            <img src="{{ asset('storage/' . $part->image) }}" class="card-img-top" alt="{{ $part->name }}" style="height: 150px; object-fit: cover;">
                        @else
                            <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 150px;">
                                <i class="fas fa-cogs fa-3x text-secondary"></i>
                            </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $part->name }}</h5>
                            <p class="card-text">€{{ number_format($part->price, 2, ',', '.') }}</p>
                            <a href="{{ route('parts.show', $part) }}" class="btn btn-sm btn-outline-primary">
                                {{ __('messages.view_details') }}
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
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
