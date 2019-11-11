<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategoryDatabaseSeeder::class);
    }
}

class CategoryDatabaseSeeder extends Seeder {
    public function run() 
    {
        Schema::disableForeignKeyConstraints();
        $Categories = [
            ['TRANG CHỦ', '1','trang-chu', '1', '0'],
            ['SÁCH', '1', 'sach', '1', '0'],
            ['BLOG',  '1','blog', '1', '0'],
            ['TÁC GIẢ',  '1','tac-gia', '1', '0'],
            ['SỰ KIỆN', '1','su-kien', '1', '0'],
            ['TRANG', '1','trang', '1', '0'],
            ['LIÊN HỆ', '1','lien-he', '1', '0'],
            ['HOME', '1', 'home', '2', '1'],
            ['BOOK', '1', 'book', '2', '2'],
            ['BLOG', '1', 'blog', '2', '3'],
            ['AUTHOR', '1', 'author', '2', '4'],
            ['EVENTS', '1', 'events', '2', '5'],
            ['PAGE', '1', 'page', '2', '6'],
            ['CONTACT US', '1', 'contact-us', '2', '7'],

        ];

        foreach ($Categories as $Category) {
            DB::table('categories')->insert([
                'title' => $Category[0],
                'parent_id' => $Category[1],
                'slug' => $Category[2],
                'language_id' => $Category[3],
                'parent_language_id' => $Category[4],
            ]);
        }

        Schema::enableForeignKeyConstraints();
    }
}
// php artisan db:seed --class=CategorySeeder
