<template>
  <form>
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
    <div class="form-group">
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
      <small class="text-danger">for security reasons DO YOU NOT USE YOUR GAME PASSWORD HERE</small>
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Confirm Password</label>
      <input
        type="password"
        class="form-control"
        :class="{'is-invalid': errors.password }"
        placeholder="Confirm password"
        v-model="password_confirmation"
      />
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">API Key</label>
      <input
        type="text"
        class="form-control"
        :class="{'is-invalid': errors.api_key }"
        aria-describedby="User API Key"
        placeholder="Enter your api key"
        v-model="api_key"
      />
      <div class="invalid-feedback" v-if="errors.api_key">
        {{ errors.api_key[0] }}
      </div>
      <small id="emailHelp" class="form-text text-muted">
        <a href="https://account.arena.net/applications" target="_blank">Click here</a> to generate your key
      </small>

      <div class="text-right">
        <a href="javascript:void(0)" @click="setAuthModal('signin')" class="pr-2">Sign In</a>
        <button
          type="button"
          class="btn btn-primary"
          :disabled="block_request"
          @click="submitSingUp()">
          <span v-if="!block_request">Submit</span>
          <span v-else><i class="fas fa-spinner fa-spin"></i></span>
        </button>
      </div>
    </div>
  </form>
</template>

<script>
export default {
  data() {
    return {
      email: null,
      password: null,
      password_confirmation : null,
      api_key: null,
      errors: {},
      block_request: false
    }
  },
  methods: {
    setAuthModal(modal) {
      this.$emit('changeAuthModal', modal)
    },
    submitSingUp() {
      const url = this.$root.routes.getRoute('user.create')

      this.block_request = true
      this.errors = {}

      axios.post(url, {
        "_token": this.$root.token.get(),
        "email": this.email,
        "password": this.password,
        "password_confirmation": this.password_confirmation,
        "api_key": this.api_key
      }).then(response => {
        this.block_request = false
        if (response.data.user_id > 0) {
          this.signUpSuccess()
        }
      }).catch(error => {
        this.block_request = false
        this.errors = error.response.data.errors;
      })
    },
    signUpSuccess() {
      let timerInterval
      this.$root.swal.fire({
        title: 'Account created successfully',
        timer: 2000,
        timerProgressBar: true,
        didOpen: () => {
          this.$root.swal.showLoading()
          const b = this.$root.swal.getHtmlContainer().querySelector('b')
          timerInterval = setInterval(() => {
            b.textContent = this.$root.swal.getTimerLeft()
          }, 100)
        },
        willClose: () => {
          clearInterval(timerInterval)
        }
      }).then((result) => {
        /* Read more about handling dismissals below */
        if (result.dismiss === this.$root.swal.DismissReason.timer) {
          location.reload()
        }
      })
    }
  },
  mounted() {}
};
</script>

<style scoped>
</style>
