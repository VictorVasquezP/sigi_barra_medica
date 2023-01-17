<template>
    <div class="page-content edit-add container-fluid">
        <div class="loading" v-show="showspinner">
            <svg class="spinner" width="65px" height="65px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
                <circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30">
                </circle>
            </svg>
        </div>
        <div class="redirect_loading" v-show="showredirect"></div>
        <div class="row">
            hola
        </div>
    </div>
</template>

<script>
import factoryApi from '../services'
import Swal from 'sweetalert2/dist/sweetalert2.js'
import 'sweetalert2/dist/sweetalert2.min.css'

export default {
    props: ['url', 'date'],
    data: function () {
        return {
            serviceCommand: {},
            showspinner: false,
            showredirect: false,
            command: {}
        }
    },
    mounted: function () {
        this.serviceCommand = factoryApi('command');
    },
    methods: {
        saveSale: function () {
            if (this.validateForm()) {
                // this.showspinner = true;
                var token = $('meta[name="csrf-token"]').attr('content');
                console.log('save');
            }
        },
        validateForm() {
            // if( this.store.customer_id === undefined){
            //     Swal.fire({
            //         icon: 'error',
            //         title: 'Datos incompletos',
            //         text: "Hace falta seleccionar un cliente",
            //     });
            //     return false;
            // }
            return true;
        }
    }
}
</script>
<style>

</style>