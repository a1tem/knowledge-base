import { APP_CONFIG } from './../config';

export const FIELD_API = {
  get: id => axios.get(`${APP_CONFIG.API_URL}/field/${id}`),
  getSearchFields: () => axios.get(`${APP_CONFIG.API_URL}/field/search`),
  deleteField: fieldId => axios.delete(`${APP_CONFIG.API_URL}/field/${fieldId}`),
  createField: (categoryId, type, label, defaultValue, isRequired, metaData) => axios.post(`${APP_CONFIG.API_URL}/category/${categoryId}/field`, {
    type,
    label,
    default_value: defaultValue,
    is_required: isRequired,
    meta_data: metaData,
  }, { errorHandle: false }),
  updateField: (fieldId, type, label, defaultValue, isRequired, metaData) => axios.put(`${APP_CONFIG.API_URL}/category/field/${fieldId}`, {
    type,
    label,
    default_value: defaultValue,
    is_required: isRequired,
    meta_data: metaData,
  }, { errorHandle: false }),
};
