<?php

namespace A1tem\KnowledgeBase\Resources\Category;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class CategoryResource
 *
 * @package A1tem\KnowledgeBase\Resources\Category
 * @author  Artem Petrusenko <artempetrusenko@gmail.com>
 */
class CategoryResource extends JsonResource
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
            'name' => $this->name,
        ];
    }
}
