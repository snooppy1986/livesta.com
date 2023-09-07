<template>
    <div class="card-body">
        <div class="form-group">
            <label for="country">Оберіть область: <abbr class="required" title="required">*</abbr></label>
            <model-list-select
                :list="areas"
                v-model="itemArea"
                option-value="Ref"
                option-text="Description"
                id="country"
                placeholder="Оберіть область">
            </model-list-select>
        </div>

        <div v-if="showCity" class="form-group">
            <label for="cities">Оберіть місто: <abbr class="required" title="required">*</abbr></label>
            <model-list-select
                :list="searchCities"
                v-model="itemCity"
                option-value="Ref"
                option-text="Description"
                id="cities"
                placeholder="Оберіть місто">
            </model-list-select>
        </div>

        <div v-if="showWarehouses" class="form-group">
            <label for="warehouses">Оберіть відділення: <abbr class="required" title="required">*</abbr></label>
            <model-list-select
                :list="searchWarehouses"
                v-model="itemWarehouses"
                option-value="Ref"
                option-text="Description"
                id="warehouses"
                placeholder="Оберіть відділення">
            </model-list-select>
        </div>
    </div>
    <ScaleLoader
        :loading="statusLoader"
        color="#ff6565"
        height="20px"
        width="5px"
    />
</template>

<script>
    import axios from 'axios';
    import {ModelListSelect} from 'vue-search-select';
    import { ScaleLoader } from "vue3-spinner";
    export default {
        name: "new_mail",
        data(){
            return{
                areas:[],
                searchCities: [],
                searchWarehouses: [],
                itemArea: {},
                itemCity: {},
                itemWarehouses: {},
                showCity: false,
                showWarehouses: false,
                deliveryAddress: {},
                statusLoader: true
            }
        },
        components:{
            ModelListSelect,
            ScaleLoader
        },
        mounted() {
            this.getAreas();
        },
        watch:{
            itemArea:function (value) {
                this.getCities(value)
                this.showCity=true
            },
            itemCity: function (value) {
                this.getWarehouses(value);
                this.showWarehouses=true;
            },
            itemWarehouses: function (value) {
                this.getFullAddress(this.itemArea, this.itemCity, value)
            }
        },
        methods:{
            getAreas(){
                this.statusLoader=true;
                axios.post('https://api.novaposhta.ua/v2.0/json/', {
                    apiKey: 'd00d8c26062adbddc853fc29ff519a16',
                    modelName: "Address",
                    calledMethod: 'getAreas',
                    methodProperties: {}
                }).then(response=>{
                    console.log(response.data.data);
                    this.areas = response.data.data;
                    this.statusLoader=false;
                });
            },
            getCities(value){
                this.statusLoader=true;
                axios.post('https://api.novaposhta.ua/v2.0/json/', {
                    apiKey: 'd00d8c26062adbddc853fc29ff519a16',
                    modelName: 'Address',
                    calledMethod: 'getCities',
                    methodProperties: {
                        Page:0
                    }
                }).then(response=>{
                    /*console.log(response.data.data);*/
                    this.searchCities=[]
                    let pageWithCities = response.data.data;
                    pageWithCities.forEach(cities=>{
                        if(cities.Area === value.Ref){
                            this.searchCities.push(cities);
                        }
                    })
                    this.statusLoader = false;
                });
            },
            getWarehouses(value){
                this.statusLoader=true;
                axios.post('https://api.novaposhta.ua/v2.0/json/', {
                    apiKey: 'd00d8c26062adbddc853fc29ff519a16',
                    modelName: 'Address',
                    calledMethod: 'getWarehouses',
                    methodProperties: {
                        CityRef: value.Ref,
                        Page:0,
                        Language: 'UA'
                    }
                }).then(response=>{
                    this.searchWarehouses = response.data.data;
                    this.statusLoader=false;
                });
            },
            getFullAddress(area, city, warehouses){
                this.deliveryAddress ={
                    'area': area.Description,
                    'city':  city.Description,
                    'warehouses': warehouses.Description
                }
                this.$emit('addressDelivery', this.deliveryAddress)
            }

        }
    }
</script>

<style>

</style>
