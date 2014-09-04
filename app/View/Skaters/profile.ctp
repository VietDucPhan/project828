<?php print_r($Skater); ?>
<div class="large-8 columns">
  <div class="large-12 medium-12 small-12 columns shadow content_container">
    <div class="detail_poster_container row">
      Information
    </div>
    <div class="detail_post_container">
      <p>

        Hometown: <?php //echo $skaterData['hometown']; ?>
        <br/>
        Stance: <?php echo $Skater['Skater']['stance']; ?>
        <br/>
        Age: <?php echo $Skater['Skater']['birthdate']; ?>
        <br/>
        Status: <?php echo $Skater['Skater']['status']; ?>

      </p>
    </div>
  </div>
  <div class="large-12 medium-12 small-12 columns shadow content_container">
    <div class="detail_poster_container row">
      Sponsors
    </div>
    <div class="detail_post_container">
      <p>
        Sponsors: Flip Skateboards, Volcom, Indy, Ricta, Mob Grip, Momentum Ride Shop, Bones Swiss, Converse, Loud Headphones

      </p>
    </div>
  </div>
  
</div>
<div class="large-4 columns">
  <div class="row session_right radius shadow">
    <div class="large-12">
      <ul class="side-nav">
        <li>
          <a href="#"><?php echo $Skater['Skater']['name']; ?></a>
        </li>
        <li class="divider"></li>
        <li>
          <a href="#">All posts <span class="right"><?php echo sprintf(__('(%d)'),$AllPost) ?></span></a>
        </li>
        <li>
          <a href="#">Followers <span class="right">(200)</span></a>
        </li>
        <li>
          <a href="#">Following <span class="right">(158)</span></a>
        </li>
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
