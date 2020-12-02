<template>
    <span>
        <section class="medium-gap standard-home">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8" v-if="singlepost">
                    <div class="single-posts">
                    <div class="row">
                        <div class="col-lg-12">
                        <div class="single-post">
                            <div class="post-image">
                            <div class="meta-category" v-if="singlepost.cat">
                                <span v-for="(c, z) in singlepost.cat" :key="z">{{c.cat_name}}</span>
                            </div>
                            <img v-if="singlepost.feature_photo" :src="singlepost.feature_photo" :alt="singlepost.title">
                            </div>
                            <div class="down-content">
                            <h1 v-if="singlepost">{{ singlepost.title }}</h1>
                            <ul class="post-info">
                                <li v-if="singlepost">{{singlepost.created_at | myFullDate}}</li>
                                <li v-if="singlepost.user">{{singlepost.user.name}}</li>
                            </ul>
                            <div class="code_content">
                                 <span v-html="singlepost.post"></span>
                                
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <i style="font-size:20px;margin-top:14px;color:green;" class="fa fa-share-alt"></i>
                                    <facebook-button
                                        :url="`http://127.0.0.1:8000/blog/${singlepost.slug}`"
                                        v-bind:isBlank="false" btnText

                                    />
                                    <twitter-button
                                        :url="`http://127.0.0.1:8000/blog/${singlepost.slug}`"
                                        v-bind:isBlank="false" btnText
                                    />
                                    <reddit-button
                                        :url="`http://127.0.0.1:8000/blog/${singlepost.slug}`"
                                        v-bind:isBlank="false" btnText
                                    />
                                    <pinterest-button
                                        :url="`http://127.0.0.1:8000/blog/${singlepost.slug}`"
                                        v-bind:isBlank="false" btnText
                                    />

                             
                                </div>
                            </div>
                            </div>
                        </div>
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
            title: `${this.singlepost.title} - Foreign Company Registration Expert`,
            meta: [
                { name: 'description', content:  'We provide company registration consultancy service for the foreign investors in respective countries by our experts within frame of FDI law'},
                { property: 'og:title', content: "Foreign Company Registration Consultant"},
                { property: 'og:description', content: "We provide company registration consultancy service for the foreign investors in respective countries by our experts within frame of FDI law"},
                { property: 'og:image', content: "http://127.0.0.1:8000/img/ogphoto.jpg"},
                { property: 'og:site_name', content: 'Foreign Company Registration Consultant'}    
                
            ]
        }
    },
    
    computed:{
            singlepost(){
                return this.$store.getters.singlepost
            }
        },
    methods:{
        singlePost(){
            this.$store.dispatch('getPostById',this.$route.params.slug);
        }
    },
    mounted(){
        this.singlePost();
    },
    watch:{
        $route(to,from){
            this.singlePost();
        }
    }

  





    
}
</script>

<style scoped>
.blog_post_text{
    margin-top:30px!important;
    margin-bottom: 30px!important;
}
</style>