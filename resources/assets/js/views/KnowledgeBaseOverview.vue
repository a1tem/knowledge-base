<template>
  <div class="knowledge-base-overview">
    <div class="col-left">
      <div class="categories">
        <el-button
          type="primary"
          class="create-button"
          @click="createArticle">
          Create new
        </el-button>
        <el-menu
          default-active="1"
          class="el-menu-vertical-demo">
          <el-menu-item
            v-for="(category, key) in categories"
            @click="categoryId = category.id"
            :key="key">
            <i class="el-icon-caret-right"/>
            <span>{{ category.name }}</span>
          </el-menu-item>
        </el-menu>
      </div>
    </div>
    <div class="col-right">
      <search
        class="search"
        @selected="viewArticle"/>
      <div class="articles">
        <el-table
          :data="articles"
          style="width: 100%">
          <el-table-column
            prop="title"
            label="Title"/>
          <el-table-column
            prop="author"
            label="Author"/>
          <el-table-column
            fixed="right"
            label="Actions"
            width="120">
            <template slot-scope="scope">
              <el-button
                @click="viewArticle(scope.row.slug)"
                type="primary"
                size="small">View</el-button>
            </template>
          </el-table-column>
        </el-table>
      </div>
      <el-pagination
        v-if="total > perPage"
        :total="total"
        :current-page.sync="page"
        :page-size="perPage"
        background
        class="pagination"
        layout="prev, pager, next"
        @current-change="(data) => page = data"/>
    </div>
  </div>
</template>

<script>
import { CATEGORY_API } from '../api/category';
import { ARTICLE_API } from '../api/article';
import Search from '../components/Search';
import { NavigationMixin } from '../mixins/NavigationMixin';

export default {
  mixins: [NavigationMixin],
  components: {
    Search,
  },
  data() {
    return {
      categories: [],
      categoryId: null,
      articles: [],
      perPage: 0,
      total: 0,
      page: 0,
      search: '',
    };
  },
  watch: {
    categoryId() {
      this.page = 0;
      this.getArticles();
    },
    page() {
      this.getArticles();
    },
  },
  mounted() {
    this.getCategories();
  },
  methods: {
    getCategories() {
      CATEGORY_API.all().then((response) => {
        this.categories = response.data.data;
        if (this.categories.length > 0) {
          this.categoryId = this.categories[0].id;
        }
      });
    },
    getArticles() {
      ARTICLE_API.paginate(this.page, this.categoryId).then((response) => {
        this.articles = response.data.data;
        this.total = response.data.meta.total;
        this.perPage = response.data.meta.per_page;
      });
    },
  },
};
</script>

<style lang="scss" scoped>
    .knowledge-base-overview {
        display: flex;
        .col-left {
            padding-right: 10px;
            width: 25%;
        }

        .col-right {
            width: 75%;
            padding-left: 10px;
            .articles {
                background-color: white;
            }
        }

        .create-button {
            width: 100%;
            margin-bottom: 20px;
        }

        .search {
            width: 100%;
            margin-bottom: 20px;
        }

        .pagination {
            float: right;
            margin-top: 20px;
        }
    }
</style>
