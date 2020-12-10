<template>
    <div>
        <div class="row justify-content-center">
          <div class="col-12">
            <div class="card mt-3">
              <div class="card-header">
                <h3 class="card-title fw-600">Update Page</h3>

                <div class="card-tools">
                  <Button type="success" @click="$router.push(`/managepages`)"><Icon type="md-arrow-round-back" /> Back Page List</Button>
                </div>
              </div>
              <!-- /.card-header -->
              
                    <div class="card-body table-responsive p-10">
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
                        <Input v-model="data.meta_des" type="textarea" :rows="4" placeholder="Meta Description (120-158 character)..." />
                        </div>


					 <div class="form-group">
						 <Button @click="save" :loading="isCreating" :disabled="isCreating">{{isCreating ? 'Please wait...' : 'Update Page'}}</Button>
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
  name:'Editpage',
  metaInfo() {
      return { 
          title: "Edit Page",
          meta: [
              { name: 'description', content:  'Edit Page'}

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
                meta_des:'',
                jsonData: null,
                
                slug: ''
			},
			articleHTML: '',
			isCreating: false,
		}
	},
	methods : {
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
       
        this.isCreating = true
        const res = await axios.post(`/updatepage/${this.$route.params.id}`, this.data)
        if(res.status===200){
          Toast.fire({
                icon: 'success',
                title: 'Page has been updated successfully!'
              })
          // redirect...
          this.$router.push('/managepages')
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
						<p>${obj.data.html}</p>
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
        case 'table':
          this.articleHTML += this.makeTable(obj)
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
		const [page] = await Promise.all([
			this.callApi('get', `/pagesingle/${id}`)
		])
		if(page.status==200){
            if(!page.data) return this.$router.push('/notfound')
            console.log(JSON.parse(page.data.jsonData))
            this.initData = JSON.parse(page.data.jsonData)
           
            this.data.title = page.data.title
            this.data.jsonData = page.data.jsonData
            this.data.meta_des = page.data.meta_des
            this.data.slug = page.data.slug
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