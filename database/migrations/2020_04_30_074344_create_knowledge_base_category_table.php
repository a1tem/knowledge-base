p<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateKnowledgeBaseCategoryTable
 *
 * @package A1tem\KnowledgeBase\Migrations
 * @author  Artem Petrusenko <artempetrusenko@gmail.com>
 */
class CreateKnowledgeBaseCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(config('knowledge-base.table_prefix').'categories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('name');

            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists(config('knowledge-base.table_prefix').'categories');
    }
}
