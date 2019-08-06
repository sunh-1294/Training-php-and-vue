<template>
  <form @submit.prevent="handeSubmit">
    <div class="form-group">
      <label for="email">
        {{ $t("auth.emailAddress") }}
      </label>
      <input
        id="email"
        v-model="email"
        type="email"
        class="form-control"
        :placeholder="$t('auth.enterEmail')"
      >
    </div>

    <button
      type="submit"
      class="btn btn-primary w-100"
    >
      {{ $t("auth.submit") }}
    </button>
  </form>
</template>

<script>
export default {
  name: 'SendEmail',
  data() {
    return {
      email: '',
    };
  },
  methods: {
    handeSubmit() {
      this.$emit('send-email', { email: this.email });
    },
  },
};
</script>
