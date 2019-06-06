<template>
    <div class="single-product-area section-padding-100 clearfix" :style="'height: '+ height +'px'">
        
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-lg-8 m-auto">
                    <div class="single_product_thumb">
                        <div id="product_details_slider" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators" v-for="(value,index) in chunkedItems"
                                :style="'margin-bottom: '+ margin * index + 'px'">
                                <li class="" v-if="val" data-target="#product_ details_slider"
                                    :data-slide-to="key + ( index * 6 ) "
                                    :style="{ 'background-image': 'url(' + val.Path + ')'}" v-for="(val,key) in value">
                                </li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item" v-if="image" v-for="image in images">
                                    <a class="gallery_img" :href="image.Path">
                                        <img class="d-block w-100" :src="image.Path"
                                             :alt="image.Name.replace('.png','')">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Gallery",
        data() {
            return {
                images: {},
            }
        },
        methods: {
            loadGallery() {
                axios.get('api/v1/AllImages')
                    .then(({data}) => (this.images = data));
            },
        },
        computed: {
            chunkedItems() {
                return _.chunk(_.toArray(this.images), 6);
            },
            margin() {
                return (-142);
            },
            height() {
                return (this.chunkedItems.length * 142) + 760;
            }
        },
        updated() {
            $(function () {
                $('div.carousel-inner>div.carousel-item').first().addClass('active');
                $("ol.carousel-indicators>li").click(function () {
                    $("li.active").removeClass("active");
                    $(this).addClass("active");
                    // $('div.carousel-inner>div.carousel-item').addClass("active");
                });
            });
        },
        created() {
            this.loadGallery();
        }
    }
</script>

<style scoped>
    ol.carousel-indicators>li{
        height : 140px !important;
    }
</style>
