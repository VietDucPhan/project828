<?php

App::uses('Component', 'Controller');
//import cake email
App::uses('CakeEmail', 'Network/Email');

class EmailComponent extends Component {
  /**
   * Send confirmation email to user
   * @param string $to Receiver email
   * @param array $activateLink Link to activate account
   * @return bool true on success send email, false otherwise
   */
  public function confirm($to,$activateLink){
    $subject = sprintf(__('Welcome to %s', FROMNAME));
    //declare email class
    $email = new CakeEmail();
    //config email
    $email -> config('smtp');
    $email -> template('confirm');
    $email -> emailFormat('html');
    $email->to($to);
    $email->subject($subject);
    $email->viewVars(array('email' => $to,'activateLink' => $activateLink));
    if($email->send()){
      return true;
    }
    return false;
  }
  /**
   * Send reset information to user
   * @param string $to receiver email
   * @param string $resetLink link to reset account password
   */
  public function reset($to, $resetLink){
    $subject = sprintf(__('Somebody requested a new password for your %s account'),FROMNAME);
    //declare email class
    $email = new CakeEmail();
    //config email
    $email -> config('smtp');
    $email -> template('reset');
    $email -> emailFormat('html');
    $email->to($to);
    $email->subject($subject);
    $email->viewVars(array('resetLink' => $resetLink));
    if($email->send()){
      return true;
    }
    return false;
  }
}
?>