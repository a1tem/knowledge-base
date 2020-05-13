<template>
  <div class="error">
    {{ error }}
  </div>
</template>

<script>
export default {
  props: {
    error: {
      type: String,
      required: true,
    },
  },
};
</script>

<style>
    .error {
        color: red;
        font-weight: bold;
    }
</style>
