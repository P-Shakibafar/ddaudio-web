<template>
    <div class="wrapper" id="app">
        <!-- Search Wrapper Area Start -->
        <!--<div class="search-wrapper section-padding-100">-->
        <!--<div class="search-close">-->
        <!--<i class="fa fa-close" aria-hidden="true"></i>-->
        <!--</div>-->
        <!--<div class="container">-->
        <!--<div class="row">-->
        <!--<div class="col-12">-->
        <!--<div class="search-content">-->
        <!--<input type="search" name="search" id="search" v-model="search" @keyup.enter="searchit()"-->
        <!--placeholder="Type your keyword...">-->
        <!--</div>-->
        <!--</div>-->
        <!--</div>-->
        <!--</div>-->
        <!--</div>-->
        <!-- Search Wrapper Area End -->
        
        <!-- ##### Main Content Wrapper Start ##### -->
        <div class="main-content-wrapper d-flex clearfix">
            <!-- ##### Header Area Start ##### -->
            <app-header></app-header>
            <!-- ##### Header Area End ##### -->
            
            <router-view></router-view>
        </div>
        <!-- ##### Main Content Wrapper End ##### -->
        
        <!-- ##### Footer Area Start ##### -->
        <app-footer></app-footer>
        <!-- ##### Footer Area End ##### -->
    </div>
</template>

<script>
    import Header from './Header';
    import Footer from './Footer';
    
    export default {
        name: "App",
        components: {
            'app-header': Header,
            'app-footer': Footer,
        },
    }

</script>

<style scoped>

</style>
