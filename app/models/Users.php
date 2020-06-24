<?php
class Users extends Model {

    public static $current_logged_in_user = null; // a property for store current logged in user as obj
    private $is_logged_in;
    private $session_name;
    private $cookie_name;

    public $id;
    public $full_name;
    public $username;
    public $email;
    public $password;
    public $enabled;
    public $online;
    public $acl;
    public $gender;
    public $mobile;
    public $province;
    public $township;
    public $address;
    public $postal_code;
    public $activation_code;
    public $creation_time;
    public $deleted = 0;

    // $db;
    // $table;
    // $model_name;
    // $soft_delete = false;
    // $id;



    public function __construct($user = '')
    {
        $table = 'tbl_users';
        parent::__construct($table);

        $this->session_name = CURRENT_USER_SESSION_NAME;
        $this->cookie_name = REMEMBER_ME_COOKIE_NAME;
        $this->soft_delete = true;

        // set user properties
        if ($user != '') {
            if (is_int($user))
                $u = $this->db->findFirst('tbl_users', ['conditions'=>'id=?','bind'=>[$user]], 'Users');
            else
                $u = $this->db->findFirst('tbl_users', ['conditions'=>'username=?','bind'=>[$user]], 'Users');

            if ($u)
                foreach ($u as $key => $value)
                    $this->{$key} = $value;
        }
    }



    public function findByUsername($username)
    {
        return $this->findFirst([
            'conditions' => ['username = ?'],
            'bind' => [$username]
        ]);
    }



    // returns current logged in user as an obj
    public static function currentLoggedInUser()
    {
        if (! isset(self::$current_logged_in_user) && Session::exists(CURRENT_USER_SESSION_NAME)) {
            $u = new Users((int)Session::get(CURRENT_USER_SESSION_NAME));
            self::$current_logged_in_user = $u;
        }
        return self::$current_logged_in_user;
    }



    // set user session && `remember_me` cookie
    public function login($remember_me = false)
    {
        // store user id to login session
        Session::set($this->session_name, $this->id);

        if ($remember_me) {
            // create remember_me cookie
            $hash = md5(uniqid() + rand(0, 100));
            Cookie::set($this->cookie_name, $hash, REMEMBER_ME_COOKIE_EXPIRY);

            // delete old user sessions from `tbl_user_sessions`
            $user_agent = Session::uagent_no_version();
            $this->db->query("DELETE FROM tbl_user_sessions WHERE user_id = ? AND user_agent = ?", [$this->id, $user_agent]);

            // save user to `tbl_user_sessions`
            $fields = [
                'session' => $hash,
                'user_agent' => $user_agent,
                'user_id' => $this->id
            ];
            $this->db->insert("tbl_user_sessions", $fields);

            $us = new UserSessions();
            $us->assign($fields);
            $us->save();
        }
    }



    // login with `remember_me` cookie
    public static function loginUserFromCookie()
    {
        $user_session = UserSessions::getFromRememberMeCookie();

        if ($user_session->user_id != '')
            $user = new self((int)$user_session->user_id);

        if ($user)
            $user->login();

        return $user;
    }



    // delete user session && remember me cookie && set `current_logged_in_user` to null
    public function logout()
    {
        $user_session = UserSessions::getFromRememberMeCookie();
        if ($user_session)
            $user_session->delete($user_session->id);

        Session::delete(CURRENT_USER_SESSION_NAME);
        Cookie::delete(REMEMBER_ME_COOKIE_NAME);

        self::$current_logged_in_user = null;
        return true;
    }



    public function registerNewUser($data)
    {
        $this->assign($data);
        $this->password = password_hash($data['pass_1'], PASSWORD_DEFAULT);
        $this->save();
    }



    public function acls()
    {
        if (empty($this->acl))
            return false;
        return json_decode($this->acl, true);
    }



}
