<template>
  <div
    class="modal fade"
    id="authModal"
    tabindex="-1"
    role="dialog"
    aria-hidden="true"
  >
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center">
            GW2<i class="fas fa-box-open"></i>
          </h5>
          <button
            type="button"
            class="close"
            data-dismiss="modal"
            aria-label="Close"
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form-signin
            v-show="selected_modal === 'signin'"
            v-on:changeAuthModal="handleChangeAuthModal($event)"
          ></form-signin>
          <form-signup
            v-show="selected_modal === 'signup'"
            v-on:changeAuthModal="handleChangeAuthModal($event)"
          ></form-signup>
          <form-forgot-password
            v-show="selected_modal === 'forgot_password'"
            v-on:changeAuthModal="handleChangeAuthModal($event)"
          ></form-forgot-password>
          <!-- <div class="text-center">
            <img src="/img/layout/box.jpg" alt="" class="img-fluid" />
          </div> -->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import FormSignin from "@/auth/FormSignIn";
import FormSignup from "@/auth/FormSignUp";
import FormForgotPassword from "@/auth/FormForgotPassword";
export default {
  components: {
    FormSignin,
    FormSignup,
    FormForgotPassword
  },
  data() {
    return {
      selected_modal: "signin",
      secundaryActionForm: "Sign up",
      primaryActionForm: "Sign in"
    };
  },
  methods: {
    handleChangeAuthModal(modal) {
      this.selected_modal = modal;
    },
  },
  mounted() {}
};
</script>

<style scoped></style>
