@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>{{ __('messages.scooters') }}</h1>
        </div>
        <div class="col-md-4 text-end">
            @auth
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('scooters.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus-circle"></i> {{ __('messages.add_scooter') }}
                    </a>
                @endif
            @endauth
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        @forelse($scooters as $scooter)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    @if($scooter->image)
                        <img src="{{ asset('storage/' . $scooter->image) }}" class="card-img-top" alt="{{ $scooter->name }}" style="height: 200px; object-fit: cover;">
                    @else
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                            <i class="fas fa-motorcycle fa-4x text-secondary"></i>
                        </div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $scooter->name }}</h5>
                        <p class="card-text text-muted">{{ $scooter->brand }} {{ $scooter->model }} ({{ $scooter->year }})</p>
                        <p class="card-text">{{ Str::limit($scooter->description, 100) }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="h5 mb-0">€{{ number_format($scooter->price, 2, ',', '.') }}</span>
                            <a href="{{ route('scooters.show', $scooter) }}" class="btn btn-outline-primary">
                                {{ __('messages.view_details') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-footer bg-white d-flex justify-content-between">
                        <small class="text-muted">
                            @if($scooter->stock > 0)
                                <span class="text-success">
                                    <i class="fas fa-check-circle"></i> {{ __('messages.in_stock') }}
                                </span>
                            @else
                                <span class="text-danger">
                                    <i class="fas fa-times-circle"></i> {{ __('messages.out_of_stock') }}
                                </span>
                            @endif
                        </small>
                        @if($scooter->featured)
                            <span class="badge bg-warning text-dark">
                                <i class="fas fa-star"></i> {{ __('messages.featured') }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">
                    {{ __('messages.no_scooters_found') }}
                </div>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $scooters->links() }}
    </div>
</div>
@endsection
