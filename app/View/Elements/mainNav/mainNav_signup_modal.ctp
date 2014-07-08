<!-- Modal form sign up -->
<div id="signUpModal" class="reveal-modal tiny" data-reveal>
  <div class="title"><a class="close-reveal-modal">&#215;</a></div>
  <form data-abide method="post" action="users/register">
    <div class="row">
      <div class="large-12">
        
        <label> <?php echo __('Username'); ?>:
          <input data-tooltip class="has-tip" data-options="disable_for_touch:true" title="<?php echo __('Don\'t worry, you can change it later.'); ?>"  required name="data[username]" type="text" />
        </label>
        <small class="error"><?php echo __('Please enter your username'); ?></small>
      </div>
      <div class="large-12">
        <label> <?php echo __('Email'); ?>:
          <input data-tooltip class="has-tip" data-options="disable_for_touch:true" title="<?php echo __('What is your email address?'); ?>" required name="data[email]" type="email" />
          <small class="error"><?php echo __('Doesn\'t look like an email address'); ?></small>
        </label>
      </div>
      <div class="row">
      <div class="large-6 columns">
        <label> <?php echo __('Choose a password'); ?>:
          <input data-tooltip class="has-tip" data-options="disable_for_touch:true" title="<?php echo __('6 characters or more!'); ?>" required id="password" name="data[password]" type="password" />
          <small class="error"><?php echo __('Password must at least 6 characters'); ?></small>
        </label>
      </div>
      <div class="large-6 columns">
        <label> <?php echo __('Re-Type password'); ?>:
          <input data-tooltip class="has-tip" data-options="disable_for_touch:true" title="<?php echo __('Type your password again!'); ?>" data-equalto="password" name="data[repassword]" type="password" />
        </label>
        <small class="error"><?php echo __('Please enter password again'); ?></small>
      </div>
      </div>
      <div class="large-12 text-right">
        <button class="tiny radius">
          <?php echo __('Sign up'); ?>
        </button>
        </label>
      </div>
    </div>
  </form>
  
</div>