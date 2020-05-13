<?php

namespace A1tem\KnowledgeBase\Resources\Category;

use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class CategoryCollection
 *
 * @package A1tem\KnowledgeBase\Resources\Category
 * @author  Artem Petrusenko <artempetrusenko@gmail.com>
 */
class CategoryCollection extends ResourceCollection
{
    public $collects = CategoryResource::class;

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'data' => $this->collection,
        ];
    }
}
