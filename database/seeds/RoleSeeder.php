<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call('RoleDatabaseSeeder');
        $this->call(RoleDatabaseSeeder::class);
    }
}

class RoleDatabaseSeeder extends Seeder {
    public function run() 
    {
        Schema::disableForeignKeyConstraints();
        $roles = [
            ['admin', 'Admin', 'All permission'],
            ['User', 'User', 'User or Author'],
        ];

        foreach ($roles as $role) {
            DB::table('roles')->insert([
                'name' => $role[0],
                'display_name' => $role[1],
                'description' => $role[2],
            ]);
        }

        Schema::enableForeignKeyConstraints();
    }
}
// php artisan db:seed --class=RoleSeeder
