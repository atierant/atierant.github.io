---
layout: page
title: "Tutorials"
subtitle: Learn it, dude !
css: "/assets/css/index.css"
meta-title: "Arnaud Tiérant"
bigimg:
- "/assets/img/big-imgs/1500x500.jpg" : "Passiflore <3"
permalink: tutorials
---

<div class="list-filters">
  <a href="/" class="list-filter">All posts</a>
  <a href="/popular" class="list-filter">Most Popular</a>
  <span class="list-filter filter-selected">Tutorials</span>
  <a href="/tags" class="list-filter">Index</a>
</div>

<div class="posts-list">
  {% for post in site.tags.tutorial %}
  <article>
    <a class="post-preview" href="{{ post.url | prepend: site.baseurl }}">
	    <h2 class="post-title">{{ post.title }}</h2>
	
	    {% if post.subtitle %}
	    <h3 class="post-subtitle">
	      {{ post.subtitle }}
	    </h3>
	    {% endif %}
      <p class="post-meta">
        Posted on {{ post.date | date: "%B %-d, %Y" }}
      </p>

      <div class="post-entry">
        {{ post.content | truncatewords: 50 | strip_html | xml_escape}}
        <span href="{{ post.url | prepend: site.baseurl }}" class="post-read-more">[Read&nbsp;More]</span>
      </div>
    </a>  
   </article>
  {% endfor %}
</div>
