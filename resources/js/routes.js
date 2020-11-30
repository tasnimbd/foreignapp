export const routes = [
    {   path: '/dashboard',
        component: require('./components/admin/Dashboard.vue').default
    },
    { 
        path: '/home', 
        component: require('./components/admin/Dashboard.vue').default 

    },
    { 
        path: '/categories', 
        component: require('./components/admin/Categories.vue').default 
    },
    { 
        path: '*', 
        component: require('./components/Notfound.vue').default 
    },
    { 
        path: '/manageposts', 
        component: require('./components/admin/posts/List.vue').default 
    },
    { 
        path: '/createpost', 
        component: require('./components/admin/posts/New.vue').default 
    },
    { 
        path: '/editpost/:id', 
        component: require('./components/admin/posts/Edit.vue').default 
    },
    { 
        path: '/', 
        component: require('./components/frontend/Home.vue').default
    }
   
]