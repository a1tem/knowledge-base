<template>
  <el-dialog
    :visible.sync="dialogVisible"
    :close-on-click-modal="false"
    :before-close="close"
    append-to-body
    title="Category field"
    custom-class="category-field-modal"
    width="40%"
  >
    <field
      v-if="dataLoaded"
      :category-id="categoryId"
      :field-id="fieldId"
      :init-values="initValues"
      :is-new="!isUpdate"
      @updated="$emit('updated')"
    />
  </el-dialog>
</template>

<script>

import Field from '../Field';
import { FIELD_API } from '../../api/field';

export default {
  components: {
    Field,
  },
  props: {
    fieldId: {
      type: Number,
      required: false,
      default: null,
    },
    categoryId: {
      type: Number,
      required: true,
    },
  },
  data() {
    return {
      dialogVisible: true,
      initValues: {
        label: '',
        type: 'text',
        defaultValue: '',
        isRequired: false,
        metaData: null,
      },
      dataLoaded: false,
    };
  },
  computed: {
    isUpdate() {
      return this.fieldId !== null;
    },
  },
  mounted() {
    if (this.isUpdate) {
      this.getData();
    } else {
      this.dataLoaded = true;
    }
  },
  methods: {
    close() {
      this.$emit('closeModal');
    },
    getData() {
      this.dataLoaded = false;
      FIELD_API.get(this.fieldId).then((response) => {
        this.initValues = response.data.data;
        this.dataLoaded = true;
      });
    },
  },
};
</script>

