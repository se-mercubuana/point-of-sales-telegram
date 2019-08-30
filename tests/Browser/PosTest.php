<?php

namespace Tests\Browser;

use App\Bank;
use App\Role;
use App\User;
use \Faker\Provider\Uuid;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PosTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testCase()
    {
        $user = $this->createUser();


        $this->browse(function ($browser) use ($user) {
            $browser->visit('/')
                ->type('username', $user->username)
                ->type('password', '12345678')
                ->press('Login')
                ->assertPathIs('/home');

            $browser->visit('/bank/create')
                ->type('no_rekening', '12345678')
//                ->executeScript("document.getElementById('submitBank').click();")
                ->press('Submit');
//                ->click('.postbank');
//                ->assertPathIs('/bank');
        });

        Bank::where('no_rekening', '12345678')->first()->delete();
        $user->delete();
    }

    public function createUser()
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

        return $user;
    }


}
