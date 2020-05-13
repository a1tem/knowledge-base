<template>
  <el-form
    ref="form"
    label-width="130px">
    <el-form-item
      label="Field type"
      required>
      <el-select
        :disabled="!isNew"
        v-model="form.type"
        style="width: 100%"
        placeholder="Select">
        <el-option
          v-for="item in types"
          :key="item.value"
          :label="item.label"
          :value="item.value"/>
      </el-select>
    </el-form-item>
    <el-form-item
      v-if="form.type === 'select'"
      required
      label="Values">
      <el-select
        v-model="form.values"
        style="width: 100%"
        multiple
        filterable
        allow-create
        default-first-option
        placeholder="Values">
        <el-option
          v-for="item in form.initValues"
          :key="item.value"
          :label="item.label"
          :value="item.value"/>
      </el-select>
    </el-form-item>
    <el-form-item
      label="Label"
      required>
      <el-input v-model="form.label"/>
    </el-form-item>
    <el-form-item
    label="Default value">
      <el-checkbox
        v-if="form.type === 'checkbox'"
        v-model="form.defaultValue"/>
      <el-input
        v-else
        v-model="form.defaultValue"/>
      <el-alert
        v-if="hasError('default_value')"
        :title="displayError('default_value')"
        :closable="false"
        type="error"/>
    </el-form-item>
    <el-form-item
    label="Is required">
      <el-checkbox
        v-model="form.isRequired"
        :disabled="form.type === 'checkbox'"/>
    </el-form-item>
    <el-form-item>
      <el-button
        v-if="isNew"
        style="float:right"
        type="primary"
        @click="createField">Create</el-button>
      <el-button
        v-else
        style="float: right;"
        size="small"
        type="primary"
        @click="updateField">Update</el-button>
    </el-form-item>
  </el-form>

</template>

<script>

import { FormErrorMixin } from '../mixins/FormErrorMixin';
import { FIELD_API } from '../api/field';

export default {
  mixins: [FormErrorMixin],
  props: {
    initValues: {
      type: Object,
      required: true,
    },
    isNew: {
      type: Boolean,
      default: false,
    },
    categoryId: {
      type: [Number, String],
      default: null,
    },
    fieldId: {
      type: [Number, String],
      default: null,
    },
  },
  data() {
    return {
      form: {
        label: '',
        type: 'text',
        defaultValue: '',
        isRequired: true,
        values: [],
        initValues: [],
      },
      types: [
        {
          value: 'text',
          label: 'Text',
        },
        {
          value: 'textarea',
          label: 'Textarea',
        },
        {
          value: 'number',
          label: 'Number',
        },
        {
          value: 'checkbox',
          label: 'Checkbox',
        },
        {
          value: 'select',
          label: 'Select',
        },
        {
          value: 'date',
          label: 'Date',
        },
      ],
    };
  },
  computed: {
    metaData() {
      return {
        values: this.form.values,
      };
    },
  },
  watch: {
    'form.type': function () {
      if (this.form.type === 'checkbox' && this.isNew) {
        this.form.isRequired = false;
        this.form.defaultValue = true;
      }
    },
  },
  mounted() {
    this.setData();
  },
  methods: {
    setData() {
      this.form.label = this.initValues.label;
      this.form.type = this.initValues.type;
      if (this.form.type === 'checkbox') {
        this.form.defaultValue = this.initValues.defaultValue == '1';
      } else {
        this.form.defaultValue = this.initValues.defaultValue;
      }

      this.form.isRequired = this.initValues.isRequired;
      if (this.initValues.metaData !== null) {
        this.form.initValues = this.initValues.metaData.values.map(item => ({ label: item, value: item }));
        this.form.values = this.initValues.metaData.values;
      }
    },
    createField() {
      this.cleanErrors();
      FIELD_API.createField(
        this.categoryId,
        this.form.type,
        this.form.label,
        this.form.defaultValue,
        this.form.isRequired,
        this.metaData,
      ).then((response) => {
        this.cleanErrors();
        this.$emit('updated');
      }).catch((error) => {
        if (error.response.status === 422) {
          this.errors = error.response.data.errors;
        }
      });
    },
    updateField() {
      this.cleanErrors();
      FIELD_API.updateField(
        this.fieldId,
        this.form.type,
        this.form.label,
        this.form.defaultValue,
        this.form.isRequired,
        this.metaData,
      ).then((response) => {
        this.cleanErrors();
        this.$emit('updated');
      }).catch((error) => {
        if (error.response.status === 422) {
          this.errors = error.response.data.errors;
        }
      });
    },
    displayError(errorName) {
      return this.error(`${errorName}`).replace('meta data.values.*', 'Values');
    },
  },
};
</script>


<style scoped>
    .el-form-item {
        margin-bottom: 5px!important;
    }

    .el-alert {
        padding: 0;
        margin-top: 10px;
    }
</style>
