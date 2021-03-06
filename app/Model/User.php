<?php
/**
 * Application model for CakePHP.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
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
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppModel', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class User extends AppModel {
  //Table name
  public $name = 'users';
  public $validate = array(
    'email' => array(
      'email-rule-1' => array(
        'rule' => 'email',
        'required' => true,
        'allowEmpty' => false,
        'message' => 'Invalid email.'
      ),
      'email-rule-2' => array(
        'rule' => 'isUnique',
        'message' => 'This email already registered.'
      ),
    ),
    'password' => array(
      'password-rule-1' => array(
        'rule' => array('minLength',6),
        'required' => true,
        'allowEmpty' => false,
        'message' => 'Password must be entered and at leat 6 characters'
      )
    ),
    'resetCode' => array(
      'reset-rule-1' => array(
        'rule' => 'notEmpty',
        'message' => 'Your reset code was not matched'
      )
    ),
  );
}
