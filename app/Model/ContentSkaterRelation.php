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
class ContentSkaterRelation extends AppModel {
  public $belongsTo = array(
        'AllPostContent' => array(
            'className' => 'AllPostContent',
            'foreignKey' => 'content_id'
        )
    );
  /**
   * Get all contents that were post by skater or added to skater by another skater
   * @param int $id skater id
   * @return mixed array of data on success or false otherwise
   */
  public function getContentBelongToSkater($id){
    $this -> unbindModel(array('belongsTo' => array('AllPostContent')));
    $ContentSkaterRelationJoins = array(
        array(
          'table' => 'all_post_contents',
          'alias' => 'AllPostContent',
          'type' => 'LEFT',
          'conditions' => array(
            'AllPostContent.id = ContentSkaterRelation.content_id',
          )
        ),
        array(
          'table' => 'skaters',
          'alias' => 'Skater',
          'type' => 'LEFT',
          'conditions' => array(
            'AllPostContent.is_added_by_skater = Skater.id',
          )
        ),
        array(
          'table' => 'all_post_contents',
          'alias' => 'profile',
          'type' => 'LEFT',
          'conditions' => array(
            'Skater.profile_img_id = profile.id',
          )
        )
       );
       $fields = array('AllPostContent.id','AllPostContent.desc','AllPostContent.img_url','AllPostContent.link_url','AllPostContent.link_img_url','AllPostContent.link_title','AllPostContent.created_date','AllPostContent.is_added_by_skater','Skater.id','Skater.alias',"IFNULL(profile.img_url,'$this->noImage') AS profile_img");
      $ContentSkaterRelation = $this -> find('all',array('conditions'=>array('ContentSkaterRelation.skater_id'=>$id),
                'joins'=>$ContentSkaterRelationJoins,
                'fields'=>$fields
      ));
      
      return $ContentSkaterRelation;
  }
}
