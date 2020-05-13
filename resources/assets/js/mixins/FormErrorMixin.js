export const FormErrorMixin = {
  data() {
    return {
      errors: {},
    };
  },
  methods: {
    cleanErrors() {
      this.errors = {};
    },

    hasError(field) {
      return (field in this.errors)
        && this.errors[field].length !== 0;
    },
    error(field) {
      return this.hasError(field) ? this.errors[field][0] : '';
    },
  },
};
