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
        Schema::table('products',function(Blueprint $table){
            $table->string("discount_type")->default(0);
            $table->renameColumn("discount_pert",'discount')->nullable(0);
            $table->integer('product_sku')->nullable()->change();
            $table->integer('product_barcode')->nullable()->change();
            $table->text('product_tags')->nullable()->change();
            $table->float('purchase_price')->nullable()->change();
            $table->integer('size_attribute_group_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
