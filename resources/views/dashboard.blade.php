@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('messages.dashboard') }}</div>

                <div class="card-body">
                    <div class="alert alert-success" role="alert">
                        {{ __('messages.logged_in') }}
                    </div>

                    <p>{{ __('messages.dashboard_description') }}</p>
                    
                    <h4 class="mt-4">{{ __('messages.user_details') }}</h4>
                    <ul class="list-group mt-3">
                        <li class="list-group-item"><strong>{{ __('messages.name') }}:</strong> {{ Auth::user()->name }}</li>
                        <li class="list-group-item"><strong>{{ __('messages.email') }}:</strong> {{ Auth::user()->email }}</li>
                        <li class="list-group-item"><strong>{{ __('messages.member_since') }}:</strong> {{ Auth::user()->created_at->format('d-m-Y') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
