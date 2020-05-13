import { APP_CONFIG } from './../config';
import axios from './../axios';

export const ARTICLE_API = {
  get: id => axios.get(`${APP_CONFIG.API_URL}/articles/${id}`),
  update: (id, categoryId, title, content, categoryAttributes) => axios.put(`${APP_CONFIG.API_URL}/articles/${id}`, {
    categoryId,
    title,
    content,
    categoryAttributes,
  }),
  create: (categoryId, title, content, categoryAttributes) => axios.post(`${APP_CONFIG.API_URL}/articles/create`, {
    categoryId,
    title,
    content,
    categoryAttributes,
  }),
  all: (q = '') => axios.get(`${APP_CONFIG.API_URL}/articles/all?q=${q}`),
  paginate: (page, category) => axios.get(`${APP_CONFIG.API_URL}/articles/paginate?page=${page}&category=${category}`),
  deleteArticle: id => axios.delete(`${APP_CONFIG.API_URL}/articles/${id}`),
  uploadFiles: data => {
    return axios.post(
      `${APP_CONFIG.API_URL}/files/upload-file`,
      data,
      {
        headers: {
          'Content-Type': 'multipart/form-data',
        },
      },
    );
  },
};
