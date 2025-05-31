@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h2>Taal Test / Language Test</h2>
        </div>
        <div class="card-body">
            <div class="alert alert-info">
                <p><strong>Huidige taal / Current language:</strong> {{ app()->getLocale() }}</p>
                <p><strong>Sessie taal / Session language:</strong> {{ session('locale', 'niet ingesteld / not set') }}</p>
            </div>
            
            <h3>Vertalingen / Translations</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sleutel / Key</th>
                        <th>Vertaling / Translation</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>messages.welcome_to_lerox</td>
                        <td>{{ __('messages.welcome_to_lerox') }}</td>
                    </tr>
                    <tr>
                        <td>messages.scooter_specialist</td>
                        <td>{{ __('messages.scooter_specialist') }}</td>
                    </tr>
                    <tr>
                        <td>messages.view_scooters</td>
                        <td>{{ __('messages.view_scooters') }}</td>
                    </tr>
                    <tr>
                        <td>messages.featured_scooters</td>
                        <td>{{ __('messages.featured_scooters') }}</td>
                    </tr>
                    <tr>
                        <td>messages.scooters</td>
                        <td>{{ __('messages.scooters') }}</td>
                    </tr>
                    <tr>
                        <td>messages.parts</td>
                        <td>{{ __('messages.parts') }}</td>
                    </tr>
                    <tr>
                        <td>messages.services</td>
                        <td>{{ __('messages.services') }}</td>
                    </tr>
                </tbody>
            </table>
            
            <h3>Taal wisselen / Switch Language</h3>
            <div class="btn-group">
                <a href="{{ route('language.switch', 'nl') }}" class="btn btn-outline-primary">Nederlands</a>
                <a href="{{ route('language.switch', 'en') }}" class="btn btn-outline-primary">English</a>
            </div>
        </div>
    </div>
</div>
@endsection
