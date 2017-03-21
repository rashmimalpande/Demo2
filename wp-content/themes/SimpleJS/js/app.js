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
            xhr.open('GET', 'wp-json/wp/v2/posts?per_page=5&page=' + pageNumber);
            xhr.onload = function(){
                self.posts = JSON.parse(xhr.responseText);
                localStorage.setItem('self.posts', JSON.parse(xhr.responseText));              
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
            id: to.params.slug
            post: []
            this.fetchPost()
        }
             
    },
    
    methods: {
        fetchPost: function(){
            var xhr = new XMLHttpRequest();
            var self = this;
            xhr.open('GET', 'wp-json/wp/v2/posts/?slug='+self.id);
            xhr.onload = function(){
                self.post = JSON.parse(xhr.responseText);
                localStorage.setItem('self.post', JSON.parse(xhr.responseText));
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
            cat_name:'',
            category_posts: []
        }
    },

    created: function(){
        this.fetchPost()
        this.fetchCategory()
    },

    methods: {
        fetchPost: function(){
            var xhr = new XMLHttpRequest();
            var self = this;
            xhr.open('GET', 'wp-json/wp/v2/posts?categories='+self.cat_id);
            xhr.onload = function(){
                self.category_posts = JSON.parse(xhr.responseText);
                localStorage.setItem('self.category_posts', JSON.parse(xhr.responseText));
                console.log(self.category_posts)
            }

            xhr.send();
        },

        fetchCategory: function(){
            var xhr = new XMLHttpRequest();
            var self = this;
            xhr.open('GET', 'wp-json/wp/v2/categories/'+self.cat_id);
            xhr.onload = function(){
                self.cat_name = JSON.parse(xhr.responseText);
                localStorage.setItem('self.cat_name', JSON.parse(xhr.responseText));
            }

            xhr.send();
        }

    }

});

var singleAuthor = Vue.extend({
    template: '#single-author-template',
    data: function(){
        return{
             user: this.$route.params.user,
             id: this.$route.params.id,
             author_posts: []
        }
    },

    created: function(){
        this.fetchPost()
    },

    methods: {
        fetchPost: function(){
            var xhr = new XMLHttpRequest();
            var self = this;
            xhr.open('GET', 'wp-json/wp/v2/posts?author='+self.id);
            xhr.onload = function(){
                self.author_posts = JSON.parse(xhr.responseText);
                localStorage.setItem('self.author_posts', JSON.parse(xhr.responseText));                
            }

            xhr.send();
        }
    }

});


var router = new VueRouter({
    routes: [
        {path: '/', component: postList},
        {path:'/blog/:slug', name:'post', component: singlePost},         
        {path: '/category/:catId', name:'category', component: singleCategory},
        {path: '/author/:id/:user', name:'author', component: singleAuthor}        
                
    ]
});



new Vue({
    el:'#app',
    router: router
});