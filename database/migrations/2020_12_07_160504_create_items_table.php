<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_type_id')->constrained('itemtypes');
            $table->foreignId('user_id')->constrained('users');
            $table->string('item_name');
            $table->float('item_price')->money_format();
            $table->string('perishable_state');
            $table->string('dry_wet_state');
            $table->softDeletes();
            $table->timestamps();
        });
        DB::statement("ALTER TABLE items AUTO_INCREMENT = 4001;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
