<template>
    <div>
        <div class="row justify-content-center">
          <div class="col-12">
            <div class="card mt-3">
              <div class="card-header">
                <h3 class="card-title fw-600">Page List</h3>

                <div class="card-tools">
                  <Button type="success" @click="$router.push(`/createpage`)"> Create Page <Icon type="md-add-circle" /></Button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>Title</th>
                      <th>Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(page, i) in pages.data" :key="i">
                      <td>{{page.title}}</td>
                      <td>{{page.created_at | myDate}}</td>
                      <td>
                          
                          <Button type="success" @click="$router.push(`/editpage/${page.id}`)"><i class="fas fa-edit"></i></Button>
                          <Button type="error" @click="deletePost(page.id)"><Icon type="md-trash" /></Button>
                          <a class="btn btn-primary" :href="`/${page.slug}`" target="_blank"><i class="fas fa-eye"></i></a>
                      </td>
                    </tr>
                    
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <pagination :data="pages" @pagination-change-page="getResults"></pagination>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>
        
    </div>
</template>

<script>
    export default {
        name:'Pagelist',
        metaInfo() {
            return { 
                title: "Page List",
                meta: [
                    { name: 'description', content:  'Page List'}

                ]
            }
        },
        data () {
            return {
                pages: {},
            }
        },
        methods: {
            getResults(page = 1) {
              axios.get('pagedata?page=' + page)
                .then(response => {
                  this.pages = response.data;
                });
            },
            deletePost(id){
              Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
              }).then((result) => {
                if (result.isConfirmed) {
                  //send request to server
                  axios.get('deletepage/'+id)
                  .then(() => {
                    Swal.fire(
                      'Deleted!',
                      'Your file has been deleted.',
                      'success'
                    )
                    Fire.$emit('AfterCreate')
                  })
                  .catch(() => {
                    Swal.fire("Failed!", "There is something wrong", "Warning")
                  })

                  

                }
              })
            },

            loadPost(){
                axios.get('pagedata')
                .then(({data}) => (this.pages = data))
            }
        },
      

      created(){
          Fire.$on('searching', () => {
          let query = this.$parent.$parent.search
          axios.get('findpage?q='+ query)
          .then((data) => {
            this.pages = data.data
          })
          .catch(() => {
            
          })
        })
        this.loadPost()
        Fire.$on('AfterCreate', () => {
               this.loadPost()
            })
      }



    }
</script>
