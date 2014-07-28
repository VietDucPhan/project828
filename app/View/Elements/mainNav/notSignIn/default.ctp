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
<?php echo $this->element('mainNav/notSignIn/default_signin_modal'); ?>
<?php echo $this->element('mainNav/notSignIn/default_signup_modal'); ?>