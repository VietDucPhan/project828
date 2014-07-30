<?php echo $this -> Form -> create('User', array('url' => array('controller' => 'users', 'action' => 'recover'), 'data-abide'));
if (empty($code)) {
  $code = '';
}
?>
      <div class="large-12">
          <?php echo $this -> Form -> input('password', array('label' => __('Your new password'), 'required' => 'required', 'div' => false, 'id' => 'newPassword')); ?>
          <small class="error"><?php echo __('Please enter your new password'); ?></small>
      </div>
      <div class="large-12">
          <?php echo $this -> Form -> input('repassword', array('label' => __('Retype your new password'), 'required' => 'required', 'div' => false, 'data-equalto' => 'newPassword')); ?>
          <small class="error"><?php echo __('Password did not match'); ?></small>
      </div>
      <div class="large-12 text-right">
        <button class="tiny radius">
          <?php echo __('Update'); ?>
        </button>
        <?php echo $this -> Form -> input('resetCode', array('label' => false, 'div' => false, 'value' => $code, 'type' => 'hidden')); ?>
      </div>
  <?php echo $this -> Form -> end(); ?>