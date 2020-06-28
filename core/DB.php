<?php
class DB {

    /*
     * this class in used for intract with database
     * mostly used in Model class and Models classes
     */

    private static $instance = null; // a flag for create only one connection to DB
    private $query; // a place for store prepared statement
    private $pdo;   // database connection
    private $error = false;
    private $result;
    private $count = 0;
    private $last_insert_id = null;



    // set instance of PDOStatement class
    private function __construct()
    {
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8;";

        try {
            $this->pdo = new PDO($dsn, DB_USER, DB_PASS);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_CLASS);
            $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $e) {
            die('DB ERROR: ' . $e->getMessage());
        }     
    }   



    // get instance of this class
    public static function getInstance()
    {
        if (! isset(self::$instance))
            self::$instance = new DB();
       
        return self::$instance;   
    }    
    


    // get error
    public function error()
    {
        return $this->error;
    }



    // get result(s)
    public function results()
    {
        return $this->result;
    }



    // get result rows count
    public function count()
    {
        return $this->count;
    }
    
    

    // get last insert id
    public function lastId()
    {
        return $this->last_insert_id;
    }



    // get columns names
    public function getColumns($table)
    {
        return $this->query("show columns from {$table}")->results();
    }



    // get first row of result
    public function first()
    {
        return (!empty($this->result)) ? $this->result[0] : [];
    }

   
   
    // create prepaired && bind params && execute query
    public function query($sql, $params = [], $class = false)
    {
        $this->error = false;

        // save prepared statement on `query` attribute
        if ($this->query = $this->pdo->prepare($sql)) {
            // add params to query
            $counter = 1;
            if (count($params)) {
                foreach ($params as $param) {
                    $this->query->bindValue($counter, $param);
                    $counter++;    
                }
            }

            // execute query, set results & rowCount & lastInsertId
            if ($this->query->execute()) {
                if ($class)
                    $this->result = $this->query->fetchAll(PDO::FETCH_CLASS, $class);
                else
                    $this->result = $this->query->fetchAll(PDO::FETCH_OBJ);

                $this->count = $this->query->rowCount();
                $this->last_insert_id = $this->pdo->lastInsertId();
            }
            else
                $this->error = true;
        }

        return $this; // returns an instance of DB class
    }



    // insert
    public function insert($table, $fields = [])
    {
        $field_names_str = $field_values_str = '';

        foreach ($fields as $field => $value) {
            $field_names_str .= '`' . $field . '`, ';
            $field_values_str .= '?,';
            $values[] = $value;
        }
        $field_values_str = rtrim($field_values_str, ', '); // ?, ?, ?, ...
        $field_names_str  = rtrim($field_names_str, ', '); // `field1`, `field2`, ...

        $sql = "insert into {$table} ({$field_names_str}) values({$field_values_str})";

        $this->query($sql, $values);

        if (! $this->error)
            return true;
        
        return false;
    }



    // update
    public function update($table, $id, $fields = [])
    {
        $fields_str = '';
        foreach ($fields as $field => $value) {
            $fields_str .= "`" . $fields . "`=?, ";
            $values[] = $value;
        }
        $fields_str = rtrim($fields_str, ', '); // `field1`=?, `field2`=?, ...

        $sql = "update {$table} set {$fields_str} where id={$id}";

        $this->query($sql, $values);

        if (! $this->error())
            return true;
        
        return false;
    }



    // delete
    public function delete($table, $id)
    {
        $sql = "delete from {$table} where id={$id}";

        $this->query($sql);

        if (! $this->error())
            return true;
        
        return false;
    }

    
    
    // find
    public function find($table, $params = [], $class = false)
    {
        if ($this->read($table, $params, $class))
            return $this->results();

        return false;
    }


    
    // find first
    public function findFirst($table, $params = [], $class = false)
    {
        if ($this->read($table, $params, $class))
            return $this->first();

        return false;
    }



    // select
    protected function read($table, $params = [], $class)
    {
        $condition_str = '';
        $bind = [];
        $order = '';
        $limit = '';

        // conditions
        if (isset($params['conditions'])) {
            if (is_array($params['conditions'])) {
                foreach ($params['conditions'] as $condition)
                    $condition_str .= " " . $condition . " AND";
                $condition_str = rtrim($condition_str, 'AND');
            } 
            else
                $condition_str .= " " . $params['conditions'];

            if ($condition_str != '')
                $condition_str = ' WHERE ' . $condition_str;
        }

        // bind
        if (array_key_exists('bind', $params))
            $bind = $params['bind'];

        // order
        if (array_key_exists('order', $params))
            $order = " ORDER BY " . $params['order'];

        // limit & count
        if (array_key_exists('limit', $params)) {
            $limit = " LIMIT " . $params['limit'];
            if (array_key_exists('count', $params))
                $limit .= " , " . (int)$params['count'];
        }


        $sql = "SELECT * FROM {$table}{$condition_str}{$order}{$limit}";
        if ($this->query($sql, $bind, $class))
            if (! count($this->result))
                return false;

        return true;
    }


    
}