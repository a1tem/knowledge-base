<?php

namespace A1tem\KnowledgeBase\Resources\Field;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;

/**
 * Class FieldCollection
 *
 * @package A1tem\KnowledgeBase\Resources\Field
 * @author  Artem Petrusenko <artempetrusenko@gmail.com>
 */
class FieldCollection extends ResourceCollection
{
    public $collects = FieldResource::class;

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request): Collection
    {
        return $this->collection;
    }
}
