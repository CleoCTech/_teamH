<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMergeReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merge_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('report_id')->nullable()->constrained('reports');
            $table->foreignId('category_id')->nullable()->constrained('merge_categories');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('merge_reports');
    }
}
