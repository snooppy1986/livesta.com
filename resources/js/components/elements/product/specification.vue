<template>
    <div class="tab-pane" id="specification" role="tabpanel" aria-labelledby="specification-tab">
        <ul class="product-details-info-wrap">
            <li v-if="brand">
                <span>Бренд</span>
                <p class="content">{{brand.title}}</p>
            </li>
            <li v-if="attributes">
                <span>Вага</span>
                <p class="content">{{attributes.weight}}</p>
            </li>
            <li v-if="attributes">
                <span>Країна</span>
                <p class="content">{{attributes.country}}</p>
            </li>
            <li v-if="attributes">
                <span>Застосування</span>
                <p class="content">{{attributes.application}}</p>
            </li>
            <li v-if="attributes">
                <span>Застереження</span>
                <p class="content">{{attributes.warning}}</p>
            </li>
            <li v-if="attributes">
                <span>Склад</span>
                <p class="content">{{attributes.composition}}</p>
            </li>
            <li v-if="attributes">
                <span>Стать</span>
                <p class="content">{{attributes.gender}}</p>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        name: "specification",
        props:['attributes', 'brand']
    }
</script>

<style>
    .product-details-info-wrap li{
        display: flex;
        align-items: flex-start;
    }
    .product-details-info-wrap li span{
        display: flex;
        margin-right: 50px;
    }
    .product-details-info-wrap li .content{
        font-weight: 400;
        font-size: 14px;
        line-height: 22px;
        color: #21242D;
    }
</style>
