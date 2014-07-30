<?php echo $this -> Form -> create('User', array('url' => array('controller' => 'users', 'action' => 'add'), 'data-abide')); ?>
    <div class="row">
      <div class="large-12">
        <?php echo $this -> Form -> input('email', array('label' => __('Email:'), 'required' => 'required', 'div' => false,'data-options'=>'disable_for_touch:true','class' => 'has-tip',' data-tooltip','title' => __('What is your email address?'))); ?>
        <small class="error"><?php echo __('Doesn\'t look like an email address'); ?></small>
      </div>
      <div class="large-12">
        <?php echo $this -> Form -> input('email', array('label' => __('Re-type your email:'), 'required' => 'required', 'div' => false,'data-options'=>'disable_for_touch:true','class' => 'has-tip',' data-tooltip','title' => __('Please re-type your email'),'id' => 'retypeEmail','data-equalto' => 'email')); ?>
        <small class="error"><?php echo __('Please type your email again'); ?></small>
      </div>
      <div class="row">
        <div class="large-6 columns">
          <?php echo $this -> Form -> input('password', array('label' => __('Password:'), 'required' => 'required', 'div' => false,'data-options'=>'disable_for_touch:true','class' => 'has-tip',' data-tooltip','title' => __('6 characters or more!'))); ?>
        <small class="error"><?php echo __('Please enter your password'); ?></small>
        </div>
        <div class="large-6 columns">
          <?php echo $this -> Form -> input('password', array('label' => __('Re-type your password:'), 'required' => 'required', 'div' => false,'data-options'=>'disable_for_touch:true','class' => 'has-tip',' data-tooltip','title' => __('Type your password again'),'id' => 'rePassword','data-equalto' => 'password')); ?>
        <small class="error"><?php echo __('Please enter your password again'); ?></small>
        </div>
      </div>
      <div class="large-12 text-right">
        <button class="tiny radius">
          <?php echo __('Sign up'); ?>
        </button>
        </label>
      </div>
    </div>
<?php echo $this -> Form -> end(); ?>