<template>
  <div
    class="modal fade"
    id="exampleModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center" id="exampleModalLabel">
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
            @click="changeSecundaryActionForm()"
          ></form-signup>
          <form-forgot-password
            v-show="selected_modal === 'forgot_password'"
          ></form-forgot-password>
          <!-- <div class="text-center">
            <img src="/img/layout/box.jpg" alt="" class="img-fluid" />
          </div> -->
        </div>
        <div class="modal-footer">
          <a href="javascript:void(0)" @click="handleSecundaryActionForm()">{{
            secundaryActionForm
          }}</a>
          <button
            type="submit"
            class="btn btn-primary"
            @click="handlePrimaryActionForm()"
          >
            {{ primaryActionForm }}
          </button>
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
      if (modal == 'forgot_password') {
        this.secundaryActionForm = 'Sign in'
      }
    },
    handleSecundaryActionForm() {
      if (this.selected_modal == "signin") {
        this.secundaryActionForm = "Sign in"
        this.selected_modal = "signup"
      } else if (this.selected_modal == "signup") {
        this.secundaryActionForm = "Sign up"
        this.selected_modal = "signin"
      } else if (this.selected_modal == "forgot_password") {
        this.secundaryActionForm = "Sign up"
        this.selected_modal = "signin"
      }
    },
    handlePrimaryActionForm() {
      if (this.selected_modal == "signin") {
        console.log("Action sign in");
      } else if (this.selected_modal == "signup") {
        console.log("Action sign up");
      } else if (this.selected_modal == "forgot_password") {
        console.log("Action forgot password");
      }
    }
  },
  mounted() {}
};
</script>

<style scoped></style>
