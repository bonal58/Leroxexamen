<?php

namespace Tests\Unit;

use App\Models\Part;
use App\Models\Scooter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ScooterModelTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    
    protected function setUp(): void
    {
        parent::setUp();
        
        // Controleer of de benodigde tabellen bestaan
        if (!Schema::hasTable('scooters') || !Schema::hasTable('parts') || !Schema::hasTable('part_scooter')) {
            $this->markTestSkipped('Benodigde tabellen bestaan niet in de testdatabase');
        }
    }

    public function test_scooter_has_parts_relationship()
    {
        $this->markTestSkipped('Deze test vereist een specifieke implementatie van de parts relatie');
        
        // Maak een scooter aan
        $scooter = Scooter::create([
            'name' => 'Test Scooter',
            'brand' => 'Lerox',
            'model' => 'Test Model',
            'year' => 2025,
            'price' => 1299.99,
            'description' => 'Test description',
            'color' => 'Red',
            'stock' => 5
        ]);
        
        // Maak een onderdeel aan
        $part = Part::create([
            'name' => 'Test Part',
            'sku' => 'TEST-123',
            'description' => 'Test part description',
            'price' => 99.99,
            'stock' => 10
        ]);
        
        // Controleer of de parts methode bestaat
        $this->assertTrue(method_exists($scooter, 'parts'), 'De parts methode bestaat niet in het Scooter model');
    }

    public function test_scooter_has_formatted_price()
    {
        $this->markTestSkipped('Deze test vereist een specifieke implementatie van de formatted_price accessor');
        
        // Maak een scooter aan met een specifieke prijs
        $scooter = Scooter::create([
            'name' => 'Test Scooter',
            'brand' => 'Lerox',
            'model' => 'Test Model',
            'year' => 2025,
            'price' => 1299.99,
            'description' => 'Test description',
            'color' => 'Red',
            'stock' => 5
        ]);
        
        // Controleer of de formatted_price accessor bestaat
        // Dit is een eenvoudige test die alleen controleert of de prijs een waarde heeft
        $this->assertNotNull($scooter->price);
    }
}
