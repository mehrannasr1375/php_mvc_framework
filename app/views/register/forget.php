<?php $this->start('head'); ?>
<?php $this->end(); ?>




<?php $this->start('body'); ?>

<!--  login form  ----------------------------------------------------------------------------------------------------------------------------------------------------->
<div class="login-form-con container row m-auto">

    <!-- right-part -->
    <div class="login-right col-12 col-md-4">
        <p class="f-12"> آدرس ایمیلی که با آن در وبسایت ثبتنام کرده اید را وارد نمایید </p>
        <div style="width:20%;height:3px;background-color:white;margin-bottom:50px;"></div>
        <p class="my-2 d-flex justify-content-center align-items-center f-13"><i class="fa fa-2x fa-question-circle-o ml-3"></i> آیا حساب کاربری ندارید؟ </p>
        <a href="<?=PROOT?>register/register" class="btn-round-green mt-3">ثبتنام </a>
    </div>

    <!-- left-part -->
    <div class="login-left col-12 col-md-8">
        <form method="POST" action="<?=PROOT?>register/forget" class="w-50 m-auto">

            <!-- csrf -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
            <?= FormHelper::csrfInput(); ?>

            <!-- title -->
            <span class="d-flex p-3 justify-content-center align-items-center font-weight-bold" style="color:rgb(66,166,100);">
                <i class="fa pl-2 fa-comment-o"></i>فراموشی کلمه عبور
            </span>
            <div style="width:20%;height:4px;background-color:rgb(66,166,100); margin:auto"></div>

            <!-- result message -->
            <small class="login-res">
                <?= $this->displayErrors; ?>
            </small>
            <small class="form-res">
                <?= $this->resultMessage; ?>
            </small>

            <!-- username -->
            <div class="form-group mt-4">
                <label>آدرس ایمیل : </label>
                <input type="email" class="form-control text-center" name="email" value="test@test.com" placeholder="test@gmail.com" autocomplete="off" >
            </div>

            <hr>

            <!-- submit -->
            <button type="submit" class="btn-round-green-rev d-block m-auto"><i class="fa fa-comment-o pl-2"></i>ارسال ایمیل</button>

        </form>
    </div>

</div>
<!--  /login form  ----------------------------------------------------------------------------------------------------------------------------------------------------->

<?php $this->end(); ?>


