<?php

namespace A1tem\KnowledgeBase\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class CategoryRequest
 *
 * @package A1tem\Requests
 * @author  Artem Petrusenko <artempetrusenko@gmail.com>
 */
class CategoryRequest extends FormRequest
{
    const FIELD_NAME = 'name';

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
        $uniqueName = ($this->category !== null)
            ? Rule::unique(config('knowledge-base.table_prefix') . 'categories')->ignore($this->category->id)
            : Rule::unique(config('knowledge-base.table_prefix') . 'categories');

        return [
            self::FIELD_NAME => ['required', $uniqueName]
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            self::FIELD_NAME . '.unique' => 'The category with the same name already exists'
        ];
    }
}
