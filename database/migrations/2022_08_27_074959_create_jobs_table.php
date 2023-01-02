<?php

use App\Models\Company;
use App\Models\Location;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title', 50);
            $table->string('short_description', 250)->nullable();
            $table->longText('full_description')->nullable();
            $table->longText('requirements')->nullable();
            $table->string('job_nature', 50)->nullable();
            $table->string('address')->nullable();
            $table->boolean('top_rated')->nullable()->default(false);
            $table->integer('salary');
            $table->timestamps();
            $table->softDeletes();
            $table->foreignIdFor(Location::class)->nullable();
            $table->foreignIdFor(Company::class)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
