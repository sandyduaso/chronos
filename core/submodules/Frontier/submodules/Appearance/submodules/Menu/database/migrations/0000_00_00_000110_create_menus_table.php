<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * The table name.
     *
     * @var string
     */
    protected $table = 'menus';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->table)) {
            return;
        }

        Schema::create($this->table, function (Blueprint $table) {
            // $table->increments('id');
            $table->string('title');
            $table->string('code');
            $table->string('location');
            $table->string('icon')->nullable();
            $table->string('slug')->nullable()->default('');
            $table->string('key')->unique();
            $table->string('type')->nullable();
            $table->integer('sort')->unsigned()->default(0);
            $table->string('parent')->nullable();
            $table->integer('lft')->unsigned()->nullable();
            $table->integer('rgt')->unsigned()->nullable();
            $table->timestamps();
            $table->index(['location', 'type', 'slug', 'icon']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->table);
    }
}
