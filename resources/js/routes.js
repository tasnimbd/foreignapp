export const routes = [
    {   path: '/dashboard',
        component: require('./components/admin/Dashboard.vue').default
    },
    { 
        path: '/home', 
        component: require('./components/admin/Dashboard.vue').default 

    },
    { 
        path: '*', 
        component: require('./components/Notfound.vue').default 
    },
   
]