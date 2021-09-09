<template>
  <form>
    <div class="alert alert-danger" role="alert" v-if="login_countdown > 0">
      Invalid email or password, please try again or click on <b>forget my password</b>.
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Email address</label>
      <input
        type="email"
        name="email"
        class="form-control"
        :class="{'is-invalid': errors.email }"
        aria-describedby="User email input"
        placeholder="Enter email"
        v-model="email"
      />
      <div class="invalid-feedback" v-if="errors.email">
        {{ errors.email[0] }}
      </div>
    </div>
    <div class="form-group mb-1">
      <label for="exampleInputPassword1">Password</label>
      <input
        type="password"
        class="form-control"
        :class="{'is-invalid': errors.password }"
        placeholder="User password"
        v-model="password"
      />
      <div class="invalid-feedback" v-if="errors.password">
        {{ errors.password[0] }}
      </div>
    </div>
    <p class="text-right">
      <small><a href="javascript:void(0)" @click="setAuthModal('forgot_password')">Forgot my password</a></small>
    </p>
    <div class="text-right">
      <a href="javascript:void(0)" @click="setAuthModal('signup')" class="pr-2">Sign up</a>
      <button
        type="button"
        class="btn btn-primary"
        :disabled="block_request || !email || !password"
        @click="submitSingIn()">

        <span v-if="!block_request && login_countdown === 0">Submit</span>
        <span v-else>
          <i v-if="login_countdown > 0">Try again in {{ login_countdown }} ... </i>
          <i v-else class="fas fa-spinner fa-spin"></i>
        </span>
      </button>
    </div>
  </form>
</template>

<script>
export default {
  data() {
    return {
      email: null,
      password: null,
      errors: {},
      block_request: false,
      login_countdown: 0,
    }
  },
  methods: {
    setAuthModal(modal) {
      this.$emit('changeAuthModal', modal)
    },
    submitSingIn() {
      const url = this.$root.routes.getRoute('user.login')

      this.block_request = true
      this.errors = {}

      axios.post(url, {
        "_token": this.$root.token.get(),
        "email": this.email,
        "password": this.password
      }).then(response => {
        if(response.data.logged_in) {
          location.reload()
        } else {
          this.login_countdown = 5
          this.countDownTimer()
        }
      }).catch(error => {
        this.block_request = false
        this.errors = error.response.data.errors;
      })
    },
    countDownTimer() {
      if (this.login_countdown > 0) {
        setTimeout(() => {
          this.login_countdown -= 1
          this.countDownTimer()
        }, 1000)
      } else {
        this.block_request = false
      }
    }
  },
  mounted() {}
};
</script>

<style scoped></style>
