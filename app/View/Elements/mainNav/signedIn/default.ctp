<ul class="right usermenu">
  <li class="divider "></li>
  <li class="plusOne">
    <?php echo $this -> element('mainNav/signedIn/default_plus_one'); ?>
  </li>
  <li class="divider "></li>
  <li>
    <a href="#">#<?php echo AuthComponent::user('username'); ?></a>
  </li>
  <li class="divider "></li>
  <li>
    <a href="#"><?php echo __('Notifications'); ?></a>
  </li>
  <li class="divider "></li>
  <li>
    <?php echo $this -> element('mainNav/signedIn/default_setting'); ?>
  </li>
  <li class="divider "></li>
</ul>