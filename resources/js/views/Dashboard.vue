<template>
  <div>
    <div class="row text-center">
      <div class="col-md-4">
        <DashboardCard title="Registros" :url="url + '/admin/commands'"
          icon="voyager-file-text" :info="totalRequestCareer" textSmall="Cortes de caja" color="rgb(7, 41, 77)" />
      </div>
      <div class="col-md-4">
        <DashboardCard title="Habitaciones" :url="url + '/admin/rooms'"
          icon="voyager-file-text" :info="totalRequestPostgraduate" textSmall="Habitaciones" color="rgb(7, 41, 77)" />
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
      serviceDashboard: {},
      totalRequestCareer: 0,
      totalRequestPostgraduate: 0
    }
  },
  mounted: function () {
    this.serviceDashboard = factoryApi('dashboard');
    // this.getCountRequestCareerChoice();
    // this.getCountRequestPostgraduate();
  },
  methods: {
    getCountRequestCareerChoice: function () {
      this.serviceDashboard.getCountRequestCareerChoice().then(response => {
        if (response.status === 200) {
          this.totalRequestCareer = response.data;
        }
      });
    },
    getCountRequestPostgraduate: function () {
      this.serviceDashboard.getCountRequestPostgraduate().then(response => {
        if (response.status === 200) {
          this.totalRequestPostgraduate = response.data;
        }
      });
    }
  }
}
</script>
<style>

</style>