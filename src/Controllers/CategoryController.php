<?php

namespace A1tem\KnowledgeBase\Controllers;


use A1tem\KnowledgeBase\Services\CategoryService;
use A1tem\KnowledgeBase\Services\FieldsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use A1tem\KnowledgeBase\Models\Category;
use A1tem\KnowledgeBase\Resources\Category\CategoryCollection;
use A1tem\KnowledgeBase\Resources\Category\CategoryResource;
use A1tem\KnowledgeBase\Requests\CategoryRequest;
use A1tem\KnowledgeBase\Resources\Field\FieldCollection;

/**
 * Class CategoryController
 *
 * @package A1tem\KnowledgeBase\Controllers
 * @author  Artem Petrusenko <artempetrusenko@gmail.com>
 */
class CategoryController extends ApiController
{
    /**
     * @param \A1tem\KnowledgeBase\Models\Category $category
     *
     * @return \A1tem\KnowledgeBase\Resources\Category\CategoryResource
     */
    public function get(Category $category): JsonResponse
    {
        return $this->respond([
                'category' => new CategoryResource($category),
                'fields' => new FieldCollection($category->fields)
            ]
        );
    }

    /**
     * @return \Illuminate\Http\Resources\Json\ResourceCollection
     */
    public function getAll(): ResourceCollection
    {
        return new CategoryCollection(Category::all());
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Resources\Json\ResourceCollection
     */
    public function paginate(Request $request): ResourceCollection
    {
        return new CategoryCollection(
            Category::orderBy(config('knowledge-base.order_by.category'))->paginate(
                config('knowledge-base.pagination_count')
            )
        );
    }

    /**
     * @param \A1tem\KnowledgeBase\Models\Category $category
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(Category $category): JsonResponse
    {
        $category->delete();

        return $this->respondDeleted();
    }

    /**
     * @param \A1tem\KnowledgeBase\Requests\CategoryRequest $categoryRequest
     * @param \A1tem\KnowledgeBase\Models\Category $category
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CategoryRequest $categoryRequest, Category $category): JsonResponse
    {
        Category::persist(
            $category,
            $categoryRequest->get(CategoryRequest::FIELD_NAME),
            \Auth::id()
        );

        return $this->respondUpdated();
    }

    /**
     * @param \A1tem\KnowledgeBase\Models\Category $category
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function copy(Category $category, FieldsService $fieldsService, Request $request): JsonResponse
    {
        return $this->respond([
            'data' => new CategoryResource(
                CategoryService::copyCategory($fieldsService, $category)
            )
        ]);
    }

    /**
     * @param \A1tem\KnowledgeBase\Requests\CategoryRequest $categoryRequest
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(CategoryRequest $categoryRequest): JsonResponse
    {
        $category = Category::persist(
            null,
            $categoryRequest->get(CategoryRequest::FIELD_NAME),
            \Auth::id()
        );

        return $this->respond(['data' => new CategoryResource($category)]);
    }
}
