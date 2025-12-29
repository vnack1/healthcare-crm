<!DOCTYPE html>
<html lang="ko">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - Mazer Admin Dashboard</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap"
      rel="stylesheet"
    />    <link rel="stylesheet" href="<?=base_url('assets/css/bootstrap.css')?>" />

<link rel="stylesheet" href="<?=base_url('assets/css/app.css')?>">
<link rel="stylesheet" href="<?=base_url('assets/css/pages/auth.css')?>">
<link rel="stylesheet" href="<?=base_url('assets/css/custom/landing.css')?>">

<body>
    <div id="landing-page">
      <nav class="navbar">
        <div class="container">
          <a class="navbar-brand" href="#">
            <img
              src="/docs/5.3/assets/brand/bootstrap-logo.svg"
              alt="melolife"
              width="30"
              height="24"
            />
          </a>
        </div>
      </nav>

      <section>
        <div>
          <div class="text-center">
            <h5 class="fw-light" style="font-size: 28px">
              보다 더 편하게 회원을 관리해보세요
            </h5>
            <h1 style="font-size: 55px" class="pb-2">
              멜로시라 회원 관리 프로그램
            </h1>
            <a class="btn btn-primary px-5 py-2 fs-4" 
           href="<?= base_url('login')?>">
              지금 바로 시작하기
            </a>
          </div>
          <img
            src="<?= base_url('assetes/images/samples/landing_1.png')?>"
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

      <section style="padding-top: 85px">
        <div class="row mt-0">
          <div class="col-md-4">
            <img
             src="<?= base_url('assetes/images/samples/landing_2.png')?>"
              alt="landing2"
              class="img-fluid"
              style="width: 700px; height: 480px"
            />
          </div>
          <div
            class="col-md-8 d-flex justify-content-center align-items-center"
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
            class="col-md-8 d-flex justify-content-center align-items-center"
          >
            <div>
              <h1 class="section-heading">
                건강 데이터를 한눈에, 더 효과적으로 관리하세요
              </h1>
              <p class="section-subtext mt-5">
                멜로시라를 마시는 사람들과 양자파동기 사용자의 데이터를 한눈에
                확인할 수 있는 <br />건강관리 데시보드입니다. 몇 주차에 얼마나
                많은 사용자가 있는지 손쉽게 파악하고, <br />체계적인 데이터로
                건강 관리의 효율성을 높여보세요.
              </p>
            </div>
          </div>
          <div class="col-md-4">
            <img
            src="<?= base_url('assetes/images/samples/landing_3.png')?>""
              alt="landing5"
              class="img-fluid"
              style="width: 700px; height: 480px"
            />
          </div>
        </div>
      </section>

      <section style="padding-top: 85px">
        <div class="row mt-0">
          <div class="col-md-4">
            <img
              src="<?= base_url('assetes/images/samples/laning_4.png')?>"
              alt="landing3"
              class="img-fluid"
              style="width: 700px; height: 480px"
            />
          </div>
          <div
            class="col-md-8 d-flex justify-content-center align-items-center"
          >
            <div>
              <h1 class="section-heading">
                회원별 건강 상태를 세부적으로 기록하세요
              </h1>
              <p class="section-subtext mt-5">
                이 페이지는 양자파동기를 사용하는 회원의 상세 정보를 확인하고
                관리할 수 있도록 도와줍니다.<br />
                회원의 이름, 성별, 생년월일, 전화번호와 같은 기본 정보와 함께,
                회원의 1주차부터 3주차까지의 검사 결과를 <br />간편하게 등록하고
                확인할 수 있습니다. 주차별 데이터를 통해 건강 변화를 효과적으로
                추적하고 관리하세요.
              </p>
            </div>
          </div>
          <div
            class="col-md-8 d-flex justify-content-center align-items-center"
          >
            <div>
              <h1 class="section-heading">
                멜로시라 섭취 데이터를 꼼꼼히 관리하세요
              </h1>
              <p class="section-subtext mt-5">
                이 페이지에서는 멜로시라를 섭취 중인 회원의 정보를 한눈에
                확인하고 관리할 수 있습니다. <br />
                회원의 이름, 성별, 생년월일, 전화번호와 같은 기본 정보부터 섭취
                시작일과 진행 주차, <br />그리고 1주차, 2주차, 3주차, 4주차,
                8주차, 12주차의 섭취 상태와 빈도를 꼼꼼히 기록하고 <br />추적할
                수 있습니다. 주차별 데이터를 통해 회원의 건강 변화 과정을
                체계적으로 살펴보세요.
              </p>
            </div>
          </div>
          <div class="col-md-4">
            <img
              src="<?= base_url('assetes/images/samples/landing_5.png')?>"
              alt="landing4"
              class="img-fluid"
              style="width: 700px; height: 480px"
            />
          </div>
        </div>
      </section>

      <section
        style="background-color: #ebebeb; padding-top: 125px"
        class="d-block"
      >
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
                <div>
                  <button
                    class="accordion-button collapsed faq-header w-100"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseOne"
                    aria-expanded="false"
                    aria-controls="collapseOne"
                  >
                    회원가입은 어떻게 하나요?
                    <i class="bi bi-chevron-down ms-auto mb-3"></i>
                  </button>
                </div>
              </div>
              <div
                id="collapseOne"
                class="accordion-collapse collapse"
                aria-labelledby="headingOne"
                data-bs-parent="#faqAccordion"
              >
                <div class="accordion-body faq-body">
                  대회 일시는 2024년 12월 7일(토) / 집결 시간은 (08:00), 달리기
                  출발시간은 (09:00)입니다.
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
                  참가 방법이 궁금합니다.
                  <i class="bi bi-chevron-down ms-auto mb-3"></i>
                </button>
              </div>
              <div
                id="collapseTwo"
                class="accordion-collapse collapse"
                aria-labelledby="headingTwo"
                data-bs-parent="#faqAccordion"
              >
                <div class="accordion-body faq-body">
                  참가 신청은 홈페이지 상단 메뉴에서 "참가 신청" 버튼을 클릭 후
                  안내에 따라 정보를 입력하고 결제하시면 됩니다.
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
                  참가자 정보 수정이 가능한가요?
                  <i class="bi bi-chevron-down ms-auto mb-3"></i>
                </button>
              </div>
              <div
                id="collapseThree"
                class="accordion-collapse collapse"
                aria-labelledby="headingThree"
                data-bs-parent="#faqAccordion"
              >
                <div class="accordion-body faq-body">
                  참가자 정보는 신청 후 1회에 한해 수정 가능합니다. 수정 요청은
                  고객센터로 연락해주세요.
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
                  참가 방법이 궁금합니다.
                  <i class="bi bi-chevron-down ms-auto mb-3"></i>
                </button>
              </div>
              <div
                id="collapseFour"
                class="accordion-collapse collapse"
                aria-labelledby="headingFour"
                data-bs-parent="#faqAccordion"
              >
                <div class="accordion-body faq-body">
                  참가 신청은 홈페이지 상단 메뉴에서 "참가 신청" 버튼을 클릭 후
                  안내에 따라 정보를 입력하고 결제하시면 됩니다.
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
                  참가 방법이 궁금합니다.
                  <i class="bi bi-chevron-down ms-auto mb-3"></i>
                </button>
              </div>
              <div
                id="collapseFive"
                class="accordion-collapse collapse"
                aria-labelledby="headingFive"
                data-bs-parent="#faqAccordion"
              >
                <div class="accordion-body faq-body">
                  참가 신청은 홈페이지 상단 메뉴에서 "참가 신청" 버튼을 클릭 후
                  안내에 따라 정보를 입력하고 결제하시면 됩니다.
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
        <footer class="mt-5 bg-white pt-5">
          <div class="container pb-4">
            <h3>(주)지에스랜드</h3>
            <hr class="my-4" />
            <div class="d-flex gap-4 container fs-4">
              <p>대표: 김유신</p>
              <p>주소: 서울 강남구 학동로 309 6층</p>
              <p>전화: 02-515-2026</p>
              <p>팩스: 02-518-2026</p>
              <p>사업자등록번호: 231-81-11769</p>
            </div><div class="d-flex gap-4 container fs-4">
              <p>대표: 김유신</p>
              <p>주소: 서울 강남구 학동로 309 6층dldldl</p>
            </div>
            <p class="container fs-4">Copyright © 2024 GS Land Co., Ltd.</p>
          </div>
        </footer>
      </section>
    </div>
</body>
</html>
    <script src="<?= base_url('/assets/js/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?= base_url('/assetes/js/custom/landing.js')?>"></script>
