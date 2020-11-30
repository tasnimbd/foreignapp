<template>
    <span>
        <section class="medium-gap standard-home">
            <div class="container">
                <div class="row">
                <div class="col-lg-8">
                    <div class="standard-posts">
                    <div class="row">
                        <div class="col-lg-12" v-for="(post, i) in posts.data" :key="i">
                        <div class="standard-post">
                            <div class="post-image">
                            <a href="single-standard-post.html"><img :src="post.feature_photo" alt=""></a>
                            </div>
                            <div class="down-content">
                            <div class="meta-category">
                                <span v-for="(c, j) in post.cat" :key="j">{{c.cat_name}}</span>
                            </div>
                            <a href="single-standard-post.html"><h4>{{post.title}}</h4></a>
                            <ul class="post-info">
                                <li>{{post.created_at | myFullDate}}</li>
                                <li>{{post.user.name}}</li>
                            </ul>
                            <p>{{post.post_excerpt | sortlength(237, "...")}}</p>
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                <div class="comments-info">
                                    <i class="fa fa-comment-o"></i>
                                    <span>8 comments</span>
                                </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                <ul class="share-post">
                                    <li><i class="fa fa-share-alt"></i></li>
                                    <li><a href="#">Facebook</a>,</li>
                                    <li><a href="#">Twitter</a>,</li>
                                    <li><a href="#">Pinterest</a></li>
                                </ul>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                        
                        
                        <div class="col-lg-12">
                        <ul class="pagination">
                            <pagination :data="posts" @pagination-change-page="getResults"></pagination>
                        </ul>
                        </div>
                    </div>
                    </div>
                </div>
                <Sidebar/>
                </div>
            </div>
            </section>
    </span>
</template>

<script>
import Sidebar from "./partials/Sidebar.vue";
export default {
    name: 'Home',
    components:{
        Sidebar
    }, 
    metaInfo() {
        return { 
            title: "Foreign Company Registration Consultant",
            meta: [
                { name: 'description', content:  'We provide company registration consultancy service for the foreign investors in respective countries by our experts within frame of FDI law'},
                { property: 'og:title', content: "Foreign Company Registration Consultant"},
                { property: 'og:description', content: "We provide company registration consultancy service for the foreign investors in respective countries by our experts within frame of FDI law"},
                { property: 'og:image', content: "http://127.0.0.1:8000/img/ogphoto.jpg"},
                { property: 'og:site_name', content: 'Foreign Company Registration Consultant'}    
                
            ]
        }
    },

    data(){
        return{
            posts: {},
            
        }
    },

    methods:{
        getResults(page = 1) {
            axios.get('pubgetpost?page=' + page)
            .then(({data}) => (this.posts = data))
        },
        loadPost(){
            axios.get('pubgetpost')
            .then(({data}) => (this.posts = data))
        },
        

  },

  created(){
      this.loadPost()
      
  }



    
}
</script>