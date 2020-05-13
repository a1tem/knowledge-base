<template>
  <div>
    <h3>
      {{ field.label }}
      <span
        class="required"
        v-if="field.isRequired">*</span>
    </h3>
    <el-input
      v-if="isText"
      :disabled="isDisabled"
      v-model="value"/>
    <el-input-number
      v-if="isNumber"
      :disabled="isDisabled"
      v-model="value"/>
    <el-select
      v-if="isSelect"
      :disabled="isDisabled"
      v-model="value">
      <el-option
        v-for="item in options"
        :key="item.value"
        :label="item.label"
        :value="item.value"/>
    </el-select>
    <el-input
      v-if="isTextarea"
      :disabled="isDisabled"
      :rows="2"
      v-model="value"
      type="textarea"/>
    <el-checkbox
      v-if="isCheckbox"
      :disabled="isDisabled"
      v-model="value"/>
    <el-date-picker
      v-if="isDate"
      v-model="value"
      value-format="yyyy-MM-dd"
      format="dd-MM-yyyy"/>
    <error
      v-if="checkError('value')"
      :error="displayError('value')"/>
  </div>
</template>

<script>
import { FormErrorMixin } from '../mixins/FormErrorMixin';
import Error from './Error';

export default{
  components: { Error },
  mixins: [FormErrorMixin],
  props: ['initValue', 'field', 'initialErrors', 'isDisabled'],
  data() {
    return {
      value: '',
      options: [],
    };
  },
  computed: {
    isText() {
      return this.field.type === 'text';
    },
    isDate() {
      return this.field.type === 'date';
    },
    isNumber() {
      return this.field.type === 'number';
    },
    isSelect() {
      return this.field.type === 'select';
    },
    isTextarea() {
      return this.field.type === 'textarea';
    },
    isCheckbox() {
      return this.field.type === 'checkbox';
    },
  },
  watch: {
    initValue() {
      this.setData();
    },
    value() {
      this.$emit('valueChanged', { fieldId: this.field.id, value: this.value });
    },
    initialErrors() {
      this.errors = this.initialErrors;
    },
  },
  mounted() {
    this.setData();
  },
  methods: {
    setData() {
      if (this.field.type === 'checkbox') {
        this.value = this.field.defaultValue == '1';
      } else {
        this.value = this.initValue;
      }
      if (this.field.metaData !== null) {
        this.options = this.field.metaData.values.map(item => ({ label: item, value: item }));
      }
    },
    checkError(errorName) {
      return this.hasError(`categoryAttributes.${this.field.id}.${errorName}`);
    },
    displayError(errorName) {
      return this.error(`categoryAttributes.${this.field.id}.${errorName}`);
    },
  },
};
</script>

<style scoped>
 .el-alert {
     padding: 0;
     margin-top: 10px;
 }

    .required {
        color: red;
    }
</style>
