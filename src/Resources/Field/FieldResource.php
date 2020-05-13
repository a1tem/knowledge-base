<?php

namespace A1tem\KnowledgeBase\Resources\Field;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class FieldResource
 *
 * @package A1tem\KnowledgeBase\Resources\Field
 * @author  Artem Petrusenko <artempetrusenko@gmail.com>
 */
class FieldResource extends JsonResource
{
    const PROPERTY_ID = 'id';
    const PROPERTY_CATEGORY_ID = 'categoryId';
    const PROPERTY_LABEL = 'label';
    const PROPERTY_DEFAULT_VALUE = 'defaultValue';
    const PROPERTY_IS_REQUIRED = 'isRequired';
    const PROPERTY_TYPE = 'type';
    const PROPERTY_META_DATA = 'metaData';
    const PROPERTY_VALUE = 'value';

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        $result =  [
            self::PROPERTY_ID => $this->id,
            self::PROPERTY_CATEGORY_ID => $this->category_id,
            self::PROPERTY_LABEL => $this->label,
            self::PROPERTY_DEFAULT_VALUE => $this->default_value,
            self::PROPERTY_IS_REQUIRED => $this->is_required,
            self::PROPERTY_TYPE => $this->type,
            self::PROPERTY_META_DATA => $this->meta_data,
            self::PROPERTY_VALUE => $this->pivot->value ?? $this->default_value
        ];

        return $result;
    }

}
