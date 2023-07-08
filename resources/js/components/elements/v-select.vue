<template>
    <div class="v-select">
        <p class="current"
            @click="statusVisible = !statusVisible"

        >
            {{selected}}
            <i class="fa fa-angle-down" aria-hidden="true"></i>
        </p>
        <div
            class="options"
            v-if="statusVisible"
        >
            <p
                class="option"
                v-for="option in options"
                :key="option.value"
                @click="selectOption(option)"
            >
                {{option.name}}
            </p>
        </div>
    </div>
</template>

<script>
    export default {
        name: "v_select",
        props:{
            options:{
                type: Array,
                default(){
                    return []
                }
            },
            selected:{
                type: String,
                default: ''
            }
        },
        data(){
            return{
                statusVisible: false
            }
        },
        mounted() {
            document.addEventListener('click', this.hideSelect.bind(this), true);
        },
        beforeDestroy() {
            document.removeEventListener('click', this.hideSelect)
        },
        methods:{
            selectOption(option){
                this.$emit('select_option', option);
                this.statusVisible=false;
            },
            hideSelect(){
                this.statusVisible=false;
            }
        }

    }
</script>

<style >
    .v-select{
        position:relative;
        width: 200px;
        cursor: pointer;
    }


    .v-select .select-title{
        border: solid 1px;
    }

    .v-select p{
        margin: 0;
    }

    .v-select .current i{
        margin-left: 10px;
        color: red;
    }


    .options{
        border:solid 1px ;
        position: absolute;
        top: 30px;
        right: 0;
        width: 100%;
        background: #fff;
        border-radius: 5px;
        box-shadow: 0 0 0 1px rgba(68, 68, 68, 0.11);
        box-sizing: border-box;
        margin-top: 4px;
        z-index: 10;
    }
    .options .option{
        font-size: 14px;
        line-height: 35px;
        min-height: 35px;
        border-bottom: 1px solid #eee;
        padding: 2px 20px;
    }
    .options p:hover{
        background: #e7e7e7;
    }
</style>
