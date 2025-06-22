<?php

namespace Tests\Feature;

use App\Models\Part;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PartTest extends TestCase
{
    use RefreshDatabase;

    public function test_parts_page_loads_correctly()
    {
        // Maak een onderdeel aan
        Part::factory()->create([
            'name' => 'Test Onderdeel',
            'category' => 'Motor',
            'price' => 99.99,
            'sku' => 'TST-12345'
        ]);

        // Bezoek de onderdelen pagina
        $response = $this->get('/parts');

        // Controleer of de response succesvol is
        $response->assertStatus(200);
        
        // Controleer of het onderdeel naam op de pagina staat
        $response->assertSee('Test Onderdeel');
    }

    public function test_admin_can_create_part()
    {
        // Maak een admin gebruiker
        $admin = User::factory()->create([
            'role' => 'admin'
        ]);

        // Authenticeer als admin
        $this->actingAs($admin);

        // Maak een POST request om een onderdeel aan te maken
        $response = $this->post('/parts', [
            'name' => 'Nieuw Test Onderdeel',
            'category' => 'Elektrisch',
            'description' => 'Dit is een test onderdeel',
            'price' => 149.99,
            'sku' => 'NTO-54321',
            'stock' => 10
        ]);

        // Controleer of het onderdeel is aangemaakt in de database
        $this->assertDatabaseHas('parts', [
            'name' => 'Nieuw Test Onderdeel',
            'sku' => 'NTO-54321'
        ]);

        // Controleer of we worden doorgestuurd naar de onderdelen index pagina
        $response->assertRedirect('/parts');
    }

    public function test_sku_is_required()
    {
        // Maak een admin gebruiker
        $admin = User::factory()->create([
            'role' => 'admin'
        ]);

        // Authenticeer als admin
        $this->actingAs($admin);

        // Maak een POST request om een onderdeel aan te maken zonder SKU
        $response = $this->post('/parts', [
            'name' => 'Onderdeel Zonder SKU',
            'category' => 'Elektrisch',
            'description' => 'Dit is een test onderdeel',
            'price' => 149.99,
            'stock' => 10
        ]);

        // Controleer of we een validatiefout krijgen
        $response->assertSessionHasErrors('sku');

        // Controleer of het onderdeel NIET is aangemaakt in de database
        $this->assertDatabaseMissing('parts', [
            'name' => 'Onderdeel Zonder SKU'
        ]);
    }
}
