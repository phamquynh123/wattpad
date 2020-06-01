<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleDatabaseSeeder::class);
    }
}

class UserDatabaseSeeder extends Seeder {
    public function run() 
    {
        //
        Schema::disableForeignKeyConstraints();
        $users = [
            
        ];

        foreach ($users as $user) {
            DB::table('users')->insert([
                'name' => $user[0],
                'description' => $user[1],
                'avatar' ,
                'account_status', //vip or normal
                'role_id',
                'status', //active deactive
                'password',
                'email',
            ]);
        }

        Schema::enableForeignKeyConstraints();
    }
}
