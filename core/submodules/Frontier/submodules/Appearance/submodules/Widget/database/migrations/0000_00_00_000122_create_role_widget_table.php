<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreateRoleWidgetTable extends Migration
{
    /**
     * The table name.
     *
     * @var string
     */
    protected $table = 'role_widget';

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
            $table->integer('role_id')->unsigned();
            $table->integer('widget_id')->unsigned();

            $table->foreign('role_id')->references('id')->on('roles')
                  ->onUpdate('CASCADE')
                  ->onDelete('CASCADE');
            $table->foreign('widget_id')->references('id')->on('widgets')
                  ->onUpdate('CASCADE')
                  ->onDelete('CASCADE');
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
