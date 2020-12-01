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
                            <router-link :to="`/blog/${post.slug}`"><img :src="post.feature_photo" alt=""></router-link>
                            </div>
                            <div class="down-content">
                            <div class="meta-category">
                                <span v-for="(c, j) in post.cat" :key="j">{{c.cat_name}}</span>
                            </div>
                            <router-link :to="`/blog/${post.slug}`"><h4>{{post.title}}</h4></router-link>
                            <ul class="post-info">
                                <li>{{post.created_at | myFullDate}}</li>
                                <li>{{post.user.name}}</li>
                            </ul>
                            <p>{{post.post_excerpt | sortlength(237, "...")}}</p>
                            <div class="row">
                                
                               <div class="col-lg-12 col-md-12">
                                    <center><facebook-button
                                        :url="`http://127.0.0.1:8000/blog/${post.slug}`"
                                        v-bind:isBlank="false" btnText

                                    />
                                    <twitter-button
                                        :url="`http://127.0.0.1:8000/blog/${post.slug}`"
                                        v-bind:isBlank="false" btnText
                                    />
                                    <reddit-button
                                        :url="`http://127.0.0.1:8000/blog/${post.slug}`"
                                        v-bind:isBlank="false" btnText
                                    />
                                    <pinterest-button
                                        :url="`http://127.0.0.1:8000/blog/${post.slug}`"
                                        v-bind:isBlank="false" btnText
                                    /></center>

                             
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
import FacebookButton from "vue-share-buttons/src/components/FacebookButton";
import TwitterButton from "vue-share-buttons/src/components/TwitterButton";
import RedditButton from "vue-share-buttons/src/components/RedditButton";
import PinterestButton from "vue-share-buttons/src/components/PinterestButton";
export default {
    name: 'Home',
    components:{
        Sidebar,
        FacebookButton,
        TwitterButton,
        RedditButton,
        PinterestButton
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
      
  },
  





    
}
</script>

