<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributeOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(config('rinvex.attributes.tables.attribute_options'), function (Blueprint $table) {
            // Columns
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('attribute_id')->unsigned();
            $table->string('value');
            $table->text('label');
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            // Indexes
            $table->foreign('attribute_id')->references('id')->on(config('rinvex.attributes.tables.attributes'))
                  ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists(config('rinvex.attributes.tables.attribute_options'));
    }
}
