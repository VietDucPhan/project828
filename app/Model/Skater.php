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
class Skater extends AppModel {
  public $virtualFields = array(
    'name' => 'CONCAT(Skater.firstname," ",Skater.lastname)',
  );
  public $hasMany = array(
    'AllPostContent' => array(
      'className' => 'AllPostContent',
      'foreignKey' => 'is_added_by_skater'
    )
  );
  public $belongsTo = array(
    'ProfileImage' => array(
      'className' => 'AllPostContent',
      'foreignKey' => 'profile_img_id'
    )
  );
  public $validate = array(
    'alias' => array(
      'alias-rule-1' => array(
        'rule' => 'isUnique',
        'allowEmpty' => false,
        'required' => true,
        'message' => 'this skater already exist'
      )
    ),
    'firstname' => array(
      'firstname-rule-1' => array(
        'rule' => 'notEmpty',
        'required' => true,
        'allowEmpty' => false,
        'message' => 'First name must be provided'
      ),
      'firstname-rule-1' => array(
        'rule' => 'alphaNumeric',
        'message' => 'First name can not have special characters'
      )
    ),
    'middlename' => array(
      'middlename-rule-1' => array(
        'rule' => 'alphaNumeric',
        'allowEmpty' => true,
        'message' => 'Middle name can not have special characters'
      )
    ),
    'lastname' => array(
      'lastname-rule-1' => array(
        'rule' => 'notEmpty',
        'required' => true,
        'allowEmpty' => false,
        'message' => 'Last name must be provided'
      ),
      'lastname-rule-2' => array(
        'rule' => 'alphaNumeric',
        'message' => 'Last name can not have special characters'
      )
    ),
    'stance' => array(
      'stance-rule-1' => array(
        'rule' => 'numeric',
        'message' => 'Please specifize your stance'
      )
    ),
    'birthdate' => array(
      'birthdate-rule-1' => array(
        'rule' => array('date', 'ymd'),
        'message' => 'Please enter your birthdate'
      )
    ),
    'status' => array(
      'status-rule-1' => array(
        'rule' => 'numeric',
        'message' => 'Please specifize your status'
      )
    ),
  );
}
