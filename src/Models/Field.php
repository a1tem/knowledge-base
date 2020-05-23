<?php

namespace A1tem\KnowledgeBase\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Field
 *
 * @package A1tem\KnowledgeBase\Models
 * @author  Artem Petrusenko <artempetrusenko@gmail.com>
 */
class Field extends BaseModel
{
    const TABLE_NAME = 'category_fields';
    protected $table = self::TABLE_NAME;

    const TYPE_TEXT = 'text';
    const TYPE_TEXTAREA = 'textarea';
    const TYPE_NUMBER = 'number';
    const TYPE_CHECKBOX = 'checkbox';
    const TYPE_SELECT = 'select';
    const TYPE_DATE = 'date';

    public static $types = [
        self::TYPE_TEXT,
        self::TYPE_TEXTAREA,
        self::TYPE_NUMBER,
        self::TYPE_CHECKBOX,
        self::TYPE_SELECT,
        self::TYPE_DATE
    ];

    protected $casts = [
        'meta_data' => 'json',
        'is_required' => 'boolean',
    ];

    protected $fillable = [
        'category_id',
        'type',
        'label',
        'default_value',
        'is_required',
        'meta_data'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @param \A1tem\KnowledgeBase\Models\Field|null $field
     * @param int $categoryId
     * @param string $type
     * @param string $label
     * @param $defaultValue
     * @param bool $isRequired
     * @param array $metaData
     *
     * @return static
     */
    public static function persist(
        ?Field $field,
        int $categoryId,
        string $type,
        string $label,
        $defaultValue,
        bool $isRequired,
        array $metaData
        ): self
    {
        $data = [
            'category_id' => $categoryId,
            'type' => $type,
            'label' => $label,
            'default_value' => $defaultValue,
            'is_required' => $isRequired,
            'meta_data' => $metaData
        ];

        if ($field === null) {
            $field = self::create($data);
        } else {
            $field->fill($data)->save();
        }

        return $field;
    }
}
