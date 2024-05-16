<template>
  <div class="form-group row">
      <label class="col-sm-4 col-form-label">{{ this.label }}</label>
      <div class="col-sm-8">
          <input class="form-control" :value="modelValue" @change="modelValueChange" :disabled='isDisabled' :required="isRequired"/>
      </div>
  </div>
</template>

<script>
  export default {
    props: {
      label: String,
      value: String,
      isDisabled: {
        required: false,
        default: false,
        type: Boolean
      },
      rows: {
        required: false,
        default: 3,
        type: Number
      },
      isRequired: {
        required: false,
        default: false,
        type: Boolean
      }
    },
    data () {
      return {
        modelValue: this.value
      }
    },
    methods: {
      modelValueChange(newValue) {
        this.modelValue = newValue.target.value;
        this.$emit("valueUpdate", this.modelValue);
      }
    }
  }
</script>
