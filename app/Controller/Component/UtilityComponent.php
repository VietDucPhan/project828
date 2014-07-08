<?php

App::uses('Component', 'Controller');

class UtilityComponent extends Component {
  /**
   * Create a random seed
   * @return int
   */
  public function uniqueSeed(){
    return uniqid(mt_rand(), true);
  }
}
?>