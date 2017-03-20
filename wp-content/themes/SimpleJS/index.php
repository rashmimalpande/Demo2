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
            <div class="post-list" v-for="single_post in post">
                <div class="banner">
                    <img :src="single_post.featured_url">
                </div>
                <h2 class="post-title">{{single_post.title.rendered}}</h2> 
            
               <div class="post-content" v-html="single_post.content.rendered"></div>
               <div class="category">
                    <span v-for="category in single_post.category_names
                    ">
                        <router-link :to="{name:'category', params:{catId: category.cat_ID}}">{{category.name}}</router-link>
                    </span>
               </div>
            </div>
        </div>

    </template>


    <template id="single-category-template">
        <div class="container">
            <div class="post-list">
                <h1>Category: {{cat_id}}</h1>
                <article v-for="post in category_posts">
                    <h2 class="post-title"><router-link :to="{name:'post', params:{slug: post.slug}}">{{ post.title.rendered }}</router-link></h2>
                    <p v-html="post.excerpt.rendered"></p>
                </article>
            </div>
        </div>
    </template>

    
<?php get_footer(); ?>