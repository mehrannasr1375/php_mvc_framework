<?php $this->start('head'); ?>
<?php $this->end(); ?>


<?php $this->start('body'); ?>
<div id="signup-con" class="container">

    <!-- top-part -->
    <div class="signup-top">
        <div class="d-flex justify-content-start align-items-center mb-4">
            <i class="fa fa-user-plus ml-4 f-20"></i>
            <span class="font-weight-bold"> ثبت نام در سایت : </span>
        </div>
        <div style="width:7%;height:3px;background-color:white;margin-bottom:30px;"></div>
        <p class="f-12 mb-0"> کاربر گرامی، لطفا جهت ثبت نام در سایت، فرم زیر را با دقت پر کرده و روی دکمه ثبت کلیک نمایید: </p>
    </div>

    <!-- general errors -->
    <div class="register-res">
        <?= $this->displayErrors; ?>
    </div>

    <!-- form -->
    <form method="POST" action="<?=PROOT?>register/register" class="p-4">
      
        <div class="row">

            <div class="col-6 m-auto">

                <!-- csrf -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
                <?= FormHelper::csrfInput(); ?>

                <!-- full_name -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
                <label> نام و نام خانوادگی : <span class="text-danger">*</span></label>
                <input type="text" class="form-control text-center mr-3" name="full_name" value="<?= @$this->post['full_name'] ?>" autocomplete="off">
                <div class="invalid-feedback pr-3"></div>

                <!-- username --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
                <label> نام کاربری : <span class="text-danger">*</span></label>
                <input type="text" class="form-control text-center mr-3" name="username" value="<?= @$this->post['username'] ?>" autocomplete="off">
                <div class="invalid-feedback pr-3"></div>

                <!-- email ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
                <label> ایمیل : <span class="text-danger">*</span></label>
                <input type="email" class="form-control text-center mr-3" name="email" value="<?= @$this->post['email'] ?>" >
                <div class="invalid-feedback pr-3"></div>

                <!-- mobile ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
                <label> تلفن همراه : <span class="text-danger">*</span></label>
                <input type="text" class="form-control text-center mr-3" name="mobile" value="<?= @$this->post['mobile'] ?>" >
                <div class="invalid-feedback pr-3"></div>

                <!-- pass 1 ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
                <label> رمز عبور : <span class="text-danger">*</span></label>
                <input type="password" class="form-control text-center mr-3" name="pass_1" autocomplete="off">

                <!-- pass 2 ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
                <label> تکرار رمز عبور : <span class="text-danger">*</span></label>
                <input type="password" class="form-control text-center mr-3" name="pass_2" autocomplete="off">
                <div class="invalid-feedback pr-3"></div>
            </div>

        </div>

        <!-- aggreement ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
        <div class="custom-control custom-checkbox py-4 text-vsm text-center">
            <input type="checkbox" class="custom-control-input" id="accept-rules" name="accept_rules" checked>
            <label class="custom-control-label mb-2" for="accept-rules">اساسنامه را خوانده ام و با آن موافقم.</label>
        </div><hr class="p-0">

        <!-- submit ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
        <div class="d-flex justify-content-center align-items-center">
            <button type="submit" name="submit" class="btn-round-green-rev">ثبت نام</button>
            <p class="mr-5 mb-0 f-12" style="cursor:pointer;color:#566988;" onclick="location.href='<?=PROOT?>register/login'">از قبل حساب کاربری دارید؟ </p>
        </div>

    </form>

</div>
<?php $this->end(); ?>



