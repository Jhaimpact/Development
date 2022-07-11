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
        Schema::table('users',function(Blueprint $table){
            $table->string('username')->after('email');
            $table->string('contact',10)->after('email');
            $table->integer('otp')->after('email')->nullable();
            $table->integer('card_id')->after('email')->nullable();
            $table->boolean('is_social_login')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username');
            $table->dropColumn('contact');
            $table->dropColumn('otp');
            $table->dropColumn('card_id');
            $table->dropColumn('is_social_login');
        });
    }
};
