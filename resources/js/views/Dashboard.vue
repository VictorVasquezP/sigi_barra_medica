<template>
  <div>
    <div class="row text-center">
      <div class="col-md-4">
        <DashboardCard title="Registros" :url="url + '/admin/commands'"
          icon="voyager-file-text" :info="'Ir'" textSmall="" color="rgb(7, 41, 77)" />
      </div>
    </div>
  </div>
</template>
<script>
import DashboardCard from '../components/DashboardCard.vue';
import factoryApi from '../services';

export default {
  components: { DashboardCard },
  props: {
    url: String
  },
  data: function () {
    return {
      serviceDashboard: {}
    }
  },
  mounted: function () {
    this.serviceDashboard = factoryApi('dashboard');
    // this.getCountRequestCareerChoice();
    // this.getCountRequestPostgraduate();
  },
  methods: {
  }
}
</script>
<style>

</style>