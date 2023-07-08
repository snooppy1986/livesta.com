<link rel="stylesheet" href="{{asset('css/style.min.css')}}">

<div class="modal-content">
    <div class="modal-body">
        <div class="product-quick-view-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal">

            </button>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <!--== Start Product Thumbnail Area ==-->
                        <div class="product-single-thumb">
                            <img src="{{asset("storage/images/$product->image")}}" width="544" height="560" alt="Image-HasTech">
                        </div>
                        <!--== End Product Thumbnail Area ==-->
                    </div>
                    <div class="col-lg-6">
                        <!--== Start Product Info Area ==-->
                        <div class="product-details-content">
                            {{--<h5 class="product-details-collection">Premioum collection</h5>--}}
                            <h3 class="product-details-title">{{$product->title}}</h3>
                            <div class="product-details-review mb-5">
                                <div class="product-review-icon">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <button type="button" class="product-review-show">150 reviews</button>
                            </div>
                            <p class="mb-6">{{$product->content}}</p>
                            <div class="product-details-pro-qty">
                                <div class="pro-qty">
                                    <input type="text" title="Quantity" value="01">
                                    <div class="dec qty-btn">-</div><div class="inc qty-btn">+</div></div>
                            </div>
                            <div class="product-details-action">
                                <h4 class="price">{{$product->price_special}} &#8372</h4>
                                <div class="product-details-cart-wishlist">
                                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#action-CartAddModal">Add to cart</button>
                                </div>
                            </div>
                        </div>
                        <!--== End Product Info Area ==-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style >
    .product-quick-view-content .btn-close {
        background-color: #fff;
        box-shadow: none;
        border: 1px solid #c8c8c8;
        background-image: none;
        font-size: 22px;
        line-height: 1;
        border-radius: 0 0 60px 0;
        position: absolute;
        top: 0;
        left: 0;
        z-index: 2;
        width: 45px;
        height: 45px;
        text-align: left;
    }
    .product-quick-view-content .btn-close i {
        position: relative;
        top: -5px;
        left: 4px;
    }

    .product-quick-view-content .product-details-content {
         padding-left: 0;
    }
    .product-details-content .product-details-collection {
        color: #000;
        font-weight: 400;
        font-size: 16px;
        margin-bottom: 14px;
    }
    .swal2-close:focus{
        font-size: 2.5em;
        box-shadow: none;
        justify-self: start;
        width: 2.4em;
        position: relative;
        top: 5px;
    }
</style>


