<template>
  <div
    class="modal fade"
    id="apiKeyModal"
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
          <form>
            <div class="form-group">
              <label for="exampleInputEmail1">API Key</label>
              <input
                type="text"
                class="form-control"
                :class="{ 'is-invalid': errors.api_key }"
                aria-describedby="User API Key"
                placeholder="Enter your api key"
                v-model="api_key"
              />
              <div class="invalid-feedback" v-if="errors.api_key">
                {{ errors.api_key[0] }}
              </div>
              <small id="emailHelp" class="form-text text-muted">
                <a
                  href="https://account.arena.net/applications"
                  target="_blank"
                >
                  Click here
                </a>
                to generate your key
              </small>
              <small class="text-danger">
                All your data will be replaced by the new API KEY data.
              </small>
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
      api_key: null,
      errors: {},
      block_request: false
    };
  },
  methods: {
    handleChangeAuthModal(modal) {
      this.selected_modal = modal;
    },
    submit() {
      const url = this.$root.routes.getRoute("user.updateApiKey");

      this.block_request = true;
      this.errors = [];

      axios
        .post(url, {
          _token: this.$root.token.get(),
          api_key: this.api_key
        })
        .then(response => {
          this.block_request = false;
          if ((response.data.status = 200)) {
            this.updateApiKeySuccess();
          }
        })
        .catch(error => {
          this.block_request = false;
          this.errors = error.response.data.errors;
        });
    },
    updateApiKeySuccess() {
      let timerInterval
      this.$root.swal
        .fire({
          title: "API Key updated successfully",
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
