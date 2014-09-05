<div class="large-8 columns">
  <div class="large-12 medium-12 small-12 columns shadow content_container">
    <div class="detail_poster_container row">
      Information <span data-ajax-href="<?php echo Router::url('/ajax/getEditInfoForm/'.$Skater['Skater']['id']); ?>" data-html-append-to="#edit_information" class="right edit"><?php echo __('Edit'); ?></span>
    </div>
    <div id="edit_information" class="detail_post_container">
      <p>
        Stance: <?php echo $Skater['Skater']['stance']; ?>
        <br/>
        Age: <?php echo $Skater['Skater']['birthdate']; ?>
        <br/>
        Status: <?php echo $Skater['Status']['status_title_en']; ?>
      </p>
    </div>
  </div>
  <div class="large-12 medium-12 small-12 columns shadow content_container">
    <div class="detail_poster_container row">
      Sponsors <span data-ajax-href="<?php echo Router::url('/ajax/getEditSponsorForm/'.$Skater['Skater']['id']); ?>" data-html-append-to="#edit_sponsors" class="right edit"><?php echo __('Edit'); ?></span>
    </div>
    <div id="edit_sponsors" class="detail_post_container">
      <p>
        <?php if(!empty($SkaterSponsors)): ?>
        <?php foreach($SkaterSponsors as $sponsor): ?>
          <?php echo $sponsor['Company']['name']; ?>,
        <?php endforeach; ?>
        <?php else: ?>
          <?php echo __('Don\'t have any sponsors') ?>
        <?php endif; ?>
      </p>
    </div>
  </div>
  <?php foreach($Skater['AllPostContent'] as $PostContent): ?>
    <?php 
    $Content[]['profile_img'] =  $Skater['ProfileImage']['img_url'];
    $Content['AllPostContent'] = $PostContent;
    $Content['Skater']['id'] = $Skater['Skater']['id'];
    $Content['Skater']['alias'] = $Skater['Skater']['alias'];
    echo $this->element("content/default",array('PostContent'=>$Content));
    ?>
  <?php endforeach; ?>
  
</div>
<div class="large-4 columns">
  <div class="row session_right radius shadow">
    <div class="large-12">
      <ul class="side-nav">
        <li>
          <a><img alt="<?php echo $Skater['Skater']['name']; ?>" title="<?php echo $Skater['Skater']['name']; ?>" src="<?php echo $Skater['ProfileImage']['img_url']; ?>" /></a>
        </li>
        <li>
          <a href="#"><?php echo $Skater['Skater']['name']; ?></a>
        </li>
        <li class="divider"></li>
        <li>
          <a href="#">All posts <span class="right"><?php echo sprintf(__('(%d)'),$AllPostCount) ?></span></a>
        </li>
        <!-- <li>
          <a href="#">Followers <span class="right">(200)</span></a>
        </li>
        <li>
          <a href="#">Following <span class="right">(158)</span></a>
        </li> -->
        <li class="title">
          Accounts
        </li>
        <li class="divider"></li>
        <li>
          <a href="#">Radness</a>
        </li>
        <li>
          <a href="#">Shit</a>
        </li>
        <li>
          <a href="#">Following</a>
        </li>
      </ul>
    </div>
  </div>
</div>
