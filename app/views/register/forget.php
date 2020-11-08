<?php $this->start('head'); ?>
<?php $this->end(); ?>




<?php $this->start('body'); ?>
<div class="two-part-box">

    <!-- right-part -->
    <div class="two-part-right col-12 col-md-4">
        آدرس ایمیلی که با آن در وب سایت ثبت نام کرده اید را وارد نمایید :
    </div>

    <!-- left-part -->
    <div class="two-part-left col-12 col-md-8">
        <form method="POST" action="<?=PROOT?>register/forget">
            <?= FormHelper::csrfInput(); ?>
            <p class="two-part-left-header"> فراموشی کلمه عبور </p>
            <div class="two-part-left-body">
                
                <!-- email -->
                <div class="scalable-input-wrapper validate-input mt-5 mb-0">
                    <input id="email" name="email" type="text" class="scalable-input" autocomplete="off">
                    <span class="scalable-input-title" data-placeholder="آدرس ایمیل"></span>
                </div>      
                
                <!-- errors -->
                <small class="login-res">
                    <?= $this->displayErrors; ?>
                </small>
                <small class="form-res">
                    <?= $this->resultMessage; ?>
                </small>

            </div>
            <div class="two-part-left-footer mt-4">
                <button type="submit" class="btn-round-green-rev d-block m-auto mt-5"><i class="fa fa-comment-o pl-2"></i>ارسال ایمیل</button>
            </div>
        </form>
    </div>

</div>
<?php $this->end(); ?>


