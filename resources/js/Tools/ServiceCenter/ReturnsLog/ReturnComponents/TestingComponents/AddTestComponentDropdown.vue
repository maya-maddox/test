<template>
    <div class="card form-group">
        <div class="card-body p-1">
            <h5>{{label}}</h5>
            <div class="btn-group-vertical mb-2" role="group">
                <button v-for="option in topOptions" :key="option.id" type="button" class="btn btn-sm btn-outline-primary" @click="addClicked(option.id)" data-toggle="tooltip" :title="'Total Returns: ' + option.return_items_count">{{ option.sku }}</button>
            </div>
            <div :class="{
                'my-1 position-absolute mx-2 fixed-bottom': topOptions.length < 5
                }">
                <!-- <select class="form-control" v-model="selected">
                    <option v-for="option in options" :key="option.value" :value="option.value">{{ option.name }}</option>
                </select> -->
                <v-select :options="options" label="name" v-model="selected" :reduce="sku => sku.value"></v-select>
                <button @click="addClicked(this.selected); this.selected = null" class=" mt-2 btn btn-lg btn-success" :disabled="!selected">Add</button>
            </div>
        </div>
    </div>
</template>

<script>
import vSelect from "vue-select";
import 'vue-select/dist/vue-select.css';

  export default {
  components: { vSelect },
    props: {
        skus: Array,
        label: String,
    },
    data() {
        return {
            selected: null
        }
    },
    computed: {
        options() {
            return this.skus.map((sku) => ({
                value: sku.id,
                name: sku.sku
            }))
        },
        topOptions() {
            return this.skus.sort((a, b) => b.return_items_count-a.return_items_count).slice(0, 5); //take 5 most popular items
        }
    },
    methods: {
        addClicked(sku_id) {
            this.$emit("addComponent", sku_id);
        }
    }
  }
</script>
