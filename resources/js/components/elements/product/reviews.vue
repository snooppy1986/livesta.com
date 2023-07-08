<template>
    <div class="tab-pane fade show active" id="review" role="tabpanel" aria-labelledby="review-tab">
        <!--== Start Reviews Content Item ==-->
        <div v-for="review in reviews" class="product-review-item">
            <div class="product-review-top">
                <div class="product-review-thumb ">
                    <img src="/images/user_avatar.jpg" alt="Images" width="60">
                </div>
                <div class="product-review-content text-capitalize">
                    <span class="product-review-name">{{review.name_surname}}</span>
                </div>
                <div class="product-review-content review-date">
                    <span class="product-review-name">{{moment(review.created_at).format("D-MM-Y H:mm:ss") }}</span>
                </div>
            </div>
            <p class="desc">{{review.message}}</p>
            <div class="product-review-icon">
                <StarRating
                    inactive-color="#fff"
                    border-color="#ff6565"
                    active-color="#ff6565"
                    v-bind:border-width=1
                    aria-valuenow=3
                    v-bind:star-size=18
                    v-bind:read-only="true"
                    v-bind:round-start-rating="false"
                    v-model:rating="review.rating"
                ></StarRating>
            </div>
        </div>
        <!--== End Reviews Content Item ==-->


    </div>
</template>

<script>
    import StarRating from 'vue-star-rating';
    import moment from  'moment/src/moment';
    export default {
        name: "reviews",
        props:['reviews'],
        components:{
            StarRating,
            moment,
        },
        data: () => ({
            moment: moment,
        }),
        methods:{

        }
    }
</script>

<style >
    .product-review-top .review-date{
        margin-left: auto;
    }
</style>
