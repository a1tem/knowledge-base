<template>
  <el-select
    ref="select"
    v-model="term"
    placeholder="Search"
    :remote-method="suggest"
    :loading="loading"
    filterable
    remote
    popper-class="search-dropdown"
    @change="(data) => $emit('selected', data)"
  >
    <el-option
      v-for="(item, key) in suggestions"
      :key="key"
      :label="item.title"
      :value="item.slug"/>
  </el-select>
</template>

<script>
import { ARTICLE_API } from '../api/article';

export default {
  data() {
    return {
      term: '',
      loading: false,
      suggestions: [],
    };
  },
  methods: {
    suggest(term) {
      if (term.length !== 0) {
        this.loading = true;
        clearTimeout(this.delay);
        this.delay = setTimeout(() => {
          ARTICLE_API.all(term).then((response) => {
            this.loading = false;
            this.suggestions = response.data.data;
          });
        }, 300);
      }
    },
  },
};
</script>

