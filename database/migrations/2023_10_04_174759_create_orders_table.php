<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->Integer('vehicle_id')->default(0);
            $table->string('name', 200)->nullable();
            $table->text('address')->nullable();
            $table->string('city', 200)->nullable();
            $table->string('state', 200)->nullable();
            $table->string('country', 200)->nullable();
            $table->string('zip', 50)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('work_phone', 100)->nullable();
            $table->string('home_phone', 100)->nullable();
            $table->string('cellular_phone', 100)->nullable();
            $table->string('fax', 100)->nullable();
            $table->string('consignee_name', 100)->nullable();
            $table->text('consignee_address')->nullable();
            $table->string('consignee_city', 100)->nullable();
            $table->string('consignee_state', 100)->nullable();
            $table->string('consignee_country', 100)->nullable();
            $table->string('consignee_zip', 100)->nullable();
            $table->string('consignee_email', 100)->nullable();
            $table->string('consignee_work_phone', 100)->nullable();
            $table->string('consignee_home_phone', 100)->nullable();
            $table->string('consignee_fax', 100)->nullable();
            $table->string('permit_no', 100)->nullable();
            $table->string('payment_mode', 100)->nullable();
            $table->string('destination_port', 100)->nullable();
            $table->string('destination_country', 100)->nullable();
            $table->tinyInteger('status')->default(0);
            $table->softDeletesTz($column = 'deleted_at', $precision = 0);
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
        Schema::dropIfExists('orders');
    }
};
