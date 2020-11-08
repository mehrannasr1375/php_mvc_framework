<?php
class RegisterController extends Controller {

    // $view;
    // $UsersModel



    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
        $this->loadModel('Users'); // sets `UsersModel` property
        $this->view->setLayout('default');
    }



    public function login()
    {
        // if data posted -> login
        $validation = new Validate();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $validation->check($_POST, [
                'username' => [
                    'display'=>'نام کاربری',
                    'required'=>true
                ],
                'password' => [
                    'display'=>'رمز عبور',
                    'required'=>true
                ]
            ], true);

            if ($validation->passed()) {
                $user = $this->UsersModel->findByUsername($_POST['username']);
                if ($user && password_verify(Input::get('password'), $user->password)) {
                    $remember = (isset($_POST['remember_me']) && Input::get('remember_me')) ? true : false;
                    $user->login($remember);
                    Router::redirect('');
                }
                else {
                    $validation->addError("نام کاربری یا کلمه عبور اشتباه است !");
                }
            }
        }

        // set view errors (as an attribute)
        $this->view->displayErrors = $validation->displayErrors();

        // if noting posted -> show form
        $this->view->render('register/login');
    }



    public function logout()
    {
        if (Helpers::currentUser())
            Helpers::currentUser()->logout();

        Router::redirect('register/login');
    }



    public function register()
    {
        $data = [];
        $validation = new Validate();
        if ($_POST) {
            $data = Helpers::sanitize($_POST);
            $validation->check($data, [
                'full_name' => [
                    'display'=>'نام',
                    'required'=>true,
                    'min'=>3
                ],
                'username' => [
                    'display'=>'نام کاربری',
                    'required'=>true,
                    'min'=>5
                ],
                'email' => [
                    'display'=>'ایمیل',
                    'required'=>true,
                    'valid_email'=>true
                ],
                'mobile' => [
                    'display'=>'موبایل',
                    'required'=>true,
                    'is_numeric'=>true,
                    'min'=>10
                ],
                'pass_1' => [
                    'display'=>'رمز عبور',
                    'required'=>true,
                    'min'=>6
                ],
                'pass_2' => [
                    'display'=>'تکرار رمز عبور',
                    'required'=>true,
                ],
                'accept_rules' => [
                    'display'=>'پذیرش مقررات',
                    'required'=>true
                ],
            ], true);
            if ($validation->passed()) {
                $new_user = new Users();
                $new_user->registerNewUser($data);
                Router::redirect('register/login');
            }
        }

        $this->view->displayErrors = $validation->displayErrors();
        $this->view->post = $data;
        $this->view->render('register/register');
    }



    public function forget()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $validator = new Validate();
            $email = Input::get('email');
            $validator->check($_POST, [
                'email' => [
                    'display'=>'ایمیل',
                    'required'=>true,
                    'valid_email'=>true,
                    'exists'=> [
                        'table' => 'tbl_users',
                        'column' => 'email',
                        'value' => $_POST['email']
                    ],
                ]
            ], true);

            if ($validator->passed()) {
                $sent_mails_obj = new SentMails();
                if ($sent_mails_obj->allowedToSendMail($email)) {
                    $user = new Users($email);
                    if ($user->updateActivationCode()) {
                        // sende mail
                        $this->view->resultMessage = 'ایمیل حاوی لینک بازیابی رمز عبور به ایمیل شما ارسال گردید!';
                    }
                    else
                        $validator->addError('خطایی در اطلاعات ورودی وجود دارد!');
                }
                else
                    $validator->addError('حساب کاربری شما موقتا مسدود شده است. لطفا بعدا تلاش نمایید!');
            }

            $this->view->displayErrors = $validator->displayErrors();
        }

        $this->view->render('register/forget');
    }



    public function changepass()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $validator = new Validate();
            $validator->check($_POST, [
                'user' => [
                    'display'=>'شناسه کاربری',
                    'required'=>true,
                    'exists'=> [
                        'table' => 'tbl_users',
                        'column' => 'id',
                        'value' => $_POST['user']
                    ],
                ],
                'security_code' => [
                    'display'=>'کد امنیتی',
                    'required'=>true
                ],
                'password' => [
                    'display'=>'رمز عبور',
                    'required'=>true,
                    'min'=>6
                ],
                'password_confirm' => [
                    'display'=>'تکرار رمز عبور',
                    'required'=>true,
                    'min'=>6
                ]
            ] , true);

            if ($validator->passed()) {
                $user = new Users((int)Input::get('user'));
                if ($user) { // if user exists
                    if ($user->activation_code == Input::get('security_code')) {
                        $user->changePassword(Input::get('password'));
                        $this->view->resultMessage = 'رمز عبور شما با موفقیت تغییر یافت.' . '<a class="mr-2 btn-round-green-rev" href="' . PROOT . 'register/login">ورود</a>';
                    }
                    else
                        $validator->addError('درخواست معتبر نیست!');
                }
                else // if user not exists
                    $validator->addError('چنین کاربری موجود نمی باشد!');
            }
            $this->view->displayErrors = $validator->displayErrors();
        }

        $this->view->render('register/change_password');
    }



}
