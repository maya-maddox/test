<template>
  <div> <!-- keep this single "parent" div in your template -->

    <!-- your Blade layout here -->

    <div class="card my-4 col-8 offset-2 p-0">
        <div class="card-body alert-secondary text-center">
          <option-button-selector label="All Checks" :options="allChecksOptions" :key="allChecksValue" :value="allChecksValue" :editable="false"/>
          <option-button-selector label="Refund Type" :options="refundTypeOptions" v-on:valueUpdate="refundTypeUpdate" :value="this.return.refund_type" :editable="!this.return.completed_date"/>
          <option-button-selector v-if="showCustomerAwareSelection" label="Customer Aware" :options="customerAwareOptions" v-on:valueUpdate="customerAwareUpdate" :value="this.return.customer_aware" :editable="!this.return.completed_date"/>
          <text-area-entry label="Notes" :value="this.return.notes" v-on:valueUpdate="notesUpdate" :isDisabled="this.return.completed_date"/>
        </div>
    </div>

  </div>
</template>

<script>
import OptionButtonSelector from '../../../../Components/OptionButtonSelector.vue';
import TextAreaEntry from '../../../../Components/Form/TextAreaEntry.vue';
  export default {
  components: { OptionButtonSelector, TextAreaEntry },
    props: {
        serviceCenterId: String,
        return: Object
    },
    computed: {
      showCustomerAwareSelection () {
        return this.return.refund_type !== null && this.return.refund_type !== 'not_applicable'
      },
      allChecksValue() {
        return this.return.all_checks
      }
    },
    data() {
        return {
            allChecksOptions: [{
                text: "Pass",
                value: true,
                style: "btn-outline-success",
                selectedStyle: 'btn-success text-white'
            }, {
                text: "Fail",
                value: false,
                style: "btn-outline-danger",
                selectedStyle: 'btn-danger text-white'
            }],
            refundTypeOptions: [
                {
                    value: "not_applicable",
                    text: "Not Applicable",
                    style: "btn-outline-secondary",
                    selectedStyle: 'btn-secondary text-white'
                },
                {
                    value: "full",
                    text: "Full",
                    style: "btn-outline-success",
                    selectedStyle: 'btn-success text-white'
                },
                {
                    value: "partial",
                    text: "Partial",
                    style: "btn-outline-warning",
                    selectedStyle: 'btn-warning text-dark'
                },
                {
                    value: "no_refund",
                    text: "No Refund",
                    style: "btn-outline-danger",
                    selectedStyle: 'btn-danger text-white'
                },
            ],
            customerAwareOptions: [
              {
                  text: "Yes",
                  value: true,
                  style: "btn-outline-success",
                  selectedStyle: 'btn-success text-white'
              }, 
              {
                  text: "No",
                  value: false,
                  style: "btn-outline-danger",
                  selectedStyle: 'btn-danger text-white'
              }
            ],
        }
    },
    methods: {
      refundTypeUpdate(newValue) {
        this.return.refund_type = newValue;
        this.$emit("returnUpdate", this.return);
      },
      customerAwareUpdate(newValue) {
        this.return.customer_aware = newValue;
        this.$emit("returnUpdate", this.return);
      },
      notesUpdate(newValue) {
        this.return.notes = newValue;
        this.$emit("returnUpdate", this.return);
      },
    },
  }
</script>
