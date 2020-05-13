<template>
  <div
    v-if="article !== null"
    class="knowledge-base-article">
    <div class="top">
      <h3>{{ article.title }}</h3>
      <div class="buttons">
        <el-button
          size="small"
          type="primary"
          @click="editArticle(article.slug)"
        >
          Edit
        </el-button>
        <el-button
          size="small"
          type="danger"
          @click="deleteArticle"
        >
          Delete
        </el-button>
      </div>
    </div>
    <div class="navigation">
      <div class="category">Category: {{ category.name }}</div>
      <div class="author">Author: {{ article.author }}</div>
    </div>

    <div v-html="article.content"/>

    <div
      v-if="fields.length > 0"
      class="footer">
      <div class="additional-fields">Additional fields:</div>
      <div
        v-for="(field, key) in fields"
        :key="key">
        <b>{{ field.label }}</b> - {{ field.value }}
      </div>
    </div>
  </div>
</template>

<script>
import { ARTICLE_API } from '../api/article';
import { NavigationMixin } from '../mixins/NavigationMixin';

export default {
  mixins: [NavigationMixin],
  props: {
    slug: {
      type: String,
      required: true,
    },
  },
  data() {
    return {
      article: null,
      category: null,
      fields: [],
    };
  },
  mounted() {
    ARTICLE_API.get(this.slug).then((response) => {
      this.article = response.data.data;
      this.category = response.data.category;
      this.fields = response.data.attributes;
    });
  },
  methods: {
    deleteArticle() {
      ARTICLE_API.deleteArticle(this.article.slug).then(() => {
        this.articlesOverview();
      });
    },
  },
};
</script>

<style lang="scss">
    .knowledge-base-article {
        .top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            border-bottom: 1px solid lightgray;
            h3 {
                display: block;
            }

            .buttons {
                width: 150px;
            }
        }

        .navigation {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 17px;
            .category {
                font-weight: bold;
            }

        }

        .additional-fields {
            margin-top: 20px;
            border-top: 1px solid lightgray;
            padding-top: 20px;
            font-weight: bold;
            font-size: 15px;
        }

        img {
            max-width: 100%;
            width: auto;
        }
    }
</style>
