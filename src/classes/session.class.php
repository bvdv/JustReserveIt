<?php
/*!
  \brief Session object class
  \author Danil
  \version 1.0
  \date 21.06.2018

  Session object class
*/
class Session
{

    private $user_id;
    public $username;
    private $last_login;
    private $role;
    private $status;
  // private $check_admin_class
  
    public const MAX_LOGIN_AGE = 60*60*24; // 1 day

    public function __construct()
    {
        session_start();
        $this->check_stored_login();
    }

  /**
   * { Login method }
   *
   * @param      <type>   $user   Get user object
   *
   * @return     boolean  ( true if user logged )
   */
    public function login($user)
    {
        if ($user) {
          // prevent session fixation attacks
            session_regenerate_id();
            $this->user_id = $_SESSION['user_id'] = $user->id;
            $this->username = $_SESSION['username'] = $user->username;
            $this->last_login = $_SESSION['last_login'] = time();
            if (is_a($user, 'Staff')) {
                $this->role = $_SESSION['role'] = $user->check_role();
            } elseif (is_a($user, 'Users')) {
                $this->status = $_SESSION['status'] = $user->check_user_status();
            }
        }
        return true;
    }

  /**
   * { Staff logged checking }
   *
   * @return     <type>  ( return result of login )
   */
    public function staff_logged_in()
    {
      // return isset($this->admin_id);
        if (isset($this->role)) {
            return isset($this->user_id) && $this->last_login_is_recent() && isset($this->role);
        }
    }

  /**
   * { User logged checking }
   *
   * @return     <type>  ( description_of_the_return_value )
   */
    public function user_logged_in()
    {
        if (isset($this->status) && ($this->status == 0)) {
            return isset($this->user_id) && $this->last_login_is_recent() && isset($this->status);
        }
    }

  /**
   * { LogOut method }
   *
   * @return     boolean  ( return result logout )
   */
    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        unset($_SESSION['last_login']);
        unset($_SESSION['role']);
        unset($_SESSION['status']);
        unset($this->user_id);
        unset($this->username);
        unset($this->last_login);
        unset($this->role);
        unset($this->status);
        return true;
    }

  /**
   * { check stored login }
   */
    private function check_stored_login()
    {
        if (isset($_SESSION['user_id'])) {
            $this->user_id = $_SESSION['user_id'];
            $this->username = $_SESSION['username'];
            $this->last_login = $_SESSION['last_login'];
            $this->role = $_SESSION['role'];
            $this->status = $_SESSION['status'];
        }
    }

  /**
   * { last login }
   *
   * @return     boolean  ( description_of_the_return_value )
   */
    private function last_login_is_recent()
    {
        if (!isset($this->last_login)) {
            return false;
        } elseif (($this->last_login + self::MAX_LOGIN_AGE) < time()) {
            return false;
        } else {
            return true;
        }
    }

  /**
   * { errors msg }
   *
   * @param      string   $msg    The message
   *
   * @return     boolean  ( description_of_the_return_value )
   */
    public function message($msg = "")
    {
        if (!empty($msg)) {
          // Then this is a "set" message
            $_SESSION['message'] = $msg;
            return true;
        } else {
          // Then this is a "get" message
            return $_SESSION['message'] ?? '';
        }
    }

    public function clear_message()
    {
        unset($_SESSION['message']);
    }
}
