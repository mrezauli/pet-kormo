<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToCategoryJobTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('category_job', function (Blueprint $table) {
            $table->foreign(['category_id'], 'category_id_fk_476513')->references(['id'])->on('categories')->onDelete('CASCADE');
            $table->foreign(['job_id'], 'job_id_fk_476513')->references(['id'])->on('jobs')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('category_job', function (Blueprint $table) {
            $table->dropForeign('category_id_fk_476513');
            $table->dropForeign('job_id_fk_476513');
        });
    }
}
