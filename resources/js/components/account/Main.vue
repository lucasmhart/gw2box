<template>
  <div>
    <p>PAGE!</p>
  </div>
</template>

<script>
export default {
  data() {
    return {};
  },
  methods: {

  },
  created() {
    console.log('aqqwe')
    console.log(this.$root.gw_object.get());
  }
};
</script>

<style scoped></style>
