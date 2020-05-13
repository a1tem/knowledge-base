<?php

namespace A1tem\KnowledgeBase\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

/**
 * Class Article
 *
 * @package A1tem\KnowledgeBase\Models
 * @author  Artem Petrusenko <artempetrusenko@gmail.com>
 */
class Article extends BaseModel
{
    protected $table = 'articles';

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected $fillable = [
        'title',
        'content',
        'user_id',
        'category_id',
        'slug'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(config('knowledge-base.user_model'), 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fields(): BelongsToMany
    {
        return $this->belongsToMany(
            Field::class, config('knowledge-base.table_prefix') . 'category_attributes',
            'article_id',
            'category_field_id'
        )
            ->using(Attribute::class)
            ->withPivot('value');
    }

    /**
     * @param \A1tem\KnowledgeBase\Models\Article|null $article
     * @param string $title
     * @param string $content
     * @param array $attributes
     * @param int $userId
     *
     * @return static
     */
    public static function persist(
        ?Article $article,
        int $categoryId,
        string $title,
        string $content,
        array $attributes,
        int $userId
    ): self {

        $data = [
            'title' => $title,
            'content' => $content,
            'user_id' => $userId,
            'category_id' => $categoryId,
            'slug' => Str::slug($title),
        ];

        if ($article === null) {
            $article = self::create($data);
        } else {
            $article->fill($data)->save();
        }

        $fields = [];

        foreach ($attributes as $attribute) {
            $fields[$attribute['id']] = ['value' => $attribute['value']];
        }

        $article->fields()->sync($fields);

        return $article;
    }
}
