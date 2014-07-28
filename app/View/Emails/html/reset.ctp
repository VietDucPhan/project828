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
<table cellspacing="0" cellpadding="0" style="border-collapse:collapse;width:100%">
  <tbody>
    <tr>
      <td style="font-size:11px;font-family:LucidaGrande,tahoma,verdana,arial,sans-serif;padding-bottom:6px">
      <div>
        Somebody recently asked to reset your <?php echo FROMNAME; ?> password.
      </div><a href="<?php echo $resetLink; ?>" style="color:#008cba;text-decoration:none" target="_blank">Click here to change your password.</a></td>
    </tr>
    <tr>
      <td style="font-size:11px;font-family:LucidaGrande,tahoma,verdana,arial,sans-serif;padding-top:6px;padding-bottom:6px">
      <div>
        <span style="color:#333333;font-weight:bold">Didn't request this change?</span>
      </div>If you didn't request a new password, <a href="#" style="color:#008cba;text-decoration:none" target="_blank">let us know immediately</a>.</td>
    </tr>
    <tr>
      <td style="font-size:11px;font-family:LucidaGrande,tahoma,verdana,arial,sans-serif;padding-top:6px"><a href="<?php echo $resetLink; ?>" style="color:#008cba;text-decoration:none" target="_blank">
      <table cellspacing="0" cellpadding="0" width="100%" bgcolor="#008cba" style="border-collapse:collapse;border-width:1px;border-style:solid;display:block;font-weight:bold;border-radius:3px;font-size:14px;border-color:#008cba;text-align:center">
        <tbody>
          <tr>
            <td height="7" colspan="3" style="line-height:7px">&nbsp;</td>
          </tr>
          <tr>
            <td width="16" style="display:block;width:16px">&nbsp;</td><td width="100%" style="text-align:center"><a href="<?php echo $resetLink; ?>" style="color:#008cba;text-decoration:none;display:block" target="_blank">
            <center>
              <font size="3"><span style="font-family:Helvetica Neue,Helvetica,Lucida Grande,tahoma,verdana,arial,sans-serif;font-weight:bold;font-size:14px;color:#ffffff">Change&nbsp;Password</span></font>
            </center></a></td><td width="16" style="display:block;width:16px">&nbsp;</td>
          </tr>
          <tr>
            <td height="7" colspan="3" style="line-height:7px">&nbsp;</td>
          </tr>
        </tbody>
      </table></a></td>
    </tr>
  </tbody>
</table>