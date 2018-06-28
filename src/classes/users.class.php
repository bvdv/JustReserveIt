<?php
/*!
  \brief User object class
  \author Danil
  \version 1.0
  \date 21.06.2018

  User object class
*/
class Users extends DatabaseObject {

  static protected $table_name = "users";
  static protected $db_columns = ['id', 'username', 'name', 'surname', 'email', 'hashed_password', 'user_status', 'contacts', 'document_id'];

  public $id;
  public $username;
  public $name;
  public $surname;
  public $email;
  protected $hashed_password;
  //make protected user status
  public $user_status;
  //
  public $contacts;
  public $document_id;
  public $password;
  public $confirm_password;
  protected $password_required = true;

  public function __construct($args=[]) {
    $this->username = $args['username'] ?? '';
    $this->name = $args['name'] ?? '';
    $this->surname = $args['surname'] ?? '';
    $this->email = $args['email'] ?? '';
    $this->user_status = $args['user_status'] ?? 0;
    $this->contacts = $args['contacts'] ?? '';
    $this->document_id = $args['document_id'] ?? '';
    $this->password = $args['password'] ?? '';
    $this->confirm_password = $args['confirm_password'] ?? '';
  }

  /**
   * { return full name }
   *
   * @return     <type>  ( description_of_the_return_value )
   */
  public function full_name() {
    return $this->name . " " . $this->surname;
  }

  /**
   * Sets the hashed password.
   */
  protected function set_hashed_password() {
    $this->hashed_password = password_hash($this->password, PASSWORD_BCRYPT);
  }

  /**
   * { function_description }
   *
   * @param      <type>  $password  The password
   *
   * @return     <type>  ( description_of_the_return_value )
   */
  public function verify_password($password) {
    return password_verify($password, $this->hashed_password);
  }

  /**
   * { function_description }
   *
   * @return     <type>  ( description_of_the_return_value )
   */
  protected function create() {
    $this->set_hashed_password();
    return parent::create();
  }

  /**
   * { Update }
   *
   * @return     <type>  ( description_of_the_return_value )
   */
  protected function update() {
    if($this->password != '') {
      $this->set_hashed_password();
      // validate password
    } else {
      // password not being updated, skip hashing and validation
      $this->password_required = false;
    }
    return parent::update();
  }

  /**
   * { Validation }
   *
   * @return     <type>  ( description_of_the_return_value )
   */
  protected function validate() {
    $this->errors = [];
    
    if(is_blank($this->username)) {
      $this->errors[] = "Username cannot be blank.";
    } elseif (!has_length($this->username, array('min' => 3, 'max' => 255))) {
      $this->errors[] = "Username must be between 3 and 255 characters.";
    } elseif (!has_unique_username($this->username, $this->id ?? 0)) {
      $this->errors[] = "Username not allowed. Try another.";
    }

    if(is_blank($this->name)) {
      $this->errors[] = "Name cannot be blank.";
    } elseif (!has_length($this->name, array('min' => 2, 'max' => 255))) {
      $this->errors[] = "Name must be between 2 and 255 characters.";
    }

    if(is_blank($this->surname)) {
      $this->errors[] = "Surname cannot be blank.";
    } elseif (!has_length($this->surname, array('min' => 2, 'max' => 255))) {
      $this->errors[] = "Surname must be between 2 and 255 characters.";
    }

    if(is_blank($this->email)) {
      $this->errors[] = "Email cannot be blank.";
    } elseif (!has_length($this->email, array('max' => 255))) {
      $this->errors[] = "Last name must be less than 255 characters.";
    } elseif (!has_valid_email_format($this->email)) {
      $this->errors[] = "Email must be a valid format.";
    }

    if(is_blank($this->document_id)) {
      $this->errors[] = "Document ID cannot be blank.";
    } elseif (!has_length($this->document_id, array('min' => 3, 'max' => 255))) {
      $this->errors[] = "Document ID must be between 3 and 255 characters.";
    } elseif (!has_unique_username($this->document_id, $this->id ?? 0)) {
      $this->errors[] = "Document ID not allowed. Try another.";
    }

    if($this->password_required) {
      if(is_blank($this->password)) {
        $this->errors[] = "Password cannot be blank.";
      } elseif (!has_length($this->password, array('min' => 12))) {
        $this->errors[] = "Password must contain 12 or more characters";
      } elseif (!preg_match('/[A-Z]/', $this->password)) {
        $this->errors[] = "Password must contain at least 1 uppercase letter";
      } elseif (!preg_match('/[a-z]/', $this->password)) {
        $this->errors[] = "Password must contain at least 1 lowercase letter";
      } elseif (!preg_match('/[0-9]/', $this->password)) {
        $this->errors[] = "Password must contain at least 1 number";
      } elseif (!preg_match('/[^A-Za-z0-9\s]/', $this->password)) {
        $this->errors[] = "Password must contain at least 1 symbol";
      }

      if(is_blank($this->confirm_password)) {
        $this->errors[] = "Confirm password cannot be blank.";
      } elseif ($this->password !== $this->confirm_password) {
        $this->errors[] = "Password and confirm password must match.";
      }
    }

    return $this->errors;
  }

  /**
   * { Find by username }
   *
   * @param      <type>   $username  The username
   *
   * @return     boolean  ( description_of_the_return_value )
   */
  static public function find_by_username($username) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE username='" . self::$database->escape_string($username) . "'";
    $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  /**
   * { Check for satus }
   *
   * @return     <type>  ( description_of_the_return_value )
   */
  public function check_user_status() {
    return $checked_status = $this->user_status;
  } 

}

?>
