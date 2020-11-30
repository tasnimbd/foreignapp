<template>
        <div class="col-lg-4">
            <div class="main-sidebar right-sidebar">
            <div class="row">
                <div class="col-lg-12">
                <div class="widget-sidebar about-me">
                    <div class="widget-header">
                    <h4>About Us</h4>
                    </div>
                    <div class="widget-content">
                    <img src="/img/aboutus.jpg" alt="">
                    <p style="text-align:left;">Foreign Company Registration is one of the world leading consulting firm. We have started our journey in 2012. Since then, we are providing various quality business services which include Company registration for foreign investors, Accounting, Income Tax, Free Business Advisory etc.</p>
                    <div style="box-shadow:1px 1px 3px #ddd;background:#ddd;" class="normal-white-button">
                        <a href="#">Read More</a>
                    </div>
                    <ul class="social-icons">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="#"><i class="fa fa-rss"></i></a></li>
                        <li><a href="#"><i class="fa fa-behance"></i></a></li>
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
                        <a href="single-standard-post.html">
                            <div class="left-image">
                            <img style="width:80px;height:80px;" :src="lpost.feature_photo" alt="">
                            <span>9</span>
                            </div>
                            <div class="right-content">
                            <h6>{{lpost.title}}</h6>
                            <span>{{lpost.created_at | myFullDate}}</span>
                            </div>
                        </a>
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
export default {
    name: "Sidebar",
    data(){
        return{
            latestpost: [],
            categorieswithcount: []
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
    }
    },

    created(){
        this.latestPost()
        this.loadCategories()
    }
}
</script>