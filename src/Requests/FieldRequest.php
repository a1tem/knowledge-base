<?php

namespace A1tem\KnowledgeBase\Requests;

use Illuminate\Foundation\Http\FormRequest;
use A1tem\KnowledgeBase\Models\Field;

/**
 * Class FieldRequest
 *
 * @package A1tem\Requests
 * @author  Artem Petrusenko <artempetrusenko@gmail.com>
 */
class FieldRequest extends FormRequest
{
    const FIELD_TYPE = 'type';
    const FIELD_LABEL = 'label';
    const FIELD_DEFAULT_VALUE = 'default_value';
    const FIELD_IS_REQUIRED = 'is_required';
    const FIELD_META_DATA = 'meta_data';

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $result = [
            self::FIELD_TYPE => 'required',
            self::FIELD_LABEL => 'required',
            self::FIELD_DEFAULT_VALUE => 'present',
            self::FIELD_IS_REQUIRED => 'present',
            self::FIELD_META_DATA => 'present',
        ];

        if ($this->type === Field::TYPE_SELECT) {
            $result[self::FIELD_DEFAULT_VALUE] = 'in_array:meta_data.values.*';
        }

        return $result;
    }
}
