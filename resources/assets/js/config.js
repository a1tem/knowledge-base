const MODE_SPA = 'spa';
const MODE_NOT_SPA = 'not_spa';

export const APP_CONFIG = {
  API_URL: '/knowledge-base',
  MODE: MODE_NOT_SPA,
  AVAILABLE_MODES: {
    MODE_NOT_SPA: MODE_NOT_SPA,
    MODE_SPA: MODE_SPA
  },
  NOT_SPA_ROUTES: {
    CREATE_ARTICLE: '/knowledge-base/view/article/create',
    VIEW_ARTICLE: '/knowledge-base/view/article/view',
    EDIT_ARTICLE: '/knowledge-base/view/article/edit',
    ARTICLES_OVERVIEW: '/knowledge-base/view/articles',
  }
};
