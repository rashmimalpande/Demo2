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
                    <h2 class="post-title"><router-link :to="{name:'post', params:{slug: post.slug}}">{{ post.title.rendered }}</router-link></h2>
                    <p v-html="post.excerpt.rendered"></p>
                </article>
            </div>
        </div>
    </template>


    <template id="single-post-template">
        <div class="container">
            <div class="post-list">
                <h2 class="post-title" v-if="post">{{post[0].title.rendered}}</h2> 
            
               <div class="post-content" v-if="post" v-html="fetchHtml"></div>
        </div>
    </template>

    
<?php get_footer(); ?>