<template>
  <form>
    <div class="form-group">
      <label for="exampleInputEmail1">Email address</label>
      <input
        type="email"
        name="email"
        class="form-control"
        aria-describedby="User email input"
        placeholder="Enter email"
        v-model="email"
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
        placeholder="User password"
        v-model="password"
      />
      <small class="text-danger">for security reasons DO YOU NOT USE YOUR GAME PASSWORD HERE</small>
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Confirm Password</label>
      <input
        type="password"
        class="form-control"
        placeholder="Confirm password"
        v-model="password_confirm"
      />
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">API Key</label>
      <input
        type="email"
        class="form-control"
        aria-describedby="User API Key"
        placeholder="Enter your api key"
        v-model="api_key"
      />
      <small id="emailHelp" class="form-text text-muted">
        <a href="javascript:void(0)">Click here</a> to generate your key
      </small>

      <div class="text-right">
        <a href="javascript:void(0)" @click="setAuthModal('signin')">Sign In</a>
        <button
          type="button"
          class="btn btn-primary"
        >
          Submit
        </button>
      </div>
    </div>
  </form>
</template>

<script>
export default {
  props: ['selected_modal'],
  data() {
    return {
      email: null,
      password: null,
      password_confirm: null,
      api_key: null
    }
  },
  methods: {
    setAuthModal(modal) {
      this.$emit('changeAuthModal', modal)
    }
  },
  mounted() {}
};
</script>

<style scoped></style>
