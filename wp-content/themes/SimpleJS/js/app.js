Vue.use(VueRouter);

var postList = Vue.extend({
    template: '#post-list-template',
    data: function(){
        return {
            posts: '',
            currentPage: '',
            allPages: '',
            prev_page:'',
            next_page:''
        }
    },

    created: function(){
        this.fetchData(1)
    },

    methods: {
        fetchData: function(pageNumber){
            var xhr = new XMLHttpRequest();
            var self = this;
            self.currentPage = pageNumber;
            xhr.open('GET', 'wp-json/wp/v2/posts?per_page=2&page=' + pageNumber);
            xhr.onload = function(){
                self.posts = JSON.parse(xhr.responseText);
                self.makePagination(xhr.getResponseHeader('X-WP-TotalPages'));
            }

            xhr.send();
        },

        makePagination: function(data){
            this.allPages = data;
            //Setup prev page
            if(this.currentPage > 1){
               this.prev_page = this.currentPage - 1;
            } else {
                this.prev_page = null;
            }

            // Setup next page
            if(this.currentPage == this.allPages){
                this.next_page = null;
            } else {
                this.next_page = this.currentPage + 1 ;
            }
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

     watch: {
        '$route' (to, from){
              this.fetchPost();
        }
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