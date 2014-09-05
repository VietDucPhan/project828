<?php echo $this -> Form -> create('Skater', array('url' => array('controller' => 'skaters', 'action' => 'add'), 'data-abide', 'type' => 'file')); ?>
<div class="large-12 medium-12 small-12 columns shadow content_container">
  <div class="detail_poster_container row">
    <?php echo __('Add skater') ?>
  </div>
  <div class="detail_post_container">
      <div class="large-9 medium-9 small-12 large-centered medium-centered small-centered columns">
        <?php echo $this -> Form -> input('firstname', array('label' => __('First name:'), 'required' => 'required', 'div' => false,  'title' => __('What is your first name?'))); ?>
        <small class="error"><?php echo __('Please enter your first name'); ?></small>
      </div>
      <div class="large-9 medium-9 small-12 large-centered medium-centered small-centered columns">
        <?php echo $this -> Form -> input('middlename', array('label' => __('Middle name:'), 'required' => false, 'div' => false,  'title' => __('What is your middle name?'))); ?>
      </div>
      <div class="large-9 medium-9 small-12 large-centered medium-centered small-centered columns">
        <?php echo $this -> Form -> input('lastname', array('label' => __('Last name:'), 'required' => 'required', 'div' => false,  'title' => __('What is your last name?'))); ?>
        <small class="error"><?php echo __('Please enter your last name'); ?></small>
      </div>
    <div class="large-9 medium-9 small-12 large-centered medium-centered small-centered columns">
      <div class="row">
        <div class="large-6 medium-6 small-12 columns">
        <?php $options = array(__('Regular'), __('Goofy'));
          echo $this -> Form -> input('stance', array('options' => $options, 'default' => '', 'label' => __('Stance:'), 'required' => 'required', 'div' => false));
 ?>
        <small class="error"><?php echo __('Please enter your last name'); ?></small>
      </div>
      <div class="large-6 medium-6 small-12 columns">
        <?php echo $this -> Form -> input('status', array('options' => $Status, 'default' => 3, 'label' => __('Status:'), 'required' => 'required', 'div' => false));
 ?>
        <small class="error"><?php echo __('Please enter your last name'); ?></small>
      </div>
      </div>
    </div>
    <div class="large-9 medium-9 small-12 large-centered medium-centered small-centered columns">
      <?php echo $this -> Form -> input('AllPostContent.cover_photo', array('type' => 'file', 'label' => __('Cover photo:(<4MB and .jpg, .png only)'), 'div' => false)); ?>
    </div>
  </div>
</div>

<div class="large-12 medium-12 small-12 columns">
  <div class="large-12 medium-12 small-12 columns large-centered medium-centered small-centered">
    <button>Submit</button>
  </div>
</div>
<?php echo $this -> Form -> end(); ?>