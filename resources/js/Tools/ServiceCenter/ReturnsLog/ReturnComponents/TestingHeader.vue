<template>
  <div> <!-- keep this single "parent" div in your template -->

    <!-- your Blade layout here -->

    <div class="card my-4 col-6 offset-3 p-0">
        <div class="card-body alert-secondary text-center">
          <date-form-entry :label="'Test Start Date (' + this.return.service_center.timezone + ')'" :timezone="this.return.service_center.timezone"  :value="this.savedReturn.tested_date ? this.return.tested_date_localized_formatted : this.return.tested_date_localized" v-on:valueUpdate="testedDateUpdate" :isRequired="true" :isDisabled="this.savedReturn.tested_date" :includeSetToNow="true"/>
          <select-form-entry label="Technician" :options="this.userOptions" :value="this.return.technician_id" v-on:valueUpdate="technicianUpdate" :isRequired="true"  :isDisabled="this.savedReturn.tested_date"/>
          <button v-if="!this.savedReturn.tested_date" class="btn btn-lg btn-success mt-2" @click="startProcessing">START PROCESSING</button>
        </div>
    </div>

  </div>
</template>

<script>
  import DateFormEntry from '../../../../Components/Form/DateFormEntry.vue';
  import SelectFormEntry from '../../../../Components/Form/SelectFormEntry.vue';
  export default {
  components: { DateFormEntry, SelectFormEntry },
    props: {
        serviceCenterId: String,
        return: Object,
        savedReturn: Object,
    },
    data () {
      return {
        users: []
      }
    },
    created () {
      axios.get("/api/tools/servicecenter/users")
        .then(({data}) => {
          this.users = data;
      });

      if (this.return.technician_id === null) {
        this.technicianUpdate(window.Laravel['user_id'])
      }
    },
    methods: {
      testedDateUpdate(newValue) {
        this.return.tested_date_localized = newValue;
        this.$emit("returnUpdate", this.return);
      },
      technicianUpdate(newValue) {
        this.return.technician_id = newValue;
        this.$emit("returnUpdate", this.return);
      },
      startProcessing() {
        this.$emit("startProcessing");
      }
    },
    computed: {
      userOptions() {
        return this.users.map(user => ({
          name: user.text,
          value: user.value
        }))
      }
    }
  }
</script>
