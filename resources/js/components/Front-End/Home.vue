<template>
    <!-- Product Catagories Area Start -->
    <div class="single-product-area pt-3 clearfix">
        
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-lg-12">
                    <div class="single_product_thumb mb-0">
                        <div id="product_details_slider" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators mb-2" style="bottom: 0px">
                                <li class="active" v-if="images.data[0]" data-target="#product_ details_slider"
                                    data-slide-to="0"
                                    :style="{ 'background-image': 'url(' + images.data[0].Path + ')' }">
                                </li>
                                <li data-target="#product_details_slider" v-if="images.data[1]" data-slide-to="1"
                                    :style="{ 'background-image': 'url(' + images.data[1].Path + ')' }">
                                </li>
                                <li data-target="#product_details_slider" v-if="images.data[2]" data-slide-to="2"
                                    :style="{ 'background-image': 'url(' + images.data[2].Path + ')' }">
                                </li>
                                <li data-target="#product_details_slider" v-if="images.data[3]" data-slide-to="3"
                                    :style="{ 'background-image': 'url(' + images.data[3].Path + ')' }">
                                </li>
                                <li data-target="#product_details_slider" v-if="images.data[4]" data-slide-to="4"
                                    :style="{ 'background-image': 'url(' + images.data[4].Path + ')' }">
                                </li>
                                <li data-target="#product_details_slider" v-if="images.data[5]" data-slide-to="5"
                                    :style="{ 'background-image': 'url(' + images.data[5].Path + ')' }">
                                </li>
                                <li data-target="#product_details_slider" v-if="images.data[6]" data-slide-to="6"
                                    :style="{ 'background-image': 'url(' + images.data[6].Path + ')' }">
                                </li>
                                <li data-target="#product_details_slider" v-if="images.data[7]" data-slide-to="7"
                                    :style="{ 'background-image': 'url(' + images.data[7].Path + ')' }">
                                </li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active" v-if="images.data[0]">
                                    <a class="gallery_img" :href="images.data[0].Path">
                                        <img class="d-block " :src="images.data[0].Path"
                                             :alt="images.data[0].Name.replace('.png','')">
                                    </a>
                                </div>
                                <div class="carousel-item" v-if="images.data[1]">
                                    <a class="gallery_img" :href="images.data[1].Path">
                                        <img class="d-block " :src="images.data[1].Path"
                                             :alt="images.data[1].Name.replace('.png','')">
                                    </a>
                                </div>
                                <div class="carousel-item" v-if="images.data[2]">
                                    <a class="gallery_img" :href="images.data[2].Path">
                                        <img class="d-block " :src="images.data[2].Path"
                                             :alt="images.data[2].Name.replace('.png','')">
                                    </a>
                                </div>
                                <div class="carousel-item" v-if="images.data[3]">
                                    <a class="gallery_img" :href="images.data[3].Path">
                                        <img class="d-block " :src="images.data[3].Path"
                                             :alt="images.data[3].Name.replace('.png','')">
                                    </a>
                                </div>
                                <div class="carousel-item" v-if="images.data[4]">
                                    <a class="gallery_img" :href="images.data[4].Path">
                                        <img class="d-block " :src="images.data[4].Path"
                                             :alt="images.data[4].Name.replace('.png','')">
                                    </a>
                                </div>
                                <div class="carousel-item" v-if="images.data[5]">
                                    <a class="gallery_img" :href="images.data[5].Path">
                                        <img class="d-block " :src="images.data[5].Path"
                                             :alt="images.data[5].Name.replace('.png','')">
                                    </a>
                                </div>
                                <div class="carousel-item" v-if="images.data[6]">
                                    <a class="gallery_img" :href="images.data[6].Path">
                                        <img class="d-block " :src="images.data[6].Path"
                                             :alt="images.data[6].Name.replace('.png','')">
                                    </a>
                                </div>
                                <div class="carousel-item" v-if="images.data[7]">
                                    <a class="gallery_img" :href="images.data[7].Path">
                                        <img class="d-block " :src="images.data[7].Path"
                                             :alt="images.data[7].Name.replace('.png','')">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
            </div>
        </div>
        <hr>
        <div class="amado-pro-catagory clearfix" style="position: relative; height: 555px;">
            <div class="single-products-catagory clearfix" style="position: absolute; left: 0%; top: 0px;">
                <product-header :data="images.data[0]"></product-header>
            </div>
            <div class="single-products-catagory clearfix" style="position: absolute; left: 25%; top: 40px;">
                <product-header :data="images.data[1]"></product-header>
            </div>
            <div class="single-products-catagory clearfix" style="position: absolute; left: 50%; top: 0px;">
                <product-header :data="images.data[2]"></product-header>
            </div>
            <div class="single-products-catagory clearfix" style="position: absolute; left: 75%; top: 40px;">
                <product-header :data="images.data[3]"></product-header>
            </div>
            <div class="single-products-catagory clearfix" style="position: absolute; left: 0%; top: 276px;">
                <product-header :data="images.data[4]"></product-header>
            </div>
            <div class="single-products-catagory clearfix" style="position: absolute; left: 25%; top: 316px;">
                <product-header :data="images.data[5]"></product-header>
            </div>
        
            <div class="single-products-catagory clearfix" style="position: absolute; left: 50%; top: 276px;">
                <product-header :data="images.data[6]"></product-header>
            </div>
            <div class="single-products-catagory clearfix"
                 style="position: absolute; left: 75%;       top: 316px;">
                <product-header :data="images.data[7]"></product-header>
            </div>
            <!--<div class="single-products-catagory clearfix"-->
                 <!--style="position: absolute; left: 0%;       top: 552px;">-->
                <!--<product-header :data="images.data[8]"></product-header>-->
            <!--</div>-->
            <!--<div class="single-products-catagory clearfix" style="position: absolute; left: 25%; top: 592px;">-->
                <!--<product-header :data="images.data[9]"></product-header>-->
            <!--</div>-->
            <!--<div class="single-products-catagory clearfix" style="position: absolute; left: 50%; top: 552px;">-->
                <!--<product-header :data="images.data[10]"></product-header>-->
            <!--</div>-->
            <!--<div class="single-products-catagory clearfix" style="position: absolute; left: 75%; top: 592px;">-->
                <!--<product-header :data="images.data[11]"></product-header>-->
            <!--</div>-->
            <!--<div class="single-products-catagory clearfix"-->
                 <!--style="position: absolute; left: 0%;       top: 804px;">-->
                <!--<product-header :data="images.data[12]"></product-header>-->
            <!--</div>-->
        <!---->
            <!--<div class="single-products-catagory clearfix" style="position: absolute; left: 25%; top: 868px;">-->
                <!--<product-header :data="images.data[13]"></product-header>-->
            <!--</div>-->
            <!--<div class="single-products-catagory clearfix" style="position: absolute; left: 50%; top: 804px;">-->
                <!--<product-header :data="images.data[14]"></product-header>-->
            <!--</div>-->
            <!--<div class="single-products-catagory clearfix"-->
                 <!--style="position: absolute; left: 75%;       top: 868px;">-->
                <!--<product-header :data="images.data[15]"></product-header>-->
            <!--</div>-->
        
        
            <!--//33.3012% (2-3-3)-->
            <!--//66.6023% (3-1-1)-->
            <!--//0% (1-2-2)-->
        </div>
        <hr>
    </div>
    <!-- Product Catagories Area End -->
</template>

<script>
    import ProductHeader from './product-header';
    
    export default {
        name: "home",
        data() {
            return {
                images: {},
            }
        },
        components: {ProductHeader},
        methods: {
            loadGallery() {
                axios.get('api/v1/Images')
                    .then(({data}) => (this.images = data));
            },
        },
        created() {
            this.loadGallery();
        }
    }
</script>
<style scoped>
    .single-products-catagory {
        width : 25%;
    }
    img.d-block{
        height: 500px;
        margin-left: auto;
        margin-right: auto;
        display: block;
    }
    ol.carousel-indicators{
        width: 25%;
        margin-left: auto !important;
        margin-right: auto !important;
    }
</style>
