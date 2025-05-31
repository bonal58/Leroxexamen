@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="mb-4">
        <a href="{{ route('services.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> {{ __('messages.back_to_services') }}
        </a>
    </div>

    <div class="row">
        <div class="col-md-5">
            <div class="card shadow-sm mb-4">
                @if($service->image)
                <img src="{{ asset('storage/' . $service->image) }}" class="card-img-top" alt="{{ $service->name }}">
                @else
                <img src="{{ asset('images/placeholders/service-placeholder.svg') }}" class="card-img-top" alt="{{ $service->name }}">
                @endif
            </div>
        </div>
        <div class="col-md-7">
            <h1 class="mb-3">{{ $service->name }}</h1>
            
            <div class="mb-4">
                <h5 class="text-primary">{{ __('messages.price') }}</h5>
                <p class="fs-4 fw-bold">€{{ number_format($service->price, 2, ',', '.') }}</p>
            </div>
            
            <div class="mb-4">
                <h5 class="text-primary">{{ __('messages.duration') }}</h5>
                <p>{{ $service->duration }} {{ __('messages.minutes') }}</p>
            </div>
            
            <div class="mb-4">
                <h5 class="text-primary">{{ __('messages.description') }}</h5>
                <p>{{ $service->description }}</p>
            </div>
            
            <div class="d-grid gap-2 d-md-flex mt-4">
                <a href="{{ route('services.index') }}" class="btn btn-outline-secondary me-md-2">
                    {{ __('messages.back_to_services') }}
                </a>
                
                <a href="#" class="btn btn-primary">
                    <i class="bi bi-calendar-plus"></i> {{ __('messages.request_quote') }}
                </a>
                
                @auth
                    @if(auth()->user()->role === 'admin')
                    <a href="{{ route('services.edit', $service) }}" class="btn btn-outline-primary me-md-2">
                        <i class="bi bi-pencil"></i> {{ __('messages.edit') }}
                    </a>
                    <form action="{{ route('services.destroy', $service) }}" method="POST" class="d-inline">
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
