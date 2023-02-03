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
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="row">
                            <div class="form-group form-wizard col-md-6">
                                <label for="first_name" class="control-label">Nombre del paciente</label>
                                <input type="text" id="patient" name="patient" class="form-control" maxlength="80"
                                    minlength="1" placeholder="Nombre" required v-model="command.patient">
                            </div>
                            <div class="form-group form-wizard col-md-3">
                                <label for="first_name" class="control-label">Edad</label>
                                <input type="text" id="year_old" name="year_old" class="form-control" maxlength="80"
                                    minlength="1" placeholder="Edad" required v-model="command.year_old">
                            </div>
                            <div class="form-group form-wizard col-md-3">
                                <label for="first_name" class="control-label">Peso</label>
                                <input type="text" id="weight" name="weight" class="form-control" maxlength="80"
                                    minlength="1" placeholder="Peso" required v-model="command.weight">
                            </div>
                            <div class="form-group form-wizard col-md-6">
                                <label for="address" class="control-label">Dirección</label>
                                <input type="text" id="address" name="address" class="form-control" maxlength="80"
                                    title="máximo 150 caracteres" placeholder="Dirección" v-model="command.address">
                            </div>
                            <div class="form-group form-wizard col-md-6">
                                <label for="address" class="control-label">Telefono</label>
                                <input type="text" id="phone" name="phone" class="form-control" maxlength="80"
                                    title="Telefono" placeholder="Dirección" v-model="command.phone">
                            </div>
                            <div class="form-group form-wizard col-md-6 text-center">
                                <label for="start_date" class="control-label">Fecha de Ingreso </label>
                                <datetime type="datetime" v-model="command.date_admission" input-class="request-calendar"
                                    value-zone="America/Mexico_City" zone="America/Mexico_City"
                                    :format="{ year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: '2-digit' }"
                                    :phrases="{ ok: 'Continuar', cancel: 'Salir' }"
                                    :week-start="1"
                                    :week-finish="5" use12-hour>
                                </datetime>
                            </div>
                            <div class="form-group form-wizard col-md-6">
                                <label for="address" class="control-label">Diagnostico</label>
                                <input type="text" id="diagnostic" name="diagnostic" class="form-control" maxlength="80"
                                    title="máximo 150 caracteres" placeholder="Diagnostico" v-model="command.diagnostic">
                            </div>
                            <div class="form-group form-wizard col-md-6">
                                <label for="address" class="control-label">Alergias</label>
                                <input type="text" id="allergies" name="allergies" class="form-control" maxlength="80"
                                    title="máximo 150 caracteres" placeholder="Alergias" v-model="command.allergies">
                            </div>
                            <div class="form-group form-wizard col-md-6">
                                <label for="first_name" class="control-label">Nombre Doctor</label>
                                <input type="text" id="doctor" name="doctor" class="form-control" maxlength="80"
                                    minlength="1" placeholder="Doctor" required v-model="command.doctor">
                            </div>
                            <div class="form-group form-wizard col-md-6">
                                <label for="first_name" class="control-label">Nombre Enfermer@</label>
                                <input type="text" id="nurse" name="nurse" class="form-control" maxlength="80"
                                    minlength="1" placeholder="Enfermer@" required v-model="command.nurse">
                            </div>
                            <div class="form-group form-wizard col-md-6">
                                <label for="first_name" class="control-label">Tipo</label>
                                <input disabled type="text" id="type" name="type" class="form-control" maxlength="80"
                                    minlength="1" placeholder="Enfermer@" required v-model="dn">
                            </div>
                            <div class="form-group form-wizard col-md-6">
                                <label for="first_name" class="control-label">Habitación</label>
                                <select  class="form-control select2-ajax" name="room_id" id="room_id" required v-model="command.room_id">
                                    <option v-for="room in rooms" :value="room.id">{{room.name}}</option>
                                </select>
                            </div>
                            <div class="form-group form-wizard col-md-6">
                                <label for="first_name" class="control-label">Doctor en turno</label>
                                <input type="text" id="doctor_shift" name="doctor_shift" class="form-control" maxlength="80"
                                    minlength="1" placeholder="Doctor en turno" required v-model="command.doctor_shift">
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <button type="button" class="btn btn-primary save"
                            @click="saveCommand(command)">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import factoryApi from '../services'
import Swal from 'sweetalert2/dist/sweetalert2.js'
import 'sweetalert2/dist/sweetalert2.min.css'
import Vue from 'vue'
import { Datetime } from 'vue-datetime'
import 'vue-datetime/dist/vue-datetime.css'

Vue.component('datetime', Datetime);

export default {
    props: ['url', 'date','display_name'],
    data: function () {
        return {
            serviceCommand: {},
            showspinner: false,
            showredirect: false,
            dn:undefined,
            command: {},
            rooms: []
        }
    },
    mounted: function () {
        this.serviceCommand = factoryApi('command');
        this.getRooms();
        this.dn=this.display_name;
    },
    methods: {
        saveCommand: function () {
            this.command.type=this.dn;
            if (this.validateForm()) {
                this.showspinner = true;
                var token = $('meta[name="csrf-token"]').attr('content');
                this.serviceCommand.storeCommand(this.command,token).then(response => { 
                    this.showspinner=false;
                    if(response.status==200){
                        Swal.fire({
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1500,
                        }).then(()=>{
                            this.showredirect = true;
                            window.location.href = this.url +"/admin/commands";
                        });
                    }else{
                        Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'No se realizó el registro',
                        });
                    }
                });
            }
        },
        validateForm() {
            if(this.command.patient == undefined){
                Swal.fire({
                    icon: 'error',
                    title: 'Datos incompletos',
                    text: "Es necesario rellenar el campo paciente",
                });
                return false;
                
            }else if(this.command.address === undefined){
                Swal.fire({
                        icon: 'error',
                        title: 'Datos incompletos',
                        text: "Es necesario rellenar el campo dirección",
                    });
                    return false;
            }else if(this.command.date_admission === undefined){
                Swal.fire({
                        icon: 'error',
                        title: 'Datos incompletos',
                        text: "Es necesario elegir Fecha inicial",
                    });
                    return false;
            }else if(this.command.diagnostic === undefined){
                Swal.fire({
                        icon: 'error',
                        title: 'Datos incompletos',
                        text: "Es necesario rellenar el campo diagnostico",
                    });
                    return false;
            }else if(this.command.doctor === undefined){
                Swal.fire({
                        icon: 'error',
                        title: 'Datos incompletos',
                        text: "Es necesario rellenar el campo doctor",
                    });
                    return false;
            }else if(this.command.nurse === undefined){
                Swal.fire({
                        icon: 'error',
                        title: 'Fecha final incorrecta',
                        text: "Es necesario rellenar el campo enfermera",
                    });
                    return false;
            }
            
            return true;
        },
        getRooms: function () {
            this.serviceCommand.getRooms().then(response => {
                if (response.status === 200) {
                    this.rooms = response.data;
                }
            });
        },
    }
}
</script>
<style>

</style>