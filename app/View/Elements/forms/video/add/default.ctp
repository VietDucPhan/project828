<?php echo $this -> Form -> create('Video', array('url' => array('controller' => 'skaters', 'action' => 'add'), 'data-abide', 'type' => 'file')); ?>
<div class="large-12 medium-12 small-12 columns shadow content_container">
  <div class="detail_poster_container row">
    <?php echo __('Video\'s information') ?>
  </div>
  <div class="detail_post_container">
      <div class="large-9 medium-9 small-12 large-centered medium-centered small-centered columns">
        <?php echo $this -> Form -> input('firstname', array('label' => __('Title:'), 'required' => 'required', 'div' => false)); ?>
        <small class="error"><?php echo __('Please enter video\'s title'); ?></small>
      </div>
    <div class="large-9 medium-9 small-12 large-centered medium-centered small-centered columns">
      <div class="row">
        <div class="large-6 medium-6 small-12 columns">
        <?php echo $this -> Form -> input('released_year', array('type'=>'date','label' => 'Released year', 'dateFormat' => 'Y','minYear' => date('Y') - 50,'maxYear' => date('Y'), 'div' => false ));
 ?>
        <small class="error"><?php echo __('Please enter your last name'); ?></small>
      </div>
      <div class="large-6 medium-6 small-12 columns">
        <?php echo $this -> Form -> input('length', array('label' => __('Running time:'),'type'=>'number', 'required' => 'required', 'div' => false));
 ?>
        <small class="error"><?php echo __('Please enter length of the video'); ?></small>
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
    Company
  </div>
  <div class="detail_post_container">
    <div class="large-9 medium-9 small-12 large-centered medium-centered small-centered columns">
      <ul id="getCompanies-notIn" class="clearfix notIn">
      </ul>
    </div>
    <div class="large-9 medium-9 small-12 large-centered medium-centered small-centered columns">
      <div class="row collapse">
          <div class="small-10 columns">
            <?php echo $this -> Form -> input('sponsor', array('label' => false, 'div' => false, 'class' => 'dropdown ajaxContentAddSearch', 'data-dropdown' => 'getCompanies', 'data-controller'=>'Video', 'data-action'=>'companies','autocomplete' => 'off','id'=>'getCompanies-searchInput')); ?>
            <ul id="getCompanies" class="searchPanel" data-dropdown-content style="position: absolute;left: -99999px;top: 35px;">
              
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
    Video parts
  </div>
  <div class="detail_post_container">
    <div class="large-9 medium-9 small-12 large-centered medium-centered small-centered columns">
      <ul id="getSkaters-notIn" class="clearfix notIn">
      </ul>
    </div>
    <div class="large-9 medium-9 small-12 large-centered medium-centered small-centered columns">
      <div class="row collapse">
          <div class="small-10 columns">
            <?php echo $this -> Form -> input('skater', array('label' => false, 'div' => false, 'class' => 'dropdown ajaxContentAddSearch', 'data-dropdown' => 'getSkaters', 'data-controller'=>'Video', 'data-action'=>'skaters','autocomplete' => 'off','id'=>'getSkaters-searchInput')); ?>
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
<div class="large-12 medium-12 small-12 columns">
  <div class="large-12 medium-12 small-12 columns large-centered medium-centered small-centered">
    <button>Submit</button>
  </div>
</div>
<?php echo $this -> Form -> end(); ?>