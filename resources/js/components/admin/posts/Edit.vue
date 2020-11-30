<template>
    <div>
        <div class="row justify-content-center">
          <div class="col-12">
            <div class="card mt-3">
              <div class="card-header">
                <h3 class="card-title fw-600">Update Post</h3>

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
                <p>Click or drag feature image here to upload</p>
              </div>
            </Upload>
            <div class="demo-upload-list" v-if="data.feature_photo">
            <center><img v-if="data.feature_photo" :src="`${data.feature_photo}`" /></center>
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
              <editor v-if="initData"
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
						 <Button @click="save" :loading="isCreating" :disabled="isCreating">{{isCreating ? 'Please wait...' : 'Update blog'}}</Button>
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
  name:'Edit',
  metaInfo() {
      return { 
          title: "Modify Post",
          meta: [
              { name: 'description', content:  'Modify Post'}

          ]
      }
  },
	data(){
		return {
            config: {
			},
            initData: null,
            data: {
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
			articleHTML: '',
			category : [],
			isCreating: false,
		}
	},
	methods : {
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
        const res = await axios.post(`/updatepost/${this.$route.params.id}`, this.data)
        if(res.status===200){
          Toast.fire({
                icon: 'success',
                title: 'Post has been updated successfully!'
              })
          // redirect...
          this.$router.push('/manageposts')
        }else{
          this.swr()
        }
        this.isCreating = false
      },
        async save(){
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
        const id = parseInt(this.$route.params.id)
        console.log(id)
        if(!id){
            return this.$router.push('/notfound')
        }
		const [blog, cat] = await Promise.all([
			this.callApi('get', `/blogsingle/${id}`),
			this.callApi('get', '/api/getcategory')
		])
		if(blog.status==200){
            if(!blog.data) return this.$router.push('/notfound')
            console.log(JSON.parse(blog.data.jsonData))
            this.initData = JSON.parse(blog.data.jsonData)
			this.category = cat.data
           
            for(let c of blog.data.cat){
                this.data.category_id.push(c.id)
            }
            this.data.title = blog.data.title
            this.data.jsonData = blog.data.jsonData
            this.data.meta_des = blog.data.meta_des
            this.data.post_excerpt = blog.data.post_excerpt
            this.data.slug = blog.data.slug
            this.data.tags = blog.data.tags
            this.data.feature_photo = blog.data.feature_photo
        }else{
            this.swr()
        }
	}
}
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