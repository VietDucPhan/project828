<?php echo $this -> Form -> create('Skater', array('url' => array('controller' => 'skaters', 'action' => 'add'), 'data-abide','type'=>'file')); ?>
<div class="large-12 medium-12 small-12 columns shadow content_container">
  <div class="detail_poster_container row">
    Information
  </div>
  <div class="detail_post_container">
      <div class="large-9 medium-9 small-12 large-centered medium-centered small-centered columns">
        <?php echo $this -> Form -> input('firstname', array('label' => __('First name:'), 'required' => 'required', 'div' => false, 'data-options' => 'disable_for_touch:true', 'class' => 'has-tip', ' data-tooltip', 'title' => __('What is your first name?'))); ?>
        <small class="error"><?php echo __('Please enter your first name'); ?></small>
      </div>
      <div class="large-9 medium-9 small-12 large-centered medium-centered small-centered columns">
        <?php echo $this -> Form -> input('middlename', array('label' => __('Middle name:'), 'required' => 'required', 'div' => false, 'data-options' => 'disable_for_touch:true', 'class' => 'has-tip', ' data-tooltip', 'title' => __('What is your middle name?'))); ?>
        <small class="error"><?php echo __('Please enter your middle name'); ?></small>
      </div>
      <div class="large-9 medium-9 small-12 large-centered medium-centered small-centered columns">
        <?php echo $this -> Form -> input('lastname', array('label' => __('Last name:'), 'required' => 'required', 'div' => false, 'data-options' => 'disable_for_touch:true', 'class' => 'has-tip', ' data-tooltip', 'title' => __('What is your last name?'))); ?>
        <small class="error"><?php echo __('Please enter your last name'); ?></small>
      </div>
    <div class="large-9 medium-9 small-12 large-centered medium-centered small-centered columns">
      <div class="row">
        <div class="large-6 medium-6 small-12 columns">
        <?php $options = array(__('Regular'),__('Goofy')); echo $this -> Form -> input('stance', array('options'=>$options,'default'=>'','label' => __('Stance:'), 'required' => 'required', 'div' => false, 'data-options' => 'disable_for_touch:true', 'class' => 'has-tip', ' data-tooltip', 'title' => __('Right foot or left foot forward?'))); ?>
        <small class="error"><?php echo __('Please enter your last name'); ?></small>
      </div>
      <div class="large-6 medium-6 small-12 columns">
        <?php $options = array(__('Pro'),__('Am'),__('Flow'),__('Just skate')); echo $this -> Form -> input('status', array('options'=>$options,'default'=>3,'label' => __('Status:'), 'required' => 'required', 'div' => false, 'data-options' => 'disable_for_touch:true', 'class' => 'has-tip', ' data-tooltip', 'title' => __('Are you professional skateboarder?'))); ?>
        <small class="error"><?php echo __('Please enter your last name'); ?></small>
      </div>
      </div>
    </div>
    <div class="large-9 medium-9 small-12 large-centered medium-centered small-centered columns">
      <?php echo $this -> Form -> input('profile_image', array('type'=>'file','label' => __('Photo:'), 'div' => false)); ?>
    </div>
  </div>
</div>
<div class="large-12 medium-12 small-12 columns shadow content_container">
  <div class="detail_poster_container row">
    Sponsors
  </div>
  <div class="detail_post_container">
  <div class="large-9 medium-9 small-12 large-centered medium-centered small-centered columns">
    <p><?php echo __('Don\'t have any sponsors'); ?></p>
  </div>
  <div class="large-9 medium-9 small-12 large-centered medium-centered small-centered columns">
    <div class="row collapse">
        <div class="small-10 columns">
          <input type="text" placeholder="Search for company or brand">
        </div>
        <div class="small-2 columns">
          <a href="#" class="button postfix">add</a>
        </div>
      </div>
  </div>
  </div>
</div>
<div class="large-2 medium-2 small-5 columns large-centered medium-centered small-centered ">
  <div class="large-12 medium-12 small-12 columns large-centered medium-centered small-centered">
    <button>Submit</button>
  </div>
</div>
<?php echo $this -> Form -> end(); ?>