<template>
        <div class="col-lg-4">
            <div class="main-sidebar right-sidebar">
            <div class="row">
                <div class="col-lg-12">
                <div class="widget-sidebar about-me">
                    <div class="widget-header">
                    <h4>Search</h4>
                    </div>
                    <div class="widget-content">
                        <form class="form-search">
                        <input @keyup="RealSearch" placeholder="Type something" v-model="keyword" type="text" class="input-medium search-query">
                        <button type="submit" @click.prevent="RealSearch" class="btn btn-square btn-theme">Search</button>
                        </form>
                    </div>
                </div>
                </div>
                <div class="col-lg-12">
                <div class="widget-sidebar about-me">
                    <div class="widget-header">
                    <h4>About Us</h4>
                    </div>
                    <div class="widget-content">
                    <img src="/img/aboutus.jpg" alt="">
                    <p style="text-align:left;">Foreign Company Registration is one of the world leading consulting firm. We have started our journey in 2012. Since then, we are providing various quality business services which include Company registration for foreign investors, Accounting, Income Tax, Free Business Advisory etc.</p>
                    <div style="box-shadow:1px 1px 3px #ddd;background:#ddd;" class="normal-white-button">
                        <router-link :to="{ name: 'page', params: { slug: 'about-us' }}">Read More</router-link>
                    </div>
                    <ul class="social-icons">
                        <li><a href="https://www.facebook.com/sfconsultingbd/" target="_blank"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="https://twitter.com/sfconsultingbd" target="_blank"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="https://www.linkedin.com/company/s-&-f-consulting-firm-limited/" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="https://www.instagram.com/sfconsultingfirm/" target="_blank"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="https://www.pinterest.com/sfconsultingbd/" target="_blank"><i class="fa fa-pinterest"></i></a></li>
                        <li><a href="https://www.youtube.com/user/companyregistration1/" target="_blank"><i class="fa fa-youtube"></i></a></li>
                    </ul>
                    </div>
                </div>
                </div>
                
                <div class="col-lg-12">
                <div class="widget-sidebar latest-posts">
                    <div class="widget-header">
                    <h4>Latest Posts</h4>
                    </div>
                    <div class="widget-content">
                    <ul class="latest-post-list" v-for="(lpost, i) in latestpost" :key="i">
                        <li v-if="i<5">
                         <router-link :to="`/blog/${lpost.slug}`">
                            <div class="left-image">
                            <img style="width:80px;height:80px;" :src="lpost.feature_photo" alt="">
                            <span>9</span>
                            </div>
                            <div class="right-content">
                            <h6>{{lpost.title}}</h6>
                            <span>{{lpost.created_at | myFullDate}}</span>
                            </div>
                         </router-link>
                        </li>
                        
                    </ul>
                    </div>
                </div>
                </div>
                <div class="col-lg-12">
                <div class="widget-sidebar categories">
                    <div class="widget-header">
                    <h4>Categories</h4>
                    </div>
                    <div class="widget-content">
                    <ul class="categories">
                        <li v-for="(cat, i) in categorieswithcount" :key="i">
                            <router-link :to="`/category/${cat.cat_slug}`">{{cat.cat_name}} <span>({{ cat.post_count_count }})</span></router-link>
                        </li>
                    </ul>
                    </div>
                </div>
                </div>
             
            </div>
            </div>
        </div>
    
</template>

<script>
import _ from 'lodash'
export default {
    name: "Sidebar",
    data(){
        return{
            latestpost: [],
            categorieswithcount: [],
            keyword:''
        }
    },
    methods:{
        latestPost(){
            axios.get('publatestpost')
            .then(({data}) => (this.latestpost = data))
        },
        loadCategories(){
        axios.get('pubgetcategorywithcount')
        .then(({data}) => (this.categorieswithcount = data))
        },
        RealSearch:_.debounce(function () {
                axios.get('search?s=' + this.keyword)
                .then(({data}) => (this.posts = data))
            },1000)
        
    },

    
    created(){
        this.latestPost()
        this.loadCategories()
    },

   

    
}
</script>