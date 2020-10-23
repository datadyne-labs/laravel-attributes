<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(config('rinvex.attributes.tables.attributes'), function (Blueprint $table) {
            // Columns
            $table->bigIncrements('id');
            $table->string('slug');
            $table->{$this->jsonable()}('name');
            $table->{$this->jsonable()}('description')->nullable();
            $table->mediumInteger('sort_order')->unsigned()->default(0);
            $table->string('group')->nullable();
            $table->string('type');
            $table->boolean('is_required')->default(false);
            $table->boolean('is_collection')->default(false);
            $table->boolean('is_sortable')->default(false);
            $table->boolean('is_filterable')->default(false);
            $table->text('default')->nullable();
            $table->string('frontend_type')->nullable();
            $table->bigInteger('owner_id')->unsigned();
            $table->timestamps();

            // Indexes
            $table->unique('slug');

            $table->foreign('owner_id')->references('id')->on(config('rinvex.attributes.tables.attribute_owner'))
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
        Schema::dropIfExists(config('rinvex.attributes.tables.attributes'));
    }

    /**
     * Get jsonable column data type.
     *
     * @return string
     */
    protected function jsonable(): string
    {
        $driverName = DB::connection()->getPdo()->getAttribute(PDO::ATTR_DRIVER_NAME);
        $dbVersion = DB::connection()->getPdo()->getAttribute(PDO::ATTR_SERVER_VERSION);
        $isOldVersion = version_compare($dbVersion, '5.7.8', 'lt');

        return $driverName === 'mysql' && $isOldVersion ? 'text' : 'json';
    }
}
