<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateKnowledgeBaseCategoryAttributesTable
 *
 * @package A1tem\KnowledgeBase\Migrations
 * @author  Artem Petrusenko <artempetrusenko@gmail.com>
 */
class CreateKnowledgeBaseCategoryAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(config('knowledge-base.table_prefix') . 'category_attributes', function (Blueprint $table) {
            $table->unsignedInteger('article_id');
            $table->unsignedInteger('category_field_id');
            $table->longText('value')->nullable();
            $table->timestamps();

            $table
                ->foreign('article_id')
                ->references('id')
                ->on(config('knowledge-base.table_prefix') . 'articles')
                ->onDelete('cascade');

            $table
                ->foreign('category_field_id')
                ->references('id')
                ->on(config('knowledge-base.table_prefix') . 'category_fields')
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
        Schema::dropIfExists(config('knowledge-base.table_prefix') . 'category_attributes');
    }
}
