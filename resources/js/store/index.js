export default {
    state:{
        singlepost:[],
        singlepage:[]
    },
    getters:{
        
        singlepost(state){
            return state.singlepost
        },
        singlepage(state){
            return state.singlepage
        }

    },
    actions:{
        
        getPostById(context,payload){
            axios.get('/singlepost/'+payload)
                .then((response)=>{
                    context.commit('siglePost',response.data.post)
                })
        },

        getPageById(context,payload){
            axios.get('/singlepage/'+payload)
                .then((response)=>{
                    context.commit('siglePage',response.data.page)
                })
        },
        
    },
    mutations:{
        
        siglePost(state,payload){
            return state.singlepost = payload
        },
        siglePage(state,payload){
            return state.singlepage = payload
        }
        

    }
}
