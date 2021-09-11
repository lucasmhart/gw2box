<template>
  <div class="container">
    <nav class="navbar navbar-expand-md">
      <a class="navbar-brand" :href="this.$root.routes.baseRoute()"
        >GW2<i class="fas fa-box-open"></i
      ></a>
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

        <ul class="navbar-nav ml-auto">
        <li class="nav-item" v-if="!this.$root.auth.user()">
            <a
              class="nav-link"
              href="javascript:void(0)"
              @click="openModalLogin()"
              >Login / Register</a
            >
          </li>
          <li class="nav-item dropdown" v-else>
            <a
              class="nav-link dropdown-toggle"
              href="#"
              id="navbarDropdown"
              role="button"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
              Profile
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#" @click="openModalApiKey()"><i class="fas fa-key fa-fw"></i> Api Key</a>
              <a class="dropdown-item" href="#"><i class="fas fa-user-lock fa-fw"></i> Change password</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" :href="this.$root.routes.getRoute('user.logout')"><i class="fas fa-sign-out-alt fa-fw"></i> Logout</a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
    <auth-modal></auth-modal>
    <api-key-modal></api-key-modal>
  </div>
</template>

<script>
import authModal from "@/auth/Modal";
import apiKeyModal from "@/api_key/Modal";
export default {
  components: { authModal, apiKeyModal },
  methods: {
    openModalLogin() {
      $("#authModal").modal("show");
    },
    openModalApiKey() {
      $("#apiKeyModal").modal("show");
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
