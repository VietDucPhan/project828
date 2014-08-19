<?php echo $this -> Form -> create('Company', array('url' => array('controller' => 'companies', 'action' => 'add'), 'data-abide', 'type' => 'file')); ?>
<div class="large-12 medium-12 small-12 columns shadow content_container">
  <div class="detail_poster_container row">
    <?php echo __('Company detail') ?>
  </div>
  <div class="detail_post_container">
      <div class="large-9 medium-9 small-12 large-centered medium-centered small-centered columns">
        <?php echo $this -> Form -> input('name', array('label' => __('Company name:'), 'required' => 'required', 'div' => false)); ?>
        <small class="error"><?php echo __('Please enter the company name'); ?></small>
      </div>
    <div class="large-9 medium-9 small-12 large-centered medium-centered small-centered columns">
      <div class="row">
        <div class="large-6 medium-6 small-12 columns">
        <?php echo $this -> Form -> input('launched_year', array('type'=>'date','required'=>'required','label' => 'Launched year', 'dateFormat' => 'Y','minYear' => date('Y') - 50,'maxYear' => date('Y'), 'div' => false ));
 ?>
        <small class="error"><?php echo __('Please enter the company launched year'); ?></small>
      </div>
      <div class="large-6 medium-6 small-12 columns">
        <?php echo $this -> Form -> input('closed_year', array('type'=>'date','label' => 'Closed year', 'dateFormat' => 'Y','minYear' => date('Y') - 50,'maxYear' => date('Y'),'empty'=>'Still operated, leave empty', 'default'=>'', 'div' => false ));
 ?>
      </div>
      </div>
    </div>
    <div class="large-9 medium-9 small-12 large-centered medium-centered small-centered columns">
      <?php echo $this -> Form -> input('profile_image', array('type' => 'file', 'label' => __('Photo:(<4MB and .jpg, .png only)'), 'div' => false)); ?>
    </div>
  </div>
</div>
<div class="large-12 medium-12 small-12 columns shadow content_container">
  <div class="detail_poster_container row">
    Team
  </div>
  <div class="detail_post_container">
    <div class="large-9 medium-9 small-12 large-centered medium-centered small-centered columns">
      <ul id="getSkaters-notIn" class="clearfix notIn">
      </ul>
    </div>
    <div class="large-9 medium-9 small-12 large-centered medium-centered small-centered columns">
      <div class="row collapse">
          <div class="small-10 columns">
            <?php echo $this -> Form -> input('sponsor', array('label' => false, 'div' => false, 'class' => 'dropdown ajaxContentAddSearch', 'data-dropdown' => 'getSkaters', 'data-controller'=>'Company', 'data-action'=>'sponsors', 'autocomplete' => 'off','id'=>'getSkaters-searchInput')); ?>
            <ul id="getSkaters" class="searchPanel" data-dropdown-content style="position: absolute;left: -99999px;top: 35px;">
              
            </ul>
          
          </div>
          <div class="small-2 columns">
            <a href="#" id="searchCompany" class="button postfix"><?php echo __('Search'); ?></a>
          </div>
        </div>
        
    </div>
  </div>
</div>
<div class="large-12 medium-12 small-12 columns shadow content_container">
  <div class="detail_poster_container row">
    Video released
  </div>
  <div class="detail_post_container">
    <div class="large-9 medium-9 small-12 large-centered medium-centered small-centered columns">
      <ul id="getVideos-notIn" class="clearfix notIn">
      </ul>
    </div>
    <div class="large-9 medium-9 small-12 large-centered medium-centered small-centered columns">
      <div class="row collapse">
          <div class="small-10 columns">
            <?php echo $this -> Form -> input('video', array('label' => false, 'div' => false, 'class' => 'dropdown ajaxContentAddSearch', 'data-dropdown' => 'getVideos', 'data-controller'=>'Company', 'data-action'=>'videos','autocomplete' => 'off','id'=>'getVideos-searchInput')); ?>
            <ul id="getVideos" class="searchPanel" data-dropdown-content style="position: absolute;left: -99999px;top: 35px;">
              
            </ul>
          
          </div>
          <div class="small-2 columns">
            <a href="#" id="searchCompany" class="button postfix"><?php echo __('Search'); ?></a>
          </div>
        </div>
        
    </div>
  </div>
</div>
<div class="large-12 medium-12 small-12 columns">
  <div class="large-12 medium-12 small-12 columns large-centered medium-centered small-centered">
    <button>Submit</button>
  </div>
</div>
<?php echo $this -> Form -> end(); ?>