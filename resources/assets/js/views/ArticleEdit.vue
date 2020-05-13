<template>
  <div class="knowledge-base-article-edit">
    <h3>Select category</h3>
    <el-select
      :disabled="!isNew"
      v-model="article.category"
      style="width: 100%"
      placeholder="Select category">
      <el-option
        v-for="item in categories"
        :key="item.id"
        :label="item.label"
        :value="item.id"/>
    </el-select>
    <h3>Title</h3>
    <el-input
      v-model="article.title"
      type="text"/>
    <error
      v-if="hasError('title')"
      :error="error('title')"/>
    <h3>Description</h3>
    <vue-editor
      v-model="article.content"
      use-custom-image-handler
      @imageAdded="handleImageAdded"
    />
    <error
      v-if="hasError('content')"
      :error="error('content')"/>
    <field-input
      v-for="attribute in article.attributes"
      :init-value="attribute.value"
      :field="attribute"
      :key="attribute.id"
      :initial-errors="errors"
      @valueChanged="updateAttribute"
    />
    <div class="footer">
      <el-button
        @click="save"
        type="primary">
        Save
      </el-button>
    </div>
  </div>
</template>

<script>
import { CATEGORY_API } from '../api/category';
import FieldInput from '../components/FieldInput';
import { ARTICLE_API } from '../api/article';
import Error from './../components/Error';
import { FormErrorMixin } from '../mixins/FormErrorMixin';
import { VueEditor } from 'vue2-editor';
import { NavigationMixin } from '../mixins/NavigationMixin';

export default {
  components: {
    FieldInput,
    Error,
    VueEditor,
  },
  mixins: [FormErrorMixin, NavigationMixin],
  props: {
    articleId: {
      type: String,
      required: false,
      default: null,
    },
  },
  data() {
    return {
      article: {
        category: null,
        title: '',
        content: '',
        attributes: [],
      },
      categories: [],
      errors: [],
    };
  },
  computed: {
    isNew() {
      return this.articleId === null;
    },
  },
  watch: {
    'article.category': function () {
      if (this.isNew) {
        this.getCategory();
      }
    },
  },
  mounted() {
    this.getCategories();
    if (!this.isNew) {
      this.getArticle();
    }
  },
  methods: {
    getCategories() {
      CATEGORY_API.all().then((response) => {
        response.data.data.map((item) => {
          this.categories.push({
            id: item.id,
            label: item.name,
          });
        });
      });
    },
    getCategory() {
      this.article.attributes = [];
      CATEGORY_API.get(this.article.category).then((response) => {
        response.data.fields.map((item) => {
          this.article.attributes.push(item);
        });
      });
    },
    getArticle() {
      ARTICLE_API.get(this.articleId).then((response) => {
        this.article.title = response.data.data.title;
        this.article.content = response.data.data.content;
        this.article.category = response.data.category.id;
        this.article.attributes = response.data.attributes;
      });
    },
    save() {
      if (this.isNew) {
        ARTICLE_API.create(
          this.article.category,
          this.article.title,
          this.article.content,
          this.article.attributes,
        ).then((response) => {
          this.viewArticle(response.data.data.slug);
        }).catch((error) => {
          if (error.response.status === 422) {
            this.errors = error.response.data.errors;
          }
        });
      } else {
        ARTICLE_API.update(
          this.articleId,
          this.article.category,
          this.article.title,
          this.article.content,
          this.article.attributes,
        ).then((response) => {
          this.viewArticle(response.data.data.slug);
        }).catch((error) => {
          if (error.response.status === 422) {
            this.errors = error.response.data.errors;
          }
        });
      }
    },
    updateAttribute(data) {
      const attr = this.article.attributes.find(item => item.id === data.fieldId);
      if (attr !== undefined) {
        attr.value = data.value;
      }
    },
    handleImageAdded(file, Editor, cursorLocation, resetUploader) {
      const formData = new FormData();
      formData.append('articleFile', file);

      ARTICLE_API.uploadFiles(formData)
        .then((response) => {
          Editor.insertEmbed(cursorLocation, 'image', response.data.url);
          resetUploader();
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>

<style lang="scss">
    .knowledge-base-article-edit {
        h3 {
            font-size: 18px;
            font-weight: bold;
        }

        .footer {
            margin-top: 25px;
        }

        img {
            max-width: 100%;
            width: auto;
        }
    }
</style>
