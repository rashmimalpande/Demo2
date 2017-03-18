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
            id: this.$route.params.postId,
            post: ''
        }
    },
    
    created: function(){
        this.fetchPost()
    },

    methods: {
        fetchPost: function(){
            var xhr = new XMLHttpRequest();
            var self = this;
            xhr.open('GET', 'wp-json/wp/v2/posts/'+self.id);
            xhr.onload = function(){
                self.post = JSON.parse(xhr.responseText);
                console.log(self.post)
            }

            xhr.send();
        }
    },

    computed: {
        fetchHtml: function(){
            return this.post.content.rendered;
        }
    }
    
});


var router = new VueRouter({
    routes: [
        {path:'/post/:postId', name:'post', component: singlePost},         
        {path: '/', component: postList}
    ]
});



new Vue({
    el:'#app',
    router: router
});