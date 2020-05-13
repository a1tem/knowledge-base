<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use A1tem\KnowledgeBase\Models\Field;

/**
 * Class CreateKnowledgeBaseCategoryFieldsTable
 *
 * @package A1tem\KnowledgeBase\Migrations
 * @author  Artem Petrusenko <artempetrusenko@gmail.com>
 */
class CreateKnowledgeBaseCategoryFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(config('knowledge-base.table_prefix').'category_fields', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('category_id');
            $table->string('label');
            $table->string('default_value')->nullable();
            $table->boolean('is_required');
            $table->enum('type', Field::$types);
            $table->json('meta_data')->nullable();
            $table->timestamps();

            $table->foreign('category_id')
                ->references('id')
                ->on(config('knowledge-base.table_prefix').'categories')
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
        Schema::dropIfExists(config('knowledge-base.table_prefix').'category_fields');
    }
}
