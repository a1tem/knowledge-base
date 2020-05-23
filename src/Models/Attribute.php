<?php

namespace A1tem\KnowledgeBase\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Class Attribute
 *
 * @package A1tem\KnowledgeBase\Models
 * @author  Artem Petrusenko <artempetrusenko@gmail.com>
 */
class Attribute extends Pivot
{
    const TABLE_NAME = 'category_attributes';
    protected $table = self::TABLE_NAME;

    protected $with = [
        'field'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function field(): BelongsTo
    {
        return $this->belongsTo(Field::class, 'category_field_id');
    }

    /**
     * @param $value
     *
     * @return bool
     */
    public function getValueAttribute($value)
    {
        if ($this->field->type === Field::TYPE_CHECKBOX) {
            return (bool)$value;
        }

        return $value;
    }

    /**
     * @param int $fieldId
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getAllByFieldId(int $fieldId): Collection
    {
        return self::where('category_field_id', $fieldId)->get();
    }
}
