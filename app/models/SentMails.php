<?php
class SentMails extends Model
{

    private $max_allowed_attempts = EMAIL_FORGET_MAX_SEND_ATTEMPTS;
    private $time_interval = 600; // sec
    protected $soft_delete = false;

    // $db;
    // $table;
    // $model_name;
    // $id;



    public function __construct()
    {
        $table = 'tbl_sent_mails';
        parent::__construct($table);
    }



    public function setMaxAllowedAttempts($value)
    {
        if (is_int($value))
            $this->max_allowed_attempts = $value;
    }



    public function allowedToSendMail($email)
    {
        $time_interval = time() - $this->time_interval;
        $this->deleteOldAttempts($email);

        $res = $this->find([
            'conditions' => ['email = ?', '`time` > ?'],
            'bind' => [$email, $time_interval]
        ]);

        if (count($res) < $this->max_allowed_attempts)
            return true;
        return false;
    }



    public function deleteOldAttempts($email)
    {
        $time_interval = time() - $this->time_interval;

        $this->db->query("DELETE FROM {$this->table} WHERE `time` > ?", [$time_interval]);
    }



}