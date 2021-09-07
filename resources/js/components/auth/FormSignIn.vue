<template>
  <form>
    <div class="form-group">
      <label for="exampleInputEmail1">Email address</label>
      <input
        type="email"
        class="form-control"
        id="exampleInputEmail1"
        aria-describedby="emailHelp"
        placeholder="Enter email"
      />
      <small id="emailHelp" class="form-text text-muted"
        >We'll never share your email with anyone else.</small
      >
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Password</label>
      <input
        type="password"
        class="form-control"
        id="exampleInputPassword1"
        placeholder="Password"
      />
      <p class="text-right">
        <small><a href="javascript:void(0)" @click="set_forgot_password()">Forgot my password</a></small>
      </p>
    </div>
  </form>
</template>

<script>
export default {
  methods: {
    set_forgot_password() {
      this.$emit('changeAuthModal', 'forgot_password')
    }
  },
  mounted() {}
};
</script>

<style scoped></style>
