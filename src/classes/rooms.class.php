<?php
/*!
  \brief Room object class
  \author Danil
  \version 1.0
  \date 21.06.2018

  Room object class
*/
class Room extends DatabaseObject
{

    static protected $table_name = 'rooms';
    static protected $db_columns = ['id', 'room_name', 'bed_num', 'overview' ];

    public $id;
    public $room_name;
    public $bed_num;
    public $overview;

    public function __construct($args = [])
    {
        $this->room_name = $args['room_name'] ?? '';
        $this->bed_num = $args['bed_num'] ?? '';
        $this->overview = $args['overview'] ?? '';

      // Caution: allows private/protected properties to be set
      // foreach($args as $k => $v) {
      //   if(property_exists($this, $k)) {
      //     $this->$k = $v;
      //   }
      // }
    }

  /**
   * { Return object room name }
   *
   * @return     string  ( Object room name )
   */
    public function name()
    {
        return "{$this->room_name}";
    }

  /**
   * { Room data validation }
   *
   * @return     <type>  ( return errors if occured )
   */
    protected function validate()
    {
        $this->errors = [];

        if (is_blank($this->room_name)) {
            $this->errors[] = "Title cannot be blank.";
        }
        if (is_blank($this->bed_num)) {
            $this->errors[] = "Bed number cannot be blank.";
        }
     
        return $this->errors;
    }
}
