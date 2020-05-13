<?php

namespace A1tem\KnowledgeBase\Resources\Article;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class ArticleCollectionResource
 *
 * @package A1tem\KnowledgeBase\Resources\Article
 * @author  Artem Petrusenko <artempetrusenko@gmail.com>
 */
class ArticleCollectionResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'categoryId' => $this->category_id,
            'author' => $this->author->name
        ];
    }
}
