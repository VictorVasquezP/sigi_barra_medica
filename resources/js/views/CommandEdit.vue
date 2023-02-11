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
            <div class="col-md-12" v-if="isHiddenInfo">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="row">
                            <input hidden type="text" id="id" name="id" v-model="command.id">
                            <div class="form-group form-wizard col-md-6">
                                <label for="first_name" class="control-label">Nombre del paciente</label>
                                <h4 id="hpatient">{{ command.patient }}</h4>
                            </div>
                            <div class="form-group form-wizard col-md-3">
                                <label for="first_name" class="control-label">Edad</label>
                                <h4 id="hpatient">{{ command.year_old }}</h4>
                            </div>
                            <div class="form-group form-wizard col-md-3">
                                <label for="first_name" class="control-label">Peso</label>
                                <h4 id="hpatient">{{ command.weight }}</h4>
                            </div>
                            <div class="form-group form-wizard col-md-6">
                                <label for="address" class="control-label">Dirección</label>
                                <h4 id="haddres">{{ command.address }}</h4>
                            </div>
                            <div class="form-group form-wizard col-md-6">
                                <label for="address" class="control-label">Telefono</label>
                                <h4 id="haddres">{{ command.phone }}</h4>
                            </div>
                            <div class="form-group form-wizard col-md-6">
                                <label for="address" class="control-label">Diagnostico</label>
                                <h4 id="hdiagnostic">{{ command.diagnostic }}</h4>
                            </div>
                            <div class="form-group form-wizard col-md-6">
                                <label for="address" class="control-label">Alergias</label>
                                <h4 id="hdiagnostic">{{ command.allergies }}</h4>
                            </div>
                            <div class="form-group form-wizard col-md-6">
                                <label for="first_name" class="control-label">Nombre Doctor</label>
                                <h4 id="hdoctor">{{ command.doctor }}</h4>
                            </div>
                            <div class="form-group form-wizard col-md-6">
                                <label for="first_name" class="control-label">Nombre Enfermer@</label>
                                <h4 id="hnurse">{{ command.nurse }}</h4>
                            </div>
                            <div class="form-group form-wizard col-md-6">
                                <label for="first_name" class="control-label">Tipo</label>
                                <h4 id="htype">{{ command.type }}</h4>
                            </div>
                            <div class="form-group form-wizard col-md-6">
                                <label for="first_name" class="control-label">Habitación Actual</label>
                                <h4 id="hdoctor_shift">{{ command.room_name }}</h4>
                            </div>
                            <div class="form-group form-wizard col-md-6">
                                <label for="first_name" class="control-label">Doctor en turno</label>
                                <h4 id="hdoctor_shift">{{ command.doctor_shift }}</h4>
                            </div>
                            <div class="form-group form-wizard col-md-6">
                                <label for="first_name" class="control-label">Fecha de ingreso</label>
                                <h4 id="hdoctor_shift">{{ command.date_admission }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer" v-if="(command.status_id==3) || (command.status_id < 5 && role_id <= 2)">
                        <button class="btn btn-primary save" v-on:click="isHiddenInfo = false; isHiddenForm=true">Editar</button>
                    </div>
                </div>
            </div>
            <div class="col-md-12" v-if="isHiddenForm">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="row">
                            <input hidden type="text" id="id" name="id" v-model="command.id">
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
                                <select  class="form-control select2-ajax" name="type" id="type" required v-model="type">
                                    <option v-for="tr in typesrooms" :value="tr.name">{{tr.name}}</option>
                                </select>
                            </div>
                            <div class="form-group form-wizard col-md-6">
                                <label for="first_name" class="control-label">Habitación Nueva</label>
                                <select  class="form-control select2-ajax" name="type" id="type" required v-model="command.room_id">
                                    <option v-for="room in rooms" :value="room.id">{{room.name}}</option>
                                </select>
                            </div>
                            <div class="form-group form-wizard col-md-6">
                                <label for="first_name" class="control-label">Doctor en turno</label>
                                <input type="text" id="doctor_shift" name="doctor_shift" class="form-control" maxlength="80"
                                    minlength="1" placeholder="Doctor en turno" required v-model="command.doctor_shift">
                            </div>
                            <div class="form-group form-wizard col-md-6 text-center">
                                <label for="start_date" class="control-label">Fecha de Ingreso </label>
                                <input type="date" id="date_admission" name="date_admission" class="form-control" required v-model="command.date_admission">
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <button type="button" class="btn btn-primary save"
                            @click="editCommand(command)">Guardar</button>
                        <button class="btn btn-danger save" v-on:click="isHiddenForm = false; isHiddenInfo=true">Cancelar</button>
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
import { type } from 'os'

Vue.component('datetime', Datetime);

export default {
    props: ['url','info', 'date', 'role_id'],
    data: function () {
        return {
            serviceCommand: {},
            showspinner: false,
            showredirect: false,
            isHiddenInfo: true,
            isHiddenForm: false,
            command: {},
            rooms: [],
            typesrooms:[],
            type:undefined
        }
    },
    mounted: function () {
        this.serviceCommand = factoryApi('command');
        this.command = JSON.parse(this.info);
        this.type=this.command.type;
        this.getRooms();
        this.getTypeRooms();
    },
    methods: {
        editCommand: function () {
            if (this.validateForm()) {
                this.showspinner = true;
                var token = $('meta[name="csrf-token"]').attr('content');
                this.serviceCommand.editCommand(this.command,token).then(response => { 
                    this.showspinner=false;
                    console.log(response.data);
                    if(response.status==200){
                        Swal.fire({
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1500,
                        }).then(()=>{
                            this.showredirect = true;
                            this.isHiddenForm = false; 
                            this.isHiddenInfo=true;
                            this.getRooms();
                            this.command = response.data;
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
            if(this.command.patient == null){
                Swal.fire({
                    icon: 'error',
                    title: 'Datos incompletos',
                    text: "Es necesario rellenar el campo paciente",
                });
                return false;
                
            }else if(this.command.address === null){
                Swal.fire({
                        icon: 'error',
                        title: 'Datos incompletos',
                        text: "Es necesario rellenar el campo dirección",
                    });
                    return false;
            }else if(this.command.diagnostic === null){
                Swal.fire({
                        icon: 'error',
                        title: 'Datos incompletos',
                        text: "Es necesario rellenar el campo diagnostico",
                    });
                    return false;
            }else if(this.command.doctor === null){
                Swal.fire({
                        icon: 'error',
                        title: 'Datos incompletos',
                        text: "Es necesario rellenar el campo doctor",
                    });
                    return false;
            }else if(this.command.nurse === null){
                Swal.fire({
                        icon: 'error',
                        title: 'Datos incompletos',
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
        getTypeRooms: function () {
            this.serviceCommand.getTypesRooms().then(response => {
                if (response.status === 200) {
                    this.typesrooms = response.data;
                }
            });
        },
        getRoomsWhere: function (type) {
            this.serviceCommand.getRoomsWhere(type).then(response => {
                if (response.status === 200) {
                    this.rooms = response.data;
                    console.log(this.rooms);
                }
            });
        },
    },
    watch:{
        type: function(value){
            this.command.type=value;
            this.getRoomsWhere(value);
            
        },
    }
}
</script>
<style>

</style>