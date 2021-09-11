<template>
  <div
    class="modal fade"
    id="passwordModal"
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
          <div
            class="alert alert-danger"
            role="alert"
            v-if="errors.generic">
            {{ errors.generic }}
          </div>
          <form>
            <div class="form-group">
              <label for="exampleInputPassword1">Current Password</label>
              <input
                type="password"
                class="form-control"
                :class="{ 'is-invalid': errors.current_password }"
                placeholder="Current password"
                v-model="current_password"
              />
              <div class="invalid-feedback" v-if="errors.current_password">
                {{ errors.current_password[0] }}
              </div>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Password</label>
              <input
                type="password"
                class="form-control"
                :class="{ 'is-invalid': errors.password }"
                placeholder="User password"
                v-model="password"
              />
              <div class="invalid-feedback" v-if="errors.password">
                {{ errors.password[0] }}
              </div>
              <small class="text-danger"
                >for security reasons DO YOU NOT USE YOUR GAME PASSWORD
                HERE</small
              >
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Confirm Password</label>
              <input
                type="password"
                class="form-control"
                :class="{ 'is-invalid': errors.password }"
                placeholder="Confirm password"
                v-model="password_confirmation"
              />
            </div>
            <div class="text-right">
              <button
                type="button"
                class="btn btn-primary"
                :disabled="block_request"
                @click="submit()"
              >
                <span v-if="!block_request">Update API Key</span>
                <span v-else><i class="fas fa-spinner fa-spin"></i></span>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      current_password: null,
      password: null,
      password_confirmation: null,
      errors: {},
      block_request: false
    };
  },
  methods: {
    submit() {
      const url = this.$root.routes.getRoute("user.updatePassword");

      this.block_request = true;
      this.errors = [];

      axios
        .post(url, {
          _token: this.$root.token.get(),
          current_password: this.current_password,
          password: this.password,
          password_confirmation: this.password_confirmation
        })
        .then(response => {
          this.block_request = false;
          if (response.data.status == 200) {
            this.updateSuccess();
          } else if (response.data.status == 401) {
            this.errors.generic = response.data.message;
          }
        })
        .catch(error => {
          this.block_request = false;
          this.errors = error.response.data.errors;
        });
    },
    updateSuccess() {
      let timerInterval;
      this.$root.swal
        .fire({
          title: "Password updated successfully",
          timer: 2000,
          timerProgressBar: true,
          didOpen: () => {
            this.$root.swal.showLoading();
            const b = this.$root.swal.getHtmlContainer().querySelector("b");
            timerInterval = setInterval(() => {
              b.textContent = this.$root.swal.getTimerLeft();
            }, 100);
          },
          willClose: () => {
            clearInterval(timerInterval);
          }
        })
        .then(result => {
          /* Read more about handling dismissals below */
          if (result.dismiss === this.$root.swal.DismissReason.timer) {
            location.reload();
          }
        });
    }
  },
  mounted() {
    this.api_key = this.$root.auth.user().api_key;
  }
};
</script>

<style scoped></style>
