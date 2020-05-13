const axios = require('axios');

const axiosInstance = axios.create();

const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

axiosInstance.defaults.headers.common = {
  'X-Requested-With': 'XMLHttpRequest',
  'X-CSRF-TOKEN': token,
};
axiosInstance.defaults.headers.put = {
  Accept: 'application/json',
};
axiosInstance.defaults.headers.post = {
  Accept: 'application/json',
};
axiosInstance.defaults.headers.get = {
  Accept: 'application/json',
};
axiosInstance.defaults.headers.delete = {
  Accept: 'application/json',
};

export default axiosInstance;
