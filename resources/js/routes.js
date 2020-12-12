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
        path: '/managepages', 
        component: require('./components/admin/page/Pagelist.vue').default 
    },
    { 
        path: '/createpage', 
        component: require('./components/admin/page/Createpage.vue').default 
    },
    { 
        path: '/editpage/:id', 
        component: require('./components/admin/page/Editpage.vue').default 
    },
    { 
        path: '/', 
        component: require('./components/frontend/Home.vue').default
    },

    { 
        path: '/blog/:slug',
        component: require('./components/frontend/Single.vue').default
    },
    { 
        path: '/category/:cat_slug',
        component: require('./components/frontend/Categorypost.vue').default
    },
    { 
        path: '/:slug',
        name: 'page',
        component: require('./components/frontend/Singlepage.vue').default
    },
    { 
        path: '/search/:keyword',
        name: 'search',
        component: require('./components/frontend/Search.vue').default
    }
   
]