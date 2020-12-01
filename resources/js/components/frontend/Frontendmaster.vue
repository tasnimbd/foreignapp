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
                <div class="logo">
                <router-link to="/"><img style="width:25%!important;" src="frontend/images/logo.png" alt=""></router-link>
                </div>
            </div>
            <!--<div class="col-lg-4 align-self-center">
                <ul class="social-icons">
                  <li><a href="https://www.facebook.com/sfconsultingbd/" target="_blank"><i class="fa fa-facebook"></i></a></li>
                  <li><a href="https://twitter.com/sfconsultingbd" target="_blank"><i class="fa fa-twitter"></i></a></li>
                  <li><a href="https://www.linkedin.com/company/s-&-f-consulting-firm-limited/" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                  <li><a href="https://www.instagram.com/sfconsultingfirm/" target="_blank"><i class="fa fa-instagram"></i></a></li>
                  <li><a href="https://www.pinterest.com/sfconsultingbd/" target="_blank"><i class="fa fa-pinterest"></i></a></li>
                  <li><a href="https://www.youtube.com/user/companyregistration1/" target="_blank"><i class="fa fa-youtube"></i></a></li>
                </ul>
            </div>--->
            <div class="col-lg-8 align-self-center">
                <img src="https://tpc.googlesyndication.com/simgad/10584050030605284207?sqp=4sqPyQQrQikqJwhfEAEdAAC0QiABKAEwCTgDQPCTCUgAUAFYAWBfcAJ4AcUBLbKdPg&rs=AOga4qm4soO1QWXZhgQXyndSG_Kj5M2W5A"/>
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
        
        <!---end header section--->
        <!--<router-view></router-view>-->
        <router-view :key="$route.fullPath"></router-view>
        
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
import _ from 'lodash'
export default {
  data(){
    return {
      categories: [],
      search:'',
      //posts:[]
    }
  },
  methods:{
    loadCategories(){
        axios.get('pubgetcategory')
        .then(({data}) => (this.categories = data))
    },
    searchit:_.debounce(function () {
      let query = this.search
      axios.get('search?q='+ query)
      .then((data) => {
        this.posts = data.data
      })
      .catch(() => {
        
      })
    },1000)

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

.main-menu>li+li {
    margin-left: 38px!important;
}
.main-menu>li>a{
    font-size: 15px!important;
    text-transform: capitalize!important;
}
.search_input{
  height: 60px;
  color: #1e1e1e;
  background: rgba(0, 0, 0, 0);
  padding: 15px;
  font-weight: 500;
  border-top: none;
  border-left: none;
  border-right: none;
  border-bottom: 1px solid #ffffff;
  text-align: center;
  outline: none;
}

</style>