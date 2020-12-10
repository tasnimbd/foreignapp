<template>
    <div>
        <div class="row justify-content-center">
          <div class="col-12">
            <div class="card mt-3">
              <div class="card-header">
                <h3 class="card-title fw-600">Post List</h3>

                <div class="card-tools">
                  <Button type="success" @click="$router.push(`/createpost`)"> Add New Post <Icon type="md-add-circle" /></Button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>Title</th>
                      <!--<th>Author</th>-->
                      <!--<th>Categories</th>-->
                      <th>Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(blog, i) in blogs.data" :key="i">
                      <td>{{blog.title}}</td>
                      <!--<td><Tag type="border">{{blog.user.name}}</Tag></td>
                      <td><span v-for="(c, j) in blog.cat" :key="j"><Tag type="border">{{c.cat_name}}</Tag></span></td>-->
                      <td>{{blog.created_at | myDate}}</td>
                      <td>
                          
                          <Button type="success" @click="$router.push(`/editpost/${blog.id}`)"><i class="fas fa-edit"></i></Button>
                          <Button type="error" @click="deletePost(blog.id)"><Icon type="md-trash" /></Button>
                          <a class="btn btn-primary" :href="`/blog/${blog.slug}`" target="_blank"><i class="fas fa-eye"></i></a>
                      </td>
                    </tr>
                    
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <pagination :data="blogs" @pagination-change-page="getResults"></pagination>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>
        
    </div>
</template>

<script>
    export default {
        name:'List',
        metaInfo() {
            return { 
                title: "Post List",
                meta: [
                    { name: 'description', content:  'Post List'}

                ]
            }
        },
        data () {
            return {
                blogs: {},
            }
        },
        methods: {
            getResults(page = 1) {
              axios.get('blogsdata?page=' + page)
                .then(response => {
                  this.blogs = response.data;
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
                  axios.get('deletepost/'+id)
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
                axios.get('blogsdata')
                .then(({data}) => (this.blogs = data))
            }
        },
      

      created(){
        Fire.$on('searching', () => {
          let query = this.$parent.$parent.search
          axios.get('findpost?q='+ query)
          .then((data) => {
            this.blogs = data.data
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
