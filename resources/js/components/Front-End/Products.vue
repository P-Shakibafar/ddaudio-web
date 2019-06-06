<template>
    <div class="row" style="display: contents">
        <div class="shop_sidebar_area">
            
            <!-- ##### Single Widget ##### -->
            <div class="widget catagory mb-50">
                <!-- Widget Title -->
                <h6 class="widget-title mb-30">Catagories</h6>
                
                <!--  Catagories  -->
                <div class="catagories-menu">
                    <ul>
                        <li>
                            <a @click="custome=!custome">All {{productName.replace('_',' ')}}</a>
                        </li>
                        <li v-for="serie in series">
                            <a @click="CustomizeProducts(serie.Name)">{{serie.Name}}</a>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!--&lt;!&ndash; ##### Single Widget ##### &ndash;&gt;-->
            <!--<div class="widget brands mb-50">-->
                <!--&lt;!&ndash; Widget Title &ndash;&gt;-->
                <!--<h6 class="widget-title mb-30">Brands</h6>-->
                <!---->
                <!--<div class="widget-desc">-->
                    <!--&lt;!&ndash; Single Form Check &ndash;&gt;-->
                    <!--<div class="form-check">-->
                        <!--<input class="form-check-input" type="checkbox" value="" id="amado">-->
                        <!--<label class="form-check-label" for="amado">Amado</label>-->
                    <!--</div>-->
                    <!--&lt;!&ndash; Single Form Check &ndash;&gt;-->
                    <!--<div class="form-check">-->
                        <!--<input class="form-check-input" type="checkbox" value="" id="ikea">-->
                        <!--<label class="form-check-label" for="ikea">Ikea</label>-->
                    <!--</div>-->
                    <!--&lt;!&ndash; Single Form Check &ndash;&gt;-->
                    <!--<div class="form-check">-->
                        <!--<input class="form-check-input" type="checkbox" value="" id="furniture">-->
                        <!--<label class="form-check-label" for="furniture">Furniture Inc</label>-->
                    <!--</div>-->
                    <!--&lt;!&ndash; Single Form Check &ndash;&gt;-->
                    <!--<div class="form-check">-->
                        <!--<input class="form-check-input" type="checkbox" value="" id="factory">-->
                        <!--<label class="form-check-label" for="factory">The factory</label>-->
                    <!--</div>-->
                    <!--&lt;!&ndash; Single Form Check &ndash;&gt;-->
                    <!--<div class="form-check">-->
                        <!--<input class="form-check-input" type="checkbox" value="" id="artdeco">-->
                        <!--<label class="form-check-label" for="artdeco">Artdeco</label>-->
                    <!--</div>-->
                <!--</div>-->
            <!--</div>-->
            <!---->
            <!--&lt;!&ndash; ##### Single Widget ##### &ndash;&gt;-->
            <!--<div class="widget color mb-50">-->
                <!--&lt;!&ndash; Widget Title &ndash;&gt;-->
                <!--<h6 class="widget-title mb-30">Color</h6>-->
                <!---->
                <!--<div class="widget-desc">-->
                    <!--<ul class="d-flex">-->
                        <!--<li><a href="#" class="color1"></a></li>-->
                        <!--<li><a href="#" class="color2"></a></li>-->
                        <!--<li><a href="#" class="color3"></a></li>-->
                        <!--<li><a href="#" class="color4"></a></li>-->
                        <!--<li><a href="#" class="color5"></a></li>-->
                        <!--<li><a href="#" class="color6"></a></li>-->
                        <!--<li><a href="#" class="color7"></a></li>-->
                        <!--<li><a href="#" class="color8"></a></li>-->
                    <!--</ul>-->
                <!--</div>-->
            <!--</div>-->
            <!---->
            <!--&lt;!&ndash;##### Single Widget ##### &ndash;&gt;-->
            <!--<div class="widget price mb-50">-->
                <!--&lt;!&ndash; Widget Title &ndash;&gt;-->
                <!--<h6 class="widget-title mb-30">Price</h6>-->
                <!---->
                <!--<div class="widget-desc">-->
                    <!--<div class="slider-range">-->
                        <!--<div data-min="10" data-max="1000" data-unit="$"-->
                             <!--class="slider-range-price ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"-->
                             <!--data-value-min="10" data-value-max="1000" data-label-result="">-->
                            <!--<div class="ui-slider-range ui-widget-header ui-corner-all"></div>-->
                            <!--<span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>-->
                            <!--<span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>-->
                        <!--</div>-->
                        <!--<div class="range-price">$10 - $1000</div>-->
                    <!--</div>-->
                <!--</div>-->
            <!--</div>-->
        </div>
        <div class="amado_product_area section-padding-100">
            
            <div class="container-fluid">
                
                <div class="row">
                    <div class="col-12">
                        <div class="product-topbar d-xl-flex align-items-end justify-content-between">
                            <!-- Total Products -->
                            <div class="total-products">
                                <p style="margin-bottom:0 ">Showing
                                    {{(perPage*(page-1)+1)}}-{{displayedProducts.length+(perPage*(page-1))}} Of
                                    {{products.length}}</p>
                            </div>
                            <!--Sorting-->
                            <!--<div class="product-sorting d-flex">-->
                            <!--<div class="sort-by-date d-flex align-items-center mr-15">-->
                            <!--<p>Sort by</p>-->
                            <!--<form action="#" method="get">-->
                            <!--<div class="nice-select" tabindex="0"><span class="current">Popular</span>-->
                            <!--<ul class="list">-->
                            <!--<li data-value="value" class="option">Date</li>-->
                            <!--<li data-value="value" class="option">Newest</li>-->
                            <!--<li data-value="value" class="option selected focus">Popular</li>-->
                            <!--</ul>-->
                            <!--</div>-->
                            <!--&lt;!&ndash;<select name="select" id="sortBydate">&ndash;&gt;-->
                            <!--&lt;!&ndash;<option value="value">Date</option>&ndash;&gt;-->
                            <!--&lt;!&ndash;<option value="value">Newest</option>&ndash;&gt;-->
                            <!--&lt;!&ndash;<option value="value">Popular</option>&ndash;&gt;-->
                            <!--&lt;!&ndash;</select>&ndash;&gt;-->
                            <!--</form>-->
                            <!--</div>-->
                            <!--<div class="view-product d-flex align-items-center">-->
                            <!--<p>View</p>-->
                            <!--<form action="#" method="get">-->
                            <!--&lt;!&ndash;<div class="nice-select" tabindex="0">&ndash;&gt;-->
                            <!--&lt;!&ndash;<span class="current">12</span>&ndash;&gt;-->
                            <!--&lt;!&ndash;<ul class="list" v-model="perPage">&ndash;&gt;-->
                            <!--&lt;!&ndash;<li data-value="value" class="option selected">12</li>&ndash;&gt;-->
                            <!--&lt;!&ndash;<li data-value="value" class="option">24</li>&ndash;&gt;-->
                            <!--&lt;!&ndash;<li data-value="value" class="option">48</li>&ndash;&gt;-->
                            <!--&lt;!&ndash;<li data-value="value" class="option">96</li>&ndash;&gt;-->
                            <!--&lt;!&ndash;</ul>&ndash;&gt;-->
                            <!--&lt;!&ndash;</div>&ndash;&gt;-->
                            <!--<select v-model="perPage" name="select" id="viewProduct">-->
                            <!--<option value="12">12</option>-->
                            <!--<option value="24">24</option>-->
                            <!--<option value="48">48</option>-->
                            <!--<option value="96">96</option>-->
                            <!--</select>-->
                            <!--</form>-->
                            <!--</div>-->
                            
                            <div class="search-content">
                                <input type="search" name="search" id="search" v-model="search"
                                       @keyup="searchit"
                                       placeholder="Type your keyword...">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row" style="padding-left: 15px;" v-if="!custome">
                <!-- Single Product Area -->
                <div class="col-6 col-sm-3 col-md-6 col-xl-3" v-for="product in displayedProducts">
                    <div class="single-product-wrapper">
                        <!-- Product Image -->
                        <div class="product-img">
                            <img :src="product.image" alt="">
                            <!-- Hover Thumb -->
                            <!--<img class="hover-img" :src="product.hover_image" alt="">-->
                        </div>
                        
                        <!-- Product Description -->
                        <div class="product-description d-flex align-items-center justify-content-between">
                            <!-- Product Meta Data -->
                            <div class="product-meta-data">
                                <div class="line"></div>
                                <p class="product-price">$180</p>
                                <router-link :to="'/products/'+productName+'/'+product.Name">
                                    <h6>{{product.Name}}</h6>
                                    <h6>{{product.series_name}}</h6>
                                </router-link>
                            </div>
                            <!-- Ratings & Cart -->
                            <!--<div class="ratings-cart text-right">-->
                                <!--<div class="cart">-->
                                    <!--<a href="cart.html" data-toggle="tooltip" data-placement="left"-->
                                       <!--title="Add to Cart"><img-->
                                        <!--src="img/core-img/cart.png" alt=""></a>-->
                                <!--</div>-->
                            <!--</div>-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="padding-left: 15px;" v-else>
                <!-- Single Product Area -->
                <div class="col-6 col-sm-3 col-md-6 col-xl-3" v-for="product in products"
                     v-if="product.series_name===seriesName">
                    <div class="single-product-wrapper">
                        <!-- Product Image -->
                        <div class="product-img">
                            <img :src="product.image" alt="">
                            <!-- Hover Thumb -->
                            <!--<img class="hover-img" :src="product.hover_image" alt="">-->
                        </div>
                        
                        <!-- Product Description -->
                        <div class="product-description d-flex align-items-center justify-content-between">
                            <!-- Product Meta Data -->
                            <div class="product-meta-data">
                                <div class="line"></div>
                                <p class="product-price">$180</p>
                                <router-link :to="'/products/'+productName+'/'+product.Name">
                                    <h6>{{product.Name}}</h6>
                                    <h6>{{product.series_name}}</h6>
                                </router-link>
                            </div>
                            <!-- Ratings & Cart -->
                            <div class="ratings-cart text-right">
                                <div class="cart">
                                    <a href="cart.html" data-toggle="tooltip" data-placement="left"
                                       title="Add to Cart"><img
                                        src="img/core-img/cart.png" alt=""></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row" v-if="!custome">
                <div class="col-12">
                    <!-- Pagination -->
                    <nav aria-label="navigation">
                        <ul class="pagination justify-content-end mt-50">
                            <li class="page-item" v-if="page !== 1" @click="page--"><a class="page-link"><i
                                class="fa fa-chevron-left"></i></a></li>
                            <li :class="{'page-item':true ,'active':(pageNumber===1)}" v-for="pageNumber in pages"
                                @click="page = pageNumber"><a class="page-link">{{pageNumber}}</a>
                            </li>
                            <li @click="page++" v-if="page < pages.length" class="page-item"><a class="page-link"><i
                                class="fa fa-chevron-right"></i></a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import _ from 'lodash';
    
    export default {
        name: "product",
        props: {
            productName: String,
        },
        data() {
            return {
                products: {},
                series: [],
                page: 1,
                perPage: 12,
                pages: [],
                custome: false,
                seriesName: '',
                search: ''
            }
        },
        methods: {
            loadProducts() {
                if ((this.productName === 'Subwoofers' || this.productName === 'Enclosures')) {
                    this.$http.get("api/v1/indexOfSubSeries/" + this.productName)
                        .then(({data}) => (this.products = data));
                } else {
                    this.$http.get('api/v1/' + this.productName)
                        .then(({data}) => (this.products = data));
                }
            },
            setPages() {
                this.pages = [];
                let numberOfPages = Math.ceil(this.products.length / this.perPage);
                for (let index = 1; index <= numberOfPages; index++) {
                    this.pages.push(index);
                }
            },
            paginate(products) {
                let page = this.page;
                let perPage = this.perPage;
                let from = (page * perPage) - perPage;
                let to = (page * perPage);
                return products.slice(from, to);
            },
            loadSeries() {
                this.$http.get("api/v1/indexOfSeries/" + this.productName)
                    .then(({data}) => (this.series = data));
            },
            CustomizeProducts(seriesName) {
                this.seriesName = seriesName;
                this.custome = true;
            },
            searchit: _.debounce(() => {
                Fire.$emit('searching');
            }, 1000),
        },
        watch: {
            products() {
                this.setPages();
            }
        },
        computed: {
            displayedProducts() {
                return this.paginate(this.products);
            }
        },
        updated() {
            $("nav>ul.pagination>li.page-item>a.page-link").click(function () {
                $("nav>ul>li.active").removeClass("active");
                $(this.parentNode).addClass("active");
            });
            console.log(this.$route);
        },
        created() {
            Fire.$on('searching', () => {
                let query = this.search;
                if ((this.productName === 'Subwoofers' || this.productName === 'Enclosures')) {
                    this.$http.get('api/v1/find/' + this.productName + '?q=' + query)
                        .then(({data}) => (this.products = data))
                        .catch();
                } else {
                    this.$http.get('api/v1/find' + this.productName + '?q=' + query)
                        .then(({data}) => (this.products = data))
                        .catch();
                }
            });
            this.loadProducts();
            this.loadSeries();
            console.log(this.productName + ' Products Created.')
        }
    }
</script>

<style scoped>
    li > a {
        cursor : pointer;
    }
</style>
