<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained('items');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('supplier_id')->nullable()->constrained('suppliers')->nullable();
            $table->integer('add_stock')->nullable();
            $table->integer('subtract_stock')->nullable();
            $table->string('unit');
            $table->dateTime('restock_out_date');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE stocks AUTO_INCREMENT = 7001;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stocks');
    }
}
