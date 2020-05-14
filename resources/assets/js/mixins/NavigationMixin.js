import { APP_CONFIG } from '../config'
import { ROUTES } from './../knowledge-base-router';

export const NavigationMixin = {
  methods: {
    editArticle(slug) {
      if (APP_CONFIG.MODE === APP_CONFIG.AVAILABLE_MODES.MODE_NOT_SPA) {
        window.location.replace(`${APP_CONFIG.NOT_SPA_ROUTES.EDIT_ARTICLE}/${slug}`);
      } else {
        this.$router.push({name: ROUTES.EDIT_ARTICLE , params: {slug}});
      }
    },
    createArticle() {
      if (APP_CONFIG.MODE === APP_CONFIG.AVAILABLE_MODES.MODE_NOT_SPA) {
        window.location.replace(APP_CONFIG.NOT_SPA_ROUTES.CREATE_ARTICLE);
      } else {
        this.$router.push({name: ROUTES.CREATE_ARTICLE });
      }
    },
    viewArticle(slug) {
      if (APP_CONFIG.MODE === APP_CONFIG.AVAILABLE_MODES.MODE_NOT_SPA) {
        window.location.replace(`${APP_CONFIG.NOT_SPA_ROUTES.VIEW_ARTICLE}/${slug}`);
      } else {
        this.$router.push({name: ROUTES.VIEW_ARTICLE, params: {slug}});
      }
    },
    articlesOverview() {
      if (APP_CONFIG.MODE === APP_CONFIG.AVAILABLE_MODES.MODE_NOT_SPA) {
        window.location.replace(`${APP_CONFIG.NOT_SPA_ROUTES.ARTICLES_OVERVIEW}`);
      } else {
        this.$router.push({name: ROUTES.OVERVIEW_ARTICLES });
      }
    },
    categoriesOverview() {
      if (APP_CONFIG.MODE === APP_CONFIG.AVAILABLE_MODES.MODE_NOT_SPA) {
        window.location.replace(`${APP_CONFIG.NOT_SPA_ROUTES.CATEGORIES_OVERVIEW}`);
      } else {
        this.$router.push({name: ROUTES.OVERVIEW_CATEGORIES });
      }
    }
  },
};
