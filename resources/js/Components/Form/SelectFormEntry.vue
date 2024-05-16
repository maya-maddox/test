<template>
  <div class="form-group row">
      <label class="col-sm-4 col-form-label">{{ this.label }}</label>
      <div class="col-sm-8">
          <select class="form-control" v-model="selected" :disabled='isDisabled' :required="isRequired">
            <option disabled value="">Please select one</option>
            <option v-for="option in options" :key="option.value" :value="option.value">{{ option.name }}</option>
          </select>
      </div>
  </div>
</template>

<script>
  export default {
    props: {
      label: String,
      value: undefined,
      options: Array,
      isDisabled: {
        required: false,
        default: false,
        type: Boolean
      },
      isRequired: {
        required: false,
        default: false,
        type: Boolean
      }
    },
    data () {
      return {
        selected: this.value
      }
    }
  }
</script>
