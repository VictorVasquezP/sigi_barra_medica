<template>
    <div class="page-content edit-add container-fluid">
        <div class="loading" v-show="showspinner">
            <svg class="spinner" width="65px" height="65px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
                <circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30">
                </circle>
            </svg>
        </div>
        <div class="redirect_loading" v-show="showredirect"></div>
        <div class="row" v-if="(command.status_id==3) || (command.status_id < 5  && role <= 2)">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-10">
                        <div class="d-flex" style="width: 90%; margin: auto;">
                            <label for="product_id" class="control-label"
                                style="padding-right: 5px;width: 15%;text-align: right;margin: auto; color: black; font-size: 12pt;">Buscar
                                Insumo:
                            </label>
                            <v-select name="product_id" class="" style="flex: 1; border: 1px solid #8F8F8F;"
                                :options="products" :reduce="product => product.id" label="name"
                                v-model="product_id"></v-select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                            Agregar consumo
                        </button>
                    </div>
                </div>
                <table class="table" v-show="(product_id != undefined)">
                    <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Categoria</th>
                            <th v-if="(role == 1 || role == 2)" scope="col">Precio unitario</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ product.name }}</td>
                            <td>{{ product.description }}</td>
                            <td>{{ product.category }}</td>
                            <td v-if="(role == 1 || role == 2)">
                                <div class="form-wizard">
                                    <input type="number" name="quantity" id="quantity" v-model="price"
                                        class="form-control" style="width: 100px;" />
                                </div>
                            </td>
                            <td>
                                <div class="form-wizard">
                                    <input type="number" name="quantity" id="quantity" v-model="quantity"
                                        class="form-control" style="width: 100px;" />
                                </div>
                            </td>
                            <td>
                                <button class="btn btn-success" @click="addProduct"><i class="voyager-plus"
                                        style="width: 20px;"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <div class="text-center">
                        <h3 style="margin: 0px 0px 15px 0px;">LISTA DE INSUMOS</h3>
                    </div>
                    <vue-good-table styleClass="vgt-table condensed" :columns="columns" :rows="myproducts"
                        :search-options="{
                            enabled: true,
                            placeholder: 'Buscar en la tabla...',
                        }" :pagination-options="{
    enabled: true,
    firstLabel: 'Primer página',
    lastLabel: 'Ultima página',
    nextLabel: 'Siguiente',
    prevLabel: 'Anterior',
    ofLabel: 'de',
    rowsPerPageLabel: 'Productos por página'
}">
                        <template slot="table-row" slot-scope="props"  v-if="command.status_id==3">
                            <span v-if="props.column.field == 'actions'">
                                <button class="btn-product-list btn-increment" @click="incrementProduct(props.row.name)">
                                    +
                                </button>
                                <button class="btn-product-list btn-reduce" @click="reduceProduct(props.row.name)">
                                    -
                                </button>
                                <button class="btn-product-list btn-remove" @click="removeProduct(props.row.name)">
                                    x
                                </button>
                            </span>
                            <span v-else>
                                {{ props.formattedRow[props.column.field] }}
                            </span>
                        </template>
                    </vue-good-table>
                </div>
            </div>
        </div>
        <div class="row" v-if="(role == 1 || role == 2)">
            <div class="col-md-12">
                <div class="table-total">
                    <table class="table">
                        <tr>
                            <td>Total: ${{ total.toFixed(2) }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="text-center">
            <button v-if="((role==1 || role == 2 ||role==3)&&(command.status_id==3)) || (command.status_id < 5 && role <= 2)" class="btn btn-primary" @click="saveSale">Guardar</button>
            <button v-if="(role==1 || role == 2 ||role==3)&&(command.status_id==3)" class="btn btn-warning" @click="updateStatusCommand(1)">Cerrar cuenta</button>
            <button v-if="(role==1 || role == 2)&&(command.status_id==4)" class="btn btn-dark" @click="updateStatusCommand(2)">Abrir cuenta de nuevo</button>
            <button v-if="(role==1 || role == 2)&&(command.status_id==4)" class="btn btn-success" @click="updateStatusCommand(3)">Finalizado</button>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Agregar consumo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group form-wizard col-md-6">
                            <input type="text" name="out_name" id="out_name" v-model="out_name" class="form-control" placeholder="Nombre">
                        </div>
                        <div class="form-group form-wizard col-md-3">
                            <input type="number" name="out_price" id="out_price" v-model="out_price" class="form-control" placeholder="Precio">
                        </div>
                        <div class="form-group form-wizard col-md-3">
                            <input type="number" name="out_quantity" id="out_quantity" v-model="out_quantity" class="form-control" placeholder="Cantidad">
                        </div>
                        <div class="form-group form-wizard col-md-12">
                            <span class="badge badge-secondary">Opcional</span>
                            <input type="text" name="out_des" id="out_des" v-model="out_des" class="form-control" placeholder="Descripción">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" @click="addProductOut">Guardar</button>
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
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css'
import VueGoodTablePlugin from 'vue-good-table';
import 'vue-good-table/dist/vue-good-table.css'
Vue.use(VueGoodTablePlugin);
Vue.component("v-select", vSelect);

export default {
    props: ['url', 'info', 'date','role_id'],
    components: {},
    data: function () {
        return {
            serviceCommand: {},
            serviceProduct: {},
            showspinner: false,
            showredirect: false,
            product_id: undefined,
            role:{},
            buttonStatus: {},
            products: [],
            product: {},
            quantity: 1,
            price: 0,
            out_quantity: undefined,
            out_price: undefined,
            out_name: "",
            out_des: "",
            myproducts: [],
            columns: [
                {
                    label: 'Nombre',
                    field: 'name',
                },
                {
                    label: 'Descripción',
                    field: 'description',
                },
                {
                    label: 'P. Unitario',
                    field: 'price',
                },
                {
                    label: 'Cantidad',
                    field: 'quantity',
                },
                {
                    label: 'Importe',
                    field: 'total',
                },
                {
                    label: 'Acciones',
                    field: 'actions',
                }
            ],
            command: {},
            total: 0
        }
    },
    mounted: function () {
        this.serviceCommand = factoryApi('command');
        this.serviceProduct = factoryApi('product');
        this.getProducts();
        this.command = JSON.parse(this.info);
        this.getInsumos(this.command.id);
        this.role = this.role_id;
        if(this.role > 2 ){
            this.columns = [
                {
                    label: 'Nombre',
                    field: 'name',
                },
                {
                    label: 'Descripción',
                    field: 'description',
                },
                {
                    label: 'Cantidad',
                    field: 'quantity',
                },
                {
                    label: 'Acciones',
                    field: 'actions',
                }
            ];
        }
    },
    methods: {
        saveSale: function () {
            var token = $('meta[name="csrf-token"]').attr('content');
            this.serviceCommand.saveInsumos(this.myproducts, token, this.command.id).then(response => {
                if (response.status === 200) {
                    Swal.fire({
                        icon: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500,
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.message,
                    })
                }
            });
        },
        updateStatusCommand: function (type) {
                this.showspinner = true;
                var token = $('meta[name="csrf-token"]').attr('content');
                this.serviceCommand.updateStatusCommand(this.command,token,type).then(response => { 
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
        },
        getProducts: function () {
            this.serviceProduct.getProducts().then(response => {
                if (response.status === 200) {
                    this.products = response.data;
                }
            });
        },
        getInsumos: function (id) {
            this.serviceCommand.getInsumos(id).then(response => {
                if (response.status === 200) {
                    this.myproducts = response.data;
                    this.calculateTotal(response.data);
                }
            });
        },
        addProduct() {
            if (Number.parseInt(this.quantity) > 0) {
                var aux = this.products.find(x => x.id == this.product_id);
                    var item = this.myproducts.find(x => x.name == this.name);
                    if (item != undefined) {//si esta registrado y solo aumentamos la cantidad
                        item.quantity = Number.parseInt(item.quantity) + Number.parseInt(this.quantity);
                        item.total = Number.parseInt(item.quantity) * Number.parseFloat(item.price);
                    } else {
                        item = {
                            name: aux.name,
                            description: aux.description,
                            price: this.price,
                            quantity: Number.parseInt(this.quantity),
                            total: Number.parseInt(this.quantity) * Number.parseFloat(this.price),
                        };
                        this.myproducts.push(item);
                    }
                    this.quantity = 1;
                    this.price = 0;
                    this.product_id = undefined;
                    this.calculateTotal(this.myproducts);
                    
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Sin cantidad',
                    text: 'Debe ingresar una cantidad mayor a cero',
                });
            }
        },
        addProductOut() {
            if (Number.parseInt(this.out_quantity) > 0) {
                    var item = this.myproducts.find(x => x.name == this.out_name);
                    if (item != undefined) {//si esta registrado y solo aumentamos la cantidad
                        item.quantity = Number.parseInt(item.quantity) + Number.parseInt(this.out_quantity);
                        item.total = Number.parseInt(item.quantity) * Number.parseFloat(this.out_price);
                    } else {
                        item = {
                            name: this.out_name,
                            description: this.out_des,
                            price: this.out_price,
                            quantity: Number.parseInt(this.out_quantity),
                            total: Number.parseInt(this.out_quantity) * Number.parseFloat(this.out_price)
                        };
                        this.myproducts.push(item);
                    }
                    this.out_name = "";
                    this.out_des = "";
                    this.out_quantity = undefined;
                    this.out_price = undefined;
                    this.calculateTotal(this.myproducts);
                    
                    $("[data-dismiss=modal]").trigger({ type: "click" });
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Sin cantidad',
                    text: 'Debe ingresar una cantidad mayor a cero',
                });
            }
        },
        incrementProduct: function (name) {
            var item = this.myproducts.find(x => x.name == name);
            item.quantity = Number.parseInt(item.quantity) + 1;
            item.total = Number.parseInt(item.quantity) * Number.parseFloat(item.price);
            this.calculateTotal(this.myproducts);
        },
        reduceProduct: function (name) {
            for (var i = 0; i < this.myproducts.length; i++) {
                if (this.myproducts[i].name === name) {
                    this.myproducts[i].quantity = Number.parseInt(this.myproducts[i].quantity) - 1;
                    this.myproducts[i].total = Number.parseInt(this.myproducts[i].quantity) * Number.parseFloat(this.myproducts[i].price);

                    if (this.myproducts[i].quantity < 1) {
                        this.myproducts.splice(i, 1);
                    }
                }
            }
            this.calculateTotal(this.myproducts);
        },
        removeProduct: function (name) {
            Swal.fire({
                icon: 'warning',
                title: 'Quitar insumo',
                text: '¿Está seguro de quitar este insumo?',
                showConfirmButton: true,
                confirmButtonText: 'Sí, Quitar',
                showCancelButton: true,
                denyButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {
                    for (var i = 0; i < this.myproducts.length; i++) {
                        if (this.myproducts[i].name === name) {
                            this.myproducts.splice(i, 1);
                        }
                    }
                    this.calculateTotal(this.myproducts);
                    Swal.fire('Quitado!', '', 'success');
                }
            });
        },
        calculateTotal: function(list){
            var aux = 0;
            list.forEach(element => {
                aux += Number.parseFloat(element.total);
            });
            this.total = aux;
        }
    },
    watch: {
        product_id: function (val) {
            if (val == undefined) {
                this.product = {};
            } else {
                this.product = this.products.find(x => x.id == val);
                this.price = this.product.price;
            }
        }
    }
}
</script>
<style>
.row>[class*=col-] {
    margin-bottom: 15px;
}

.gradient-1 {
    padding: 3px 7px 0px 7px;
    border: 3px solid #FFF;
    outline: 3px solid #2f8fb4;
    color: black;
}

.d-flex {
    display: flex;
}

.form-wizard .select2-container {
    border: 1px solid rgb(82, 82, 82);
}

.form-wizard input[type=number] {
    border: 1px solid rgb(82, 82, 82);
}

.voyager .table thead tr th {
    background-color: #17ac7f;
    color: #FFF;
}

.voyager .table {
    margin-bottom: 0;
}

.voyager .table tbody {
    color: black;
}

.btn-product-list {
    width: 33px;
    height: 33px;
    color: white;
    -webkit-border-radius: 50px;
    -moz-border-radius: 50px;
    border-radius: 50px;
    font-size: 13px;
    text-transform: uppercase;
    border: transparent;
    display: inline-block;
}

.btn-product-list:hover {
    opacity: 0.70;
    -moz-opacity: .70;
    filter: alpha (opacity=70);
}

.btn-increment {
    background-color: #24C334;
}

.btn-reduce {
    background-color: #006983;
}

.btn-remove {
    background-color: #910000;
}

.table-total {
    padding: 3px 10px;
    border: 2px solid #FFF;
    outline: 2px solid #C64D0D;
    background-color: #C64D0D;
}

.table-total .table {
    color: rgb(255, 255, 255);
    text-align: center;
    font-size: 11pt;
}
</style>