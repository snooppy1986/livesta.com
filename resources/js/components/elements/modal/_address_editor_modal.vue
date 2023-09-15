<template>
    <!--== Start Order Show Modal ==-->
    <aside ref="AddressEditor" class="product-action-modal modal fade" id="action-AddressEditor" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="product-action-view-content">
                        <button type="button" id="close" class="btn-close" data-bs-dismiss="modal">
                            <i class="fa fa-times"></i>
                        </button>
                        <div class="modal-action-product">
                            <div class="my-account-item-wrap">
                                <h3 class="title">Змінити адресу</h3>
                                <div class="my-account-form">
                                    <form action="#" method="post">
                                        <div class="form-group mb-6">
                                            <label for="area">Область</label>
                                            <input
                                                v-model="address.area"
                                                class="form-control"
                                                :class="{'is-invalid': errors && errors.area}"
                                                type="text"
                                                id="area"
                                                placeholder="Назва області"
                                            >
                                            <div
                                                v-if="errors && errors.area"
                                                class="alert alert-danger "
                                            >
                                                {{errors.area[0]}}
                                            </div>
                                        </div>

                                        <div class="form-group mb-6">
                                            <label for="city">Місто</label>
                                            <input
                                                v-model="address.city"
                                                class="form-control"
                                                :class="{'is-invalid': errors && errors.city}"
                                                type="text"
                                                id="city"
                                                placeholder="Назва міста"
                                            >
                                            <div
                                                v-if="errors && errors.city"
                                                class="alert alert-danger "
                                            >
                                                {{errors.city[0]}}
                                            </div>
                                        </div>

                                        <div class="form-group mb-6">
                                            <label for="street">Вулиця</label>
                                            <input
                                                v-model="address.street"
                                                class="form-control"
                                                :class="{'is-invalid': errors && errors.street}"
                                                type="text"
                                                id="street"
                                                placeholder="Назва вулиці"
                                            >
                                            <div
                                                v-if="errors && errors.street"
                                                class="alert alert-danger "
                                            >
                                                {{errors.street[0]}}
                                            </div>
                                        </div>

                                        <div class="form-group mb-6">
                                            <label for="house">Будинок</label>
                                            <input
                                                v-model="address.house_number"
                                                class="form-control"
                                                :class="{'is-invalid': errors && errors.house_number}"
                                                type="text"
                                                id="house"
                                                placeholder="Номер будинку"
                                            >
                                            <div
                                                v-if="errors && errors.house_number"
                                                class="alert alert-danger "
                                            >
                                                {{errors.house_number[0]}}
                                            </div>
                                        </div>

                                        <div class="form-group mb-6">
                                            <label for="postcode">Поштовий індекс</label>
                                            <input
                                                v-model="address.postcode"
                                                class="form-control"
                                                :class="{'is-invalid': errors && errors.postcode}"
                                                type="text"
                                                id="postcode"
                                                placeholder="Поштовий індекс"
                                            >
                                            <div
                                                v-if="errors && errors.postcode"
                                                class="alert alert-danger "
                                            >
                                                {{errors.postcode[0]}}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <button  class="btn" @click.prevent="edit_user_attributes">{{address ? 'Змінити адресу' : 'Додати адресу'}}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </aside>
    <!--== End Order Show Modal ==-->
</template>

<script>
    import api from '../../../api.js';

    export default {
        name: "_address_editor_modal",
        props: ['user_id', 'address'],
        data(){
            return {
                errors: {},
            }
        },

        methods:{
            edit_user_attributes(){
                this.errors = {};
                api.post('/api/auth/add-user-attr', {
                    'user_id': this.user_id,
                    'area': this.address.area,
                    'city': this.address.city,
                    'street': this.address.street,
                    'house_number': this.address.house_number,
                    'postcode': this.address.postcode
                }).then(result=>{
                    this.$emit('message', result.data.message);
                    document.getElementById('close').click();
                }).catch(error=>{
                    this.errors = error.response.data.errors;
                })
            }
        }
    }
</script>

<style scoped>

</style>
