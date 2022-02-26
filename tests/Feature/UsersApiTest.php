<?php

namespace Tests\Feature;

use App\Mail\UserWelcomeMail;
use App\Models\Categoria;
use App\Models\User;
use Database\Seeders\CategoriaSeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
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

    public function testUpdateUser()
    {
        User::factory()->count(50)->create();

        $userToEdit = User::find(1);

        $userToEdit->email = 'emaileditadotest@mail.com';
        $userToEdit->nombres = 'NombreEditado';


        $response = $this->putJson('api/users/1',$userToEdit->toArray());

        $response->assertStatus(204);

        $this->assertDatabaseHas('users', [
            'email' => 'emaileditadotest@mail.com',
        ]);

    }

    public function testValidationUpdateUser()
    {
        User::factory()->count(50)->create();

        $userToEdit = User::find(1);

        $userToEdit->email = 'emaileditadotest@mail';
        $userToEdit->nombres = 'joe';
        $userToEdit->apellidos = '6';
        $userToEdit->pais = 'Mexico';
        $userToEdit->celular = '321123';
        $userToEdit->cedula = 'd984';

        $response = $this->putJson('api/users/1',$userToEdit->toArray());

        $response->assertStatus(422);

        $response->assertJsonValidationErrors(
            [
                'nombres',
                'email',
                'apellidos',
                'pais',
                'celular',
                'cedula'
            ], $responseKey = 'errors');
    }

    public function testDeleteUser()
    {
        User::factory()->count(1)->create();

        $response = $this->delete('api/users/1');

        $response->assertStatus(204);

        $this->assertDatabaseMissing('users', [
            'id' => 1,
            'deleted_at' => null
        ]);
    }

    public function testPostUser()
    {
        User::factory()->count(50)->create();
        $user = User::factory()->make()->toArray();
        $user['password'] = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';

        $response = $this->postJson('api/users',$user);

        $response->assertStatus(201);

        unset($user['password']);

        $response->assertJson($user);

        $this->assertDatabaseHas('users',[
            'email' => $user['email']
        ]);
    }

    public function testShow()
    {
        $user = User::factory()->create();

        $response = $this->getJson('api/users/1');

        $response->assertStatus(200);

        $response->assertJson($user->toArray());
    }
}
