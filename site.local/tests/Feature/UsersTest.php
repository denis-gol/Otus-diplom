<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class UsersTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
//    public function testExample()
//    {
//        $response = $this->get('/');
//
//        $response->assertStatus(200);
//    }

    /**
     * Получить случайного пользователя из таблицы.
     */
    public function testGetRandomUser()
    {
        $user = DB::table('users')
            ->inRandomOrder()
            ->first();

        $this->assertNotEmpty($user->id, 'Random user doesn\'t exist');
    }
}
