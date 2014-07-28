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
 * @package       app.View.Emails.html
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<h1 style="color:#222222;font-family:'Helvetica','Arial',sans-serif;font-weight:normal;text-align:center;line-height:40px;word-break:normal;font-size:35px;margin:0;padding:0"><?php echo sprintf(__('Welcome to %s', FROMNAME)); ?></h1>
<p style="color:#999999;font-family:'Helvetica','Arial',sans-serif;font-weight:normal;text-align:center;line-height:21px;font-size:18px;margin:0 0 10px;padding:0" align="center"><?php echo __('The largest skateboarder profile website'); ?></p>
<p style="color:#999999;font-family:'Helvetica','Arial',sans-serif;font-weight:normal;text-align:center;line-height:21px;font-size:18px;margin:0 0 10px;padding:0" align="center">
  <img width="580" height="300" src="https://ci3.googleusercontent.com/proxy/oanzoXPkuO4qLyyEOdw8QFjQ_mKbI-sXq5rFSfwGUxSc7GnvV3c3VTv_Zw7FB7Fc2w=s0-d-e1-ft#http://placehold.it/580x300" style="outline:none;text-decoration:none;width:auto;max-width:100%;float:left;clear:both;display:block" align="left">
</p>
<p>
  <h6 style="color:#222222;font-weight:normal;text-align:left;line-height:1.3;word-break:normal;font-size:20px;margin:0;padding:0" align="left">Your sign in detail</h6>
  <p style="color:#222222;font-family:'Helvetica','Arial',sans-serif;font-weight:normal;text-align:left;line-height:19px;font-size:14px;margin:0 0 10px;padding:0" align="left">Email: <?php echo $email; ?><br>
                      </p>
</p>
<h6 style="color:#222222;font-family:'Helvetica','Arial',sans-serif;font-weight:normal;text-align:left;line-height:1.3;word-break:normal;font-size:20px;margin:0;padding:0" align="left">How to get the most out of SkaterProfile</h6><p style="color:#222222;font-family:'Helvetica','Arial',sans-serif;font-weight:normal;text-align:left;line-height:19px;font-size:14px;margin:0 0 10px;padding:0" align="left"></p>
                      <ul style="list-style:none">
                        <li>
                          Follow your favorite skateboarders or hommies to get their latest post
                        </li>
                        <li>
                          Discover new images and videos through 100 Radness and Search
                        </li>
                        <li>
                          Likes post and share post with skateboarders around the world
                        </li>
                      </ul><p style="color:#222222;font-family:'Helvetica','Arial',sans-serif;font-weight:normal;text-align:left;line-height:19px;font-size:14px;margin:0 0 10px;padding:0" align="left">

                      </p>
<a href="<?php echo $activateLink; ?>" style="color:#008cba;text-decoration:none" target="_blank">
<table cellspacing="0" cellpadding="0" width="100%" bgcolor="#008cba" style="border-collapse:collapse;border-width:1px;border-style:solid;display:block;font-weight:bold;border-radius:3px;font-size:14px;border-color:#008cba;text-align:center">
    <tbody>
      <tr><td height="7" colspan="3" style="line-height:7px">&nbsp;</td></tr>
      <tr>
        <td width="16" style="display:block;width:16px">&nbsp;</td>
        <td width="100%" style="text-align:center">
          <a href="<?php echo $activateLink; ?>" style="color:#008cba;text-decoration:none;display:block" target="_blank">
          <center>
            <font size="3"><span style="font-family:Helvetica Neue,Helvetica,Lucida Grande,tahoma,verdana,arial,sans-serif;font-weight:bold;font-size:14px;color:#ffffff">Activate Your Account</span></font>
          </center>
          </a>
        </td>
        <td width="16" style="display:block;width:16px">&nbsp;</td>
      </tr>
      <tr>
        <td height="7" colspan="3" style="line-height:7px">&nbsp;</td>
      </tr>
    </tbody>
  </table>
</a>