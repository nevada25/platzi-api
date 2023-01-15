<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $user = \App\Models\User::factory([
            "name" => "Administrador"
        ])->create();
        Schema::create('products', function (Blueprint $table) use ($user) {
            $table->id();
            $table->string('name');
            $table->float('price');
            $table->unsignedBigInteger('created_by')->default($user->id);
            $table->foreign('created_by')->references('id')->on('users');
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
