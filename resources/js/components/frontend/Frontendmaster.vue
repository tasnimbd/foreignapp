<template>
    <div>
        <!-- Mobile Menu -->
        <div class="mobile-nav-wrapper">
        <div class="mobile-menu-inner">
            <ul class="mobile-menu">
              <li v-for="(cat, i) in categories" :key="i">
                <router-link :to="`/category/${cat.cat_slug}`">{{cat.cat_name}}</router-link>
              </li>
            </ul>
        </div>
        </div>
        <div class="mobile-menu-overlay"></div>

        <section class="above-header">
        <div class="container">
            <div class="row">
            <div class="col-lg-4 align-self-center">
                <ul class="social-icons">
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                <li><a href="#"><i class="fa fa-behance"></i></a></li>
                </ul>
            </div>
            <div class="col-lg-4 align-self-center">
                <div class="logo">
                <router-link to="/"><img style="width:25%!important;" src="frontend/images/logo.png" alt=""></router-link>
                </div>
            </div>
            <div class="col-lg-4 align-self-center">
                <ul class="search-item">
                <li class="menu-item menu-search">
                    <a href="#search" id="menu-search-btn">
                    <i class="icon_search"></i>
                    </a>
                </li>
                </ul>
            </div>
            </div>
        </div>
        </section>

        <!-- Header -->
        <header class="site-header fixed-header">
        <div class="container expanded">
            <div class="header-wrap">
            <div class="header-logo">
                <router-link to="/"><img src="frontend/images/logo.png" alt=""></router-link>
            </div>
            <div class="header-nav">
                <ul class="main-menu">
                    <li class="menu-item-has-children" v-for="(cat, i) in categories" :key="i">
                        <router-link :to="`/category/${cat.cat_slug}`">{{cat.cat_name}}</router-link>
                    </li>
                    
                </ul>    
            </div>
            <div class="header-widgets">
                <ul class="right-menu">
                <li class="menu-item menu-mobile-nav">
                    <a href="#" class="menu-bar" id="menu-show-mobile-nav">
                    <span class="hamburger"></span>
                    </a>
                </li>
                </ul>
            </div>
            </div>
        </div>
        </header>
        <!-- /Header -->

        <!-- change class -->
        <div class="change-class"></div>

        <div id="search">
        <button type="button" class="close">×</button>
            <form>
                <input type="search" value="" placeholder="Search..." />
                <button type="submit" class="primary-button"><i class="icon_search"></i></button>
            </form>
        </div>
        
        <!---end header section--->
        <router-view></router-view>

        <!----start footer section--->
        <div class="instagram-footer">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="instagram-account">
              <div class="widget-content">
                <div class="widget-header">
                  <h4><a href="#">@shareenBlog</a></h4>
                </div>
                <div class="row">
                  <div class="col-lg-3">
                    <div class="instagram-item">
                      <img src="http://placehold.it/255x220" alt="">
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="instagram-item">
                      <img src="http://placehold.it/255x220" alt="">
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="instagram-item">
                      <img src="http://placehold.it/255x220" alt="">
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="instagram-item">
                      <img src="http://placehold.it/255x220" alt="">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <footer>
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <ul class="footer-social-icons">
              <li><a href="#"><i class="fa fa-facebook"></i> Facebook</a></li>
              <li><a href="#"><i class="fa fa-twitter"></i> Twitter</a></li>
              <li><a href="#"><i class="fa fa-behance"></i> Behance</a></li>
              <li><a href="#"><i class="fa fa-linkedin"></i> Linkedin</a></li>
              <li><a href="#"><i class="fa fa-dribbble"></i> Dribbble</a></li>
            </ul>
          </div>
          <div class="col-lg-12">
            <div class="copyright-text">
              <p>all rights reserved. <a href="#">robert imeri</a> 2020.</p>
            </div>
          </div>
        </div>
      </div>
    </footer>

    <a href="#" class="go-top"><i class="fa fa-angle-up"></i></a>
    </div>
</template>

<script>
export default {
  data(){
    return {
      categories: []
    }
  },
  methods:{
    loadCategories(){
        axios.get('pubgetcategory')
        .then(({data}) => (this.categories = data))
    }

  },

  created(){
      this.loadCategories()
  }




}
</script>

<style scoped>
footer {
    background-color: #1e1e1e;
    position: relative;
    z-index: 1;
    border-top: 3px solid #f7f7f7;
    margin-top: -153px!important;
    padding-top: 213px!important;
}
</style>