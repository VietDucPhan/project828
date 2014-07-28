<!-- Modal form login -->
<div id="signInModal" class="reveal-modal tiny" data-reveal>
  <div id="loginForm">
  <?php echo $this -> Form -> create(null, array('url' => array('controller' => 'users', 'action' => 'login'), 'data-abide')); ?>
    <div class="row">
      <div class="large-12">
        <label> <?php echo __('Email'); ?>:
          <input required type="email" />
        </label>
      </div>
      <div class="large-12">
        <label> <?php echo __('Password'); ?>:
          <input required type="password" />
        </label>
      </div>
      <div class="large-12">
        <a class="showRemindPass" href="#"><?php echo __('Forgot your password?'); ?></a>
      </div>
      <div class="large-12 text-right">
        <button class="tiny radius">
          <?php echo __('Sign in'); ?>
        </button>
        </label>
      </div>
    </div>
  <?php echo $this -> Form -> end(); ?>
  </div>
  <div id="remindPass">
  <?php echo $this -> Form -> create(null, array('url' => array('controller' => 'users', 'action' => 'reset'), 'data-abide')); ?>
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
</div>
  <a class="close-reveal-modal">&#215;</a>
</div>