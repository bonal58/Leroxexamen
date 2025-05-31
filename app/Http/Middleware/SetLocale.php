<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * De ondersteunde talen in de applicatie
     * 
     * @var array
     */
    protected $supportedLocales = ['nl', 'en'];

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Controleer of er een taal is opgeslagen in de sessie
        if (Session::has('locale')) {
            $locale = Session::get('locale');
            
            // Controleer of de taal wordt ondersteund
            if (in_array($locale, $this->supportedLocales)) {
                App::setLocale($locale);
            }
        } else {
            // Standaard taal instellen als er geen taal is opgeslagen
            Session::put('locale', 'nl');
            App::setLocale('nl');
        }
        
        // Zorg ervoor dat de taal beschikbaar is in alle views
        app()->setLocale(Session::get('locale', 'nl'));
        
        return $next($request);
    }
}
