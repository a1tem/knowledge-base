<?php

namespace A1tem\KnowledgeBase\Controllers;

use A1tem\KnowledgeBase\Models\Article;
use Illuminate\Routing\Controller;
use Illuminate\View\View;

/**
 * Class FrontendController
 *
 * @package A1tem\KnowledgeBase\Controllers
 * @author  Artem Petrusenko <artempetrusenko@gmail.com>
 */
class FrontendController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function categories(): View
    {
        return view('vendor.a1tem.knowledge-base.categories');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function articles(): View
    {
        return view('vendor.a1tem.knowledge-base.articles');
    }

    /**
     * @param string $slug
     *
     * @return \Illuminate\View\View
     */
    public function editArticle(string $slug): View
    {
        return view('vendor.a1tem.knowledge-base.edit-article', ['id' => $slug]);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function createArticle(): View
    {
        return view('vendor.a1tem.knowledge-base.create-article');
    }

    /**
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function viewArticle(string $slug): View
    {
        return view('vendor.a1tem.knowledge-base.view-article', ['id' => $slug]);
    }
}
