<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;

class LanguageController extends Controller
{
    /**
     * Wissel naar de geselecteerde taal
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $locale
     * @return \Illuminate\Http\Response
     */
    public function switchLang(Request $request, $locale)
    {
        // Controleer of de geselecteerde taal wordt ondersteund
        if (in_array($locale, ['nl', 'en'])) {
            // Sla de geselecteerde taal op in de sessie
            Session::put('locale', $locale);
            
            // Stel de applicatie locale in
            App::setLocale($locale);
            
            // Update de .env file om de standaard taal te wijzigen
            if ($locale === 'en') {
                $this->updateEnvFile('APP_LOCALE', 'en');
            } else {
                $this->updateEnvFile('APP_LOCALE', 'nl');
            }
        }
        
        // Ga terug naar de vorige pagina
        return redirect()->back();
    }
    
    /**
     * Update de .env file
     *
     * @param  string  $key
     * @param  string  $value
     * @return void
     */
    private function updateEnvFile($key, $value)
    {
        $path = base_path('.env');
        
        if (file_exists($path)) {
            file_put_contents(
                $path, 
                preg_replace(
                    "/^{$key}=.*/m",
                    "{$key}={$value}",
                    file_get_contents($path)
                )
            );
        }
    }
}
