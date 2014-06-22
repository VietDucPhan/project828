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
    <?php echo $this -> Html -> charset(); ?>
    <title><?php echo $title_for_layout; ?></title>
    <?php 
    echo $this -> Html -> meta('icon');
    echo $this->Html->css("skaterprofile");
    ?>
  </head>
  <body>
    <div class="head">
      <div class="wrapper">
      <div class="box">
        <form>
          <input type="text" placeholder="search" />
        </form>
      </div>
      <div class="box"></div>
      </div>
    </div>
    <div class="wrapper">
      <div class="mainWrapper">
        <div class="leftSection">
          <div class="post">
            <div class="postImage">
              <img src="https://38.media.tumblr.com/814c113b912c42b242f6e12121ccb57e/tumblr_mpzvrpcQfz1rkbo6ho1_400.gif" />
            </div>
            <div class="postDetail">
              <h2>caption goes here</h2>
              <p>post by <a>Some one</a> about 1 minutes ago</p>
            </div>
          </div>
        </div>
        <div class="rightSection"></div>
        <div style="height:1000px;"></div>
      </div>
    </div>
    <?php echo $this -> Session -> flash(); ?>
    <?php echo $this -> fetch('content'); ?>
    <?php echo $this -> element('sql_dump'); ?>
  </body>
</html>
