<?php
$basket = new stdClass();
?>
<nav id="navbar-con">



    <div id="main-navbar" class="navbar navbar-expand-lg navbar-light">


        <!-- navbar toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapsible" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


        <!-- collapsible part -->
        <div class="collapse navbar-collapse" id="navbar-collapsible">
            <div style="border-top: 1px solid lightgray;margin-top: 10px"></div>
            <!-- navbar links -->
            <ul class="navbar-nav py-3 py-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="<?=PROOT?>">
                        <i class="fa fa-xing pl-1"></i>
                        صفحه اصلی
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
            </ul>

            <div style="border-top: 1px solid lightgray;margin-bottom: 10px"></div>

            <div class="d-none d-lg-flex justify-content-around justify-content-lg-end align-items-center mr-auto pb-3 pb-lg-0" id="nav-left" data-target="#modal-show-signin" data-toggle="modal">

                <?php
                if (Session::exists(CURRENT_USER_SESSION_NAME)) {
                    echo "<a href='#' class='text-secondary ml-4'>" . currentUser()->username . "</a>";
                    echo "<a href='" . PROOT . "register/logout' class='text-secondary ml-2'>خروج</a>";
                }
                else {
                    echo "<a href='" . PROOT . "register/login' class='text-secondary ml-4'>ورود</a>";
                    echo "<a href='" . PROOT . "register/register' class='text-secondary ml-4'>ثبت نام</a>";
                }
                ?>
            </div>

        </div>


    </div>



</nav>