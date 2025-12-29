<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>멜로시라 회원관리프로그램 로그인</title>

    <link rel="stylesheet" href="<?= base_url('/assets/css/bootstrap.css')?>" />

    <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendors/iconly/bold.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendors/bootstrap-icons/bootstrap-icons.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/app.css" />

    <!-- Favicon links -->
    <link rel="apple-touch-icon" sizes="180x180"
        href="<?php echo base_url('assets/favicon_io/apple-touch-icon.png') ?>">
    <link rel="icon" type="image/png" sizes="32x32"
        href="<?php echo base_url('assets/favicon_io/favicon-32x32.png') ?>">
    <link rel="icon" type="image/png" sizes="16x16"
        href="<?php echo base_url('assets/favicon_io/favicon-16x16.png') ?>">
</head>

<!-- auth.css 연결  -->
<link rel="stylesheet" href="<?php echo base_url('assets/css/pages/auth.css') ?>">
</head>

<body>
    <div id="auth">
        <div class="row">
            <div class="col-lg-6 d-none d-lg-block">
                <img src="<?=base_url('assets/images/samples/login.jpg')?>" alt="login_left_img" class="img-fluid"
                    style="height:100vh;" />
            </div>

            <div class="col-lg-6 col-12">
                <div id="auth-left" style="height:100vh;">
                    <div class="auth-logo">
                        <a href="<?= base_url('/login')?>"><img src="assets/images/logo/logo.png" alt="Logo"
                                style="height:55px;" /></a>
                    </div>
                    <h1 class="auth-title">Log in.</h1>
                    <p class="auth-subtitle mb-5">로그인을 해주세요</p>

                    <form action="<?= base_url('/login')?>" method="POST">
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" class="form-control form-control-xl" name="user_id" placeholder="아이디" />
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" name="password" class="form-control form-control-xl"
                                placeholder="비밀번호" />
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <!-- 에러 메시지 -->
                        <?php if (session('error')): ?>
                        <p class="error-message" style="color: red; margin-bottom: 1.5rem; margin-top: 15px;">
                            <?= session('error') ?>
                        </p>
                        <?php endif; ?>

                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5" type="submit">
                            로그인
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>

</body>

</html>