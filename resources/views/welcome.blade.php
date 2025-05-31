@extends('layouts.app')

@section('content')
<!-- Custom CSS voor de homepage -->
<style>
    .hero-section {
        background-image: url('{{ asset('images/placeholders/hero-bg.jpg') }}');
        background-size: cover;
        background-position: center;
        color: white;
        padding: 100px 0;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }
    
    .featured-section {
        padding: 60px 0;
    }
    
    .card-img-top {
        height: 200px;
        object-fit: cover;
    }
    
    .service-card {
        transition: transform 0.3s;
        height: 100%;
    }
    
    .service-card:hover {
        transform: translateY(-5px);
    }
</style>

<!-- Hero Section -->
<div class="hero-section">
    <div class="container text-center">
        <h1 class="display-4 fw-bold">{{ __('messages.welcome_to_lerox') }}</h1>
        <p class="lead">{{ __('messages.scooter_specialist') }}</p>
        <a href="{{ route('scooters.index') }}" class="btn btn-primary btn-lg mt-3">{{ __('messages.view_scooters') }}</a>
    </div>
</div>

<!-- Featured Scooters Section -->
<section class="featured-section bg-light">
    <div class="container">
        <h2 class="text-center mb-5">{{ __('messages.featured_scooters') }}</h2>
        <div class="row">
            @forelse($featuredScooters as $scooter)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    @if($scooter->image)
                    <img src="{{ asset('storage/' . $scooter->image) }}" class="card-img-top" alt="{{ $scooter->brand }} {{ $scooter->model }}">
                    @else
                    <img src="{{ asset('images/placeholders/scooter.jpg') }}" class="card-img-top" alt="{{ $scooter->brand }} {{ $scooter->model }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $scooter->brand }} {{ $scooter->model }}</h5>
                        <p class="card-text">{{ Str::limit($scooter->description, 100) }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold">€{{ number_format($scooter->price, 2, ',', '.') }}</span>
                            <a href="{{ route('scooters.show', $scooter) }}" class="btn btn-sm btn-outline-primary">{{ __('messages.view_details') }}</a>
                        </div>
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
        
        <div class="text-center mt-4">
            <a href="{{ route('scooters.index') }}" class="btn btn-primary">{{ __('messages.view_all_scooters') }}</a>
        </div>
    </div>
</section>

<!-- Parts Section -->
<section class="featured-section">
    <div class="container">
        <h2 class="text-center mb-5">{{ __('messages.popular_parts') }}</h2>
        <div class="row">
            <!-- Part 1 -->
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('images/placeholders/exhaust.jpg') }}" class="card-img-top" alt="{{ __('messages.performance_exhaust') }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('messages.performance_exhaust') }}</h5>
                        <p class="card-text">{{ __('messages.performance_exhaust_desc') }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold">€149,95</span>
                            <a href="{{ route('parts.index') }}" class="btn btn-sm btn-outline-primary">{{ __('messages.view_details') }}</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Part 2 -->
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('images/placeholders/led-lights.jpg') }}" class="card-img-top" alt="{{ __('messages.led_lights') }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('messages.led_lights') }}</h5>
                        <p class="card-text">{{ __('messages.led_lights_desc') }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold">€79,95</span>
                            <a href="{{ route('parts.index') }}" class="btn btn-sm btn-outline-primary">{{ __('messages.view_details') }}</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Part 3 -->
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('images/placeholders/tires.jpg') }}" class="card-img-top" alt="{{ __('messages.premium_tires') }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('messages.premium_tires') }}</h5>
                        <p class="card-text">{{ __('messages.premium_tires_desc') }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold">€129,95</span>
                            <a href="{{ route('parts.index') }}" class="btn btn-sm btn-outline-primary">{{ __('messages.view_details') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-4">
            <a href="{{ route('parts.index') }}" class="btn btn-primary">{{ __('messages.view_all_parts') }}</a>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="featured-section bg-light">
    <div class="container">
        <h2 class="text-center mb-5">{{ __('messages.our_services') }}</h2>
        <div class="row">
            <!-- Service 1: Maintenance -->
            <div class="col-md-4 mb-4">
                <div class="card service-card shadow-sm">
                    <div class="card-body text-center">
                        <i class="bi bi-tools fs-1 mb-3 text-primary"></i>
                        <h5 class="card-title">{{ __('messages.maintenance') }}</h5>
                        <p class="card-text">{{ __('messages.maintenance_desc') }}</p>
                        <div class="mt-3">
                            <span class="badge bg-success">{{ __('messages.economy') }}</span>
                            <span class="badge bg-warning text-dark">{{ __('messages.standard') }}</span>
                            <span class="badge bg-danger">{{ __('messages.premium') }}</span>
                        </div>
                        <a href="{{ route('services.index') }}" class="btn btn-outline-primary mt-3">{{ __('messages.learn_more') }}</a>
                    </div>
                </div>
            </div>
            
            <!-- Service 2: Repair -->
            <div class="col-md-4 mb-4">
                <div class="card service-card shadow-sm">
                    <div class="card-body text-center">
                        <i class="bi bi-wrench-adjustable fs-1 mb-3 text-primary"></i>
                        <h5 class="card-title">{{ __('messages.repair') }}</h5>
                        <p class="card-text">{{ __('messages.repair_desc') }}</p>
                        <div class="mt-3">
                            <span class="badge bg-success">{{ __('messages.economy') }}</span>
                            <span class="badge bg-warning text-dark">{{ __('messages.standard') }}</span>
                            <span class="badge bg-danger">{{ __('messages.premium') }}</span>
                        </div>
                        <a href="{{ route('services.index') }}" class="btn btn-outline-primary mt-3">{{ __('messages.learn_more') }}</a>
                    </div>
                </div>
            </div>
            
            <!-- Service 3: Customization -->
            <div class="col-md-4 mb-4">
                <div class="card service-card shadow-sm">
                    <div class="card-body text-center">
                        <i class="bi bi-brush fs-1 mb-3 text-primary"></i>
                        <h5 class="card-title">{{ __('messages.customization') }}</h5>
                        <p class="card-text">{{ __('messages.customization_desc') }}</p>
                        <div class="mt-3">
                            <span class="badge bg-success">{{ __('messages.economy') }}</span>
                            <span class="badge bg-warning text-dark">{{ __('messages.standard') }}</span>
                            <span class="badge bg-danger">{{ __('messages.premium') }}</span>
                        </div>
                        <a href="{{ route('services.index') }}" class="btn btn-outline-primary mt-3">{{ __('messages.learn_more') }}</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-4">
            <a href="{{ route('services.index') }}" class="btn btn-primary">{{ __('messages.view_all_services') }}</a>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="mb-4">{{ __('messages.ready_to_upgrade') }}</h2>
                <p class="lead mb-5">{{ __('messages.contact_us_desc') }}</p>
                <a href="#" class="btn btn-primary btn-lg">{{ __('messages.contact_us') }}</a>
            </div>
        </div>
    </div>
</section>
@endsection
