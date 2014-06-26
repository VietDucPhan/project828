<?php
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
    echo $this->fetch('meta');
		echo $this->Html->css('skaterprofile');
    echo $this->Html->script('//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js');
    echo $this->Html->script('modernizr');
    echo $this->Html->script('foundation.min');
	?>
	<script>
	  $(document).ready(function(){
	    $(document).foundation();
	  });
	</script>
</head>
<body>
  <?php echo $this->element('mainNav/default'); ?>
  <div class="mainContent row">
    <div class="large-8 columns">
      <?php echo $this->fetch('content'); ?>
      <?php echo $this->element('sql_dump'); ?>
    </div>
    <div class="large-4 columns">
      &nbsp;
    </div>
    
  </div>
  
	
</body>
</html>
