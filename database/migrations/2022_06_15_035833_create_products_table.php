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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("product_name",255);
            $table->integer("product_sku")->unique();
            $table->integer("category_id");
            $table->string("product_barcode",255);
            $table->boolean("is_featured")->default(0);
            $table->boolean("is_flash_sale");
            $table->boolean("is_customizable");
            $table->boolean("can_return");
            $table->json("product_tags");
            $table->float("purchase_price");
            $table->float("sell_price");
            $table->text("product_description");
            $table->text("return_policy_description");
            $table->text("cod_policy_description");
            $table->integer("discount_pert");
            $table->string("feature_image",255);
            $table->boolean("is_active");
            $table->integer("size_attribute_group_id");
            $table->integer("system_user_id"); /**for the one who can add the things */
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
        Schema::dropIfExists('products');
    }
};
