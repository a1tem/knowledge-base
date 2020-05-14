<?php

namespace A1tem\KnowledgeBase\Services;

use A1tem\KnowledgeBase\Models\Category;

/**
 * Class CategoryService
 *
 * @package A1tem\KnowledgeBase\Services
 * @author  Artem Petrusenko <artempetrusenko@gmail.com>
 */
class CategoryService
{
    /**
     * @param \A1tem\KnowledgeBase\Services\FieldsService $fieldsService
     * @param \A1tem\KnowledgeBase\Models\Category $category
     *
     * @return \A1tem\KnowledgeBase\Models\Category
     */
    public static function copyCategory(FieldsService $fieldsService, Category $category): Category
    {
        $newCategory = Category::persist(null, self::generateName($category->name), $category->user_id);

        foreach ($category->fields->toArray() as $field) {
            $fieldsService->createField(
                $newCategory,
                $field['type'],
                $field['label'],
                $field['default_value'],
                $field['is_required'],
                $field['meta_data']
            );
        }

        return $newCategory;
    }

    /**
     * @param string $name
     *
     * @return string
     */
    protected static function generateName(string $name): string
    {
        $newName = $name;

        while (true) {
            $newName .= ' copy';
            if (Category::where('name', $newName)->count() === 0) {
                break;
            }
        }

        return $newName;
    }
}
