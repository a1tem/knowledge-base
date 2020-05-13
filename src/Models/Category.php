<?php

namespace A1tem\KnowledgeBase\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Category
 *
 * @package A1tem\KnowledgeBase\Models
 * @author  Artem Petrusenko <artempetrusenko@gmail.com>
 */
class Category extends BaseModel
{
    protected $table = 'categories';

    protected $fillable = [
        'name',
        'user_id',
    ];

    /**
     * @param \A1tem\KnowledgeBase\Models\Category|null $category
     * @param string $name
     * @param int $userId
     *
     * @return static
     */
    public static function persist(?Category $category, string $name, int $userId): self
    {
        $data = [
            'name' => $name,
            'user_id' => $userId
        ];

        if ($category === null) {
            $category = self::create($data);
        } else {
            $category->fill($data)->save();
        }

        return $category;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fields(): HasMany
    {
        return $this->hasMany(Field::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }
}
