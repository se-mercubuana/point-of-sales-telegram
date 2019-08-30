<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Bank;
use App\Role;
use App\User;
use \Faker\Provider\Uuid;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    public function testCase()
    {
        $managerId = Role::where('name', 'Manager')->first()->id;

        $user = User::where('username', 'kelompokpos')->get();
        $bank = Bank::where('no_rekening', '12345678')->get();

        if (count($user) > 0) {
            $user->first()->delete();
        }

        if (count($bank) > 0) {
            $bank->first()->delete();
        }

        $user = \App\User::create([
            'id' => Uuid::uuid(),
            'name' => "Kelompok POS",
            'username' => "kelompokpos",
            'password' => bcrypt('12345678'),
            'role_id' => $managerId,
            'is_active' => true,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);

        $bank = \App\Bank::create([
            'id' => Uuid::uuid(),
            'name' => "BCA",
            'no_rekening' => "12345678",
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);

        $bank->delete();
        $user->delete();
    }


}
