<template>
    <div style="width: 245px">
        <!-- Mobile Nav (max width 767px)-->
        <div class="mobile-nav">
            <!-- Navbar Brand -->
            <div class="amado-navbar-brand">
                <router-link to="/">
                    <img style="width: 50px;" :src="'../../images/dd_logo.png'" alt="">
                </router-link>
            </div>
            <!-- Navbar Toggler -->
            <div class="amado-navbar-toggler">
                <span></span><span></span><span></span>
            </div>
        </div>
        
        <!-- Header Area Start -->
        <header class="header-area clearfix" style="padding: 60px 40px">
            <!-- Close Icon -->
            <div class="nav-close">
                <i class="fa fa-close" aria-hidden="true"></i>
            </div>
            <!-- Logo -->
            <div class="logo">
                <router-link to="/">
                    <img style="width: 137px" :src="'../../images/dd_logo.png'" alt="">
                </router-link>
            </div>
            <!-- Amado Nav -->
            <nav class="amado-nav">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item active">
                        <router-link class="nav-link" to="/home">
                            Home
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/products/Amplifiers">
                            Amplifiers
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/products/Enclosures">
                            Enclosures
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/products/Signal_Processors">
                            Signal Processors
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/products/Speakers">
                            Speakers
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/products/Subwoofers">
                            Subwoofers
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/Gallery">
                            Gallery
                        </router-link>
                    </li>
                </ul>
            </nav>
            <!-- Cart Menu -->
            <div class="cart-fav-search mb-100">
            </div>
            <!-- Social Button -->
            <div class="social-info d-flex justify-content-between" style="width: 150px">
                <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
            </div>
        </header>
        <!-- Header Area End -->
    </div>

</template>

<script>
    export default {
        name: "Header",
    }
</script>

<style scoped>
    div.logo {
        margin-bottom : 40px !important;
    }
</style>
