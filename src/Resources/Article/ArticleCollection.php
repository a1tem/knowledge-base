<?php

namespace A1tem\KnowledgeBase\Resources\Article;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;

/**
 * Class ArticleCollection
 *
 * @package A1tem\KnowledgeBase\Resources\Article
 * @author  Artem Petrusenko <artempetrusenko@gmail.com>
 */
class ArticleCollection extends ResourceCollection
{
    public $collects = ArticleCollectionResource::class;

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return Collection
     */
    public function toArray($request): Collection
    {
        return $this->collection;
    }
}
