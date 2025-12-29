<!-- 회원정보 수정 페이지  -->
<?= $this->include('templates/header') ?>
<?= $this->include('templates/sidebar') ?>

<?php 
    // 현재 사용자 권한 가져오기
    $userGrade = session()->get('grade');

    // 권한 체크: 슈퍼어드민(0)과 대리점(2)만 허용
    if ($userGrade !== 0 && $userGrade !== 2) {
        // 접근 차단: 권한이 없는 경우 에러 메시지를 띄우고 뒤로 이동
        echo "<script>
            alert('접근 권한이 없습니다.');
            window.history.back();
        </script>";
        exit;
    }
?>

<?php if (session()->getFlashdata('success')): ?>
<script>
alert('<?= session()->getFlashdata('success'); ?>');
window.location.reload();
</script>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
<script>
alert('<?= session()->getFlashdata('error'); ?>');
window.location.reload();
</script>
<?php endif; ?>

<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>

    </header>

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>회원 상세정보 수정</h3>
                    <p class="text-subtitle text-muted">
                        회원의 상세정보를 수정합니다
                    </p>
                </div>
            </div>
        </div>

        <!-- 회원조회 -->
        <section id="basic-horizontal-layouts">
            <div class="row match-height">
                <div class="col-md-12 col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body px-5">
                                <form class="form form-horizontal"
                                    action="<?= base_url('user-management/user/update/'.esc($user['member_code']))?>"
                                    method="post">
                                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                                    <input type="hidden" name="ref_menu" value="user">
                                    <input type="hidden" name="ref" value="user-list">
                                    <div class="form-body p-3">
                                        <div class="row">
                                            <div class="col-md-2 form-group">
                                                <label class="pt-2">이름</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="user_name" name="user_name" class="form-control"
                                                    value="<?= esc($user['user_name']) ?>">
                                            </div>

                                            <!-- 성별 -->
                                            <div class="col-md-2 form-group">
                                                <label class="pt-2">성별</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" class="form-control"
                                                    value="<?= esc($user['gender'] == 0 ? '남자' : '여자') ?>" disabled>
                                            </div>
                                            <!-- 멤버코드 -->
                                            <div class="col-md-2 form-group">
                                                <label class="pt-2">멤버코드</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="member_code" name="member_code"
                                                    class="form-control" value="<?= esc($user['member_code']) ?>"
                                                    disabled>
                                            </div>

                                            <div class="col-md-2 form-group">
                                                <label class="pt-2">생년월일</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="birth_date" name="birth_date"
                                                    class="form-control" value="<?= esc($user['birth_date']) ?>"
                                                    placeholder="YYYY-MM-DD">
                                            </div>


                                            <div class="col-md-2 form-group">
                                                <label class="pt-2 ">전화번호</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="phone-number" name="phone" class="form-control"
                                                    value="<?= esc($user['phone']) ?>">
                                            </div>

                                            <!-- 이메일 -->
                                            <div class="col-md-2 form-group">
                                                <label class="pt-2">이메일</label>
                                            </div>
                                            <?php 
                                                $emailParts = explode('@', $user['email']);
                                                $emailId = $emailParts[0] ?? ''; 
                                                $emailDomain = $emailParts[1] ?? ''; 
                                            ?>
                                            <div class="col-md-8 form-group pe-0">
                                                <div class="d-flex gap-2">
                                                    <input type="text" id="email_id" name="email_id"
                                                        class="form-control" value="<?= esc($emailId) ?>">
                                                    <span class="d-flex align-items-center">@</span>
                                                    <input type="text" id="email_domain" name="email_domain"
                                                        class="form-control" value="<?= esc($emailDomain) ?>"
                                                        placeholder="도메인을 입력하세요">
                                                </div>
                                                <div id="emailCheckMessage" class="email-message col-md-10 ms-2 mt-1">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" id="checkEmailButton"
                                                    class="btn btn-secondary w-100">중복
                                                    확인</button>
                                            </div>

                                            <!-- 주소 입력 -->
                                            <div class="col-md-2 form-group">
                                                <label class="pt-2">주소</label>
                                            </div>
                                            <div class="col-md-8 form-group pe-0">
                                                <div class="d-flex">
                                                    <input type="text" class="form-control" id="sample6_postcode"
                                                        name="postcode" value="<?= esc($user['postcode']) ?>" readonly>
                                                </div>
                                            </div>

                                            <!-- 주소 -->
                                            <div class="col-md-2 form-group">
                                                <button type="button" class="btn btn-secondary w-100"
                                                    onclick="sample6_execDaumPostcode()">주소
                                                    찾기</button>
                                            </div>

                                            <div class="col-md-2 form-group"> </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" class="form-control" id="sample6_address"
                                                    name="address" value="<?= esc($user['address']) ?>" readonly>
                                            </div>

                                            <!-- 상세 주소 -->
                                            <div class="col-md-2 form-group"></div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" class="form-control" id="sample6_detailAddress"
                                                    name="address_detail" value="<?= esc($user['address_detail']) ?>"
                                                    placeholder="상세주소를 입력해주세요">

                                            </div>


                                            <div class="col-md-2 form-group">
                                                <label class="pt-2">메모</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <textarea id="notes" name="notes" class="form-control"
                                                    style="height: 115px; resize:none; overflow:auto;"><?= esc($user['notes']) ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center gap-3 pt-4 pb-3 col-12">
                                        <a href="<?= base_url('user-management/user/detail/'.esc($user['member_code']))?>?ref_menu=user&ref=user-list"
                                            class="btn btn-light-secondary d-flex align-items-center justify-content-center py-2"
                                            style="width: 160px; font-size: 18px">
                                            뒤로가기
                                        </a>
                                        <button type="submit"
                                            class="btn btn-primary d-flex align-items-center justify-content-center py-2"
                                            style="width: 160px;font-size: 18px">저장하기</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </section>

        <?= $this->include('templates/footer') ?>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/rangePlugin.js"></script>
        <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
        <script src="<?= base_url('/assets/js/custom/custom.js') ?>"></script>
        <script src="<?= base_url('/assets/vendors/sweetalert2/sweetalert2.min.js') ?>"></script>
        <script src="<?= base_url('/assets/vendors/sweetalert2/sweetalert2.all.min.js') ?>"></script>
        <script>
        // document.addEventListener("DOMContentLoaded", function() {
        //         flatpickr("#birth_date", {
        //             dateFormat: "Y-m-d",  // 원하는 형식으로 설정합니다 (예: "Y-m-d"는 연-월-일 형식)
        //             allowInput: true,
        //             onChange: function(selectedDates, dateStr, instance) {
        //                 const date = new Date(selectedDates[0]);
        //                 document.querySelector('#year').value = date.getFullYear();
        //                 document.querySelector('#month').value = date.getMonth() + 1;
        //                 document.querySelector('#day').value = date.getDate();
        //             }
        //         });
        //     });

        function sample6_execDaumPostcode() {
            new daum.Postcode({
                oncomplete: function(data) {
                    var addr = '';
                    var extraAddr = '';

                    // 사용자가 선택한 주소 타입에 따라 기본 주소 설정
                    if (data.userSelectedType === 'R') { // 도로명 주소
                        addr = data.roadAddress;
                    } else { // 지번 주소
                        addr = data.jibunAddress;
                    }

                    // 도로명 주소인 경우, 상세 주소 정보 추가
                    if (data.userSelectedType === 'R') {
                        if (data.bname !== '' && /[동|로|가]$/g.test(data.bname)) {
                            extraAddr += data.bname;
                        }
                        if (data.buildingName !== '' && data.apartment === 'Y') {
                            extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                        }
                        if (extraAddr !== '') {
                            extraAddr = ' (' + extraAddr + ')';
                        }
                    }

                    // 최종 주소에 상세 주소 추가
                    addr = addr + extraAddr;

                    // 우편번호와 주소 정보를 해당 input에 넣기
                    document.getElementById('sample6_postcode').value = data.zonecode;
                    document.getElementById('sample6_address').value = addr;

                    // 상세주소로 포커스 이동
                    document.getElementById('sample6_detailAddress').focus();
                }
            }).open();
        }

        document.addEventListener("DOMContentLoaded", function() {
            let emailValid = true; // 이메일 중복 확인 상태
            let emailChecked = false; // 이메일 중복 확인 여부
            const initialEmailId = document.getElementById("email_id").value.trim(); // 초기 이메일 ID
            const initialEmailDomain = document.getElementById("email_domain").value.trim(); // 초기 이메일 도메인
            const initialName = document.getElementById("user_name").value.trim(); // 초기 이름
            const initialBirthDate = document.getElementById("birth_date").value.trim(); // 초기 생년월일
            const initialPhone = document.getElementById("phone-number").value.trim(); // 초기 전화번호

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
            const nameInput = document.querySelector("#user_name");
            const nameMessage = document.createElement("div");
            nameMessage.className = "name-message text-danger mt-1";
            nameInput.parentElement.appendChild(nameMessage);

            nameInput.addEventListener("input", function() {
                const name = nameInput.value.trim();
                const nameRegex = /^[가-힣]{2,16}$|^[a-zA-Z]{2,16}$/;
                if (name && !nameRegex.test(name)) {
                    showMessage(nameMessage, "이름은 2~16자의 한글 또는 영문으로 입력해주세요.", false);
                } else {
                    showMessage(nameMessage, "", true);
                }
            });

            // 생년월일 유효성 검사
            const birthDateInput = document.querySelector("#birth_date");
            const birthDateMessage = document.createElement("div");
            birthDateMessage.className = "birth-date-message text-danger mt-1";
            birthDateInput.parentElement.appendChild(birthDateMessage);

            birthDateInput.addEventListener("input", function() {
                const birthDate = birthDateInput.value.trim();
                const dateRegex = /^\d{4}-\d{2}-\d{2}$/;
                if (birthDate && !dateRegex.test(birthDate)) {
                    showMessage(birthDateMessage, "생년월일은 YYYY-MM-DD 형식으로 입력해주세요.", false);
                } else {
                    showMessage(birthDateMessage, "", true);
                }
            });

            // 전화번호 유효성 검사
            const phoneInput = document.querySelector("#phone-number");
            const phoneMessage = document.createElement("div");
            phoneMessage.className = "phone-message text-danger mt-1";
            phoneInput.parentElement.appendChild(phoneMessage);

            phoneInput.addEventListener("input", function() {
                const phone = phoneInput.value.trim();
                const phoneRegex = /^\d{3}-\d{3,4}-\d{4}$/;
                if (phone && !phoneRegex.test(phone)) {
                    showMessage(phoneMessage, "전화번호는 '010-1234-5678' 형식으로 입력해주세요.", false);
                } else {
                    showMessage(phoneMessage, "", true);
                }
            });

            // 메모 유효성 검사
            const memoInput = document.querySelector("#notes");
            const memoMessage = document.createElement("div");
            memoMessage.className = "memo-message text-danger mt-1";
            memoInput.parentElement.appendChild(memoMessage);

            memoInput.addEventListener("input", function() {
                const memo = memoInput.value.trim();
                if (memo.length > 200) {
                    showMessage(memoMessage, "메모는 최대 200자까지 입력 가능합니다.", false);
                } else {
                    showMessage(memoMessage, "", true);
                }
            });
            // 이메일 중복 확인 로직
            const emailIdInput = document.getElementById("email_id");
            const emailDomainInput = document.getElementById("email_domain");
            const checkEmailButton = document.getElementById("checkEmailButton");
            const emailCheckMessage = document.getElementById("emailCheckMessage");

            // 이메일 형식 검증 함수
            function isValidEmail(email) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(email);
            }

            // 도메인 한글 포함 여부 검증 함수
            function isValidDomain(domain) {
                const domainRegex = /^[a-zA-Z0-9.-]+$/;
                return domainRegex.test(domain);
            }

            // 중복 확인 버튼 클릭 이벤트
            checkEmailButton.addEventListener("click", function() {
                const emailId = emailIdInput.value.trim();
                const emailDomain = emailDomainInput.value.trim();
                const fullEmail = `${emailId}@${emailDomain}`;

                // 이메일 입력값 검증
                if (!emailId || !emailDomain) {
                    showMessage(emailCheckMessage, "이메일과 도메인을 모두 입력해주세요.", false);
                    emailValid = false;
                    emailChecked = false;
                    return;
                }

                // 이메일 형식 검증
                if (!isValidEmail(fullEmail)) {
                    showMessage(emailCheckMessage, "올바른 이메일 형식이 아닙니다.", false);
                    emailValid = false;
                    emailChecked = false;
                    return;
                }

                // 도메인 한글 포함 여부 검증
                if (!isValidDomain(emailDomain)) {
                    showMessage(emailCheckMessage, "도메인에 한글이 포함될 수 없습니다.", false);
                    emailValid = false;
                    emailChecked = false;
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
                            emailValid = true;
                            emailChecked = true; // 중복 확인 완료
                        } else {
                            showMessage(emailCheckMessage, "이미 사용 중인 이메일입니다.", false);
                            emailValid = false;
                            emailChecked = false;
                        }
                    })
                    .catch(() => {
                        showMessage(emailCheckMessage, "이메일 확인 중 오류가 발생했습니다.", false);
                        emailValid = false;
                        emailChecked = false;
                    });
            });

            // 이메일 변경 시 중복 확인을 다시 강제
            emailIdInput.addEventListener("input", function() {
                emailChecked =
                    emailIdInput.value.trim() === initialEmailId &&
                    emailDomainInput.value.trim() === initialEmailDomain;
            });

            emailDomainInput.addEventListener("input", function() {
                emailChecked =
                    emailIdInput.value.trim() === initialEmailId &&
                    emailDomainInput.value.trim() === initialEmailDomain;
            });

            // 폼 제출 이벤트
            const form = document.querySelector("form");
            const submitButton = document.querySelector('button[type="submit"]');

            submitButton.addEventListener("click", function(e) {
                e.preventDefault();

                // 이름, 생년월일, 전화번호 유효성 검사
                const name = nameInput.value.trim();
                const birthDate = birthDateInput.value.trim();
                const phone = phoneInput.value.trim();

                const nameChanged = name !== initialName;
                const birthDateChanged = birthDate !== initialBirthDate;
                const phoneChanged = phone !== initialPhone;

                if (nameChanged && nameMessage.classList.contains("text-danger")) {
                    alert("이름을 올바르게 입력해주세요.");
                    nameInput.focus();
                    return;
                }

                if (birthDateChanged && birthDateMessage.classList.contains("text-danger")) {
                    alert("생년월일을 올바르게 입력해주세요.");
                    birthDateInput.focus();
                    return;
                }

                if (phoneChanged && phoneMessage.classList.contains("text-danger")) {
                    alert("전화번호를 올바르게 입력해주세요.");
                    phoneInput.focus();
                    return;
                }

                // 이메일이 변경되었을 경우 중복 확인을 강제
                const currentEmailId = emailIdInput.value.trim();
                const currentEmailDomain = emailDomainInput.value.trim();
                if (
                    currentEmailId !== initialEmailId ||
                    currentEmailDomain !== initialEmailDomain
                ) {
                    if (!emailChecked) {
                        alert("이메일 중복 확인 버튼을 눌러주세요.");
                        checkEmailButton.focus();
                        return;
                    }
                    if (!emailValid) {
                        alert("이메일이 중복되었거나 올바른 형식이 아닙니다.");
                        emailIdInput.focus();
                        return;
                    }
                }

                // 메모 유효성 검사
                const memo = memoInput.value.trim();
                if (memo.length > 200) {
                    alert("메모는 최대 200자까지 입력 가능합니다.");
                    memoInput.focus();
                    return;
                }
                // SweetAlert2를 사용해 저장 확인
                const script = document.createElement("script");
                script.src =
                    "<?= base_url('/assets/vendors/sweetalert2/sweetalert2.all.min.js') ?>";
                script.onload = function() {
                    Swal.fire({
                        icon: "question",
                        title: "확인 필요",
                        text: "변경 사항을 저장하시겠습니까?",
                        showCancelButton: true,
                        confirmButtonText: "저장",
                        cancelButtonText: "취소",
                        allowOutsideClick: false,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit(); // 폼 제출
                        }
                    });
                };
                document.body.appendChild(script);
            });
        });
        </script>