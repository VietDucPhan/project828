<div class="large-12 medium-12 small-12 columns shadow content_container">
  <div class="detail_post_container">
    <img title="<?php echo $PostContent['AllPostContent']['desc']; ?>" alt="<?php echo $PostContent['AllPostContent']['desc']; ?>" src="<?php echo $PostContent['AllPostContent']['img_url']; ?>" />
  </div>
  <div class="description_container">
    <?php echo $PostContent['AllPostContent']['desc']; ?>
  </div>
  <div class="detail_poster_container row">
    <a href="<?php echo Router::url('/skater/'.$PostContent['Skater']['id']); ?>"><img width="30" src="<?php echo $PostContent[0]['profile_img']; ?>" /></a> 
    <a href="<?php echo Router::url('/skater/'.$PostContent['Skater']['id']); ?>"><?php echo $PostContent['Skater']['alias']; ?></a> is share a picture.
  </div>
</div>