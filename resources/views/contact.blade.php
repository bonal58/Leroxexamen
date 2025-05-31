@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row mb-5">
        <div class="col-12 text-center">
            <h1>{{ __('messages.contact_us') }}</h1>
            <p class="lead">{{ __('messages.contact_description') }}</p>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6 mb-4 mb-md-0">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h3 class="card-title">{{ __('messages.contact_us') }}</h3>
                    <hr>
                    
                    <div class="d-flex mb-4">
                        <div class="flex-shrink-0">
                            <i class="fas fa-map-marker-alt fa-2x text-primary"></i>
                        </div>
                        <div class="ms-3">
                            <h5>{{ __('messages.address') }}</h5>
                            <p class="mb-0">Lerox Motors</p>
                            <p class="mb-0">{{ __('messages.street_address') }}</p>
                            <p class="mb-0">{{ __('messages.city') }}</p>
                        </div>
                    </div>
                    
                    <div class="d-flex mb-4">
                        <div class="flex-shrink-0">
                            <i class="fas fa-phone fa-2x text-primary"></i>
                        </div>
                        <div class="ms-3">
                            <h5>{{ __('messages.phone') }}</h5>
                            <p class="mb-0">{{ __('messages.phone_number') }}</p>
                        </div>
                    </div>
                    
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-envelope fa-2x text-primary"></i>
                        </div>
                        <div class="ms-3">
                            <h5>{{ __('messages.email') }}</h5>
                            <p class="mb-0">{{ __('messages.email_address') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="card-title">{{ __('messages.send_message') }}</h3>
                    <hr>
                    
                    <form>
                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('messages.name') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('messages.email') }} <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="subject" class="form-label">{{ __('messages.subject') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="subject" name="subject" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="message" class="form-label">{{ __('messages.message') }} <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">{{ __('messages.submit') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mt-5">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <div class="ratio ratio-16x9">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2461.0697171302244!2d4.4780382!3d51.9236811!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c433a1e5c7e5f1%3A0x7f5e9b2c39d0b8a7!2sZaadakkerstraat%2024%2C%203036%20Rotterdam!5e0!3m2!1sen!2snl!4v1653644235036!5m2!1sen!2snl" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
