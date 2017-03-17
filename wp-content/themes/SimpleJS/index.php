<?php get_header(); ?>

    <div class="wrapper">
    
        <div id="app">
            <router-view></router-view>
        </div>
    </div>    

    <template id="post-list-template">
        <div class="container">
            <div class="post-list">
                <article v-for="post in posts">
                    <router-link :to="{name:'post', params:{slug: post.slug, postId: post.id}}"><h2>{{ post.title.rendered }}</h2></router-link>
                    <p v-html="post.excerpt.rendered"></p>
                </article>
            </div>
        </div>
    </template>


    <template id="single-post-template">
        <div class="container">
            <div class="post-title">
                <h2>Hello World</h2> 
            </div>
            <div class="post-list">

            </div>
        </div>
    </template>

    
<?php get_footer(); ?>