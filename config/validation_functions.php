<?php
/*!
  \brief Validation functions
  \author Danil
  \version 1.0
  \date 21.06.2018

  Validation functions for Signin and Registration, reservations
*/

  /**
   * Determines if blank.
   *
   * @param      <type>   $value  The value
   *
   * @return     boolean  True if blank, False otherwise.
   */
  function is_blank($value) {
    return !isset($value) || trim($value) === '';
  }

  /**
   * Determines if it has presence.
   *
   * @param      <type>   $value  The value
   *
   * @return     boolean  True if has presence, False otherwise.
   */
  function has_presence($value) {
    return !is_blank($value);
  }


  /**
   * Determines if it has length greater than.
   *
   * @param      <type>   $value  The value
   * @param      integer  $min    The minimum
   *
   * @return     boolean  True if has length greater than, False otherwise.
   */
  function has_length_greater_than($value, $min) {
    $length = strlen($value);
    return $length > $min;
  }

  /**
   * Determines if it has length less than.
   *
   * @param      <type>   $value  The value
   * @param      integer  $max    The maximum
   *
   * @return     boolean  True if has length less than, False otherwise.
   */
  function has_length_less_than($value, $max) {
    $length = strlen($value);
    return $length < $max;
  }

  /**
   * Determines if it has length exactly.
   *
   * @param      <type>   $value  The value
   * @param      <type>   $exact  The exact
   *
   * @return     boolean  True if has length exactly, False otherwise.
   */
  function has_length_exactly($value, $exact) {
    $length = strlen($value);
    return $length == $exact;
  }


  /**
   * Determines if it has length.
   *
   * @param      <type>   $value    The value
   * @param      <type>   $options  The options
   *
   * @return     boolean  True if has length, False otherwise.
   */
  function has_length($value, $options) {
    if(isset($options['min']) && !has_length_greater_than($value, $options['min'] - 1)) {
      return false;
    } elseif(isset($options['max']) && !has_length_less_than($value, $options['max'] + 1)) {
      return false;
    } elseif(isset($options['exact']) && !has_length_exactly($value, $options['exact'])) {
      return false;
    } else {
      return true;
    }
  }


  /**
   * Determines if it has inclusion of.
   *
   * @param      <type>   $value  The value
   * @param      <type>   $set    The set
   *
   * @return     boolean  True if has inclusion of, False otherwise.
   */
  function has_inclusion_of($value, $set) {
  	return in_array($value, $set);
  }


  /**
   * Determines if it has exclusion of.
   *
   * @param      <type>   $value  The value
   * @param      <type>   $set    The set
   *
   * @return     boolean  True if has exclusion of, False otherwise.
   */
  function has_exclusion_of($value, $set) {
    return !in_array($value, $set);
  }


  /**
   * Determines if it has string.
   *
   * @param      <type>   $value            The value
   * @param      <type>   $required_string  The required string
   *
   * @return     boolean  True if has string, False otherwise.
   */
  function has_string($value, $required_string) {
    return strpos($value, $required_string) !== false;
  }


  /**
   * Determines if it has valid email format.
   *
   * @param      <type>   $value  The value
   *
   * @return     boolean  True if has valid email format, False otherwise.
   */
  function has_valid_email_format($value) {
    $email_regex = '/\A[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}\Z/i';
    return preg_match($email_regex, $value) === 1;
  }

  /**
   * Determines if it has unique username.
   *
   * @param      <type>   $username    The username
   * @param      string   $current_id  The current identifier
   *
   * @return     boolean  True if has unique username, False otherwise.
   */
  function has_unique_username($username, $current_id="0") {
    $user = Users::find_by_username($username);
    if($user === false || $user->id == $current_id) {
      // is unique
      return true;
    }
    $staff = Staff::find_by_username($username); 
    if ($staff === false || $staff->id == $current_id) {
      return true;
    } else {
      // not unique
      return false;
    }
  }

  /**
   * { function_description }
   *
   * @param      integer  $check_in   The check in
   * @param      integer  $check_out  The check out
   * @param      <type>   $room_id    The room identifier
   *
   * @return     boolean  ( Check reservation )
   */
  function reservation_overlap($check_in, $check_out, $room_id) {
    $reservations = Reservation::find_all_by_room_id($room_id);
    foreach($reservations as $reserved) {
      if (($check_in < $reserved->check_out) && ($check_out > $reserved->check_in)) {
          return true;
        } 
        // else {
        //   return true;
        // }  
    }

  }

  // function has_unique_document_id($username, $current_doc_id="0") {
  //   $user = Users::find_by_username($username);
  //   if($user === false || $user->document_id == $current_doc_id) {
  //     // is unique
  //     return true;
  //   } else {
  //     // not unique
  //     return false;
  //   }
  // }  

?>
