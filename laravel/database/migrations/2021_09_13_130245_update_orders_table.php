<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            // $table->unsignedBigInteger('restaurant_id');
            // $table->string('name');
            // $table->string('lastname');
            // $table->string('address');
            // $table->string('phone');
            // $table->string('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            // $table->dropForeign('orders_client_id_foreign');
            // $table->dropColumn(['restaurant_id', 'name', 'lastname', 'address', 'phone', 'email']);
        });
    }
}
