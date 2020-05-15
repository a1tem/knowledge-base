import 'element-ui/lib/theme-chalk/index.css';
import lang from 'element-ui/lib/locale/lang/en';
import locale from 'element-ui/lib/locale';
import Vue from 'vue';

import {
  Select,
  Input,
  InputNumber,
  Checkbox,
  TableColumn,
  Button,
  Menu,
  MenuItem,
  Table,
  Dialog,
  Form,
  FormItem,
  Option,
  DatePicker,
  Pagination,
} from 'element-ui';

locale.use(lang);

Vue.component('el-select', Select);
Vue.component('el-checkbox', Checkbox);
Vue.component('el-input', Input);
Vue.component('el-input-number', InputNumber);
Vue.component('el-table', Table);
Vue.component('el-button', Button);
Vue.component('el-menu', Menu);
Vue.component('el-menu-item', MenuItem);
Vue.component('el-table-column', TableColumn);
Vue.component('el-dialog', Dialog);
Vue.component('el-form', Form);
Vue.component('el-form-item', FormItem);
Vue.component('el-option', Option);
Vue.component('el-date-picker', DatePicker);
Vue.component('el-pagination', Pagination);
Vue.component('knowledge-base-overview', require('./views/KnowledgeBaseOverview').default);
Vue.component('knowledge-base-category-overview', require('./views/KnowledgeBaseCategoryOverview').default);
Vue.component('knowledge-base-article-view', require('./views/Article').default);
Vue.component('knowledge-base-article-edit', require('./views/ArticleEdit').default);
