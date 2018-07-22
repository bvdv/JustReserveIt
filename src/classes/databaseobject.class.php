<?php
/*!
  \brief Database object class
  \author Danil
  \version 1.0
  \date 21.06.2018

  Database object class
*/

class DatabaseObject
{

    static protected $database;
    static protected $table_name = "";
    static protected $columns = [];
    public $errors = [];

  /**
   * Sets the database.
   *
   * @param      <type>  $database  The database
   */
    public static function set_database($database)
    {
        self::$database = $database;
    }

  /**
   * { Query  }
   *
   * @param      <type>  $sql    The sql query for database
   *
   * @return     array   ( Sql query from database )
   */
    public static function find_by_sql($sql)
    {
        $result = self::$database->query($sql);
        if (!$result) {
            exit("Database query failed.");
        }

      // results into objects
        $object_array = [];
        while ($record = $result->fetch_assoc()) {
            $object_array[] = static::instantiate($record);
        }

        $result->free();

        return $object_array;
    }

  /**
   * Searches for all matches.
   *
   * @return     <type>  ( Sql query )
   */
    public static function find_all()
    {
        $sql = "SELECT * FROM " . static::$table_name;
        return static::find_by_sql($sql);
    }

  /**
   * { Search all by room id }
   *
   * @param      <type>  $id     The identifier
   *
   * @return     <type>  ( Sql query )
   */
    public static function find_all_by_room_id($id)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE room_id='" . self::$database->escape_string($id) . "'";
        return static::find_by_sql($sql);
    }

  /**
   * { Search all by user id }
   *
   * @param      <type>  $id     The identifier
   *
   * @return     <type>  ( sql query )
   */
    public static function find_all_by_user_id($id)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE user_id='" . self::$database->escape_string($id) . "'";
        return static::find_by_sql($sql);
    }

  /**
   * { search everything by id }
   *
   * @param      <type>   $id     The identifier
   *
   * @return     boolean  ( array )
   */
    public static function find_by_id($id)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE id='" . self::$database->escape_string($id) . "'";
        $obj_array = static::find_by_sql($sql);
        if (!empty($obj_array)) {
            return array_shift($obj_array);
        } else {
            return false;
        }
    }

  /**
   * { search by room id }
   *
   * @param      <type>   $id     The identifier
   *
   * @return     boolean  ( array )
   */
    public static function find_by_room_id($id)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE room_id='" . self::$database->escape_string($id) . "'";
        $obj_array = static::find_by_sql($sql);
        if (!empty($obj_array)) {
            return array_shift($obj_array);
        } else {
            return false;
        }
    }

  /**
   * { instatination for array filling with query }
   *
   * @param      <type>  $record  The record
   *
   * @return     static  ( description_of_the_return_value )
   */
    protected static function instantiate($record)
    {
        $object = new static;
      // Could manually assign values to properties
      // but automatically assignment is easier and re-usable
        foreach ($record as $property => $value) {
            if (property_exists($object, $property)) {
                $object->$property = $value;
            }
        }
        return $object;
    }

  /**
   * { checkin for error }
   *
   * @return     <type>  ( error msg )
   */
    protected function validate()
    {
        $this->errors = [];

      // Add custom validations

        return $this->errors;
    }

  /**
   * { insert data in DB }
   *
   * @return     boolean  ( result )
   */
    protected function create()
    {
        $this->validate();
        if (!empty($this->errors)) {
            return false;
        }

        $attributes = $this->sanitized_attributes();
        $sql = "INSERT INTO " . static::$table_name . " (";
        $sql .= join(', ', array_keys($attributes));
        $sql .= ") VALUES ('";
        $sql .= join("', '", array_values($attributes));
        $sql .= "')";
        $result = self::$database->query($sql);
        if ($result) {
            $this->id = self::$database->insert_id;
        }
        return $result;
    }

  /**
   * { update data in DB }
   *
   * @return     boolean  ( description_of_the_return_value )
   */
    protected function update()
    {
        if (!is_a($this, 'Reservation')) {
            $this->validate();
        }
        if (!empty($this->errors)) {
            return false;
        }

        $attributes = $this->sanitized_attributes();
        $attribute_pairs = [];
        foreach ($attributes as $key => $value) {
            $attribute_pairs[] = "{$key}='{$value}'";
        }

        $sql = "UPDATE " . static::$table_name . " SET ";
        $sql .= join(', ', $attribute_pairs);
        $sql .= " WHERE id='" . self::$database->escape_string($this->id) . "' ";
        $sql .= "LIMIT 1";
        $result = self::$database->query($sql);
        return $result;
    }

  /**
   * { update data }
   *
   * @return     <type>  ( or update or create )
   */
    public function save()
    {
      // A new record will not have an ID yet
        if (isset($this->id)) {
            return $this->update();
        } else {
            return $this->create();
        }
    }

  /**
   * { merge attributes }
   *
   * @param      array  $args   The arguments
   */
    public function merge_attributes($args = [])
    {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }

  /**
   * { attributes from POST request }
   *
   * @return     array  ( description_of_the_return_value )
   */
    public function attributes()
    {
        $attributes = [];
        foreach (static::$db_columns as $column) {
            if ($column == 'id') {
                continue;
            }
            $attributes[$column] = $this->$column;
        }
        return $attributes;
    }

  /**
   * { sabitaize POST request }
   *
   * @return     array  ( description_of_the_return_value )
   */
    protected function sanitized_attributes()
    {
        $sanitized = [];
        foreach ($this->attributes() as $key => $value) {
            $sanitized[$key] = self::$database->escape_string($value);
        }
        return $sanitized;
    }

  /**
   * { Delete data from DB }
   *
   * @return     <type>  ( description_of_the_return_value )
   */
    public function delete()
    {
        $sql = "DELETE FROM " . static::$table_name . " ";
        $sql .= "WHERE id='" . self::$database->escape_string($this->id) . "' ";
        $sql .= "LIMIT 1";
        $result = self::$database->query($sql);
        return $result;

      // After deleting, the instance of the object will still
      // exist, even though the database record does not.
      // This can be useful, as in:
      //   echo $user->first_name . " was deleted.";
      // but, for example, we can't call $user->update() after
      // calling $user->delete().
    }
}
