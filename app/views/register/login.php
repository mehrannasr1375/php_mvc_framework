<?php $this->start('head'); ?>
<?php $this->end(); ?>




<?php $this->start('body'); ?>
<div class="two-part-box">

    <!-- right-part -->
    <div class="two-part-right col-12 col-md-4">
        <p> آیا حساب کاربری ندارید؟ </p>
        <a href="<?=PROOT?>register/register" class="btn-round-green mb-4"> ثبت نام </a>
    </div>

    <!-- left-part -->
    <div class="two-part-left col-12 col-md-8">
        <form method="POST" action="<?=PROOT?>register/login">

            <?= FormHelper::csrfInput(); ?>

            <!-- header -->
            <p class="two-part-left-header"> ورود به حساب کاربری </p>

            <!-- body -->
            <div class="two-part-left-body">

                <!-- username -->
                <div class="scalable-input-wrapper validate-input mt-5 mb-0">
                    <input id="username" name="username" type="text" class="scalable-input" value="test@gmail.com" autocomplete="off">
                    <span class="scalable-input-title" data-placeholder="تلفن همراه یا آدرس ایمیل"></span>
                </div>

                <!-- password -->
                <div class="scalable-input-wrapper validate-input mt-5 mb-0">
                    <input id="password" name="password" type="password" class="scalable-input" autocomplete="off">
                    <span class="scalable-input-title" data-placeholder="رمز عبور"></span>
                </div>

                <!-- result message -->
                <small class="login-res">
                    <?= $this->displayErrors; ?>
                </small>

                <!-- remember me -->
                <div class="custom-control custom-checkbox mt-5 ml-auto">
                    <input class="custom-control-input"  type="checkbox" name="remember" id="remember" >
                    <label class="custom-control-label" for="remember"> مرا به خاطر بسپار </label>
                </div>

            </div>

            <!-- footer -->
            <div class="two-part-left-footer">

                <!-- submit -->
                <button type="submit" class="btn-round-green-rev d-block m-auto"><i class="fa fa-unlock-alt pl-2"></i>ورود</button>

                <!-- forget pass link -->
                <a href="<?=PROOT?>register/forget" class="text-secondary p-2 pb-0 f-11">رمز عبور خود را فراموش کرده اید؟</a>

            </div>

        </form>
    </div>

</div>
<?php $this->end(); ?>





