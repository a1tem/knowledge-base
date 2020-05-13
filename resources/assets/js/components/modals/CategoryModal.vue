<template>
  <el-dialog
    :visible.sync="dialogVisible"
    :close-on-click-modal="false"
    :before-close="close"
    :modal-append-to-body="true"
    :title="title"
    custom-class="category-modal"
    width="70%"
  >
    <h3>Category name</h3>
    <el-input v-model="category.name"/>
    <error
      v-if="hasError('name')"
      :error="error('name')"/>
    <div
      v-if="isUpdate"
      class="top">
      <h3>Category fields</h3>
      <el-button
        type="primary"
        size="small"
        @click="viewField(null)">
        Add field
      </el-button>
    </div>
    <div
      v-if="isUpdate"
      class="table-responsive">
      <el-table
      :data="fields">
        <el-table-column
          prop="type"
          label="Type"/>
        <el-table-column
          prop="label"
          label="Label"/>
        <el-table-column
          prop="defaultValue"
          label="Default value"/>
        <el-table-column
          prop="isRequired"
          label="Is required">
          <template slot-scope="scope">
            {{ isRequired(scope.row.isRequired) }}
          </template>
        </el-table-column>

        <el-table-column
          fixed="right"
          width="180">
          <template slot-scope="scope">
            <el-button
              type="primary"
              size="small"
              @click.prevent="viewField(scope.row.id)">View</el-button>
            <el-button
              type="danger"
              size="small"
              @click.prevent="deleteField(scope.row.id)">Delete</el-button>
          </template>
        </el-table-column>
      </el-table>
    </div>
    <span
      slot="footer"
      class="dialog-footer">
      <el-button @click="close">Cancel</el-button>
      <el-button
        type="primary"
        @click="save()">Save</el-button>
    </span>
    <category-field-modal
      v-if="displayFieldModal"
      :field-id="fieldId"
      :category-id="id"
      @updated="fieldUpdated"
      @closeModal="closeFieldModal"
    />
  </el-dialog>
</template>

<script>
import { CATEGORY_API } from '../../api/category';
import CategoryFieldModal from './CategoryFieldModal';
import { FIELD_API } from '../../api/field';
import { FormErrorMixin } from '../../mixins/FormErrorMixin';
import Error from '../Error';

export default {
  components: {
    CategoryFieldModal,
    Error,
  },
  mixins: [FormErrorMixin],
  props: {
    id: {
      type: Number,
      required: false,
      default: null,
    },
  },
  data() {
    return {
      dialogVisible: true,
      category: {
        name: '',
      },
      fields: [],
      fieldId: null,
      displayFieldModal: false,
    };
  },
  computed: {
    isUpdate() {
      return this.id !== null;
    },
    title() {
      return this.isUpdate ? 'Edit category' : 'Create category';
    },
  },
  mounted() {
    this.getCategory();
  },
  methods: {
    close() {
      this.$emit('closeModal');
    },
    getCategory() {
      if (this.isUpdate) {
        CATEGORY_API.get(this.id).then((response) => {
          this.category.name = response.data.category.name;
          this.fields = response.data.fields;
        });
      }
    },
    save() {
      if (this.isUpdate) {
        return CATEGORY_API.update(this.id, this.category.name).then(() => {
          this.close();
          this.$emit('updated');
        }).catch((error) => {
          if (error.response.status === 422) {
            this.errors = error.response.data.errors;
          }
        });
      }

      return CATEGORY_API.create(this.category.name).then((response) => {
        this.close();
        this.$emit('created', response.data.data.id);
      }).catch((error) => {
        if (error.response.status === 422) {
          this.errors = error.response.data.errors;
        }
      });
    },
    viewField(id) {
      this.fieldId = id;
      this.displayFieldModal = true;
    },
    deleteField(id) {
      FIELD_API.deleteField(id).then(() => {
        this.getCategory();
      });
    },
    isRequired(value) {
      return value ? 'Yes' : 'No';
    },
    closeFieldModal() {
      this.fieldId = null;
      this.displayFieldModal = false;
    },
    fieldUpdated() {
      this.closeFieldModal();
      this.getCategory();
    },
  },
};
</script>

<style lang="scss">

.category-modal {
    .el-dialog__body {
        padding: 5px 20px;
    }
    h3 {
        font-weight: bold;
        font-size: 15px;
    }

    .top {
        display: flex;
        justify-content: space-between;
        height: 30px;
        margin: 20px 0;
        align-items: center;

        h3 {
            display: block;
        }
    }
}

</style>
