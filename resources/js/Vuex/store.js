import { createApp } from 'vue'
import { createStore } from 'vuex'

// Create a new store instance.
const store = createStore({

 state: {
        id:null,
        name:null,
        token:null ,
        typeUser:null ,
    },
  getters: {

    id: (state)=>{
        return state.id;
    },

    name: (state)=>{
        return state.name;
    },

    token: (state)=>{
        return state.token;
    },
    isLogin: (state)=>{
       if(state.token){return true;}else{return false;}
    },
    typeUser: (state)=>{
        return state.typeUser;
     },

  },
  mutations: {
   id: (state,payload)=>{
    state.id=payload;
   },
    name: (state,payload)=>{
        state.name=payload;
    },
    token: (state,payload)=>{
        state.token=payload;
    },
    typeUser: (state,payload)=>{
        state.typeUser=payload;
    },
  }
  ,
  actions: {
    login(context,payload){
        context.commit("id",payload.id)
        context.commit("name",payload.name)
        context.commit("token",payload.token)  
    },
    typeUser(context,payload){ 
        context.commit("typeUser",payload)      
    },
    autoLogin(context){
        context.commit("id",localStorage.getItem("id"))
        context.commit("name",localStorage.getItem("name"))
        context.commit("token",localStorage.getItem("token"))  
        context.commit("typeUser",localStorage.getItem("typeUser"))  
    },
    logout(context){
        context.commit("id",null)
        context.commit("name",null)
        context.commit("token",null)  
        context.commit("typeUser",null)  
        localStorage.removeItem("id");
        localStorage.removeItem("name");
        localStorage.removeItem("token");
        localStorage.removeItem("typeUser");
    },


  }

})


export default store;
