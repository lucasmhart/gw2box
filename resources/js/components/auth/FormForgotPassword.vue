<template>
  <form>
    <div class="form-group">
      <label for="exampleInputEmail1">Email address</label>
      <input
        type="email"
        class="form-control"
        placeholder="Enter email"
      />
      <small id="emailHelp" class="form-text text-muted"
        >We'll never share your email with anyone else.</small
      >
    </div>
    <div class="text-right">
      <a href="javascript:void(0)" @click="setAuthModal('signin')">Sign In</a>
      <button
        type="button"
        class="btn btn-primary"
      >
        Submit
      </button>
    </div>
  </form>
</template>

<script>
export default {
  props: ['selected_modal'],
  methods: {
    setAuthModal(modal) {
      this.$emit('changeAuthModal', modal)
    }
  },
  mounted() {}
};
</script>

<style scoped></style>
