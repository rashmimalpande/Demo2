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
                    <h2>{{ post.title.rendered }}</h2>
                    <p>{{post.excerpt.rendered}}</p>
                </article>
            </div>
        </div>
    </template>
<?php get_footer(); ?>