<?php echo $this -> Form -> create('AllPostContent', array('url' => array('controller' => 'skaters', 'action' => 'addVideo'), 'data-abide', 'type' => 'file')); ?>
  <div class="row">
    <div class="large-12 medium-12 small-12">
      <?php echo $this -> Form -> input('video_link', array('type'=>'url','label' => __('Link:'), 'required' => 'required', 'div' => false)); ?>
      <small class="error">Please enter video link. Our system work best with youtube and vimeo</small>
    </div>
    <div class="large-12 medium-12 small-12">
      <?php echo $this -> Form -> input('desc', array('type'=>'textarea','pattern'=>'','label' => __('Description (optional):'), 'div' => false)); ?>
    </div>
    <div class="large-12 medium-12 small-12">
      <?php echo $this -> Form -> input('img_url', array('type'=>'file','label' => __('Cover photo (optional):'), 'div' => false)); ?>
    </div>
    <div class="row">
    <div class="large-3 medium-3 small-3 columns"><button>Post</button></div>
    <!-- <div class="large-3 medium-3 small-3 columns"><span class="button">Preview</span></div> -->
    <div class="large-6 medium-6 small-6 columns"></div>
    </div>
  </div>
  <?php echo $this -> Form -> input('ContentSkaterRelation.skater_id', array('type'=>'hidden','default'=>$skater_id, 'div' => false)); ?>
<?php echo $this -> Form -> end(); ?>