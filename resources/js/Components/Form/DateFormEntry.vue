<template>
  <div class="form-group row">
      <label class="col-sm-4 col-form-label">{{ this.label }}</label>
      <div class="col-sm-8">
          <input class="form-control" type="datetime-local" :value="modelValue" @change="modelValueChange" :disabled='isDisabled' :required="isRequired" step="1"/>
          <button v-if="includeSetToNow && !isDisabled" @click="setToNow" class="btn btn-sm mt-1 mb-0 py-0 px-4 btn-outline-primary">Set To Now</button>
      </div>
  </div>
</template>

<script>
import moment from 'moment'

  export default {
    props: {
      label: String,
      value: String,
      isDisabled: {
        required: false,
        default: false,
        type: Boolean
      },
      isRequired: {
        required: false,
        default: false,
        type: Boolean
      },
      includeSetToNow: {
        required: false,
        default: false,
        type: Boolean
      },
      timezone: {
        required: false,
        default: moment.tz.guess(),
        type: String
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
      },
      setToNow() {
        this.modelValueChange({
          target: {
            value: this.timeNow()
          }
        })
      },
      timeNow() {
        return moment.tz(new Date(), moment.tz.guess()).tz(this.timezone).format("yyyy-MM-DD HH:mm:ss")
      }
    }
  }
</script>
