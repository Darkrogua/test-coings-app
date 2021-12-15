<template>
  <section class="alert" v-if="alert.show">
    <div class="alert-container"
         :class="{ danger: alert.danger }">
      <img v-if="!alert.danger" src="/images/ok.svg" alt="ok">
      <img v-else src="/images/danger.svg" alt="danger">
      <span>{{ alert.text }}</span>
    </div>
  </section>
</template>

<script>
    export default {
        name: "alert",
        props: {
            alert: {
                type: Object,
                default: {
                    show: false,
                    danger: true,
                    text: ''
                }
            }
        },
        date: {
            test: {
                show: false
            }
        },
        watch: {
            alert: {
                handler(val) {
                    if (val.show) this.hideAlert();
                },
                deep: true
            },
        },
        methods: {
            hideAlert: function () {
                setTimeout(() => this.$emit('update:alert',{show:false}), 2000);
            }
        }
    }
</script>
