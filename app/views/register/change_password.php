<?php $this->start('head'); ?>
<?php $this->end(); ?>




<?php $this->start('body'); ?>

<!--  login form  ----------------------------------------------------------------------------------------------------------------------------------------------------->
<div class="login-form-con container row m-auto">

    <!-- right-part -->
    <div class="login-right col-12 col-md-4">
        <p class="f-12"> رمز عبور جدید خود را وارد نمایید </p>
        <div style="width:20%;height:3px;background-color:white;margin-bottom:50px;"></div>
        <small>
            دقت نمایید که رمز انتخابی باید شامل حداقل 6 کاراکتر بوده و شامل حداقل یک حرف هم باشد.
        </small>
    </div>

    <!-- left-part -->
    <div class="login-left col-12 col-md-8">
        <form method="POST" class="w-50 m-auto">

            <!-- csrf -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
            <?= FormHelper::csrfInput(); ?>

            <!-- title -->
            <span class="d-flex p-3 justify-content-center align-items-center font-weight-bold" style="color:rgb(66,166,100);">
                <i class="fa pl-2 fa-edit"></i>تغییر کلمه عبور
            </span>
            <div style="width:20%;height:4px;background-color:rgb(66,166,100); margin:auto"></div>

            <!-- result message -->
            <small class="login-res">
                <?= $this->displayErrors; ?>
            </small>
            <small class="form-res">
                <?= $this->resultMessage; ?>
            </small>

            <!-- user-id -->
            <input type="hidden" name="user" value="<?= @$_GET['user'] ?>">

            <!-- security_code -->
            <input type="hidden" name="security_code" value="<?= @$_GET['security_code'] ?>">

            <!-- pass 1 -->
            <div class="form-group mt-4">
                <label>رمز عبور : </label>
                <input type="password" value="111111" class="form-control text-center" name="password" autocomplete="off" >
            </div>

            <!-- pass 2 -->
            <div class="form-group mt-4">
                <label>تکرار رمز عبور : </label>
                <input type="password" value="111111" class="form-control text-center" name="password_confirm" autocomplete="off" >
            </div>

            <hr>

            <!-- submit -->
            <button type="submit" class="btn-round-green-rev d-block m-auto"><i class="fa fa-check pl-2"></i>ذخیره</button>

        </form>
    </div>

</div>
<!--  /login form  ----------------------------------------------------------------------------------------------------------------------------------------------------->

<?php $this->end(); ?>


