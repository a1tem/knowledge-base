<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateKnowledgeBaseArticlesTable
 *
 * @package A1tem\KnowledgeBase\Migrations
 * @author  Artem Petrusenko <artempetrusenko@gmail.com>
 */
class CreateKnowledgeBaseArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(config('knowledge-base.table_prefix') . 'articles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedInteger('category_id');
            $table->string('slug');
            $table->string('title');
            $table->longText('content');
            $table->timestamps();

            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null');

            $table->unique('slug');

            $table
                ->foreign('category_id')
                ->references('id')
                ->on(config('knowledge-base.table_prefix') . 'categories')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('knowledge_base_articles');
    }
}
