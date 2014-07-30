<?php echo $this -> Form -> create('User', array('url' => array('controller' => 'users', 'action' => 'reset'), 'data-abide')); ?>
    <div class="row">
      <div class="large-12">
        <label> <?php echo __('Email'); ?>:
          <input required type="email" name="email" />
        </label>
      </div>
      <div class="large-12">
        <a class="showLoginForm" href="#"><?php echo __('Oh, I remember it!'); ?></a>
      </div>
      <div class="large-12 text-right">
        <button class="tiny radius">
          <?php echo __('Reset password'); ?>
        </button>
        </label>
      </div>
    </div>
  <?php echo $this -> Form -> end(); ?>