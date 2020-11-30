<template>
    <div>
        <div class="row justify-content-center">
          <div class="col-12">
            <div class="card mt-3">
              <div class="card-header">
                <h3 class="card-title fw-600">Create Post</h3>

                <div class="card-tools">
                 <Button type="success" @click="$router.push(`/manageposts`)"><Icon type="md-arrow-round-back" /> Back Post List</Button>
                </div>
              </div>
              <!-- /.card-header -->
              
          <div class="card-body table-responsive p-10">
          <div class="form-group">
             <Upload
              ref="uploads"
              type="drag"
              :on-success="handleSuccess"
              :on-error="handleError"
              :format="['jpg','jpeg','png']"
              :max-size="2048"
              :on-format-error="handleFormatError"
              :on-exceeded-size="handleMaxSize"
              action="/upload"
            >
              <div style="padding: 20px 0">
                <Icon type="ios-cloud-upload" size="52" style="color: #3399ff"></Icon>
                <p>Click or drag files here to upload</p>
              </div>
            </Upload>
            <div class="demo-upload-list" v-if="data.feature_photo">
            <center><img :src="`${data.feature_photo}`" /></center>
            <div class="demo-upload-list-cover">
              <center><Icon style="font-size: 30px;color: white;background: red;padding: 10px;cursor: pointer;margin-top: 10px;" type="ios-trash-outline" @click="deleteImage"></Icon></center>
            </div>
          </div>
          </div>

          <div class="form-group">
            <Input v-model="data.title" type="text" placeholder="Title"/>
					</div>
          <div class="form-group">
            <Input v-model="data.slug" type="text" placeholder="seo-friendly-link"/>
					</div>
					<div class="form-group">
              <editor
                  class="editor"
                  ref="editor"
                  autofocus
                  holder-id="codex-editor"
                  save-button-id="save-button"
                  :init-data="initData"
                  @save="onSave"
                  :config="config"
                  :additionalRequestData="{name: 'bla bla'}"
              />
					</div>
					<div class="form-group">
						 <Input v-model="data.post_excerpt" type="textarea" :rows="4" placeholder="Post Excerpt..." />
					</div>
					

          <div class="form-group">
              <Select multiple style="" placeholder="Select Categories" v-model="data.category_id">
                <Option v-for="(cat, i) in category" :value="cat.id" :key="i">{{cat.cat_name}}</Option>     
            </Select>
					</div>
					<div class="form-group">
            <Input v-model="data.tags" type="textarea" :rows="2" placeholder="Post Tags..." />
					</div>
					<div class="form-group">
              <Input v-model="data.meta_des" type="textarea" :rows="4" placeholder="Meta Description (120-158 character)..." />
					 </div>


					 <div class="form-group">
						 <Button @click="save" :loading="isCreating" :disabled="isCreating">{{isCreating ? 'Please wait...' : 'Create blog'}}</Button>
					 </div>
                </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <!--<pagination :data="categories" @pagination-change-page="getResults"></pagination>-->
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>
        
    </div>
</template>

<script>
export default {
  name:'New',
  metaInfo() {
      return { 
          title: "Create Post",
          meta: [
              { name: 'description', content:  'Create Post'}

          ]
      }
  },
  data() {
      return {
          config: {
            image: {
                field: 'image',
                types: 'image/*',
            },
        },

        category:[],

        initData: null,

        data:{
          title:'',
          post : '',
          post_excerpt:'',
          tags:'',
          meta_des:'',
          category_id:[],
          jsonData: null,
          feature_photo: '',
          slug: ''
        },
        
        isIconImageNew: false,
        articleHTML: '',
        isCreating: false


      }
    
  },
  
  methods:{
      handleSuccess(res, file) {
        res = `/uploads/${res}`;
        console.log(res);
        this.data.feature_photo = res;
      },
      handleError(res, file) {
        this.$Notice.warning({
          title: "The file format is incorrect",
          desc: `${
            file.errors.file.length
              ? file.errors.file[0]
              : "Something went wrong!"
          }`
        });
      },
      handleFormatError(file) {
        this.$Notice.warning({
          title: "The file format is incorrect",
          desc:
            "File format of " +
            file.name +
            " is incorrect, please select jpg or png."
        });
      },
      handleMaxSize(file) {
        this.$Notice.warning({
          title: "Exceeding file size limit",
          desc: "File  " + file.name + " is too large, no more than 2M."
        });
      },

      async deleteImage(isAdd = true) {
        let image;
        image = this.data.feature_photo;
        this.data.feature_photo = "";
        this.$refs.uploads.clearFiles();
        
        const res = await this.callApi("post", "/delete_image", {
          imageName: image
        });
        if (res.status != 200) {
          this.data.feature_photo = image;
          this.swr();
        }
      },

      async onSave(response){
        var data = response
			  await this.outputHtml(data.blocks)
			  this.data.post = this.articleHTML
        this.data.jsonData = JSON.stringify(data)

        if(this.data.title.trim()=='')
        return Toast.fire({
                    icon: 'error',
                    title: 'Title is required'
                  })
        if(this.data.post.trim()=='')
        return Toast.fire({
                    icon: 'error',
                    title: 'Post is required'
                  })
        
        if(this.data.post_excerpt.trim()=='')
        return Toast.fire({
                    icon: 'error',
                    title: 'Post exerpt is required'
                  })
       if(!this.data.category_id.length) 
        return Toast.fire({
                    icon: 'error',
                    title: 'Category is required'
                  })
       
        this.isCreating = true
        const res = await axios.post('create-post', this.data)
        if(res.status===200){
          Toast.fire({
                icon: 'success',
                title: 'Post has been created successfully!'
              })
          // redirect...
         this.$router.push('/manageposts')
          //this.$router.push({name: 'List'})
        }else{
          this.swr()
        }
        this.isCreating = false
      },
      save(){
          this.$refs.editor.save()
          
      },
      outputHtml(articleObj){
		   articleObj.map(obj => {
				switch (obj.type) {
				case 'paragraph':
					this.articleHTML += this.makeParagraph(obj);
					break;
				case 'image':
					this.articleHTML += this.makeImage(obj);
					break;
				case 'header':
					this.articleHTML += this.makeHeader(obj);
					break;
				case 'raw':
					this.articleHTML += `<div class="ce-block">
					<div class="ce-block__content">
					<div class="ce-code">
						<code>${obj.data.html}</code>
					</div>
					</div>
				</div>\n`;
					break;
				case 'code':
					this.articleHTML += this.makeCode(obj);
					break;
				case 'list':
					this.articleHTML += this.makeList(obj)
					break;
				case "quote":
					this.articleHTML += this.makeQuote(obj)
					break;
				case "warning":
					this.articleHTML += this.makeWarning(obj)
					break;
				case "checklist":
					this.articleHTML += this.makeChecklist(obj)
					break;
				case "embed":
					this.articleHTML += this.makeEmbed(obj)
					break;
				case 'delimeter':
					this.articleHTML += this.makeDelimeter(obj);
					break;
				default:
					return '';
				}
			});
		},
  },

  async created(){
    
    const res = await axios.get('api/getcategory')
    if(res.status==200){
      this.category = res.data
    }else{
      this.swr()
    }
    
      
  }
 
};
</script>

<style lang="css" scoped >
.editor{
  padding: 4px 7px;
  font-size: 14px;
  border: 1px solid #dcdee2;
  border-radius: 4px;
  color: #515a6e;
  background-color: #fff;
  background-image: none;
  z-index:  -1;
}
</style>