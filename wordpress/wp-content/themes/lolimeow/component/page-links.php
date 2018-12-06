<?php 
/*
 * Template Name: 友情链接模板
*/
get_header();
?>
<section class="section-profile-cover section-blog-cover section-shaped my-0 " <?php if( meowdata('banneron') ) {echo md_banner();} ?>>
      <div class="shape shape-style-1 shape-primary alpha-4">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
      </div>
      <div class="separator separator-bottom separator-skew" >
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none">
          <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </section> 
<main class="meowblog">	
<div class="main-container">
<div class="container">
<div class="row">
<div class="col-lg-10 col-md-10 ml-auto mr-auto">
<?php while (have_posts()) : the_post(); ?>
<div class="post-single">
                                          <div class="entry-header single-entry-header">
                                                <h2 class="entry-title wow swing  animated"><?php the_title(); ?></h2>
                                          </div>
                                           

                                          <div class="entry-content wow bounceInLeft"> 
										 <?php the_content(); ?>
										 <?php echo get_link_items(); ?>
										  </div>
                                    </div>
<?php endwhile;  ?>
<?php comments_template('', true); ?>
</div>	
</div>	
</div>	
</div>	
</main>	
<style>.catalog-title {    font-size: 24px;    color: #000;    font-weight: 700}.catalog-share {    font-size: 14px;    color: rgba(0,0,0,.44);    margin-bottom: 20px}.userItems {    display: -webkit-box;    display: -webkit-flex;    display: -ms-flexbox;    display: flex;    -webkit-flex-wrap: wrap;    -ms-flex-wrap: wrap;    flex-wrap: wrap;    margin-bottom: 50px}.userItem {    width: 25%;    box-sizing: border-box;    margin-bottom: 20px;    padding-left: 10px;    padding-right: 10px}.userItem--inner {    border: 1px solid rgba(0,0,0,.05);    box-shadow: 0 1px 4px rgba(0,0,0,.04);    border-radius: 3px;    position: relative;    padding-bottom: 100%;    height: 0}.userItem-content {    display: -webkit-box;    display: -webkit-flex;    display: -ms-flexbox;    display: flex;    position: absolute;    top: 0;    bottom: 0;    left: 0;    right: 0;    padding: 10px;    -webkit-box-align: center;    -webkit-align-items: center;    -ms-flex-align: center;    align-items: center;    -webkit-flex-flow: column wrap;    -ms-flex-flow: column wrap;    flex-flow: column wrap;    -webkit-box-pack: center;    -webkit-justify-content: center;    -ms-flex-pack: center;    justify-content: center}.userItem-content .avatar {    border-radius: 100%}.userItem-name {    margin-top: 8px;    text-align: center}@media (max-width:900px) {    .userItem {        width: 33.33333%    }}@media (max-width:600px) {    .userItem {        width: 50%    }}</style>
<?php  get_footer(); ?>