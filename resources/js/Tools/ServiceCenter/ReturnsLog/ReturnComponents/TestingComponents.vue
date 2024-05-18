<template>
  <div> <!-- keep this single "parent" div in your template -->

    <!-- your Blade layout here -->
    <div class="card my-4 col-12 p-0" v-if="!this.return.completed_date">
        <div class="card-body alert-secondary text-center row pb-1">
            <h3>Suggested SKUs</h3>
            <div class="mb-2" role="group">
              <button v-for="sku in suggestedSkus" :key="sku.id" @click="addComponent(sku.id);" class="mt-2 btn btn-primary m-2">Add {{ sku.sku }}</button>
            </div>
        </div>
    </div>

    <div class="card my-4 col-12 p-0" v-if="!this.return.completed_date">
        <div class="card-body alert-secondary text-center row pb-1">
          <add-test-component-dropdown v-for="(skuTypeName, skuTypeId) in skuTypes" :key="skuTypeId" class="col-3 mb-0" :label="skuTypeName ?? 'Other'" :skus="skuByTypeId(skuTypeId)" v-on:addComponent="addComponent"></add-test-component-dropdown>
          <a class="col-12 p-0 m-0" href="/stores/swytch/sku-type/"><small>SKU Types can be updated here</small></a>
        </div>
    </div>

    <div class="card my-4 col-12 p-0">
      <div class="card-body alert-secondary text-center row p-0">
        <test-component-table 
          v-if="this.return.return_items"
          :returnItems="this.return.return_items"
          v-on:deleteReturnLogItem="deleteReturnLogItem"
          v-on:returnItemPassFailUpdate="returnItemPassFailUpdate"
          :editable="!this.return.completed_date"></test-component-table>
      </div>
    </div>

  </div>
</template>

<script>
import AddTestComponentDropdown from './TestingComponents/AddTestComponentDropdown.vue';
import TestComponentTable from './TestingComponents/TestComponentTable.vue';
  export default {
  components: { AddTestComponentDropdown, TestComponentTable },
    props: {
        serviceCenterId: String,
        return: Object
    },
    data () {
      return {
        skus: [],
        suggestedSkus: [],
      }
    },
    created () {
      axios.get("/api/sku/")
        .then(({data}) => {
          this.skus = data;
      });
      axios.get("/api/tools/servicecenter/" + this.serviceCenterId + "/returnslog/" + this.return.id + "/suggestedSkus")
        .then(({data}) => {
          this.suggestedSkus = data;
      });
    },
    methods: {
      skuByTypeId(typeId) {
        if (typeId == 0) { typeId = null; }
        return this.skus.filter(sku => (
          sku.sku_type_id == typeId
        ))
      },
      testedDateUpdate(newValue) {
        this.return.tested_date = newValue;
        this.$emit("returnUpdate", this.return);
      },
      technicianUpdate(newValue) {
        this.return.technician_id = newValue;
        this.$emit("returnUpdate", this.return);
      },
      refreshReturnItems() {
        axios.get("/api/tools/servicecenter/" + this.serviceCenterId + "/returnslog/" + this.return.id + "/returnitem/")
          .then(({data}) => {
            this.return.return_items = data;
        });
      },
      addComponent(skuId) {
        axios.post("/api/tools/servicecenter/" + this.serviceCenterId + "/returnslog/" + this.return.id + "/returnitem/", {
          "sku_id": skuId
        })
          .then(() => {
            this.suggestedSkus = this.suggestedSkus.filter(sku => sku.id !== skuId); // Remove the selected suggestion
            this.refreshReturnItems();
        });
      },
      deleteReturnLogItem(returnItemId) {
        axios.delete("/api/tools/servicecenter/" + this.serviceCenterId + "/returnslog/" + this.return.id + "/returnitem/" + returnItemId)
          .then(() => {
            let i = this.return.return_items.map(returnItem => returnItem.id).indexOf(returnItemId)
            this.return.return_items.splice(i, 1) 
            
        });
      },
      returnItemPassFailUpdate(returnItemId) {
        let passed = true;
        this.return.return_items.forEach(returnItem => {
          if (returnItem.pass === false) {
            passed = false;
          }
          if (returnItem.pass === null && passed === true) {
            passed = null;
          }
        });
        this.return.all_checks = passed;
      }
    },
    computed: {
      skuTypes() {
        let skuTypes = {
        };
        this.skus.forEach(sku => {
          if (sku.sku_type_id != null) {
            console.log(sku.sku_type_id)
            skuTypes[sku.sku_type_id] = sku.sku_type.type
          }
        })
        return skuTypes
      }
    }
  }
</script>
