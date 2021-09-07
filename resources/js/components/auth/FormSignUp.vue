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
      <small class="text-danger">for security reasons DO YOU NOT USE YOUR GAME PASSWORD HERE</small>
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Confirm Password</label>
      <input
        type="password"
        class="form-control"
        id="exampleInputPassword1"
        placeholder="Password"
      />
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">API Key</label>
      <input
        type="email"
        class="form-control"
        id="exampleInputEmail1"
        aria-describedby="emailHelp"
        placeholder="Enter your api key"
      />
      <small id="emailHelp" class="form-text text-muted"
        ><a href="javascript:void(0)">Click here</a> to generate your key</small
      >
    </div>
  </form>
</template>

<script>
export default {
  props: ['selected_modal'],
  methods: {},
  mounted() {}
};
</script>

<style scoped></style>
