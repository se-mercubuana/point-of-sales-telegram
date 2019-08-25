<?php

use Illuminate\Database\Seeder;
use \Faker\Provider\Uuid;

class BanksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Bank::insert([
            'id' => Uuid::uuid(),
            'name' => "BCA",
            'no_rekening' => 5435047031,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        \App\Bank::insert([
            'id' => Uuid::uuid(),
            'name' => "Mandiri",
            'no_rekening' => 7236047435,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        \App\Bank::insert([
            'id' => Uuid::uuid(),
            'name' => "BRI",
            'no_rekening' => 9236447432,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);


//  Role   ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $managerId = Uuid::uuid();
        \App\Role::insert([
            'id' => $managerId,
            'name' => "Manager",
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        \App\Role::insert([
            'id' => Uuid::uuid(),
            'name' => "Admin",
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);


//  User   ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        \App\User::insert([
            'id' => Uuid::uuid(),
            'name' => "Gema Akbar",
            'username' => "gemaakbar",
            'password' => bcrypt('12345678'),
            'role_id' => $managerId,
            'is_active' => true,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);


//  Customer   ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $customerId = Uuid::uuid();
        \App\Customer::insert([
            'id' => $customerId,
            'code' => "F09-02",
            'name' => "Bu Aisyah",
            'no_telp' => "0811182210",
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);


        \App\CustomerAddress::insert([
            'id' => Uuid::uuid(),
            'full_name' => "Bu Aisyah",
            'address' => "Jakarta, Jln Wirawan blok C no 49",
            'city' => "Jakarta",
            'customer_id' => $customerId,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);


        \App\CustomerAddress::insert([
            'id' => Uuid::uuid(),
            'full_name' => "Bu Aisyah Bogorz",
            'address' => "Bogor, Jln Balita blok A no 6",
            'city' => "Bogor",
            'customer_id' => $customerId,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);


//  Product   ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $productId = Uuid::uuid();
        $productName = "Gold Lovely";
        $productModal = 75000;
        $productPrice = 250000;

        \App\Product::insert([
            'id' => $productId,
            'name' => $productName,
            'modal' => $productModal,
            'price' => $productPrice,
            'is_active' => true,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        \App\Product::insert([
            'id' => Uuid::uuid(),
            'name' => 'Miracle Woman',
            'modal' => 20000,
            'price' => 100000,
            'is_active' => true,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);


//  ProductLog   ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//        jika transaksi terbuat maka
//        check di ProductLog ada tidak spesifikasi seperti product
//        jika ada gunakan id tersebut
//        jika tidak ada maka create baru

        \App\ProductLog::insert([
            'id' => Uuid::uuid(),
            'name' => $productName,
            'modal' => $productModal,
            'price' => $productPrice,
            'product_id' => $productId,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);


        \App\TransactionStatus::insert([
            'id' => Uuid::uuid(),
            'name' => 'Menunggu Pembayaran',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        \App\TransactionStatus::insert([
            'id' => Uuid::uuid(),
            'name' => 'Packing',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        \App\TransactionStatus::insert([
            'id' => Uuid::uuid(),
            'name' => 'Dikirim',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);


    }
}
