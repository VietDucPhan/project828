<?php

App::uses('Component', 'Controller');
//import cake email
App::uses('CakeEmail', 'Network/Email');

class EmailComponent extends Component {
  /**
   * Send confirmation email to user
   * @param string $to Receiver email
   * @param array $body Email content including username, activation url
   */
  public function confirmEmail($to,$activateLink){
    App::uses('CakeEmail', 'Network/Email');
    $subject = 'Welcome to ' . FROMNAME . '!';
    //declare email class
    $email = new CakeEmail();
    //config email
    $email -> config('smtp');
    $email -> template('default','default');
    $email -> emailFormat('html');
    $email->to($to);
    $email->subject($subject);
    $email->viewVars(array('content' => 12345,'activateLink' => $activateLink));
    $email->send();
  }
}
?>