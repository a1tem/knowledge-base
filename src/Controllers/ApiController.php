<?php

namespace A1tem\KnowledgeBase\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

/**
 * Class ApiController
 *
 * @package A1tem\KnowledgeBase\Controllers
 * @author  Artem Petrusenko <artempetrusenko@gmail.com>
 */
class ApiController extends Controller
{

    /**
     * @param array $data
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respond(array $data): JsonResponse
    {
        return response()->json($data);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondUpdated(): JsonResponse
    {
        return response()->json(['message' => 'Successfully updated']);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondCreated(): JsonResponse
    {
        return response()->json(['message' => 'Successfully created']);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondDeleted(): JsonResponse
    {
        return response()->json(['message' => 'Successfully deleted']);
    }
}
