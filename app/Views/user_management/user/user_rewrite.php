<!-- 회원정보 수정 페이지  -->
<?= $this->include('templates/header') ?>
<?= $this->include('templates/sidebar') ?>

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

                                    <div class="form-body p-3">
                                        <div class="row">
                                            <div class="col-md-2 form-group">
                                                <label class="pt-2">이름</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="user_name" name="user_name" class="form-control"
                                                    value="<?= esc($user['user_name']) ?>" required>
                                            </div>

                                            <div class="col-md-2 form-group">
                                                <label class="mt-2">성별</label>
                                            </div>
                                            <div class="col-md-10 form-check mt-2 d-flex" style="height: 38px;">
                                                <div class="mx-4 form-group col-md-4">
                                                    <input class="form-check-input" type="radio" name="gender"
                                                        id="flexRadioDefault1" value="0"
                                                        <?= esc($user['gender']) == 0 ? 'checked' : '' ?>>
                                                    <label class="form-check-label ms-2" for="flexRadioDefault1">
                                                        남자
                                                    </label>
                                                </div>

                                                <div class="col-md-4 mx-4">
                                                    <input class="form-check-input" type="radio" name="gender"
                                                        id="flexRadioDefault2" value="1"
                                                        <?= esc($user['gender']) == 1 ? 'checked' : '' ?>>
                                                    <label class="form-check-label ms-2" for="flexRadioDefault2">
                                                        여자
                                                    </label>
                                                </div>
                                            </div>


                                            <div class="col-md-2 form-group">
                                                <label class="pt-2">생년월일</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="birth_date" name="birth_date"
                                                    class="form-control" value="<?= esc($user['birth_date']) ?>"
                                                    placeholder="YYYY-MM-DD" required>
                                            </div>


                                            <div class="col-md-2 form-group">
                                                <label class="pt-2 ">전화번호</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="phone-number" name="phone" class="form-control"
                                                    value="<?= esc($user['phone']) ?>" required>
                                            </div>

                                            <div class="col-md-2 form-group">
                                                <label class="pt-2">이메일</label>
                                            </div>
                                            <?php 
                                  $emailParts = explode('@', $user['email']);
                                  $emailDomain = isset($emailParts[1]) ? $emailParts[1] : '';
                                  ?>
                                            <div class="col-md-10 form-group d-flex gap-2" id="emailGroup">
                                                <input type="text" id="email" name="email" class="form-control"
                                                    value="<?= esc($emailParts[0]) ?>" required>
                                                <span class="d-flex align-items-center">@</span>
                                                <select class="form-select" id="emailSelect" name="domain">
                                                    <option value="gmail.com"
                                                        <?= ($emailDomain === 'gmail.com') ? 'selected' : '' ?>>
                                                        gmail.com</option>
                                                    <option value="naver.com"
                                                        <?= ($emailDomain === 'naver.com') ? 'selected' : '' ?>>
                                                        naver.com</option>
                                                    <option value="nate.com"
                                                        <?= ($emailDomain === 'nate.com') ? 'selected' : '' ?>>nate.com
                                                    </option>
                                                    <option value="hanmail.net"
                                                        <?= ($emailDomain === 'hanmail.net') ? 'selected' : '' ?>>
                                                        hanmail.net</option>
                                                    <option value="daum.net"
                                                        <?= ($emailDomain === 'daum.net') ? 'selected' : '' ?>>daum.net
                                                    </option>
                                                </select>
                                            </div>

                                            <!-- 주소 입력 -->
                                            <div class="col-md-2 form-group">
                                                <label class="pt-2">주소</label>
                                            </div>
                                            <div class="col-md-10 form-group">

                                                <input type="text" class="form-control" id="sample6_postcode"
                                                    name="postcode" value="<?= esc($user['postcode']) ?>">
                                                <!-- <button type="button" class="btn btn-secondary ms-2"
                                                        style="width: 200px;" onclick="sample6_execDaumPostcode()">주소
                                                        찾기</button> -->

                                            </div>

                                            <!-- 주소 -->
                                            <div class="col-md-2 form-group">
                                            </div>

                                            <div class="col-md-10 form-group">
                                                <input type="text" class="form-control" id="sample6_address"
                                                    name="address" value="<?= esc($user['address']) ?>">
                                            </div>

                                            <!-- 상세 주소 -->
                                            <div class="col-md-2 form-group">
                                            </div>
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
                                                    style="height: 115px; resize:none; overflow:auto;"> <?= esc($user['notes']) ?> </textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center gap-3 pt-4 pb-3 col-12">
                                        <a href="<?= base_url('user-management/user/list')?>"
                                            class="btn btn-light-secondary d-flex align-items-center justify-content-center py-2"
                                            style="width: 160px; font-size: 18px">
                                            목록으로
                                        </a>
                                        <button type="submit"
                                            class="btn btn-primary d-flex align-items-center justify-content-center py-2"
                                            style="width: 160px;font-size: 18px">저장하기</button>
                                        <!-- <button class="btn btn-danger me-1 mb-1 px-5">삭제</button> -->
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
            // 주소 찾기 버튼 클릭 시, 인풋창 활성화
            document.getElementById('sample6_address').removeAttribute('readonly');

            new daum.Postcode({
                oncomplete: function(data) {
                    var addr = ''; // 주소 변수
                    var extraAddr = ''; // 참고 항목 변수

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

                    // 주소 정보를 해당 input에 넣기
                    document.getElementById('sample6_address').value = addr;

                    // 입력 완료 후, 주소 필드를 읽기 전용으로 변경
                    document.getElementById('sample6_address').setAttribute('readonly', true);

                    // 상세주소로 포커스 이동
                    document.getElementById('sample6_detailAddress').focus();
                }
            }).open();
        }


        document.addEventListener("DOMContentLoaded", function() {

            flatpickr("#birth_date", {
                dateFormat: "Y-m-d", // 날짜 형식 (연-월-일)
                allowInput: true, // 사용자가 직접 입력할 수 있도록 허용
                maxDate: "today", // 생년월일이 미래가 될 수 없도록 오늘 날짜까지만 선택 가능
                defaultDate: null // 기본값을 설정하지 않음

            });
        });
        </script>