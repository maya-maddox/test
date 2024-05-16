<template>
    <div>
        <div v-for="option in options" :key="option.text">
            <p @mouseover="hoverOn(option.value, $event)" 
                @mouseleave="hoverOff"
                @click="select(option.value, $event)"
                role="button"
                :class="[option.style ?? '', {
                    'font-weight-bold': hovered === option.value || selected === option.value,
                    'font-weight-light': (selected !== null && selected !== option.value),
                    'opacity-50': (selected !== null && selected !== option.value),
                    'small': (selected !== null && selected !== option.value),
                }]">{{ option.text }}</p> 
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
                this.$emit("valueUpdate", this.selected);
                return;
            }
            this.selected = value
            this.$emit("valueUpdate", this.selected);
        }
    }
  }
</script>
