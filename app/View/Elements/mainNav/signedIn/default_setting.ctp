<a href="#" data-dropdown="settingPanel"><?php echo __('Setting'); ?></a>
<div id="settingPanel" class="f-dropdown" data-dropdown-content>
  <ul>
    <li>
      <a href="<?php echo Router::url(array('controller'=>'Users','action'=>'logout')); ?>"><?php echo __('logout') ?></a>
    </li>
  </ul>
</div>
