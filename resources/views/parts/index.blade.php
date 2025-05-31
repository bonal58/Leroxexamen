@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>{{ __('messages.parts') }}</h1>
        @auth
            @if(auth()->user()->role === 'admin')
            <a href="{{ route('parts.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> {{ __('messages.add_part') }}
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

    @if($parts->count() > 0)
    <div class="row">
        @foreach($parts as $part)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                @if($part->image)
                <img src="{{ asset('storage/' . $part->image) }}" class="card-img-top" alt="{{ $part->name }}" style="height: 200px; object-fit: cover;">
                @else
                <img src="{{ asset('images/placeholders/part-placeholder.svg') }}" class="card-img-top" alt="{{ $part->name }}" style="height: 200px; object-fit: cover;">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $part->name }}</h5>
                    <p class="card-text">{{ Str::limit($part->description, 100) }}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-bold">€{{ number_format($part->price, 2, ',', '.') }}</span>
                        <a href="{{ route('parts.show', $part) }}" class="btn btn-sm btn-outline-primary">{{ __('messages.view_details') }}</a>
                    </div>
                    <div class="mt-2">
                        <span class="badge {{ $part->stock > 0 ? 'bg-success' : 'bg-danger' }}">
                            {{ $part->stock > 0 ? __('messages.in_stock') : __('messages.out_of_stock') }}
                        </span>
                    </div>
                </div>
                @auth
                    @if(auth()->user()->role === 'admin')
                    <div class="card-footer bg-transparent d-flex justify-content-between">
                        <a href="{{ route('parts.edit', $part) }}" class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-pencil"></i> {{ __('messages.edit') }}
                        </a>
                        <form action="{{ route('parts.destroy', $part) }}" method="POST" class="d-inline">
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
        {{ $parts->links() }}
    </div>
    @else
    <div class="alert alert-info">
        {{ __('messages.no_parts_found') }}
    </div>
    @endif
</div>
@endsection
