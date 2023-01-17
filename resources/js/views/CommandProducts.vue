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
                <div class="gradient-1">
                    datos generales
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="gradient-1">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex">
                                <label for="product_id" class="control-label" style="padding-right: 5px;">Producto:
                                </label>
                                <v-select name="product_id" class="" style="flex: 1; border: 1px solid #8F8F8F;"
                                    :options="products" :reduce="product => product.id" label="name"
                                    v-model="product_id"></v-select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <div class="text-center">
                        <h3>Productos seleccionados</h3>
                    </div>
                    <vue-good-table styleClass="vgt-table condensed" :columns="columns" :rows="products"
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
                        <template slot="table-row" slot-scope="props">
                            <span v-if="props.column.field == 'actions'">
                                <button class="btn-product-list btn-increment" @click="incrementProduct(props.row.id)">
                                    +
                                </button>
                                <button class="btn-product-list btn-reduce" @click="reduceProduct(props.row.id)">
                                    -
                                </button>
                                <button class="btn-product-list btn-remove" @click="removeProduct(props.row.id)">
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
        <div class="text-center">
            <button class="btn btn-primary" @click="saveSale">Guardar</button>
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
    props: ['url', 'info', 'date'],
    components: {},
    data: function () {
        return {
            serviceCommand: {},
            serviceProduct: {},
            showspinner: false,
            showredirect: false,
            product_id: undefined,
            products: [],
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
        }
    },
    mounted: function () {
        this.serviceCommand = factoryApi('command');
        this.serviceProduct = factoryApi('product');
        this.getProducts();
    },
    methods: {
        saveSale: function () {
            if (this.validateForm()) {
                // this.showspinner = true;
                var token = $('meta[name="csrf-token"]').attr('content');
                console.log('save');
            }
        },
        getProducts: function () {
            this.serviceProduct.getProducts().then(response => {
                if (response.status === 200) {
                    this.products = response.data;
                }
            });
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
    },
    watch: {
        product_id: function (val) {
            console.log(val);
        }
    }
}
</script>
<style>
.gradient-1 {
    padding: 7px;
    border: 4px solid #FFF;
    outline: 4px solid #2f8fb4;
    color: black;
}

.form-wizard .select2-container {
    border: 1px solid rgb(82, 82, 82);
}

.payment .form-wizard {
    display: flex;
    justify-content: center;
}

.payment label {
    width: 25%;
}

.payment .form-control {
    width: 75%;
}
</style>