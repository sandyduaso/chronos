<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreateCalendarsTable extends Migration
{
    /**
     * The table name.
     *
     * @var string
     */
    protected $table = 'calendars';

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
            $table->date('date')->index();
            $table->dateTime('datetime');
            $table->unsignedInteger('day');
            $table->unsignedInteger('month');
            $table->unsignedInteger('year');
            $table->unsignedInteger('week');
            $table->unsignedInteger('weekday');
            $table->boolean('weekend');
            $table->string('month_name', 16);
            $table->string('weekday_name', 16);
            $table->string('holiday');

            // Indexes
            $table->index(['year', 'month', 'day']);
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
