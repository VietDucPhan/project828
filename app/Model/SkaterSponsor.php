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
class SkaterSponsor extends AppModel {
   public $belongsTo = array(
        'Company' => array(
            'className' => 'Company',
            'foreignKey' => 'company_id'
        )
    );
    
    /**
     * get sponsors of a skater
     * @param int $id
     * @return array
     */
    public function getAllSkaterSponsor($id){
      $this -> unbindModel(array('belongsTo' => array('Company')));
      $joins = array(
        array(
          'table' => 'companies',
          'alias' => 'Company',
          'type' => 'LEFT',
          'conditions' => array(
            'SkaterSponsor.company_id = Company.id',
          )
        ),
        array(
          'table' => 'all_post_contents',
          'alias' => 'ProfileImage',
          'type' => 'LEFT',
          'conditions' => array(
            'ProfileImage.id = Company.profile_img_id',
          )
        )
      );
      $fields = array("IFNULL(ProfileImage.img_url,'$this->noImage') AS profile_img","Company.name","Company.id","Company.alias","Company.launched_year","Company.closed_year");
      $results = $this -> find('all',array('conditions'=>array('SkaterSponsor.skater_id'=>$id),
                'joins'=>$joins,
                'fields'=>$fields
      ));
      return $results;
    }
}
