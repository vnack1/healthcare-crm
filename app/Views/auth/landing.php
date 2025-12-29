<!DOCTYPE html>
<html lang="ko">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="<?= csrf_hash() ?>">

    <title>멜로시라 회원관리프로그램</title>

<link
      href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="<?= base_url('/assets/css/bootstrap.css')?>" />
    <link
      rel="stylesheet"
      href="<?php echo base_url() ?>assets/vendors/bootstrap-icons/bootstrap-icons.css"
    />
<link rel="stylesheet" href="<?=base_url('assets/css/custom/landing.css')?>"/>

<!-- Favicon links -->
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url('assets/favicon_io/apple-touch-icon.png') ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url('assets/favicon_io/favicon-32x32.png') ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('assets/favicon_io/favicon-16x16.png') ?>">
</head>

<body>
    <div id="landing-page">
      <nav class="navbar border-bottom">
        <div class="container">
          <div class="navbar-brand">
            <a href="#">
              <img
                src="assets/images/logo/logo.png"
                alt="melolife"
               
                style="height: 2rem;"
              />
            </a>
        </div>
        </div>
      </nav>

      <section>
        <div>
          <div class="text-center">
            <h5 class="fw-light" style="font-size: 28px">
              보다 더 편하게 회원을 관리해보세요
            </h5>
            <h1 style="font-size: 55px" class="pb-2">
              멜로시라 회원관리프로그램
            </h1>
            <a class="btn btn-primary px-5 py-2 fs-4" href="<?= base_url('/login')?>">
              <div class="d-flex">
              지금 바로 시작하기
                <i class="bi bi-chevron-right d-flex align-items-center"></i>
              </div>
            </a>
          </div>
          <img
            src="<?= base_url('assets/images/samples/landing_1.png') ?>"
            alt="dashboardpg"
            class="mt-5 img-fluid"
            style="width: 1000px; height: 600px"
          />
          <div class="d-flex justify-content-center">
            <div class="text-center pt-3">
              <div
                class="pe-2 d-flex align-items-center justify-content-center scroll-indicator"
                style="width: 80px; height: 80px"
              >
                <div class="btn">
                  <i class="bi bi-chevron-down fs-4"></i>
                  <div>scroll</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section style="padding-top: 60px">
        <div class="row mt-0">
          <div class="col-md-5">
            <img
            src="<?= base_url('assets/images/samples/landing_2.png') ?>"
              alt="landing2"
              class="img-fluid"
              style="width: 700px; height: 480px"
            />
          </div>
          <div
            class="col-md-7 d-flex justify-content-center align-items-center pe-5"
          >
            <div>
              <h1 class="section-heading">
                쉽고 편하게 회원을 등록하고 관리해보세요
              </h1>
              <p class="section-subtext mt-5">
                회원 등록, 검색, 수정, 리스트 관리를 간단하게 할 수 있습니다.
                <br />
                복잡한 작업은 줄이고, 필요한 회원 정보를 빠르고 정확하게
                찾아보세요. <br />
                쉽고 체계적인 관리로 업무를 더 편리하게 만들어 드립니다.
              </p>
            </div>
          </div>
          <div
            class="col-md-7 d-flex justify-content-center align-items-center ps-5"
          >
            <div>


              <h1 class="section-heading">
                건강 데이터를 한눈에 확인해보세요
              </h1>
              <p class="section-subtext mt-5">
                멜로시라를 마시는 사람들과 양자파동기 사용자의 데이터를 한눈에
                확인할 수 있는 <br />건강관리 데시보드입니다. 몇 주차에 얼마나
                많은 사용자가 있는지 손쉽게 파악하고, <br />체계적인 데이터로
                건강 관리의 효율성을 높여보세요.
              </p>
            </div>
          </div>
          <div class="col-md-5 pe-0 text-end">
            <img
            src="<?= base_url('assets/images/samples/landing_3.png') ?>"
              alt="landing3"
              class="img-fluid"
              style="width: 700px; height: 480px"
            />
          </div>
        </div>
      </section>

      <section style="padding-top: 60px">
        <div class="row mt-0">
          <div class="col-md-5">
            <img
            src="<?= base_url('assets/images/samples/landing_4.png') ?>"
              alt="landing4"
              class="img-fluid"
              style="width: 700px; height: 480px"
            />
          </div>
          <div
            class="col-md-7 d-flex justify-content-center align-items-center pe-5"
          >
            <div>
            <h1 class="section-heading">
                멜로시라 섭취 데이터를 기록해보세요
              </h1>
              <p class="section-subtext mt-5">
                멜로시라를 섭취 중인 회원의 정보를 한눈에
                확인하고 관리할 수 있습니다. <br />
                1주차, 2주차, 3주차, 4주차,
                8주차, 12주차의 섭취 상태와 빈도를 꼼꼼히 <br />기록하고 추적할
                수 있습니다.
              </p>
             
            </div>
          </div>
          <div
            class="col-md-7 d-flex justify-content-center align-items-center ps-5"
          >
            <div>
            <h1 class="section-heading">
                회원별 건강 상태를 세부적으로 기록하세요
              </h1>
              <p class="section-subtext mt-5">
                양자파동기를 사용하는 회원의 상세 정보를 확인하고
                관리할 수 있도록 도와줍니다.<br>
                주차별 데이터를 통해 건강 변화를 효과적으로
                추적하고 관리하세요.
              </p>
            </div>
          </div>
          <div class="col-md-5 pe-0 text-end">
            <img
            src="<?= base_url('assets/images/samples/landing_5.png') ?>"
              alt="landing5"
              class="img-fluid"
              style="width: 700px; height: 480px"
            />
          </div>
        </div>
      </section>

      <section
        id="faq-section" 
        class="d-block">
        <div class="text-center mb-5">
          <h1 style="font-size: 55px" class="pb-2">FAQ</h1>
          <h5 class="fw-light" style="font-size: 28px">
            주로 궁금해하는 내용들을 모았어요
          </h5>
        </div>

        <!-- FAQ Content -->
        <div class="container pb-5">
          <div class="accordion" id="faqAccordion">
            <!-- FAQ Item 1 -->
            <div class="accordion-item">
              <div class="accordion-header" id="headingOne">
                  <button
                    class="accordion-button collapsed faq-header w-100"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseOne"
                    aria-expanded="false"
                    aria-controls="collapseOne"
                  >
                    회원가입은 어떻게 하나요?
                    <i class="bi bi-chevron-down ms-auto align-middle"></i>
                  </button>
              </div>
              <div
                id="collapseOne"
                class="accordion-collapse collapse"
                aria-labelledby="headingOne"
                data-bs-parent="#faqAccordion"
              >
                <div class="accordion-body faq-body">
                회원가입은 따로 하지 않으셔도 됩니다. 본사에서 아이디를 만들어 드리며, 아이디와 비밀번호를 전달받으신 뒤 바로 사용하시면 됩니다. 혹시 아이디나 비밀번호를 못 받으셨거나, 문제가 있다면 본사로 문의해 주세요. (문의 전화: 02-515-2026)
                </div>
              </div>
            </div>

            <!-- FAQ Item 2 -->
            <div class="accordion-item">
              <div class="accordion-header" id="headingTwo">
                <button
                  class="accordion-button collapsed faq-header w-100"
                  type="button"
                  data-bs-toggle="collapse"
                  data-bs-target="#collapseTwo"
                  aria-expanded="false"
                  aria-controls="collapseTwo"
                >
                  메인 대시보드에 나와있는 차트는 무슨 의미인가요?
                  <i class="bi bi-chevron-down ms-auto align-middle"></i>
                </button>
              </div>
              <div
                id="collapseTwo"
                class="accordion-collapse collapse"
                aria-labelledby="headingTwo"
                data-bs-parent="#faqAccordion"
              >
                <div class="accordion-body faq-body">
                 현재 멜로시라를 섭취하고 있어서 상태가 "진행중"인 회원들의 주차별 수치를 표시합니다.
                </div>
              </div>
            </div>

            <!-- FAQ Item 3 -->
            <div class="accordion-item">
              <div class="accordion-header" id="headingThree">
                <button
                  class="accordion-button collapsed faq-header w-100"
                  type="button"
                  data-bs-toggle="collapse"
                  data-bs-target="#collapseThree"
                  aria-expanded="false"
                  aria-controls="collapseThree"
                >
                  멜로시라 섭취 상태는 어떻게 기록하나요?
                  <i class="bi bi-chevron-down ms-auto align-middle"></i>
                </button>
              </div>
              <div
                id="collapseThree"
                class="accordion-collapse collapse"
                aria-labelledby="headingThree"
                data-bs-parent="#faqAccordion"
              >
                <div class="accordion-body faq-body">
                1. [멜로시라 전체 리스트] 페이지에서 회원 선택
                <div class="pt-2"></div>
                2. 섭취 정보 등록 <br>
                초록색으로 표시된 "등록 가능" 글자를 클릭하세요.
                <div class="pt-2"></div>
                3. 상태 변경 <br>
                처음 시작일을 등록한 뒤, 상태를 "진행중"으로 설정하고 저장하세요.
                상태를 "완료"로 변경해야 섭취빈도 등록이 가능합니다. <br>
                <div class="pt-2"></div>
                4. 잘못된 기록 수정 <br>
                잘못 입력된 기록이 있다면, 해당 주차의 기록을 클릭하여 수정한 뒤 저장하면 됩니다.
                </div>
              </div>
            </div>

            <!-- FAQ Item 4 -->
            <div class="accordion-item">
              <div class="accordion-header" id="headingFour">
                <button
                  class="accordion-button collapsed faq-header w-100"
                  type="button"
                  data-bs-toggle="collapse"
                  data-bs-target="#collapseFour"
                  aria-expanded="false"
                  aria-controls="collapseFour"
                >
                  [멜로시라 전체 리스트] 페이지에서 "알림"은 무슨 표시인가요?
                  <i class="bi bi-chevron-down ms-auto align-middle"></i>
                </button>
              </div>
              <div
                id="collapseFour"
                class="accordion-collapse collapse"
                aria-labelledby="headingFour"
                data-bs-parent="#faqAccordion"
              >
                <div class="accordion-body faq-body">
                  1. 멜로시라 정보 입력 : 멜로시라 섭취 정보가 등록되지 않은 회원입니다. 정보를 입력해 관리하세요.<br> 
                     <div class="pt-2"></div>
                  2. 섭취진행중 : 멜로시라 섭취 상태가 "진행중"인 회원을 표시합니다. <br>
                    <div class="pt-2"></div>
                  3. 다음 회차를 진행해주세요. : 다음 회차를 진행해야 하는 회원을 표시합니다. <br>
                    <div class="pt-2"></div>
                  4. 전화예정 D-1 : 각 주차의 시작일을 기준으로 일주일이 지나기 하루 전, 이 문구가 떠 관리가 필요한 회원을 나타냅니다. <br>
                    <div class="pt-2"></div>
                  5. 전화대상자 : "전화예정 D-1"에서 하루가 지나면 문구가 "전화대상자"로 문구가 변경됩니다. 해당 회원에게 전화를 걸어 섭취 빈도나 특이사항을 확인해주세요.
                </div>
              </div>
            </div>

            <!-- FAQ Item 5 -->
            <div class="accordion-item">
              <div class="accordion-header" id="headingFive">
                <button
                  class="accordion-button collapsed faq-header w-100"
                  type="button"
                  data-bs-toggle="collapse"
                  data-bs-target="#collapseFive"
                  aria-expanded="false"
                  aria-controls="collapseFive"
                >
                양자파동기 검사 후 기록은 어떻게 하나요?
                  <i class="bi bi-chevron-down ms-auto align-middle"></i>
                </button>
              </div>
              <div
                id="collapseFive"
                class="accordion-collapse collapse"
                aria-labelledby="headingFive"
                data-bs-parent="#faqAccordion"
              >
                <div class="accordion-body faq-body">
                1. [양자파동기 전체 리스트] 페이지에서 회원 선택<br>
                <div class="pt-2"></div>
                2. 검사 정보 등록 <br>
                초록색으로 표시된 "등록 가능" 글자를 클릭하세요.
                <div class="pt-2"></div>
                3. 잘못된 기록 수정 <br>
                잘못 입력된 기록이 있다면, 해당 주차의 기록을 클릭하여 수정한 뒤 저장하면 됩니다.
                </div>
              </div>
            </div>
          </div>
        </div>

        <button
          id="topButton"
          class="btn btn-primary d-flex d-none"
          title="맨 위로"
        >
          <i class="bi bi-arrow-up fs-1 ms-1 mt-2"></i>
        </button>
        
      </section>
      <!-- footer -->
      <footer class="py-5 border-top bg-white">
        <div class="container py-4 mt-1 ">
          <h3 class="text-start">(주)지에스랜드</h3>
          <hr class="my-4" />
          <div class="d-flex justify-content-between">
            <p>대표: 김유신</p>
            <p>주소: 서울 강남구 학동로 309 6층</p>
            <p>전화: 02-515-2026</p>
            <p>팩스: 02-518-2026</p>
            <p>사업자등록번호: 231-81-11769</p>
          </div>
          
          <p class="mb-0 text-start">Copyright © 2024 GSLand Co., Ltd.</p>
        </div>
      </footer>
    </div>

    <script src="<?= base_url('/assets/js/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?= base_url('/assets/js/custom/landing.js') ?>"></script>

  </body>
</html>