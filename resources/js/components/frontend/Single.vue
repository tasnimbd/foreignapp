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
                            <h4 v-if="singlepost">{{ singlepost.title }}</h4>
                            <ul class="post-info">
                                <li v-if="singlepost">{{singlepost.created_at | myFullDate}}</li>
                                <li v-if="singlepost.user">{{singlepost.user.name}}</li>
                            </ul>
                            <div class="code_content">
                                 <span v-html="singlepost.post"></span>
                                
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-7 col-md-6">
                                <div class="tags">
                                    <ul class="tags">
                                    <li><i class="fa fa-tag"></i></li>
                                    <li><a href="#">Beauty</a>,</li>
                                    <li><a href="#">Fashion</a>,</li>
                                    <li><a href="#">Lifestyle</a></li>
                                    </ul>
                                </div>
                                </div>
                                <div class="col-lg-5 col-md-6">
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
                        <div class="about-author">
                            <div class="author-image">
                            <img src="images/about-author.jpg" alt="">
                            </div>
                            <div class="right-content">
                            <h6>Shareen Robertson</h6>
                            <p>Franzen tumeric sriracha and quinoa goard next level. Cold-pressed kinfolk cronut shoreditch freegan kistrater selfies.</p>
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
                        <ul class="post-nav">
                            <li><a href="#">Prev Post</a></li>
                            <li><a href="#">Next Post</a></li>
                        </ul>
                        </div>
                        <div class="col-lg-12">
                        <div class="widget-post comments">
                            <div class="widget-header">
                            <h4>3 Comments</h4>
                            </div>
                            <div class="widget-content">
                            <ul class="comments">
                                <li>
                                <div class="comment-author-image">
                                    <img src="images/comment-author-01.jpg" alt="">
                                </div>
                                <div class="right-content">
                                    <h6>Robert Imeri <span>January 10, 2020</span></h6>
                                    <a href="#" class="reply-button">Reply</a>
                                    <p>Franzen tumeric sriracha and quinoa goard next level. Cold-pressed kinfolk cronut short ditch freegan kistrater selfies.</p>
                                </div>
                                </li>
                                <li class="replied">
                                <div class="comment-author-image">
                                    <img src="images/comment-author-03.jpg" alt="">
                                </div>
                                <div class="right-content">
                                    <h6>Kate Luise <span>January 11, 2020</span></h6>
                                    <a href="#" class="reply-button">Reply</a>
                                    <p>Franzen tumeric sriracha and quinoa goard next level. Cold-pressed kinfolk cronut short ditch freegan kistrater selfies.</p>
                                </div>
                                </li>
                                <li>
                                <div class="comment-author-image">
                                    <img src="images/comment-author-02.jpg" alt="">
                                </div>
                                <div class="right-content">
                                    <h6>Antonio Matters <span>January 09, 2020</span></h6>
                                    <a href="#" class="reply-button">Reply</a>
                                    <p>Franzen tumeric sriracha and quinoa goard next level. Cold-pressed kinfolk cronut short ditch freegan kistrater selfies.</p>
                                </div>
                                </li>
                            </ul>
                            </div>
                        </div>
                        </div>
                        <div class="col-lg-12">
                        <div class="widget-post leave-comment">
                            <div class="widget-header">
                            <h4>Leave a comment</h4>
                            </div>
                            <div class="widget-content">
                            <div class="contact-form">
                                <form id="contact" action="#" method="post">
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 col-sm-12">
                                    <fieldset>
                                        <input name="name" type="text" class="form-control" id="name" placeholder="Your name..." required="">
                                    </fieldset>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12">
                                    <fieldset>
                                        <input name="email" type="text" class="form-control" id="email" pattern="[^ @]*@[^ @]*" placeholder="Your email..." required="">
                                    </fieldset>
                                    </div>
                                    <div class="col-lg-12"><grammarly-extension style="position: absolute; top: 0px; left: 0px; pointer-events: none;" class="_1KJtL"></grammarly-extension>
                                    <fieldset>
                                        <textarea name="message" rows="6" class="form-control" id="message" placeholder="Your comment..." required="" spellcheck="false"></textarea>
                                    </fieldset>
                                    </div>
                                    <div class="col-lg-12">
                                    <fieldset>
                                        <button type="submit" id="form-submit" class="filled-button">Post Comment</button>
                                    </fieldset>
                                    </div>
                                </div>
                                </form>
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
export default {
    name: 'Single',
    components:{
        Sidebar,
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