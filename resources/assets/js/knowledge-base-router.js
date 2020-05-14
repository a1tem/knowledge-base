import { APP_CONFIG } from './config'
import Vue from 'vue';

const ROUTES = {
  VIEW_ARTICLE : 'knowledge-base-view-article',
  EDIT_ARTICLE : 'knowledge-base-edit-article',
  CREATE_ARTICLE : 'knowledge-base-create-article',
  OVERVIEW_ARTICLES: 'knowledge-base-articles-overview',
  OVERVIEW_CATEGORIES: 'knowledge-base-categories-overview'
}

const KNOWLEDGE_BASE_ROUTER = [
  {
    path: APP_CONFIG.API_URL,
    name: 'knowledge-base',
    redirect: '/knowledge-base/articles',
    component: Vue.component('Layout', require('./components/Layout').default),
    children: [
      {
        path: 'articles',
        name: ROUTES.OVERVIEW_ARTICLES,
        component: Vue.component(ROUTES.OVERVIEW_ARTICLES, require('./views/KnowledgeBaseOverview').default),
      },
      {
        path: 'article/view/:slug',
        name: ROUTES.VIEW_ARTICLE,
        component: Vue.component(ROUTES.VIEW_ARTICLE, require('./views/Article').default),
        props: (route) => ({ slug: route.params.slug })
      },
      {
        path: 'article/edit/:slug',
        name: ROUTES.EDIT_ARTICLE,
        component: Vue.component(ROUTES.EDIT_ARTICLE, require('./views/ArticleEdit').default),
        props: (route) => ({ articleId : route.params.slug })
      },
      {
        path: 'article/create',
        name: ROUTES.CREATE_ARTICLE,
        component: Vue.component(ROUTES.CREATE_ARTICLE, require('./views/ArticleEdit').default),
        props: { articleId: null }
      },
      {
        path: 'categories',
        name: ROUTES.OVERVIEW_CATEGORIES,
        component: Vue.component(ROUTES.OVERVIEW_CATEGORIES, require('./views/KnowledgeBaseCategoryOverview').default),
      },
    ],
  }];

export {
  KNOWLEDGE_BASE_ROUTER,
  ROUTES,
};
