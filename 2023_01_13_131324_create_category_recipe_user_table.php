<?php

use Illuminate\Database\Eloquent\Relations\Pivot;
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
        Schema::create('category_recipe_user', function (Blueprint $table) {
            // $table->bigIncrements('id');
            $table->primary(['user_id', 'category_id']);
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('category_id')->unsigned();
            $table->bigInteger('recipe_id')->unsigned()->nullable();

            $table->foreign('user_id', 'pivotTable_userId')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id', 'pivotTable_categoryId')->references('id')->on('categories')->onDelete('cascade');
            // $table->foreign('recipe_id', 'pivotTable_recipeId')->references('id')->on('recipes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_recipe_user');
    }
};
