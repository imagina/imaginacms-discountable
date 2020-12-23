<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscountableDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discountable__discounts', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->string('name');

            $table->float('value', 20, 2);

            $table->string('code')->nullable();

            $table->enum('type',['coupon','discount']);

            $table->enum('criteria',['percentage','fixed']);

            $table->tinyInteger('status')->default(0);
            // Your fields
            $table->timestamps();
        });

        Schema::create('discountable__discountable', function (Blueprint $table) {
          $table->increments('id');
          $table->string('discountable_type');
          $table->integer('discountable_id')->unsigned();
          $table->integer('discount_id')->unsigned();
          $table->index(['discountable_type', 'discountable_id'], 'discountable_type_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('discountable__discountable');
      Schema::dropIfExists('discountable__discounts');
    }
}
