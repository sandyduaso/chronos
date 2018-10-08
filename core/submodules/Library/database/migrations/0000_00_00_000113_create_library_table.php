<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreateLibraryTable extends Migration
{
    /**
     * The table name.
     *
     * @var string
     */
    protected $table = 'library';

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
            $table->increments('id');
            $table->string('name');
            $table->string('originalname');
            $table->string('filename')->unique()->nullable();
            $table->text('pathname')->nullable();
            $table->integer('size')->nullable();
            $table->string('mimetype')->nullable();
            $table->string('type')->nullable();
            $table->text('description')->nullable();
            $table->text('thumbnail')->nullable();
            $table->text('url')->nullable();
            $table->integer('catalogue_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('catalogue_id')->references('id')->on('catalogues');
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
