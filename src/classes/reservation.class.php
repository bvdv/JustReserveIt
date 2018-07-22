<?php
/*!
  \brief Reservation object class
  \author Danil
  \version 1.0
  \date 21.06.2018

  Reservation object class
*/
class Reservation extends DatabaseObject
{

    static protected $table_name = 'reservations';
    static protected $db_columns = ['id', 'room_id', 'user_id', 'check_in', 'check_out', 'accepted', 'room_name' ];

    public $id;
    public $room_id;
    public $user_id;
    public $check_in;
    public $check_out;
    public $accepted;
    public $room_name;

    public function __construct($args = [])
    {
        $this->room_id = $args['room_id'] ?? '';
        $this->user_id = $args['user_id'] ?? $_SESSION['user_id'];
        $this->check_in = $args['check_in'] ?? '';
        $this->check_out = $args['check_out'] ?? '';
        $this->accepted = $args['accepted'] ?? 0;
        $this->room_name = $args['room_name'] ?? '';

      // Caution: allows private/protected properties to be set
      // foreach($args as $k => $v) {
      //   if(property_exists($this, $k)) {
      //     $this->$k = $v;
      //   }
      // }
    }

  /**
   * { Return room name and other params }
   *
   * @return     string  ( return resered room name )
   */
    public function name()
    {
        return "{$this->room_name}";
    }

  /**
   * { Reservation data validation }
   *
   * @return     <type>  ( return errors if occured )
   */
    protected function validate()
    {
        $this->errors = [];

        if (is_blank($this->room_id)) {
            $this->errors[] = "Room id cannot be blank.";
        }
        if (is_blank($this->user_id)) {
            $this->errors[] = "User id cannot be blank.";
        }
        if (is_blank($this->check_in)) {
            $this->errors[] = "Check in cannot be blank.";
        }
        if (is_blank($this->check_out)) {
            $this->errors[] = "Check out cannot be blank.";
        }
        if (reservation_overlap($this->check_in, $this->check_out, $this->room_id)) {
            $this->errors[] = "Room is busy for that date range. Please select other date range.";
        }
        return $this->errors;
    }
}
