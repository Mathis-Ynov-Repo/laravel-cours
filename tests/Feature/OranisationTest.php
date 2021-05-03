<?php

namespace Tests\Feature;


use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Organisation;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class OranisationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function testWeCanCreateOrganisation()
    {
        $organisation = Organisation::create(['id' => Str::uuid(), 'name' => 'oui', 'email' => 'non']);
        $this->assertSame(expected: 'oui', $organisation->name);
    }
}
