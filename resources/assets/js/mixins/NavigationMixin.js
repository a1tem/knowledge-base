import { APP_CONFIG } from '../config'

export const NavigationMixin = {
  methods: {
    editArticle(slug) {
      if (APP_CONFIG.MODE === APP_CONFIG.AVAILABLE_MODES.MODE_NOT_SPA) {
        window.location.replace(`${APP_CONFIG.NOT_SPA_ROUTES.EDIT_ARTICLE}/${slug}`);
      }
    },
    createArticle() {
      if (APP_CONFIG.MODE === APP_CONFIG.AVAILABLE_MODES.MODE_NOT_SPA) {
        window.location.replace(APP_CONFIG.NOT_SPA_ROUTES.CREATE_ARTICLE);
      }
    },
    viewArticle(slug) {
      if (APP_CONFIG.MODE === APP_CONFIG.AVAILABLE_MODES.MODE_NOT_SPA) {
        window.location.replace(`${APP_CONFIG.NOT_SPA_ROUTES.VIEW_ARTICLE}/${slug}`);
      }
    },
    articlesOverview() {
      if (APP_CONFIG.MODE === APP_CONFIG.AVAILABLE_MODES.MODE_NOT_SPA) {
        window.location.replace(`${APP_CONFIG.NOT_SPA_ROUTES.ARTICLES_OVERVIEW}`);
      }
    }
  },
};
