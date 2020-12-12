<template>
    <span>
        <section class="medium-gap standard-home">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8" v-if="singlepage ==null">
                    <div class="single-posts">
                    <div class="row">
                        <div class="col-lg-12">
                        <div class="single-post">
                            <div class="down-content">
                                <h1>Nothing Found</h1>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                    </div>
                    <div class="col-lg-8" v-if="singlepage !==null">
                    <div class="single-posts">
                    <div class="row">
                        <div class="col-lg-12">
                        <div class="single-post">
                            <div class="down-content">
                            <h1 v-if="singlepage">{{ singlepage.title }}</h1>
                            <div class="code_content">
                                 <span v-html="singlepage.post"></span>
                                
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <i style="font-size:20px;margin-top:14px;color:green;" class="fa fa-share-alt"></i>
                                    <facebook-button
                                        :url="`http://127.0.0.1:8000/${singlepage.slug}`"
                                        v-bind:isBlank="false" btnText

                                    />
                                    <twitter-button
                                        :url="`http://127.0.0.1:8000/${singlepage.slug}`"
                                        v-bind:isBlank="false" btnText
                                    />
                                    <reddit-button
                                        :url="`http://127.0.0.1:8000/${singlepage.slug}`"
                                        v-bind:isBlank="false" btnText
                                    />
                                    <pinterest-button
                                        :url="`http://127.0.0.1:8000/${singlepage.slug}`"
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
    name: 'Singlepage',
    components:{
        Sidebar,
        FacebookButton,
        TwitterButton,
        RedditButton,
        PinterestButton
    }, 
    metaInfo() {
        return { 
            title: this.singlepage.title,
            meta: [
                { name: 'description', content:  this.singlepage.meta_des},
                { property: 'og:title', content: this.singlepage.title},
                { property: 'og:description', content: this.singlepage.meta_des},
                { property: 'og:image', content: "http://127.0.0.1:8000/img/ogphoto.jpg"},
                { property: 'og:site_name', content: 'Foreign Company Registration Consultant'}    
                
            ]
        }
    },
    
    computed:{
            singlepage(){
                return this.$store.getters.singlepage
            }
        },
    methods:{
        singlePage(){
            this.$store.dispatch('getPageById',this.$route.params.slug);
        }
    },
    mounted(){
        this.singlePage();
    },
    watch:{
        $route(to,from){
            this.singlePage();
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