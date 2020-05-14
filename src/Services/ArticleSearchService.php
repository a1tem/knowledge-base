<?php

namespace A1tem\KnowledgeBase\Services;

use A1tem\KnowledgeBase\Models\Article;
use Illuminate\Support\Collection;

/**
 * Class ArticleSearchService
 *
 * @package A1tem\KnowledgeBase\Services
 * @author  Artem Petrusenko <artempetrusenko@gmail.com>
 */
class ArticleSearchService
{
    /**
     * @param string $q
     *
     * @return \Illuminate\Support\Collection
     */
    public static function search($q = ''): Collection
    {
        return Article::whereHas('fields', function ($query) use ($q) {
            $query->where('value', 'like', '%' . $q . '%');
        })
            ->orWhere('title', 'like', '%' . $q . '%')
            ->orWhere('content', 'like', '%' . $q . '%')
            ->get();
    }
}
