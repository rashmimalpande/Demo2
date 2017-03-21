<?php get_header(); ?>

    <div class="wrapper">
        <div id="app">
            <header class="site-header">
                <ul>
                    <li><router-link to="/">Home</router-link></li>
                    <li><router-link to="/authors">Authors</router-link></li>
                </ul>
            </header>
            <router-view></router-view>
        </div>
    </div>    

    <!-- Home Template -->    
    <template id="post-list-template">
        <div>
            <header class="home-banner">
                <h2>Simple Blog Theme</h2>
            </header>
            <div class="container">
                <div class="post-list">
                    <article v-for="post in posts">
                        <h2 class="post-title"><router-link :to="{name:'post', params:{slug: post.slug}}">{{ post.title.rendered }}</router-link></h2>
                        <p v-html="post.excerpt.rendered"></p>
                        <div class="meta">
                            <p>by <router-link :to="{name: 'author', params:{id:post.author, user: post.author_name}}">{{post.author_name}}</router-link> </p>
                            <p>{{post.post_date}}</p>
                        </div>
                        
                    </article>
                </div>

                <div class="pagination">
                    
                    <button class="btn" v-on:click="fetchData(prev_page)" :disabled="!prev_page">
                        Previous
                    </button>
                    <span>Page {{currentPage}} of {{allPages}}</span>
                    <button class="btn" v-on:click="fetchData(next_page)" :disabled="!next_page">
                        Next
                    </button>
                </div>
            </div>
        </div>
    </template>

    <!-- Single Post Template -->
    <template id="single-post-template">
        <div class="post-wrapper">
            <main v-for="single_post in post">
                 <div class="banner">
                    <img :src="single_post.featured_url">
                </div>
                <header>
                    <h1>{{single_post.title.rendered}}</h1>
                    <p>by <router-link :to="{name: 'author', params:{id:single_post.author, user: single_post.author_name}}">{{single_post.author_name}}</router-link></p>
                    <p>{{single_post.post_date}}</p>
                </header>
                <article>
                    <div class="post-content" v-html="single_post.content.rendered"></div>
                    <div class="category">
                        <span v-for="category in single_post.category_names">
                            <router-link :to="{name:'category', params:{catId: category.cat_ID}}">{{category.name}}</router-link>
                        </span>
                    </div>

                    <div class="next-prev">
                        <p><router-link to="/" class="btn">Back to Home</router-link></p>
                    </div>
                </article>
            </main>
        </div>
    </template>

    <!-- Category Template -->    
    <template id="single-category-template">
        <div>
            <header class="category-banner">
                <h1>Category: {{cat_name.name}}</h1>
            </header>
            <div class="container">
                <div class="post-list">
                    
                    <article v-for="post in category_posts">
                        <h2 class="post-title"><router-link :to="{name:'post', params:{slug: post.slug}}">{{ post.title.rendered }}</router-link></h2>
                        <p v-html="post.excerpt.rendered"></p>
                        <div class="meta">
                                <p>by <router-link :to="{name: 'author', params:{id:post.author, user: post.author_name}}">{{post.author_name}} </router-link></p>
                                <p>{{post.post_date}}</p>
                        </div>
                    </article>
                </div>

            
            </div>
        </div>
    </template>


    <!-- Author Template -->
    <template id="single-author-template">
        <div>
            <header class="author-banner">
                    <h1>Author: {{user}}</h1>
            </header>
            <div class="container">
                <div class="post-list">
                
                    <article v-for="post in author_posts">
                        <h2 class="post-title"><router-link :to="{name:'post', params:{slug: post.slug}}">{{ post.title.rendered }}</router-link></h2>
                        <p v-html="post.excerpt.rendered"></p>
                        <div class="meta">
                                <p>by <router-link :to="{name: 'author', params:{id:post.author, user: post.author_name}}">{{post.author_name}} </router-link></p>
                                <p>{{post.post_date}}</p>
                        </div>
                    </article>
                </div>

            
            </div>
        </div>
    </template>


    <template id="all-authors-template">
        <div class="container">
            <div class="list">
                <div v-for="author in authors">
                    <h2><router-link :to="{name: 'author', params:{id:author.id, user: author.name}}">{{ author.name }}</router-link></h2>
                    <p> {{author.description}}</p>
                    
                </div>
             
            </div>
                <div class="pagination">
                    
                        <button class="btn" v-on:click="fetchAuthors(prev_page)" :disabled="!prev_page">
                            Previous
                        </button>
                        <span>Page {{currentPage}} of {{allPages}}</span>
                        <button class="btn" v-on:click="fetchAuthors(next_page)" :disabled="!next_page">
                            Next
                        </button>
                    </div>
                </div>
        </div>
    </template>
    
<?php get_footer(); ?>