var App = Vue.extend({});

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

var router = new VueRouter({
    routes: [
        {path: '/', component: postList}
    ]
});



new Vue({
    el:'#app',
    router: router

});