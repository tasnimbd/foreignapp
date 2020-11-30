<template>
    <div>
        <section class="medium-gap error-404">
          <div class="container">
            <div class="row">
              <div class="col-lg-12">
                <div class="main-content">
                  <h1>error 404</h1>
                  <span>The page you were looking for does not exist.</span>
                </div>
              </div>
            </div>
          </div>
        </section>
        <section class="medium-gap go-back-home">
        <div class="container">
          <div class="row">
            <div class="col-lg-8 offset-lg-2">
              <div class="main-content">
                <div class="row">
                  <div class="col-lg-8">
                    <div class="left-content">
                      <h2><em>Oops</em>, looks like you're <em>lost</em>!</h2>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="normal-white-button">
                      <router-link to="/">Go Back Home</router-link>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>

</template>

<script>
export default {
  name:'Notfound',
  metaInfo() {
        return { 
            title: "404 Nothing Found",
            meta: [
                { name: 'description', content:  '404 Nothing Found'}   
                
            ]
        }
    }
}
</script>