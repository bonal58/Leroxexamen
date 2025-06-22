<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        // Eenvoudige test om te controleren of de applicatie draait
        $response = $this->get('/');

        // We controleren alleen of de pagina succesvol laadt
        $response->assertSuccessful();
    }
}
