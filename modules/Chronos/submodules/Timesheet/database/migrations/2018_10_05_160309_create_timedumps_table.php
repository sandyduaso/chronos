<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimedumpsTable extends Migration
{
    /**
     * The table name.
     *
     * @var string
     */
    protected $table = 'timedumps';

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
            $table->date('date');
            $table->string('key')->index();
            $table->time('time_in');
            $table->time('time_out');
            $table->time('total_am');
            $table->time('total_pm');
            $table->time('total_time');
            $table->time('tardy_time');
            $table->time('under_time');
            $table->time('over_time');
            $table->time('offset_hours');
            $table->integer('timesheet_id')->unsigned();
            $table->text('metadata')->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('CASCADE')
                  ->onUpdate('CASCADE');
            $table->foreign('timesheet_id')
                  ->references('id')
                  ->on('timesheets')
                  ->onDelete('CASCADE')
                  ->onUpdate('CASCADE');
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
