<div class="large-12 medium-12 small-12 columns shadow content_container">
  <div class="detail_post_container flex-video">
    <iframe frameborder="0" allowfullscreen src="<?php echo $PostContent['AllPostContent']['embed_url']; ?>"></iframe>
  </div>
  <div class="description_container">
    <?php echo $PostContent['AllPostContent']['desc']; ?>
  </div>
  <div class="detail_poster_container row">
    <a href="<?php echo Router::url('/skater/'.$PostContent['Skater']['id']); ?>"><img width="30" src="<?php echo $PostContent[0]['profile_img']; ?>" /></a> 
    <a href="<?php echo Router::url('/skater/'.$PostContent['Skater']['id']); ?>"><?php echo $PostContent['Skater']['alias']; ?></a>
  </div>
</div>