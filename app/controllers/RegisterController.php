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
                'province' => [
                    'display'=>'استان',
                    'required'=>true
                ],
                'township' => [
                    'display'=>'شهر',
                    'required'=>true
                ],
                'postal_code' => [
                    'display'=>'کد پستی',
                    'required'=>true
                ],
                'address' => [
                    'display'=>'آدرس',
                    'required'=>true
                ],
                'payment_type' => [
                    'display'=>'نوع پرداخت',
                    'required'=>true
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
                    'valid_email'=>true
                ]
            ], true);

            if ($validator->passed()) {
                $sent_mails_obj = new SentMails();
                if ($sent_mails_obj->allowedToSendMail($email)) {
                    $user = new Users();
                    if ($user->checkEmailExists($email)) {
                        $this->view->resultMessage = 'ایمیل حاوی لینک بازیابی رمز عبور به ایمیل شما ارسال گردید!';
                        // send an email including reset password link
                    }
                    else
                        $validator->addError('کاربری با این ایمیل ثبت نام نکرده است');
                }
                else
                    $validator->addError('حساب کاربری شما موقتا مسدود شده است. لطفا بعدا تلاش نمایید!');
            }

            $this->view->displayErrors = $validator->displayErrors();
        }

        $this->view->render('register/forget');
    }



}
