<template>
  <div> <!-- keep this single "parent" div in your template -->

    <!-- your Blade layout here -->

    <div class="card my-4 col-6 offset-3 p-0">
        <div class="card-body alert-secondary text-center">
          <template v-if="this.return.check_in_user">
              <date-form-entry :label="'Check In Date (' + this.return.service_center.timezone + ')'" :value="this.return.recieved_date_localized_formatted" :is-disabled="true"/>
              <text-form-entry label="SupportSync Return" :value="this.return.supportsync_reference" :is-disabled="true"/>
              <text-form-entry :class="{'mb-0': this.return.zendesk_reference}" label="Zendesk Number" :value="this.return.zendesk_reference" :is-disabled="true"/>
              <a v-if="this.return.zendesk_reference" :href="'https://swytchbike.zendesk.com/agent/tickets/' + this.return.zendesk_reference.match(/\d/g).join('')" class="mt-n3" target="_blank"><small>View Ticket in Zendesk</small></a>
              <text-form-entry label="Other Reference" :value="this.return.other_reference" :is-disabled="true"/>
              <text-form-entry label="Return Reason" :value="this.return.return_reason_formatted" :is-disabled="true"/>
              <text-form-entry label="Returned SKU" :value="this.return.sku_name" :is-disabled="true"/>
              <text-form-entry label="Booked In By" :value="this.return.check_in_user.name" :is-disabled="true"/>
            </template>
        </div>
    </div>

  </div>
</template>

<script>
  import DateFormEntry from '../../../../Components/Form/DateFormEntry.vue'
  import TextFormEntry from '../../../../Components/Form/TextFormEntry.vue'
  export default {
  components: { DateFormEntry, TextFormEntry },
    props: {
        return: Object
    }
  }
</script>
