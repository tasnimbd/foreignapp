<template>
    <div>
        <div class="row justify-content-center">
          <div class="col-12">
            <div class="card mt-3">
              <div class="card-header">
                <h3 class="card-title fw-600">Category List</h3>

                <div class="card-tools">
                  <button class="btn btn-success" @click="newModal"> Add New <i class="nav-icon fas fa-plus-square"></i></button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>Category Name</th>
                      <th>Date</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(category, i) in categories.data" :key="i">
                      <td>{{category.cat_name}}</td>
                      <td>{{category.created_at | myDate}}</td>
                      <td>
                          <button class="btn btn-success" @click="editModal(category)"><i class="nav-icon fas fa-edit"></i></button>
                          <button class="btn btn-danger" @click="deleteCat(category.id)"><i class="nav-icon fas fa-trash-alt"></i></button>
                      </td>
                    </tr>
                    
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <pagination :data="categories" @pagination-change-page="getResults"></pagination>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Add New Category</h5>
                    <h5 class="modal-title" v-show="editmode" id="addNewLabel">Update Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="editmode ? updateCategory() : createCategory()">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Category Name</label>
                            <input v-model="form.cat_name" type="text" name="cat_name" placeholder="Enter Category Name"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('cat_name') }">
                            <has-error :form="form" field="cat_name"></has-error>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button v-show="!editmode" type="submit" class="btn btn-primary">Create</button>
                        <button v-show="editmode" type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
        <!--end modal-->
    </div>
</template>

<script>
    export default {
      name:'Categories',
        metaInfo() {
            return { 
                title: "Manage Category",
                meta: [
                    { name: 'description', content:  'Manage Category'}

                ]
            }
        },
        data () {
            return {
                
                editmode: false,
                categories:{},
                form: new Form({
                    id: '',
                    cat_name: ''
                })
            }
        },
        methods: {
            getResults(page = 1) {
              axios.get('api/category?page=' + page)
                .then(response => {
                  this.categories = response.data;
                });
            },

            editModal(category){
              this.form.reset()
              $('#addNew').modal('show')
              this.form.fill(category)
              this.editmode = true
            },
            newModal(){
              this.form.reset()
              $('#addNew').modal('show')
              this.editmode = false
            },
            loadCategory(){
                axios.get('api/category')
                .then(({data}) => (this.categories = data))
            },

            updateCategory(){
              this.$Progress.start()
              this.form.put('api/category/'+this.form.id)
                .then(() => {
                  Fire.$emit('AfterCreate')

                  $('#addNew').modal('hide')

                  Toast.fire({
                    icon: 'success',
                    title: 'Category updated in successfully'
                  })

                  this.$Progress.finish()
                })
                .catch(() => {
                  this.$Progress.fail()
                })
            },

            createCategory(){
                this.$Progress.start()
                this.form.post('api/category')
                .then(() => {
                  Fire.$emit('AfterCreate')

                  $('#addNew').modal('hide')

                  Toast.fire({
                    icon: 'success',
                    title: 'Category created successfully'
                  })

                  this.$Progress.finish()
                })
                .catch(() => {

                })


            },

            deleteCat(id){
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
                  this.form.delete('api/category/'+id)
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
            }
        },
        created() {
            Fire.$on('searching', () => {
              let query = this.$parent.$parent.search
              axios.get('api/findcategory?q='+ query)
              .then((data) => {
                this.categories = data.data
              })
              .catch(() => {
                
              })
            })
            this.loadCategory()
            //setInterval(() => this.loadCategory(), 3000)
            Fire.$on('AfterCreate', () => {
               this.loadCategory()
            })
        }
    }
</script>