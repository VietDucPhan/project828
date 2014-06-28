<ul class="right">
  <li class="has-form">
    <a class="button radius" data-reveal-id="signInModal" href="#"><?php echo __('Sign in'); ?></a>
  </li>
  <li class="divider "></li>
  <li class="has-form">
    <a class="button radius" data-reveal-id="signUpModal" href="#"><?php echo __('Sign up'); ?></a>
  </li>
  <li class="divider "></li>
</ul>
<!-- Modal form login -->
<div id="signInModal" class="reveal-modal tiny" data-reveal>
  <form>
    <div class="row">
      <div class="large-12">
        <label> <?php echo __('Email'); ?>:
          <input type="text" />
        </label>
      </div>
      <div class="large-12">
        <label> <?php echo __('Password'); ?>:
          <input type="password" />
        </label>
      </div>
      <div class="large-12">
        <a href="#"><?php echo __('Forgot your password?'); ?></a>
      </div>
      <div class="large-12 text-right">
        <button class="tiny radius">
          <?php echo __('Sign in'); ?>
        </button>
        </label>
      </div>
    </div>
  </form>
  <a class="close-reveal-modal">&#215;</a>
</div>
<!-- Modal form sign up -->
<div id="signUpModal" class="reveal-modal tiny" data-reveal>
  <form>
    <div class="row">
      <div class="large-12">
        <label> <?php echo __('Email'); ?>:
          <input type="text" />
        </label>
      </div>
      <div class="row">
      <div class="large-6 columns">
        <label> <?php echo __('Choose a password'); ?>:
          <input type="password" />
        </label>
      </div>
      <div class="large-6 columns">
        <label> <?php echo __('Re-Type password'); ?>:
          <input type="password" />
        </label>
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
  <a class="close-reveal-modal">&#215;</a>
</div>