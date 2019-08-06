<template>
  <div class="wrapper">
    <div class="wrapper__form">
      <p class="display-4 text-center mb-4">
        {{ $t("auth.forgotPassword") }}
      </p>
      <send-email
        v-if="!isSucceeded && !isModeCheckToken"
        :errors="errors"
        @send-email="sendEmail"
      />
      <reset-form
        v-else-if="isModeCheckToken"
        :errors="errors"
        :tokenValid="tokenValid"
        :isReseted="isReseted"
        @reset-password="resetPassword"
      />
      <p v-else>
        {{ $t("auth.sendEmailSuccess") }}
      </p>
    </div>
  </div>
</template>

<script>
import typeError from '@/constant';
import { ResetForm, SendEmail } from './components';

export default {
  name: 'ForgotPassword',
  components: {
    ResetForm,
    SendEmail,
  },
  data() {
    return {
      forgotPwdForm: {
        email: '',
        password: '',
      },
      submitting: false,
      isSubmited: false,
      tokenValid: false,
      isReseted: false,
      errors: {},
    };
  },
  computed: {
    inValid() {
      return Object.keys(this.errors).length > 0;
    },
    isSucceeded() {
      return !this.submitting && this.isSubmited && Object.keys(this.errors).length === 0;
    },
    isModeCheckToken() {
      return this.$route.query && !!this.$route.query.t;
    },
  },
  created() {
    this.checkToken();
  },
  methods: {
    async sendEmail(payload) {
      try {
        this.submitting = true;
        this.isSubmited = true;
        await this.$store.dispatch('user/forgotPassword', payload);
      } catch (error) {
        if (error.error_code === typeError.REQUEST_ERROR) {
          this.$toasted.error(`${error.message}`);
        }
        this.errors = error;
      } finally {
        this.submitting = false;
      }
    },
    async resetPassword(payload) {
      try {
        this.submitting = true;
        this.isSubmited = true;
        await this.$store.dispatch('user/resetPassword', { ...payload, reset_token: this.$route.query.t });
        this.isReseted = true;
      } catch (error) {
        if (error.error_code === typeError.REQUEST_ERROR) {
          this.$toasted.error(`${error.message}`);
        }
        this.errors = error;
      } finally {
        this.submitting = false;
      }
    },
    async checkToken() {
      try {
        if (this.$route.query && this.$route.query.t) {
          await this.$store.dispatch('user/cofirmToken', { reset_token: this.$route.query.t });
          this.tokenValid = true;
        }
      } catch (error) {
        this.errors = error;
      }
    },
  },
};
</script>

<style lang='scss' scoped>
@import '../../../sass/_variables.scss';

.wrapper {
  width: 100%;
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;

  &__form {
    background-color: $clounds;
    padding: 5rem 2rem;
    border-radius: 0.5rem;
    box-shadow: 3px 3px 2px 0px rgba(50, 50, 50, 0.25);
    width: 50%;
  }
}

.error input[type="email"],
.error input[type="password"] {
  background-color: #fce4e4;
  border: 1px solid #cc0033;
  outline: none;
}

.error-message {
  color: #cc0033;
  display: inline-block;
}

.error label {
  color: #cc0033;
}

@media (min-width: $screen-large) {
  .wrapper {
    &__form {
      width: 40%;
    }
  }
}

@media (min-width: $screen-extra-large) {
  .wrapper {
    &__form {
      width: 30%;
    }
  }
}
</style>
