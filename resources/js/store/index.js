export default {
    state:{
        singlepost:[]
    },
    getters:{
        
        singlepost(state){
            return state.singlepost
        }

    },
    actions:{
        
        getPostById(context,payload){
            axios.get('/singlepost/'+payload)
                .then((response)=>{
                    context.commit('siglePost',response.data.post)
                })
        }
    },
    mutations:{
        
        siglePost(state,payload){
            return state.singlepost = payload
        }


    }
}
