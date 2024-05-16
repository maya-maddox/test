<template>
    <tr>
        <td>{{ returnItem.sku_name }}</td>
        <td><input type="text" v-model="returnItem.serial_number" :disabled="!editable"></td>
        <td>
            <option-text-selector :options="passFailOptions" v-on:valueUpdate="passFailUpdate" :value="this.returnItem.pass" :editable="editable"></option-text-selector>
        </td>
        <td>
            <div class="bg-white" style="min-width:200px">
                <v-select :options="options" label="name" v-model="returnItem.return_item_diagnosis_id" :reduce="diagnosis => diagnosis.value" :disabled="this.returnItem.pass !== false"></v-select>
            </div>
            <input v-if="returnItem.custom_diagnosis" type="text-area" v-model="returnItem.custom_diagnosis" :disabled="true">
        </td>
        <td>
            <option-text-selector :options="outcomesOptions" v-on:valueUpdate="outcomeUpdate" :value="this.returnItem.outcome" :editable="editable"></option-text-selector>
        </td>
        <td><textarea rows="3" v-model="returnItem.notes" :disabled="!editable"></textarea></td>
        <td><button v-if="editable" class="btn" :class="{
            'btn-warning': deleteConfirm === null,
            'btn-danger': deleteConfirm === false
        }" @click="deleteClicked"><i class="fas fa-trash"></i></button>
        <p v-if="deleteConfirm === false"><small>Click again to confirm</small></p></td>
    </tr>
</template>

<script>
import OptionTextSelector from '../../../../../Components/OptionTextSelector.vue'

import vSelect from "vue-select";
import 'vue-select/dist/vue-select.css';
  export default {
  components: { OptionTextSelector, vSelect },
    props: {
        returnItem: Object,
        editable: {
            required: false,
            default: true,
            type: Boolean
        },
        skuType: {
            required: true,
            type: Object
        }
    },
    data() {
        return {
            outcomesOptions: [
                {
                    value: "wastage_rejected",
                    text: "Wastage, Rejected"
                },
                {
                    value: "return_to_stock",
                    text: "Return to Stock"
                },
                {
                    value: "repaired_return_to_stock",
                    text: "Repaired & Return to Stock"
                },
                {
                    value: "repaired_rejected",
                    text: "Repaired & Rejected"
                },
            ],
            passFailOptions: [{
                text: "Pass",
                value: true,
                style: "text-success"
            }, {
                text: "Fail",
                value: false,
                style: "text-danger"
            }],
            deleteConfirm: null
        }
    },
    methods: {
        outcomeUpdate(value) {
            this.returnItem.outcome = value;
        },
        passFailUpdate(value) {
            this.returnItem.pass = value;
            if (value === true) {
                this.returnItem.return_item_diagnosis_id = null
            }
            this.$emit("returnItemPassFailUpdate", this.returnItem.id);
        },
        deleteClicked() {
            if (this.deleteConfirm === null) {
                this.deleteConfirm = false;
                setTimeout(function () { this.deleteConfirm = null }.bind(this), 2000)
                return;
            }
            this.$emit("deleteItem", this.returnItem.id);
        }
    },
    computed: {
        options() {
            return this.skuType?.return_item_diagnoses.map((diagnosis) => ({
                value: diagnosis.id,
                name: diagnosis.diagnosis
            }))
        },
    }
  }
</script>
