<template>
    <!-- Product Details Area Start -->
    <div class="single-product-area section-padding-100 clearfix">
        <div class="container-fluid">
            
            <div class="row">
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mt-50">
                            <!--<li class="breadcrumb-item"><a href="#">Home</a></li>-->
                            <li class="breadcrumb-item">
                                <router-link :to="'/products/'+categoryName"
                                             v-text="categoryName.replace('_',' ')"></router-link>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page" v-text="productName"></li>
                        </ol>
                    </nav>
                </div>
            </div>
            
            <div class="row">
                <div class="col-12 col-lg-7">
                    <div class="single_product_thumb">
                        <div id="product_details_slider" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li class="active" v-if="product.Images[0]" data-target="#product_ details_slider"
                                    data-slide-to="0"
                                    :style="{ 'background-image': 'url(' + product.Images[0].Path + ')' }">
                                </li>
                                <li data-target="#product_details_slider" v-if="product.Images[1]" data-slide-to="1"
                                    :style="{ 'background-image': 'url(' + product.Images[1].Path + ')' }">
                                </li>
                                <li data-target="#product_details_slider" v-if="product.Images[2]" data-slide-to="2"
                                    :style="{ 'background-image': 'url(' + product.Images[2].Path + ')' }">
                                </li>
                                <li data-target="#product_details_slider" v-if="product.Images[3]" data-slide-to="3"
                                    :style="{ 'background-image': 'url(' + product.Images[3].Path + ')' }">
                                </li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active" v-if="product.Images[0]">
                                    <a class="gallery_img" :href="product.Images[0].Path">
                                        <img class="d-block w-100" :src="product.Images[0].Path"
                                             :alt="product.Images[0].Name.replace('.png','')">
                                    </a>
                                </div>
                                <div class="carousel-item" v-if="product.Images[1]">
                                    <a class="gallery_img" :href="product.Images[1].Path">
                                        <img class="d-block w-100" :src="product.Images[1].Path"
                                             :alt="product.Images[1].Name.replace('.png','')">
                                    </a>
                                </div>
                                <div class="carousel-item" v-if="product.Images[2]">
                                    <a class="gallery_img" :href="product.Images[2].Path">
                                        <img class="d-block w-100" :src="product.Images[2].Path"
                                             :alt="product.Images[2].Name.replace('.png','')">
                                    </a>
                                </div>
                                <div class="carousel-item" v-if="product.Images[3]">
                                    <a class="gallery_img" :href="product.Images[3].Path">
                                        <img class="d-block w-100" :src="product.Images[3].Path"
                                             :alt="product.Images[3].Name.replace('.png','')">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-5">
                    <div class="single_product_desc">
                        <!-- Product Meta Data -->
                        <div class="product-meta-data">
                            <div class="line"></div>
                            <p class="product-price">$180</p>
                            <a href="product-details.html">
                                <h6 v-text="product.Name"></h6>
                            </a>
                            <!-- Ratings & Review -->
                            <div class="ratings-review mb-15 d-flex align-items-center justify-content-between">
                                <!--<div class="ratings">-->
                                <!--<i class="fa fa-star" aria-hidden="true"></i>-->
                                <!--<i class="fa fa-star" aria-hidden="true"></i>-->
                                <!--<i class="fa fa-star" aria-hidden="true"></i>-->
                                <!--<i class="fa fa-star" aria-hidden="true"></i>-->
                                <!--<i class="fa fa-star" aria-hidden="true"></i>-->
                                <!--</div>-->
                                <div class="review">
                                    <a href="#" v-text="product.Title"></a>
                                </div>
                            </div>
                            <!-- Avaiable -->
                            <p class="avaibilit"><i class="fa fa-circle"></i> In Stock</p>
                        </div>
                        
                        <div class="short_overview my-5">
                            <p v-text="product.Description"></p>
                        </div>
                        
                        <!-- Add to Cart Form -->
                        <form class="cart clearfix" method="post">
                            <div class="cart-btn d-flex mb-50">
                                <p>Qty</p>
                                <div class="quantity">
									<span class="qty-minus"
                                          onclick="let effect = document.getElementById('qty'); let qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;"><i
                                        class="fa fa-caret-down" aria-hidden="true"></i></span>
                                    <input type="number" class="qty-text" id="qty" step="1" min="1" max="300"
                                           name="quantity" value="1">
                                    <span class="qty-plus"
                                          onclick="let effect = document.getElementById('qty'); let qty = effect.value; if( !isNaN( qty )) effect.value++;return false;"><i
                                        class="fa fa-caret-up" aria-hidden="true"></i></span>
                                </div>
                            </div>
                            <button type="submit" name="addtocart" value="5" class="btn amado-btn">Add to cart</button>
                        </form>
                    
                    </div>
                </div>
            </div>
            
            <div class="cart-table-area section-padding-100" style="width: auto;">
                <div class="container-fluid">
                    <div class="col-12 col-lg-12">
                        <div class="row ">
                            <div class="cart-table clearfix" style="margin: 0 auto;width: 630px">
                                <table class="table table-responsive"
                                       style="overflow: hidden; outline: currentcolor none medium;"
                                       tabindex="1">
                                    <thead>
                                    <tr>
                                        <th style="margin: auto;text-align: center">Specs</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(index,val) in product"
                                        v-if="(val!=='Name')&&(val!=='Title')&&(val!=='Description')&&(val!=='Images')&&(val!=='Sub_Speaker')&&(index!==null)">
                                        <td class="cart_product_desc">
                                            <h5 v-text="val"></h5>
                                        </td>
                                        <td class="price text-secondary">
                                            <span v-text="index"></span>
                                        </td>
                                    </tr>
                                    <tr v-for="(key,value) in product.Sub_Speaker" v-if="key!==null">
                                        <td class="cart_product_desc">
                                            <h5 v-text="value"></h5>
                                        </td>
                                        <td class="price text-secondary">
                                            <span v-text="key"></span>
                                        </td>
                                    </tr>
                                    </tbody>
                                    <!--<tbody>-->
                                    <!--<tr v-for="(key,value) in product.href.Enclosures">-->
                                    <!--<td class="cart_product_desc">-->
                                    <!--<h5>{{value}}</h5>-->
                                    <!--</td>-->
                                    <!--<td class="price text-secondary">-->
                                    <!--<span>{{key}}</span>-->
                                    <!--</td>-->
                                    <!--</tr>-->
                                    <!--</tbody>-->
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Product Details Area End -->
</template>

<script>
    export default {
        name: "ProductDetails",
        data() {
            return {
                product: {},
                categoryName: this.$route.params.categoryName,
                productName: this.$route.params.productName,
            }
        },
        methods: {
            loadProduct() {
                if (!(this.categoryName === 'Subwoofers' || this.categoryName === 'Enclosures')) {
                    this.$http.get('api/v1/' + this.categoryName + '/' + this.productName)
                        .then(
                            ({data}) => (this.product = data.data)
                        );
                } else {
                    this.$http.get("api/v1/SubSeries/" + this.productName)
                        .then(({data}) => (this.product = data.data));
                }
            },
        },
        created() {
            this.loadProduct();
            console.log('Product Details Created.')
        }
    }
</script>

<style scoped>

</style>
