Vue.use(VueRouter);

var postList = Vue.extend({
    template: '#post-list-template',
    data: function(){
        return {
            posts: ''
        }
    },

    created: function(){
        this.fetchData()
    },

    methods: {
        fetchData: function(){
            var xhr = new XMLHttpRequest();
            var self = this;
            xhr.open('GET', 'wp-json/wp/v2/posts');
            xhr.onload = function(){
                self.posts = JSON.parse(xhr.responseText);

            }

            xhr.send();
        }
    }
});


var singlePost = Vue.extend({
    template: '#single-post-template',
     data: function(){
        return {
            id: this.$route.params.slug,
            post: []
        }
    },
    
    created: function(){
        this.fetchPost()
    },

    methods: {
        fetchPost: function(){
            var xhr = new XMLHttpRequest();
            var self = this;
            xhr.open('GET', 'wp-json/wp/v2/posts/?slug='+self.id);
            xhr.onload = function(){
                self.post = JSON.parse(xhr.responseText);
                console.log(self.post)
            }

            xhr.send();
        }
    }
    
});

var singleCategory = Vue.extend({
    template: '#single-category-template',
    data: function(){
        return{
            cat_id: this.$route.params.catId,
            category_posts: []
        }
    },

    created: function(){
        this.fetchPost()
    },

    methods: {
        fetchPost: function(){
            var xhr = new XMLHttpRequest();
            var self = this;
            xhr.open('GET', 'wp-json/wp/v2/posts?categories='+self.cat_id);
            xhr.onload = function(){
                self.category_posts = JSON.parse(xhr.responseText);
                console.log(self.category_posts)
            }

            xhr.send();
        }
    }

});


var router = new VueRouter({
    routes: [
        {path: '/', component: postList},
        {path:'/post/:slug', name:'post', component: singlePost},         
        {path: '/category/:catId', name:'category', component: singleCategory}        
    ]
});



new Vue({
    el:'#app',
    router: router
});