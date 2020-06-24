<?php
class Model {

    protected $db; // PDO connection instance
    protected $table;
    protected $model_name; // in CamelCase
    protected $soft_delete = false;
    public    $id;



    public function __construct($table)
    {
        $this->model_name = str_replace(' ', '', ucwords(str_replace('_', ' ', str_replace('tbl_', '', $table))));
        $this->table = $table;
        $this->db = DB::getInstance();
    }



    // insert or update model based on `column_names` with table columns attributes
    public function save()
    {
        $fields = getObjectProperties($this);

        // update or insert ?
        if ($this->id != '')
            return $this->update($this->id, $fields);

        return $this->insert($fields);
    }



    // set `soft_delete` condition to query if `soft_delete` is set
    protected function softDeleteParams($params) {
        if ($this->soft_delete) {
            if (array_key_exists('conditions', $params)) {
                if (is_array($params['conditions']))
                    $params['conditions'][] = "deleted != 1";
                else
                    $params['conditions'] .= " AND deleted != 1";
            }
            else
                $params['conditions'] = "deleted != 1";
        }
        return $params;
    }



    public function find($params = [])
    {
        $params = $this->softDeleteParams($params);
        $results = $this->db->find($this->table, $params, get_class($this));

        if (! $results)
            return [];
        return $results;
    }



    public function findFirst($params = [])
    {
        $params = $this->softDeleteParams($params);
        $result = $this->db->findFirst($this->table, $params, get_class($this));

        return $result;
    }



    public function findById($id)
    {
        return $this->findFirst([
            'conditions' => ['id=?'],
            'bind' => [$id]
        ]);
    }



    public function insert($params = [])
    {
        if (empty($params))
            return false;

        $this->db->insert($this->table, $params);
    }



    public function update($id, $params = [])
    {
        if (empty($params) || $id == '')
            return false;

        $this->db->update($this->table, $id, $params);
    }



    public function delete($id = '')
    {
        if ($id == '' && $this->id == '')
            return false;

        $id = ($id == '') ? $this->id : $id;

        if ($this->soft_delete)
            return $this->update($id, ['deleted' => 1]);

        return $this->db->delete($this->table, $id);
    }



    public function query($sql, $params = [])
    {
        return $this->db->query($sql, $params, get_class($this));
    }



    // get records of a single object as an instance of std class
    public function data()
    {
        $data = new stdClass();

        foreach (getObjectProperties($this) as $column => $value)
            $data->{$column} = $value;

        return $data;
    }



    // set object properties from input array if they are exists on `column_names` attribute
    public function assign($params = [])
    {
        if (! empty($params)) {
            foreach ($params as $key => $value)
                if (property_exists($this, $key))
                    $this->{$key} = sanitize($value);
            return true;
        }

        return false;
    }



}
