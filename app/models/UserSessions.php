<?php
class UserSessions extends Model {

    public $id;
    public $user_id;
    public $session;
    public $user_agent;

    // $db;
    // $table;
    // $model_name;
    // $soft_delete = false;
    // $id;



    public function __construct()
    {
        $table = 'tbl_user_sessions';
        parent::__construct($table);
    }



    // checks database for `user_agent` and `remember_me` cookie value
    public static function getFromRememberMeCookie()
    {
        $us = new self();
        if (Cookie::exists(REMEMBER_ME_COOKIE_NAME)) {
            $user_session = $us->findFirst([
                'conditions' => 'session=? AND user_agent=?',
                'bind' => [
                    Cookie::get(REMEMBER_ME_COOKIE_NAME),
                    Session::uagent_no_version()
                ]
            ]);

            if (! $user_session)
                return false;

            return $user_session;
        }
    }



}
