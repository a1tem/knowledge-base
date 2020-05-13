import { APP_CONFIG } from './../config';
import axios from './../axios';

export const CATEGORY_API = {
  get: id => axios.get(`${APP_CONFIG.API_URL}/categories/${id}`),
  update: (id, name) => axios.put(`${APP_CONFIG.API_URL}/categories/${id}`, {
    name,
  }),
  copy: id => axios.put(`${APP_CONFIG.API_URL}/categories/${id}/copy`),
  create: name => axios.post(`${APP_CONFIG.API_URL}/categories/create`, {
    name,
  }),
  all: () => axios.get(`${APP_CONFIG.API_URL}/categories/all`),
  paginate: page => axios.get(`${APP_CONFIG.API_URL}/categories/paginate?page=${page}`),
  deleteCategory: id => axios.delete(`${APP_CONFIG.API_URL}/categories/${id}`),
};
