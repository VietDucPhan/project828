<?php echo $this -> Form -> create('User', array('url' => array('controller' => 'users', 'action' => 'login'), 'data-abide')); ?>
<?php echo $this->Session->flash('auth'); ?>
    <div class="row">
      <div class="large-12">
        <?php echo $this -> Form -> input('email', array('label' => __('Email'), 'required' => 'required', 'div' => false, 'id' => 'remind_email')); ?>
      </div>
      <div class="large-12">
        <?php echo $this -> Form -> input('password', array('label' => __('password'), 'required' => 'required', 'div' => false, 'id' => 'login_password')); ?>
      </div>
      <div class="large-12">
        <a class="showRemindPass" href="#"><?php echo __('Forgot your password?'); ?></a>
      </div>
      <div class="large-12 text-right">
        <button class="tiny radius">
          <?php echo __('Log in'); ?>
        </button>
        </label>
      </div>
    </div>
  <?php echo $this -> Form -> end(); ?>