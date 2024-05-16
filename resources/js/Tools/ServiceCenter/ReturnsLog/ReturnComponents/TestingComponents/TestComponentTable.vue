<template>
    <table class="table">
        <thead>
            <tr>
                <th>SKU</th>
                <th>Serial Number</th>
                <th>Pass</th>
                <th>Diagnosis</th>
                <th>Outcome</th>
                <th>Notes</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <test-component-table-row
             v-on:deleteItem="deleteItem"
             v-on:returnItemPassFailUpdate="returnItemPassFailUpdate"
             v-for="returnItem in returnItems"
             :key="returnItem.id"
             :return-item="returnItem"
             :editable="editable"
             :skuType="returnItem.sku ? relevantSkuType(returnItem.sku.sku_type_id) : null"></test-component-table-row>
            <tr v-if="returnItems.length == 0">
                <td colspan="7" class="text-center text-secondary">
                    <p class="mx-auto">No Return Items Added</p>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
import TestComponentTableRow from './TestComponentTableRow.vue'
  export default {
  components: { TestComponentTableRow },
    props: {
        returnItems: Array,
        editable: {
            required: false,
            default: true,
            type: Boolean
        }
    },
    data() {
        return {
            skuTypes: []
        }
    },
    created () {
      axios.get("/api/sku-type/")
        .then(({data}) => {
          this.skuTypes = data;
      });
    },
    methods: {
        relevantSkuType(skuTypeId) {
            return this.skuTypes.find(skuType => {
                return skuType.id === skuTypeId
            })
        },
        deleteItem(returnItemId) {
            this.$emit("deleteReturnLogItem", returnItemId);
        },
        returnItemPassFailUpdate(returnItemId) {
            this.$emit("returnItemPassFailUpdate", returnItemId);
        }
    }
  }
</script>
