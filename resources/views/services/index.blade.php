@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>{{ __('messages.services') }}</h1>
        @auth
            @if(auth()->user()->role === 'admin')
            <a href="{{ route('services.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> {{ __('messages.add_service') }}
            </a>
            @endif
        @endauth
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if($services->count() > 0)
    <div class="row">
        @foreach($services as $service)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                @if($service->image)
                <img src="{{ asset('storage/' . $service->image) }}" class="card-img-top" alt="{{ $service->name }}" style="height: 200px; object-fit: cover;">
                @else
                <img src="{{ asset('images/placeholders/service-placeholder.svg') }}" class="card-img-top" alt="{{ $service->name }}" style="height: 200px; object-fit: cover;">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $service->name }}</h5>
                    <p class="card-text">{{ Str::limit($service->description, 100) }}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-bold">€{{ number_format($service->price, 2, ',', '.') }}</span>
                        <a href="{{ route('services.show', $service) }}" class="btn btn-sm btn-outline-primary">{{ __('messages.view_details') }}</a>
                    </div>
                    <div class="mt-2">
                        <span class="badge bg-info">
                            {{ __('messages.duration') }}: {{ $service->duration }} {{ __('messages.minutes') }}
                        </span>
                    </div>
                </div>
                @auth
                    @if(auth()->user()->role === 'admin')
                    <div class="card-footer bg-transparent d-flex justify-content-between">
                        <a href="{{ route('services.edit', $service) }}" class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-pencil"></i> {{ __('messages.edit') }}
                        </a>
                        <form action="{{ route('services.destroy', $service) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('{{ __('messages.confirm_delete') }}')">
                                <i class="bi bi-trash"></i> {{ __('messages.delete') }}
                            </button>
                        </form>
                    </div>
                    @endif
                @endauth
            </div>
        </div>
        @endforeach
    </div>
    
    <div class="d-flex justify-content-center mt-4">
        {{ $services->links() }}
    </div>
    @else
    <div class="alert alert-info">
        {{ __('messages.no_services_found') }}
    </div>
    @endif
</div>
@endsection
