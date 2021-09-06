<template>
  <div class="container">
    <nav class="navbar navbar-expand-md">
      <a class="navbar-brand" :href="this.$root.routes.baseRoute()">GW2Box</a>
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <!-- <li class="nav-item active">
            <a class="nav-link" href="#"
              >Home <span class="sr-only">(current)</span></a
            >
          </li> -->
        </ul>

        <form class="form-inline my-2 my-lg-0">
          <input
            class="form-control mr-sm-2 form-control-sm"
            type="search"
            placeholder="Search"
            aria-label="Search"
          />
          <button class="btn btn-outline-custom my-2 my-sm-0 btn-sm" type="submit">
            Search
          </button>
        </form>

        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="javascript:void(0)" @click="openModalLogin()" >Login / Register</a>
          </li>
        </ul>
      </div>
    </nav>
    <auth-modal></auth-modal>
  </div>
</template>

<script>
import authModal from '@/auth/Modal'
export default {
  components: {authModal},
  methods:{
    openModalLogin() {
      $('#exampleModal').modal('show')
    }
  },
  mounted() {
  }
};
</script>

<style scoped>
.navbar {
  background-color: transparent;
}
</style>
