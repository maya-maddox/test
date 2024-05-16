<template>
    <div class="form-group row">
        <label class="col-sm-4 col-form-label">{{ this.label }}</label>
        <div class="btn-group col-sm-8">
            <div v-for="option in options" :key="option.text">
                <button @mouseover="hoverOn(option.value, $event)" 
                    @mouseleave="hoverOff"
                    @click="select(option.value, $event)"
                    class="btn mx-2"
                    :class="[option.style ?? '', 
                        selected === option.value ? (option.selectedStyle ?? '') : '', {
                        'font-weight-bold': hovered === option.value || selected === option.value,
                        'font-weight-light': (selected !== null && selected !== option.value),
                        'bg-opacity-50': (selected !== null && selected !== option.value),
                        'btn-sm': (selected !== null && selected !== option.value),
                        'disabled': (!editable && selected !== option.value)
                    }]">{{ option.text }}</button> 
            </div>
        </div>
    </div>
</template> <!-- These default to opacity  -->

<script>
  export default {
    props: {
        options: Array,
        value: {
            default: null
        },
        label: String,
        editable: {
            required: false,
            default: true,
            type: Boolean
        }
    },
    data() {
        return {
            hovered: null,
            selected: this.value === '' ? null : this.value
        }
    },
    methods: {
        hoverOn(value, event) {
            if (!this.editable) { return }
            this.hovered = value;
        },
        hoverOff(event) {
            if (!this.editable) { return }
            this.hovered = null;
        },
        select(value, event) {
            if (!this.editable) { return }
            if (this.selected === value) {
                this.selected = null
                return;
            }
            this.selected = value
            this.$emit("valueUpdate", this.selected);
        }
    }
  }
</script>
