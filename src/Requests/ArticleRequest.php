<?php

namespace A1tem\KnowledgeBase\Requests;

use App\Models\Product\Attribute;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class ArticleRequest
 *
 * @package A1tem\KnowledgeBase\Requests
 * @author  Artem Petrusenko <artempetrusenko@gmail.com>
 */
class ArticleRequest extends FormRequest
{
    const FIELD_TITLE = 'title';
    const FIELD_SLUG = 'slug';
    const FIELD_CATEGORY_ID = 'categoryId';
    const FIELD_CONTENT = 'content';
    const FIELD_ATTRIBUTES = 'categoryAttributes';

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
        $uniqueName = ($this->article !== null)
            ? Rule::unique(config('knowledge-base.table_prefix') . 'articles')->ignore($this->article->id)
            : Rule::unique(config('knowledge-base.table_prefix') . 'articles');

        return [
            self::FIELD_TITLE => ['required', $uniqueName],
            self::FIELD_CATEGORY_ID => 'required',
//            self::FIELD_SLUG => 'present',
            self::FIELD_CONTENT => 'required',
            self::FIELD_ATTRIBUTES => 'present'
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            self::FIELD_TITLE . '.unique' => 'The article with the same title already exists'
        ];
    }

    /**
     * @param $factory
     *
     * @return mixed
     */
    public function validator($factory)
    {
        $validator = $factory->make(
            $this->all(), $this->container->call([$this, 'rules']), $this->messages(), $this->attributes()
        );

        $validator->after(function ($validator) {
            foreach ($this->categoryAttributes as $attr) {
                if ($attr['isRequired'] && $attr['value'] == '') {
                    $validator
                        ->errors()
                        ->add(
                            self::FIELD_ATTRIBUTES . '.' . $attr['id'] . '.value', $attr['label'] . '  field is required!'
                        );
                }
            }
        });

        return $validator;
    }
}
