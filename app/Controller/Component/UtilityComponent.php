<?php

App::uses('Component', 'Controller');

class UtilityComponent extends Component {
  /**
   * Create a random seed
   * @return int
   */
  public function uniqueSeed() {
    return uniqid(mt_rand(), true);
  }
  
  
  /**
   * Method to return datetime sql format
   * @param string $time string of date to convert
   * @return string in sql format datetime Y-m-d H:i:s
   */
  public function dateToSql($time = 'now'){
    return date('Y-m-d H:i:s',strtotime($time));
  }

  /**
   * Method to reorder multiple images uploaded.
   * @param array $files an array contains files uploaded
   * @return array array of files were re-ordered
   */
  public static function reorderImageArrayFiles($files) {
    if (is_null($files) || empty($files)) {
      return false;
    }
    $numberOfImages = count($files['name']);
    $reorderedImages = array();
    for ($i = 0; $i < $numberOfImages; $i++) {
      if (isset($files['name'][$i]) && isset($files['type'][$i]) && isset($files['tmp_name'][$i]) && $files['error'][$i] == 0) {
        $data['name'] = $files['name'][$i];
        $data['type'] = $files['type'][$i];
        $data['tmp_name'] = $files['tmp_name'][$i];
        $data['error'] = $files['error'][$i];
        $data['size'] = $files['size'][$i];
        $reorderedImages[] = $data;
      }
    }
    return $reorderedImages;
  }

  /**
   * Method to validate email address
   * @param string $email email address
   * @return boolean true or false
   */
  public static function validateEmail($email) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      return false;
    }
    return true;
  }

  /**
   * Method to check whether a website are real
   * @param string $url the website address
   * @return boolean true on success
   */
  public static function validateUrl($url) {
    $agent = "Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_5_8; pt-pt) AppleWebKit/533.20.25 (KHTML, like Gecko) Version/5.0.4 Safari/533.20.27";
    // initializes curl session
    $ch = curl_init();
    // sets the URL to fetch
    curl_setopt($ch, CURLOPT_URL, $url);
    // sets the content of the User-Agent header
    curl_setopt($ch, CURLOPT_USERAGENT, $agent);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

    // return the transfer as a string
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    // disable output verbose information
    curl_setopt($ch, CURLOPT_VERBOSE, false);

    // max number of seconds to allow cURL function to execute
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);

    curl_exec($ch);

    // get HTTP response code
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    curl_close($ch);

    if ($httpcode >= 200 && $httpcode < 300)
      return true;
    else
      return false;
  }
  
  /**
   * Method to limit number of words
   * @param string $string of words
   * @param int $num_words number of word to appear
   */
  public static function limitWords($string, $num_words = 100) {
    //Pull an array of words out from the string (you can specify what delimeter you'd like)
    $array_of_words = explode(" ", $string);
    $output = "";
    //Loop the array the requested number of times and build an output, re-inserting spaces.
    for ($i = 0; $i <= $num_words; $i++) {
      if (isset($array_of_words[$i])) {
        $output .= $array_of_words[$i] . " ";
      }

    }
    return trim($output);
  }

}
?>