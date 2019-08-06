<template>
  <div>
    <form
      v-if="tokenValid && !isReseted"
      @submit.prevent="submitForm"
    >
      <div class="form-group">
        <label for="newPassword">
          {{ $t("auth.enterPassword") }}
        </label>
        <input
          id="newPassword"
          v-model="formData.password"
          type="password"
          class="form-control"
          :placeholder="$t('auth.enterPassword')"
        >
      </div>

      <div class="form-group">
        <label for="confirmPassword">
          {{ $t("auth.confirmPassword") }}
        </label>
        <input
          id="confirmPassword"
          v-model="formData.password_confirmation"
          type="password"
          class="form-control"
          :placeholder="$t('auth.confirmPassword')"
        >
      </div>

      <button
        type="submit"
        class="btn btn-primary w-100"
      >
        {{ $t("auth.submit") }}
      </button>
    </form>
    <p v-else-if="isReseted">
      {{ $t("auth.resetPwdSuccuess") }}
    </p>
    <p v-else>
      {{ errors.message }}
    </p>
  </div>
</template>

<script>
export default {
  name: 'ResetPasswordForm',
  props: {
    errors: Object,
    tokenValid: {
      type: Boolean,
      default: () => false,
    },
    isReseted: {
      type: Boolean,
      default: () => false,
    }
  },
  data() {
    return {
      formData: {
        password: '',
        password_confirmation: '',
      },
    };
  },
  methods: {
    submitForm() {
      this.$emit('reset-password', this.formData);
    },
  },
};
</script>
