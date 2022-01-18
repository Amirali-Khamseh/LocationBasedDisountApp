<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Role;
use App\Models\Category;

class CreteProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id')->default(0);
            $table->unsignedBigInteger('owner_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('title');
            $table->bigInteger('price')->default(0);
            $table->integer('discount_percent')->default(0);
            $table->text('description');
            $table->text('product_link')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('is_slider')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
        Role::create(['title' => 'admin']);
        Role::create(['title' => 'user']);
        Role::create(['title' => 'producer']);
        // password 123123123
        User::create([
            'email' => 'test@info.com',
            'password' => '$2y$10$cZ0ZptW/hZ2Jjs2Bf8IHw.hW3TV.ToYpqIVa9cYKxsUjzPj6zc706',
            'name' => 'test',
            'family' => 'testy',
            'role_id' => '1'
        ]);
        Category::create(['title' => 'Electronics','parent_id' => 0,'status' => 1]);
        Category::create(['title' => 'Mobile','parent_id' => 1,'status' => 1]);
        Category::create(['title' => 'Tablet','parent_id' => 1,'status' => 1]);
        Category::create(['title' => 'Clothes','parent_id' => 0,'status' => 1]);
        Category::create(['title' => 'Men','parent_id' => 4,'status' => 1]);
        Category::create(['title' => 'Women','parent_id' => 4,'status' => 1]);
        Category::create(['title' => 'Toy','parent_id' => 0,'status' => 1]);
        Category::create(['title' => 'cars','parent_id' => 7,'status' => 1]);
        Category::create(['title' => 'doll','parent_id' => 7,'status' => 1]);
    }
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
