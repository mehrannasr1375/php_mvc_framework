<?php $this->start('head'); ?>
<?php $this->end(); ?>




<?php $this->start('body'); ?>

<!--  login form  ----------------------------------------------------------------------------------------------------------------------------------------------------->
<div class="login-form-con container row m-auto">

    <!-- right-part -->
    <div class="login-right col-12 col-md-4">
        <p class="f-12"> جهت ورود به حساب کاربری خود میتوانید از شماره همراه و یا ایمیل خود بعنوان نام کاربری استفاده نمایید! </p>
        <div style="width:20%;height:3px;background-color:white;margin-bottom:50px;"></div>
        <p class="my-2 d-flex justify-content-center align-items-center f-13"><i class="fa fa-2x fa-question-circle-o ml-3"></i> آیا حساب کاربری ندارید؟ </p>
        <a href="<?=PROOT?>register/register" class="btn-round-green mt-3"> ثبت نام </a>
    </div>

    <!-- left-part -->
    <div class="login-left col-12 col-md-8">
        <form method="POST" action="<?=PROOT?>register/login" class="w-50 m-auto">

            <!-- csrf -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
            <?= FormHelper::csrfInput(); ?>

            <!-- title -->
            <span class="d-flex p-3 justify-content-center align-items-center font-weight-bold" style="color:rgb(66,166,100);">
                <i class="fa pl-2 fa-unlock-alt"></i>ورود به حساب کاربری :
            </span>
            <div style="width:20%;height:4px;background-color:rgb(66,166,100); margin:auto"></div>

            <!-- result message -->
            <small class="login-res">
                <?= $this->displayErrors; ?>
            </small>
            
            <!-- username -->
            <div class="form-group mt-4">
                <label>نام کاربری : </label>
                <input type="text" class="form-control text-center" name="username" value="mehran" autocomplete="off" >
            </div>

            <!-- password -->
            <div class="form-group mb-4">
                <label>رمز عبور : </label>
                <input type="password" class="form-control text-center" name="password" autocomplete="off" value="sss31644">
            </div>

            <!-- remember me -->
            <div class="custom-control custom-checkbox mr-sm-2" style="color:#a4a4a4;">
                <input type="checkbox" class="custom-control-input" id="remember_me" name="remember_me">
                <label class="custom-control-label mb-1" for="remember_me">مرا به خاطر بسپار</label>
            </div>

            <!-- forget pass link -->
            <a href="<?=PROOT?>register/forget" class="text-secondary p-2 pb-0 f-11">رمز عبور خود را فراموش کرده اید؟</a>

            <hr>

            <!-- submit -->
            <button type="submit" class="btn-round-green-rev d-block m-auto"><i class="fa fa-unlock-alt pl-2"></i>ورود</button>

        </form>
    </div>

</div>
<!--  /login form  ----------------------------------------------------------------------------------------------------------------------------------------------------->

<?php $this->end(); ?>


