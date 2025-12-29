<?= $this->include('templates/header') ?>
<?= $this->include('templates/sidebar') ?>


<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>

        <style>
        .modal-dialog {
            max-width: 800px;
            /* 가로 크기 제한 (필요에 따라 조정 가능) */
        }

        .modal-content {
            max-height: 200vh;
            /* 모달 창 세로 높이 최대 80% */
            overflow-y: auto;
            /* 초과 내용 스크롤 활성화 */
        }

        .modal-body {
            max-height: 90vh;
            /* 모달 본문 최대 높이 */
            overflow-y: auto;
            /* 본문에서 세로 스크롤 활성화 */
        }
        </style>
        <style>
        /* 특정 보기 버튼 위치 조정 */
        .terms-button {
            margin-top: -3px;
            /* 살짝 위로 이동 */
        }
        </style>

    </header>
    <?php if (session()->getFlashdata('register_success')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('register_success') ?>
    </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('register_error')): ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('register_error') ?>
    </div>
    <?php endif; ?>

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>총판 등록</h3>
                    <p class="text-subtitle text-muted">
                        총판 등록이 가능합니다
                    </p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="<?php echo base_url('/dashboard') ?>">메인</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                총판 관리
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- 회원조회 -->
        <section id="basic-horizontal-layouts">
            <div class="row match-height">
                <div class="col-md-12 col-12">
                    <div class="card">
                        <div class="card-header d-flex">
                            <h4 class="card-title pe-3">총판정보 입력</h4>
                            <h6 class="fw-light d-flex align-items-center"><span class="text-danger">*</span> 표시는 반드시
                                입력하셔야 하는 항목입니다</h6>
                        </div>
                        <div class="card-content">
                            <div class="card-body px-5">


                                <form method="POST"
                                    action="<?php echo base_url('user-management/distributer/enroll'); ?>"
                                    class="form form-horizontal">
                                    <input type="hidden" name="ref_menu" value="distributer">
                                    <input type="hidden" name="ref" value="distributer-list">
                                    <?php echo csrf_field(); ?>
                                    <div class="form-body">
                                        <div class="row">
                                            <!-- 이름 입력 -->
                                            <div class="col-md-2 form-group">
                                                <label class="pt-2">이름<span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-md-10 form-group mb-0">
                                                <input type="text" id="name" class="form-control" name="user_name"
                                                    placeholder="이름을 입력해주세요" required>
                                            </div>

                                            <!-- 성별 선택 -->
                                            <div class="col-md-2 form-group">
                                                <label class="mt-2">성별<span class="text-danger">*</span></label>
                                            </div>

                                            <div class="col-md-10 form-check mt-1 d-flex" style="height: 38px;">
                                                <div class="mx-4 col-md-4 form-group">
                                                    <input class="form-check-input" type="radio" name="gender" value="0"
                                                        id="flexRadioDefault1" required>
                                                    <label class="form-check-label ms-2" for="flexRadioDefault1">
                                                        남자
                                                    </label>
                                                </div>
                                                <div class="mx-4 col-md-4">
                                                    <input class="form-check-input" type="radio" name="gender" value="1"
                                                        id="flexRadioDefault2" required>
                                                    <label class="form-check-label ms-2" for="flexRadioDefault2">
                                                        여자
                                                    </label>
                                                </div>
                                            </div>

                                            <!-- 생년월일 입력 -->
                                            <div class="col-md-2 form-group">
                                                <label class="pt-2">생년월일<span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="birth_date" name="birth_date"
                                                    class="form-control" placeholder="YYYY-MM-DD" required
                                                    autocomplete="off">
                                            </div>

                                            <!-- 휴대폰 입력 -->
                                            <div class="col-md-2 form-group">
                                                <label class="pt-2">전화번호<span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="phone-number" class="form-control" name="phone"
                                                    placeholder="'-' 없이 입력해주세요" required>
                                            </div>
                                            <!-- 멤버코드 입력 -->
                                            <div class="col-md-2 form-group">
                                                <label class="pt-2">멤버코드<span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-md-8 form-group pe-0">
                                                <input type="text" id="member_code" class="form-control"
                                                    name="member_code"
                                                    placeholder="ex) ABC000 '(영문 대문자 3자리 + 숫자 3자리)' 입력" required>
                                                <div id="memberCodeCheckMessage" class="member-code-message col-md-10">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" id="checkMemberCodeBtn"
                                                    class="btn btn-secondary w-100">중복 확인</button>
                                            </div>
                                            <!-- 아이디 입력 -->
                                            <div class="col-md-2 form-group">
                                                <label class="pt-2">아이디<span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-md-8 form-group pe-0">
                                                <input type="text" class="form-control" id="user_id" name="user_id"
                                                    autocomplete="username" placeholder="아이디를 입력해주세요" required>
                                                <div id="userIdCheckMessage" class="user-id-message col-md-10"></div>
                                            </div>

                                            <div class="col-md-2">
                                                <button type="button" id="checkUserIdBtn"
                                                    class="btn btn-secondary w-100">중복 확인</button>
                                            </div>

                                            <!-- 비밀번호 입력 -->
                                            <div class="col-md-2 form-group">
                                                <label class="pt-2">비밀번호<span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="password" class="form-control" name="password"
                                                    autocomplete="current-password" placeholder="비밀번호를 입력해주세요" required>
                                            </div>

                                            <!-- 이메일 입력 -->
                                            <div class="col-md-2 form-group">
                                                <label class="pt-2">이메일<span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-md-8 pe-0 form-group">
                                                <div class="d-flex gap-2">
                                                    <input type="text" id="email" class="form-control" name="email"
                                                        placeholder="예) happyday" required>
                                                    <span class="d-flex align-items-center">@</span>
                                                    <div id="domainContainer" class="d-flex w-100">
                                                        <select class="form-select w-100" id="emailSelect"
                                                            name="domain">
                                                            <option value="" disabled selected>도메인을 선택하세요</option>
                                                            <option value="gmail.com">gmail.com</option>
                                                            <option value="naver.com">naver.com</option>
                                                            <option value="nate.com">nate.com</option>
                                                            <option value="hanmail.net">hanmail.net</option>
                                                            <option value="daum.net">daum.net</option>
                                                            <option value="custom">직접 입력</option>
                                                        </select>
                                                    </div>

                                                </div>
                                                <div id="emailCheckMessage" class="email-message col-md-10 ms-2 mt-1">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" id="checkUseremailBtn"
                                                    class="btn btn-secondary w-100">중복 확인</button>

                                            </div>

                                            <!-- 주소 입력 -->
                                            <div class="col-md-2 form-group">
                                                <label class="pt-2">주소</label>
                                            </div>
                                            <div class="col-md-8 form-group pe-0">
                                                <input type="text" class="form-control" id="sample6_postcode"
                                                    name="postcode" readonly>
                                            </div>

                                            <div class="col-md-2 form-group">
                                                <button type="button" class="btn btn-secondary w-100"
                                                    onclick="sample6_execDaumPostcode();">주소 찾기</button>

                                            </div>
                                            <div class="col-md-2 form-group"></div>

                                            <div class="col-md-10 form-group">
                                                <input type="text" class="form-control" id="sample6_address"
                                                    name="address" readonly>
                                            </div>

                                            <div class="col-md-2 form-group">
                                            </div>

                                            <div class="col-md-10 form-group">
                                                <input type="text" class="form-control" id="sample6_detailAddress"
                                                    name="address_detail" placeholder="상세주소를 입력해주세요">
                                            </div>

                                            <!-- 메모 입력 -->
                                            <div class="col-md-2 form-group">
                                                <label class="pt-2">메모</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <textarea type="text" id="memo" class="form-control" name="notes"
                                                    placeholder="메모를 입력해주세요"
                                                    style="height: 115px; resize: none; overflow:auto;"></textarea>
                                            </div>
                                            <!-- 이용약관 및 개인정보 처리방침 -->
                                            <div class="col-md-2 form-group">
                                                <label class="pt-2">약관동의</label>
                                            </div>
                                            <div class="col-md-10">
                                                <div class="form-check mb-1 d-flex gap-4">
                                                    <div style="width:250px;">
                                                        <input class="form-check-input" type="checkbox" id="agreeTerms">
                                                        <label class="form-check-label" for="agreeTerms" >
                                                            이용약관에 동의합니다.
                                                        </label>
                                                    </div>
                                                    <button type="button" class="btn btn-link p-0 terms-button"
                                                        data-bs-toggle="modal" data-bs-target="#termsModal">
                                                        [보기]
                                                    </button>
                                                </div>
                                                <div class="form-check d-flex gap-4">
                                                    <div style="width:250px;">
                                                        <input class="form-check-input" type="checkbox" id="agreePrivacy">
                                                        <label class="form-check-label" for="agreePrivacy">
                                                            개인정보 처리방침에 동의합니다.
                                                        </label>
                                                    </div>
                                                    <button type="button" class="btn btn-link p-0 terms-button"
                                                        data-bs-toggle="modal" data-bs-target="#privacyModal">
                                                        [보기]
                                                    </button>
                                                </div>
                                            </div>

                                            <!-- 이용약관 모달 -->
                                            <div class="modal fade" id="termsModal" tabindex="-1"
                                                aria-labelledby="termsModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="termsModalLabel">이용약관</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body" id="termsContent">
                                                            로딩 중...
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- 개인정보 처리방침 모달 -->
                                            <div class="modal fade" id="privacyModal" tabindex="-1"
                                                aria-labelledby="privacyModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="privacyModalLabel">개인정보 처리방침
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body" id="privacyContent">
                                                            로딩 중...
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- 제출 버튼 -->
                                            <div class="col-12 d-flex justify-content-center mt-4 gap-3"
                                                style="height:45px">
                                                <a href="<?= base_url('user-management/distributer/distributerlist')?>?ref_menu=distributer&ref=distributer-list"
                                                    class="btn btn-danger d-flex align-items-center justify-content-center"
                                                    style="width: 160px;font-size: 18px;">취소하기</a>
                                                <button type="click" id="success"
                                                    class="btn btn-primary d-flex align-items-center justify-content-center"
                                                    style="width: 160px;font-size: 18px">
                                                    등록하기
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
                <?= $this->include('templates/footer') ?>
            </div>
    </div>
</div>
</section>


<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/rangePlugin.js"></script>
<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script src="<?= base_url('/assets/js/custom/custom.js') ?>"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Flashdata 메시지 표시
    const successMessage = "<?= session()->getFlashdata('success') ?>";
    const errorMessage = "<?= session()->getFlashdata('error') ?>";

    // 페이지가 등록 프로세스에서 리다이렉트된 경우에만 SweetAlert 실행
    if (document.referrer.includes("distributer/enroll") && successMessage) {
        Swal.fire({
            icon: "success",
            title: "성공",
            text: successMessage,
            confirmButtonText: "확인",
        });
    }

    if (document.referrer.includes("distributer/enroll") && errorMessage) {
        Swal.fire({
            icon: "error",
            title: "실패",
            text: errorMessage,
            confirmButtonText: "확인",
        });
    }

    // flatpickr 초기화
    flatpickr("#birth_date", {
        dateFormat: "Y-m-d",
        allowInput: true,
        maxDate: "today",
    });
});

// 주소 검색 기능
function sample6_execDaumPostcode() {
    new daum.Postcode({
        oncomplete: function(data) {
            let addr = "";
            let extraAddr = "";

            if (data.userSelectedType === "R") {
                addr = data.roadAddress;
            } else {
                addr = data.jibunAddress;
            }

            if (data.userSelectedType === "R") {
                if (data.bname !== "" && /[동|로|가]$/g.test(data.bname)) {
                    extraAddr += data.bname;
                }
                if (data.buildingName !== "" && data.apartment === "Y") {
                    extraAddr += extraAddr !== "" ? `, ${data.buildingName}` : data
                        .buildingName;
                }
                if (extraAddr !== "") {
                    extraAddr = ` (${extraAddr})`;
                }
            }

            document.getElementById("sample6_postcode").value = data.zonecode;
            document.getElementById("sample6_address").value = addr + extraAddr;
            document.getElementById("sample6_detailAddress").focus();
        },
    }).open();
}
</script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const termsButton = document.querySelector('[data-bs-target="#termsModal"]');
    const privacyButton = document.querySelector('[data-bs-target="#privacyModal"]');
    const termsContent = document.getElementById("termsContent");
    const privacyContent = document.getElementById("privacyContent");

    termsButton.addEventListener("click", function() {
        fetch("<?= base_url('modal-content/terms') ?>")
            .then((response) => {
                if (!response.ok) {
                    throw new Error("Failed to load terms content");
                }
                return response.text();
            })
            .then((data) => {
                termsContent.innerHTML = data;
            })
            .catch((error) => {
                termsContent.innerHTML = "<p>이용약관을 불러오는 중 오류가 발생했습니다.</p>";
            });
    });

    privacyButton.addEventListener("click", function() {
        fetch("<?= base_url('modal-content/privacy') ?>")
            .then((response) => {
                if (!response.ok) {
                    throw new Error("Failed to load privacy content");
                }
                return response.text();
            })
            .then((data) => {
                privacyContent.innerHTML = data;
            })
            .catch((error) => {
                privacyContent.innerHTML = "<p>개인정보 처리방침을 불러오는 중 오류가 발생했습니다.</p>";
            });
    });
});
</script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    let userIdValid = false;
    let emailValid = false;
    let phoneNumberValid = false;

    // 메시지 표시 함수
    function showMessage(element, message, isValid) {
        element.innerText = message;
        if (isValid) {
            element.classList.remove("text-danger");
            element.classList.add("text-success");
        } else {
            element.classList.remove("text-success");
            element.classList.add("text-danger");
        }
    }

    // 이름 유효성 검사
    const nameInput = document.querySelector('input[name="user_name"]');
    const nameMessage = document.createElement("div");
    nameMessage.className = "name-message text-danger ms-2 mt-1";
    nameInput.parentElement.appendChild(nameMessage);
    nameInput.addEventListener("input", function() {
        this.value = this.value.replace(/\s+/g, ""); // 모든 공백 제거
    });
    nameInput.addEventListener("input", function() {
        const name = nameInput.value; // 입력값 가져오기
        const nameRegex = /^[가-힣a-zA-Z]{2,16}$/; // 2~16자의 한글 또는 영문만 허용
        if (!nameRegex.test(name)) {
            showMessage(
                nameMessage,
                "이름은 공백 없이 2~16자의 한글 또는 영문으로 입력해주세요.",
                false
            );
        } else {
            showMessage(nameMessage, "", true);
        }
    });

    // 성별 유효성 검사
    const genderInputs = document.querySelectorAll('input[name="gender"]');

    function checkGenderValidity() {
        return Array.from(genderInputs).some(input => input.checked);
    }

    // 전화번호 유효성 검사
    const phoneNumberInput = document.getElementById("phone-number");
    const phoneRegex = /^\d{3}-\d{3,4}-\d{4}$/;

    phoneNumberInput.addEventListener("input", function() {
        const phone = phoneNumberInput.value.trim();

        if (!phoneRegex.test(phone)) {
            phoneNumberValid = false;
        } else {
            phoneNumberValid = true;
        }
    });

    // 생년월일 유효성 검사
    const birthDateInput = document.querySelector('input[name="birth_date"]');
    const birthDateMessage = document.createElement("div");
    birthDateMessage.className = "birth-date-message text-danger ms-2 mt-1";
    birthDateInput.parentElement.appendChild(birthDateMessage);

    birthDateInput.addEventListener("input", function() {
        if (!birthDateInput.value.trim()) {
            showMessage(birthDateMessage, "생년월일을 입력해주세요.", false);
        } else {
            showMessage(birthDateMessage, "", true);
        }
    });


    // 멤버코드 유효성 검사 및 중복 확인
    const memberCodeInput = document.getElementById("member_code");
    const checkMemberCodeBtn = document.getElementById("checkMemberCodeBtn");
    const memberCodeCheckMessage = document.getElementById("memberCodeCheckMessage");

    let memberCodeValid = false; // 유효성 변수
    memberCodeInput.addEventListener("input", function() {
        this.value = this.value.replace(/\s+/g, ""); // 모든 공백 제거
    });
    // 메시지 표시 함수
    function showMessage(element, message, isValid) {
        element.innerText = message;
        if (isValid) {
            element.classList.remove("text-danger");
            element.classList.add("text-success");
        } else {
            element.classList.remove("text-success");
            element.classList.add("text-danger");
        }
    }

    checkMemberCodeBtn.addEventListener("click", function() {
        const memberCode = memberCodeInput.value.trim();
        const memberCodeRegex = /^[A-Z]{3}\d{3}$/; // 정규식: 대문자 3자리 + 숫자 2자리

        if (!memberCodeRegex.test(memberCode)) {
            memberCodeCheckMessage.classList.add("ms-2");
            memberCodeCheckMessage.classList.add("mt-1");
            showMessage(memberCodeCheckMessage, "멤버코드는 영문 대문자 3자리와 숫자 3자리로 입력해주세요.", false);
            memberCodeValid = false;
            return;
        }

        // 서버로 중복 확인 요청
        fetch("<?= base_url('user-management/check-member-code') ?>", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    member_code: memberCode
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === "success") {
                    showMessage(memberCodeCheckMessage, "사용 가능한 멤버코드입니다.", true);
                    memberCodeValid = true;
                } else {
                    showMessage(memberCodeCheckMessage, data.message || "오류가 발생했습니다.", false);
                    memberCodeValid = false;
                }
            })
            .catch(() => {
                showMessage(memberCodeCheckMessage, "멤버코드 확인 중 오류가 발생했습니다.", false);
                memberCodeValid = false;
            });
    });

    // 아이디 유효성 검사 및 중복 확인
    const userIdInput = document.getElementById("user_id");
    const checkUserIdBtn = document.getElementById("checkUserIdBtn");
    const userIdCheckMessage = document.getElementById("userIdCheckMessage");
    userIdInput.addEventListener("input", function() {
        this.value = this.value.replace(/\s+/g, ""); // 모든 공백 제거
    });
    checkUserIdBtn.addEventListener("click", function() {
        const userId = userIdInput.value;
        const userIdRegex = /^[a-z0-9]{3,16}$/; // 대문자 제외, 소문자와 숫자만 허용

        if (!userIdRegex.test(userId)) {
            showMessage(userIdCheckMessage, "아이디는 공백 없이 3~16자의 소문자 영문 또는 숫자로 입력해주세요.", false);
            userIdCheckMessage.classList.add("ms-2");
            userIdCheckMessage.classList.add("mt-1");
            userIdValid = false;
            return;
        }

        fetch("<?= base_url('user/check-duplicate') ?>", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    user_id: userId.toLowerCase()
                }),
            })
            .then((response) => response.json())
            .then((data) => {
                showMessage(userIdCheckMessage, data.message || "오류가 발생했습니다.", data.status ===
                    "success");
                userIdValid = data.status === "success";
            })
            .catch(() => {
                showMessage(userIdCheckMessage, "중복 확인 중 오류가 발생했습니다.", false);
                userIdValid = false;
            });
    });

    // 비밀번호 유효성 검사
    const passwordInput = document.querySelector('input[name="password"]');
    const passwordMessage = document.createElement("div");
    passwordMessage.className = "password-message text-danger ms-2 mt-1";
    passwordInput.parentElement.appendChild(passwordMessage);
    passwordInput.addEventListener("input", function() {
        this.value = this.value.replace(/\s+/g, ""); // 모든 공백 제거
    });
    passwordInput.addEventListener("input", function() {
        const password = passwordInput.value.trim();
        const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[!@#$%^&*()_+=\-{}|:<>?~`]).{8,16}$/;
        if (!passwordRegex.test(password)) {
            showMessage(passwordMessage, "비밀번호는 8~16자의 영문, 숫자, 특수문자를 포함해야 합니다.", false);
        } else {
            showMessage(passwordMessage, "", true);
        }
    });

    // 이메일 유효성 검사 및 중복 확인
    const emailInput = document.getElementById("email"); // 이메일 아이디 입력 필드
    const domainSelect = document.getElementById("emailSelect"); // 도메인 선택 필드
    const domainContainer = document.getElementById("domainContainer"); // 도메인 컨테이너
    const checkUserEmailBtn = document.getElementById("checkUseremailBtn"); // 중복 확인 버튼
    const emailCheckMessage = document.getElementById("emailCheckMessage"); // 중복 확인 결과 메시지 표시 영역
    let customDomainInput = null;
    emailInput.addEventListener("input", function() {
        this.value = this.value.replace(/\s+/g, ""); // 모든 공백 제거
    });
    // 이메일 형식 검증 함수
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // RFC 5322 기반 간단한 정규식
        return emailRegex.test(email);
    }

    // 도메인 선택 변경 이벤트
    domainSelect.addEventListener("change", function() {
        if (this.value === "custom") {
            // "직접 입력"을 선택하면 input 필드로 교체
            customDomainInput = document.createElement("input");
            customDomainInput.type = "text";
            customDomainInput.className = "form-control w-100";
            customDomainInput.placeholder = "도메인을 입력하세요";
            customDomainInput.name = "domain"; // 서버로 전송될 name 속성 설정
            domainContainer.replaceChild(customDomainInput, domainSelect);
            customDomainInput.focus(); // 포커스 이동
        }
    });
    // 중복 확인 버튼 클릭 이벤트
    checkUserEmailBtn.addEventListener("click", function() {
        const emailValue = emailInput.value.trim(); // 이메일 아이디 값
        const domainValue = customDomainInput ? customDomainInput.value.trim() : domainSelect.value
            .trim(); // 도메인 값
        const fullEmail = `${emailValue}@${domainValue}`; // 전체 이메일 주소

        // 이메일 입력값 검증
        if (!emailValue || !domainValue) {
            showMessage(emailCheckMessage, "이메일과 도메인을 올바르게 입력해주세요.", false);
            emailValid = false; // 중복 확인 실패
            return;
        }

        // 이메일 형식 검증
        if (!isValidEmail(fullEmail)) {
            showMessage(emailCheckMessage, "올바른 이메일 형식이 아닙니다.", false);
            emailValid = false; // 중복 확인 실패
            return;
        }

        // 서버로 중복 확인 요청
        fetch("<?= base_url('user/check-duplicate-email') ?>", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    email: fullEmail
                }),
            })
            .then((response) => response.json())
            .then((data) => {
                if (data.status === "success") {
                    showMessage(emailCheckMessage, "사용 가능한 이메일입니다.", true);
                    emailValid = true; // 중복 확인 성공
                } else {
                    showMessage(emailCheckMessage, "이미 사용 중인 이메일입니다.", false);
                    emailValid = false; // 중복 확인 실패
                }
            })
            .catch(() => {
                showMessage(emailCheckMessage, "이메일 확인 중 오류가 발생했습니다.", false);
                emailValid = false; // 중복 확인 실패
            });
    });

    // 폼 제출 이벤트
    const form = document.querySelector("form");
    const submitButton = document.getElementById("success");

    submitButton.addEventListener("click", function(e) {
        e.preventDefault(); // 기본 제출 방지

        // 유효성 검사 수행
        const nameValid = nameInput.value.trim() && nameMessage.classList.contains("text-success");
        const genderValid = checkGenderValidity();
        const birthDateValid = birthDateInput.value.trim() && birthDateMessage.classList.contains(
            "text-success");
        const passwordValid = passwordInput.value.trim() && passwordMessage.classList.contains(
            "text-success");
        const domainValue = customDomainInput ? customDomainInput.value.trim() : domainSelect.value
        const agreeTermsCheckbox = document.getElementById("agreeTerms"); // 이용약관 체크박스
        const agreePrivacyCheckbox = document.getElementById("agreePrivacy"); // 개인정보 처리방침 체크박스

        if (!nameValid) {
            alert("이름을 올바르게 입력해주세요.");
            nameInput.focus();
            return;
        }
        if (!genderValid) {
            alert("성별을 선택해주세요.");
            return;
        }
        if (!birthDateValid) {
            alert("생년월일을 올바르게 입력해주세요.");
            birthDateInput.focus();
            return;
        }
        if (!phoneNumberValid) {
            alert("전화번호를 입력해주세요.");
            phoneNumberInput.focus();
            return;
        }
        if (!memberCodeValid) {
            alert("멤버코드 중복 확인을 완료해주세요.");
            memberCodeInput.focus();
            return;
        }
        if (!userIdValid) {
            alert("아이디 중복 확인을 완료해주세요.");
            userIdInput.focus();
            return;
        }

        if (!passwordValid) {
            alert("비밀번호를 올바르게 입력해주세요.");
            passwordInput.focus();
            return;
        }

        if (!emailValid) {
            alert("이메일 중복 확인을 완료해주세요.");
            emailInput.focus();
            return;
        }
        if (!domainValue) {
            alert("도메인을 선택하거나 입력해주세요.");
            return;
        }
        // 이용약관과 개인정보 처리방침 체크 여부 확인
        if (!agreeTermsCheckbox.checked) {
            alert("이용약관에 동의해주세요.");
            agreeTermsCheckbox.focus();
            return;
        }

        if (!agreePrivacyCheckbox.checked) {
            alert("개인정보 처리방침에 동의해주세요.");
            agreePrivacyCheckbox.focus();
            return;
        }

        // 모든 유효성 검사를 통과하면 SweetAlert2를 사용
        const script = document.createElement("script");
        script.src = "<?= base_url('/assets/vendors/sweetalert2/sweetalert2.all.min.js') ?>";
        script.onload = function() {
            Swal.fire({
                icon: "success",
                title: "완료",
                text: "등록이 완료되었습니다!",
                showConfirmButton: true, // 확인 버튼 활성화
                allowOutsideClick: false, // 외부 클릭으로 닫히지 않도록 설정
            }).then((result) => {
                // 사용자가 확인 버튼을 눌렀을 때만 폼 제출
                if (result.isConfirmed) {
                    form.submit(); // 폼 제출
                }
            });
        };
        document.body.appendChild(script);
    });
});
</script>