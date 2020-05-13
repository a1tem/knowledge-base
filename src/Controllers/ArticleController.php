<?php

namespace A1tem\KnowledgeBase\Controllers;

use A1tem\KnowledgeBase\Resources\Field\FieldCollection;
use A1tem\KnowledgeBase\Services\ArticleSearchService;
use A1tem\KnowledgeBase\Services\FileUploader;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use A1tem\KnowledgeBase\Models\Article;
use A1tem\KnowledgeBase\Requests\ArticleRequest;
use A1tem\KnowledgeBase\Resources\Article\ArticleCollection;
use A1tem\KnowledgeBase\Resources\Article\ArticleResource;
use A1tem\KnowledgeBase\Resources\Category\CategoryResource;

/**
 * Class ArticleController
 *
 * @package A1tem\KnowledgeBase\Controllers
 * @author  Artem Petrusenko <artempetrusenko@gmail.com>
 */
class ArticleController extends ApiController
{
    /**
     * @param \A1tem\KnowledgeBase\Models\Article $article
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Article $article): JsonResponse
    {
        return $this->respond([
                'data' => new ArticleResource($article),
                'category' => new CategoryResource($article->category),
                'attributes' => new FieldCollection($article->fields)
            ]
        );
    }

    /**
     * @return \Illuminate\Http\Resources\Json\ResourceCollection
     */
    public function getAll(Request $request): ResourceCollection
    {
        if ($request->query('q')) {
            return new ArticleCollection(
                ArticleSearchService::search($request->query('q'))
            );
        }

        return new ArticleCollection(Article::all());
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Resources\Json\ResourceCollection
     */
    public function paginate(Request $request): ResourceCollection
    {
        return new ArticleCollection(
            Article::with('author')
                ->where('category_id', $request->query('category'))
                ->paginate(config('knowledge-base.pagination_count')
                )
        );
    }

    /**
     * @param \A1tem\KnowledgeBase\Requests\ArticleRequest $articleRequest
     * @param \A1tem\KnowledgeBase\Models\Article $article
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ArticleRequest $articleRequest, Article $article): JsonResponse
    {
        $article = Article::persist(
            $article,
            $articleRequest->get(ArticleRequest::FIELD_CATEGORY_ID),
            $articleRequest->get(ArticleRequest::FIELD_TITLE),
            $articleRequest->get(ArticleRequest::FIELD_CONTENT),
            $articleRequest->get(ArticleRequest::FIELD_ATTRIBUTES),
            \Auth::id()
        );

        return $this->respond([
            'data' => new ArticleResource($article)
        ]);
    }

    /**
     * @param \A1tem\KnowledgeBase\Requests\ArticleRequest $articleRequest
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(ArticleRequest $articleRequest): JsonResponse
    {
        $article = Article::persist(
            null,
            $articleRequest->get(ArticleRequest::FIELD_CATEGORY_ID),
            $articleRequest->get(ArticleRequest::FIELD_TITLE),
            $articleRequest->get(ArticleRequest::FIELD_CONTENT),
            $articleRequest->get(ArticleRequest::FIELD_ATTRIBUTES),
            \Auth::id()
        );

        return $this->respond([
            'data' => new ArticleResource($article)
        ]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadFile(Request $request): JsonResponse {
        return $this->respond([
            'url' => FileUploader::save($request)
        ]);
    }

    /**
     * @param \A1tem\KnowledgeBase\Models\Article $article
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(Article $article): JsonResponse
    {
        $article->delete();

        return $this->respondDeleted();
    }
}
