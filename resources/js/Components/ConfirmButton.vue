<template>
    <button class="btn" :class="[confirm === null ? this.baseStyle : '', confirm === false ? this.confirmStyle : '']" @click="clicked">
        <slot></slot>

    <p v-if="confirm === false">
        <small>{{ confirmText }}</small>
    </p>
    </button>
</template>

<script>
  export default 
  {
    props: {
        baseStyle: String,
        confirmStyle: String,
        confirmText: {
            type: String,
            default: "Click again to confirm"
        }
    },
    data () {
        return {
            confirm: null
        }
    },
    methods: {
        clicked(event) {
            if (this.confirm === null) {
                this.confirm = false;
                setTimeout(function () { this.confirm = null }.bind(this), 2000)
                return;
            }
            this.$emit("clickConfirmed");
        }
    }

  }
</script>
