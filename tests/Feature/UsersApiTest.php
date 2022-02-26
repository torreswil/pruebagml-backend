<?php

namespace Tests\Feature;

use App\Models\Categoria;
use App\Models\User;
use Database\Seeders\CategoriaSeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UsersApiTest extends TestCase
{
    use DatabaseMigrations;

    protected $seed = true;


    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index_basic()
    {

        User::factory()->count(50)->create();

        $response = $this->get('/api/users');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                [
                    'nombres'
                ]
            ]
        ]);
    }

    public function test_index_filters()
    {

        User::factory()->count(50)->create([
            'categoria_id' => 2
        ]);
        User::factory()->count(10)->create([
            'categoria_id' => 2,
            'nombres' => 'Jhon',
            'pais' => 'Colombia'
        ]);

        $response = $this->get('/api/users?per_page=10&filter[search]=Jhon&filter[categoria_id]=2&filter[pais]=Colombia');

        $response->assertStatus(200);

        $data = json_decode($response->getContent(),1);

        $this->assertEquals('Colombia',$data['data'][5]['pais']);

        $this->assertGreaterThan(9,$data['total']);
        $this->assertLessThan(60,$data['total']);

    }
}
