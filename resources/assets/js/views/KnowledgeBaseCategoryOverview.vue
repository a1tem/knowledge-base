<template>
  <div>
    <div class="top-panel">
      <el-button @click="create">Create</el-button>
    </div>
    <el-table
      :data="categories"
      style="width: 100%">
      <el-table-column
        prop="name"
        label="Category Name"/>
      <el-table-column
        fixed="right"
        label="Actions"
        width="190">
        <template slot-scope="scope">
          <el-button
            @click="editCategory(scope.row.id)"
            type="text"
            size="small">Edit</el-button>
          <el-button
            @click="copy(scope.row.id)"
            type="text"
            size="small">Copy</el-button>
          <el-button
            @click="deleteCategory(scope.row.id)"
            type="text"
            size="small">Delete</el-button>
        </template>
      </el-table-column>
    </el-table>
    <el-pagination
      v-if="total > perPage"
      :total="total"
      :current-page.sync="page"
      :page-size="perPage"
      background
      style="float: right"
      layout="prev, pager, next"
      @current-change="(data) => page = data"/>
    <category-modal
      v-if="displayCategoryModal"
      :id="categoryId"
      @closeModal="displayCategoryModal = false"
      @updated="reload"
      @created="(id) => openToUpdate(id)"
    />
  </div>
</template>

<script>
import { CATEGORY_API } from '../api/category';
import CategoryModal from '../components/modals/CategoryModal';

export default {
  components: {
    CategoryModal,
  },
  data() {
    return {
      categories: [],
      perPage: 0,
      total: 0,
      page: 0,
      displayCategoryModal: false,
      categoryId: null,
    };
  },
  watch: {
    page() {
      this.getCategories();
    },
  },
  mounted() {
    this.getCategories();
  },
  methods: {
    getCategories() {
      CATEGORY_API.paginate(this.page).then((request) => {
        this.categories = request.data.data;
        this.total = request.data.meta.total;
        this.perPage = request.data.meta.per_page;
      });
    },
    create() {
      this.categoryId = null;
      this.displayCategoryModal = true;
    },
    copy(id) {
      CATEGORY_API.copy(id).then((response) => {
        this.getCategories();
      });
    },
    editCategory(id) {
      this.categoryId = id;
      this.displayCategoryModal = true;
    },
    deleteCategory(id) {
      CATEGORY_API.deleteCategory(id)
        .then(() => {
          this.reload();
        });
    },
    reload() {
      this.page = 0;
      this.getCategories();
    },
    openToUpdate(id) {
      this.categoryId = id;
      this.displayCategoryModal = true;
      this.reload();
    },
  },
};
</script>

<style lang="scss">
    .top-panel {
        margin-bottom: 20px;
        display: flex;
        flex-direction: row-reverse;
    }
</style>
