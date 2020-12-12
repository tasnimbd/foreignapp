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
                            <fieldset style="border:none;">
                            <input placeholder="Type something" v-model="keyword" type="text" class="customsearch">
                             <button type="submit" @click.prevent="RealSearch" class="searchbutton"><i class="fa fa-search"></i></button>
                            </fieldset>
                           
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
                <div class="widget-sidebar about-me">
                    <div class="widget-header">
                    <h4>Head Office</h4>
                    </div>
                    <div class="widget-content">
                        <p style="text-align:left;"><strong>Address:</strong> <span style="font-weight:300;">A-03-13 Tropicana Avenue, No 12 Persiaran Tropicana, 47410 Petaling Jaya, Selangor, Malaysia</span></p>
                        <p style="text-align:left;"><strong>Land Line:</strong> <span style="font-weight:300;">+60378860995</span></p>
                        <p style="text-align:left;"><strong>Mobile:</strong> <span style="font-weight:300;">+601131234372 (WhatsApp)</span></p>
                        <p style="text-align:left;"><strong>Mail:</strong> <span style="font-weight:300;">info@foriegncompanyregistration.com</span></p>
                    </div>
                </div>
                </div>

                <div class="col-lg-12">
                <div class="widget-sidebar contact-me">
                    <div class="widget-header">
                        <h4>Send Message</h4>
                    </div>
                    <div class="widget-content">
                        <div class="contact-form">
                        <form id="contact">
                            <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <fieldset style="border:none;">
                                <input v-model="form.cusname" type="text" class="form-control" id="name" placeholder="Your name..." required="" :class="{ 'is-invalid': form.errors.has('cusname') }">
                                <has-error :form="form" field="cusname"></has-error>
                                </fieldset>
                            </div> 
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <fieldset style="border:none;">
                                <input v-model="form.email" type="text" class="form-control" id="email" pattern="[^ @]*@[^ @]*" placeholder="Your email..." required="" :class="{ 'is-invalid': form.errors.has('email') }">
                                <has-error :form="form" field="email"></has-error>
                                </fieldset>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <fieldset style="border:none;">
                                <input v-model="form.phone" type="text" class="form-control" id="subject" placeholder="Phone..." required="" :class="{ 'is-invalid': form.errors.has('phone') }">
                                <has-error :form="form" field="phone"></has-error>
                                </fieldset>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <fieldset style="border:none;">
                                <input v-model="form.subject" type="text" class="form-control" id="subject" placeholder="Subject..." required="" :class="{ 'is-invalid': form.errors.has('subject') }">
                                <has-error :form="form" field="subject"></has-error>
                                </fieldset>
                            </div>
                            <div class="col-lg-12">
                                <fieldset style="border:none;">
                                <textarea v-model="form.message" rows="6" class="form-control" id="message" placeholder="Your message..." required="" :class="{ 'is-invalid': form.errors.has('message') }"></textarea>
                                <has-error :form="form" field="message"></has-error>
                                </fieldset>
                            </div>
                            <div class="col-lg-12">
                                <fieldset style="border:none;">
                                <button type="submit" id="form-submit" @click.prevent="sendMessage" class="filled-button">Send Message</button>
                                </fieldset>
                            </div>
                            </div>
                        </form>
                        </div>
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
            keyword:'',
            form: new Form({
            cusname:'',
            email:'',
            phone:'',
            subject:'',
            message:''
            })
        }
    },
    methods:{
        sendMessage(){
                this.$Progress.start()
                this.form.post('sendmessage')
                .then(() => {
                  Toast.fire({
                    icon: 'success',
                    title: 'Message sent successfully'
                  })

                  this.$Progress.finish()
                })
                .catch(() => {

                })


            },
        
        latestPost(){
            axios.get('publatestpost')
            .then(({data}) => (this.latestpost = data))
        },
        loadCategories(){
        axios.get('pubgetcategorywithcount')
        .then(({data}) => (this.categorieswithcount = data))
        },
        RealSearch:_.debounce(function () {
                this.$router.push('/search/'+ this.keyword)
                //axios.get('search?s=' + this.keyword)
                //.then(({data}) => (this.posts = data))
            },10)
        
    },

    
    created(){
        this.latestPost()
        this.loadCategories()
    },

   

    
}
</script>

<style scoped>
.searchbutton{
    width: 40px;
    height: 40px;
    display: inline-block;
    text-align: center;
    line-height: 30px;
    background-color: #217747;
    color: #fff;
    font-size: 25px;
    padding-bottom: 5px;
}
.customsearch{
    width:80%;
    height: 40px;
    background-color: #f7f7f7;
    border: none;
    outline: none;
    display: inline-block;
    padding: 0px 15px;
    font-size: 15px;
    margin-bottom: 0px;
}
.fieldset {
    border: none;
    padding: 0 !important;
    margin: 0 !important;
}

.filled-button:hover {
    background-color: transparent;
    border: 1px solid #79a472;
    color: #79a472;
}
.filled-button {
    display: inline-block;
    padding: 14px 24px;
    width: 100%;
    font-size: 13px;
    color: #ffffff;
    background-color: #79a472;
    text-transform: uppercase;
    font-weight: 700;
    border: 1px solid transparent;
    cursor: pointer;
    outline: none;
    -webkit-transition: all .3s;
    transition: all .3s;
}
fieldset input {
    width: 100%;
    height: 40px;
    background-color: #f7f7f7;
    border: none;
    outline: none;
    display: inline-block;
    padding: 0px 15px;
    font-size: 14px;
    margin-bottom: 30px;
}
fieldset textarea {
    width: 100%;
    height: 150px;
    max-width: 100%;
    min-width: 100%;
    max-height: 200px;
    background-color: #f7f7f7;
    border: none;
    outline: none;
    display: inline-block;
    padding: 15px;
    font-size: 14px;
    margin-bottom: 20px;
}
</style>