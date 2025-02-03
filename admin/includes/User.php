<?php

class User extends Db_object
{
    //properties
    //public,private, protected
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;

    public $role;
    public $created_at;
    public $deleted_at;

    protected static $table_name = 'users';
    //methods

    public function restore(){
        global $database;
        $table = static::$table_name;
        $escaped_id = $database->escape_string($this->id);

        // Set deleted_at to the default '0000-00-00 00:00:00' instead of NULL
        $sql = "UPDATE $table SET deleted_at = '0000-00-00 00:00:00' WHERE id = ?";
        $params = [$escaped_id];

        $result = $database->query($sql, $params);

        if ($result) {
            error_log("Gebruiker ID $escaped_id is hersteld.");
        } else {
            error_log("Fout bij herstel van gebruiker ID $escaped_id.");
        }
    }
    public static function verify_user($username, $password){
        global $database;
        $username = $database->escape_string($username);
        $password = $database->escape_string($password);

        $sql = "SELECT * FROM ". self::$table_name ." WHERE ";
        $sql .= "username = ? ";
        $sql .= "AND password = ?";
        $sql .= " LIMIT 1";

        $the_result_array = self::find_this_query($sql,[$username,$password]);

        if (!empty($the_result_array)) {
            $user = array_shift($the_result_array);

            if (empty($user->role)) {
                $user->role = 'user';
            }
            return $user;
        } else {
            return false;
        }
    }

    /* CRUD */
    /*properties als array voorzien*/
    public function get_properties(){
        return[
            'id'=> $this->id,
            'username'=>$this->username,
            'password'=>$this->password,
            'first_name'=>$this->first_name,
            'last_name'=>$this->last_name,
            'created_at'=>$this->created_at,
            'deleted_at'=>$this->deleted_at,
            'role'=>$this->role,
        ];
    }



}