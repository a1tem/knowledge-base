<?php

namespace A1tem\KnowledgeBase\Controllers;

use App\Http\Requests\Fieldset\CreateFieldRequest;
use App\Models\Product\Fieldset;
use Illuminate\Http\JsonResponse;
use A1tem\KnowledgeBase\Models\Category;
use A1tem\KnowledgeBase\Models\Field;
use A1tem\KnowledgeBase\Requests\FieldRequest;
use A1tem\KnowledgeBase\Resources\Field\FieldResource;
use A1tem\KnowledgeBase\Services\FieldsService;

/**
 * Class FieldController
 *
 * @package A1tem\KnowledgeBase\Controllers
 * @author  Artem Petrusenko <artempetrusenko@gmail.com>
 */
class FieldController extends ApiController
{

    /**
     * @param \A1tem\KnowledgeBase\Models\Field $field
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Field $field): JsonResponse
    {
        return $this->respond([
            'data' => new FieldResource($field)
        ]);
    }

    /**
     * @param \A1tem\KnowledgeBase\Models\Field $field
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Field $field): JsonResponse
    {
        Field::destroy($field->id);

        return $this->respondDeleted();
    }

    /**
     * @param \A1tem\KnowledgeBase\Models\Category $category
     * @param \A1tem\KnowledgeBase\Requests\FieldRequest $request
     * @param \A1tem\KnowledgeBase\Services\FieldsService $fieldsService
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(
        Category $category,
        FieldRequest $request,
        FieldsService $fieldsService
    ): JsonResponse {
        $field = $fieldsService->createField(
            $category,
            $request->get(FieldRequest::FIELD_TYPE),
            $request->get(FieldRequest::FIELD_LABEL),
            $request->get(FieldRequest::FIELD_DEFAULT_VALUE),
            $request->get(FieldRequest::FIELD_IS_REQUIRED),
            $request->get(FieldRequest::FIELD_META_DATA)
        );

        return $this->respond(['data' => new FieldResource($field)]);
    }

    /**
     * @param \A1tem\KnowledgeBase\Models\Field $field
     * @param \A1tem\KnowledgeBase\Requests\FieldRequest $request
     * @param \A1tem\KnowledgeBase\Services\FieldsService $fieldsService
     *
     * @return \A1tem\KnowledgeBase\Resources\Field\FieldResource
     */
    public function update(
        Field $field,
        FieldRequest $request,
        FieldsService $fieldsService
    ): JsonResponse {
        $field = $fieldsService->updateField(
            $field,
            $request->get(FieldRequest::FIELD_TYPE),
            $request->get(FieldRequest::FIELD_LABEL),
            $request->get(FieldRequest::FIELD_DEFAULT_VALUE),
            $request->get(FieldRequest::FIELD_IS_REQUIRED),
            $request->get(FieldRequest::FIELD_META_DATA)
        );

        return $this->respond(['data' => new FieldResource($field)]);
    }

}
