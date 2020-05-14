<?php

namespace A1tem\KnowledgeBase\Services;

use A1tem\KnowledgeBase\Models\Attribute;
use A1tem\KnowledgeBase\Models\Category;
use A1tem\KnowledgeBase\Models\Field;

/**
 * Class FieldsService
 *
 * @package A1tem\KnowledgeBase\Services
 * @author  Artem Petrusenko <artempetrusenko@gmail.com>
 */
class FieldsService
{
    /**
     * @param \A1tem\KnowledgeBase\Models\Category $category
     * @param $type
     * @param $label
     * @param $defaultValue
     * @param $isRequired
     * @param $metaData
     *
     * @return mixed
     */
    public function createField(
        Category $category,
        $type,
        $label,
        $defaultValue,
        $isRequired,
        $metaData
    ) {
        $field = Field::persist(null, $category->id, $type, $label, $defaultValue, $isRequired, $metaData);
        $articles = $category->articles;

        /** @var \A1tem\KnowledgeBase\Models\Article $article */
        foreach ($articles as $article) {
            $article->fields()->attach([$field->id => ['value' => $field->default_value]]);
        }

        return $field;
    }

    /**
     * @param \A1tem\KnowledgeBase\Models\Field $field
     * @param string $type
     * @param string $label
     * @param $defaultValue
     * @param bool $isRequired
     * @param array $metaData
     *
     * @return mixed
     */
    public function updateField(
        Field $field,
        string $type,
        string $label,
        $defaultValue,
        bool $isRequired,
        array $metaData
    ) {
        $result = Field::persist(
            $field,
            $field->category->id,
            $type,
            $label,
            $defaultValue,
            $isRequired,
            $metaData
        );

        return $result;
    }
}
