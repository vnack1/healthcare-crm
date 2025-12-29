<!DOCTYPE html>
<html lang="ko">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="<?= csrf_hash() ?>">

    <title>멜로시라 관리프로그램</title>

    <!-- <link rel="preconnect" href="https://fonts.gstatic.com" /> -->
    <link
      href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="/assets/css/bootstrap.css" />

    <link rel="stylesheet" href="/assets/vendors/iconly/bold.css" />
    <!-- 부트스트랩 아이콘 연결 -->
    <link
      rel="stylesheet"
      href="/assets/vendors/bootstrap-icons/bootstrap-icons.css"
    />
    <link rel="stylesheet" href="/assets/css/app.css" />

    <!-- Favicon links -->
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/favicon_io/favicon-16x16.png">
    <!-- <link rel="manifest" href="/site.webmanifest"> -->
  </head>
<!-- custom css 연결 -->
<link rel="stylesheet" href="/assets/css/custom/custom.css" />
<!-- flap picker 연결 -->

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<link rel="stylesheet" href="/assets/vendors/sweetalert2/sweetalert2.min.css">

  <body>
    <div id="app">