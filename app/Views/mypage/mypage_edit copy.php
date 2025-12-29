<?= $this->include('templates/header') ?>
<?= $this->include('templates/sidebar') ?>

<!-- 수정시 성공 알림 표시 -->
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
                    <h3>마이페이지 수정</h3>
                    <p class="text-subtitle text-muted"> 사용자의 정보를 수정할 수 있습니다.</p>
                </div>
            </div>
        </div>
        <section id="basic-horizontal-layouts">
            <div class="row match-height">
                <div class="col-md-12 col-12">
                    <div class="card border">
                        <div class="card-content">
                            <div class="card-body px-5">
                                <form class="form form-horizontal" action="<?= base_url('/mypage/update') ?>"
                                    method="post">
                                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />

                                    <div class="form-body">
                                        <div class="row">
                                            <!-- 이름 -->
                                            <div class="col-md-2 form-group">
                                                <label class="pt-2">이름</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="user_name" name="user_name" class="form-control"
                                                    value="<?= esc($data['user_name']) ?>" required>
                                            </div>

                                            <!-- 성별 -->
                                            <div class="col-md-2 form-group">
                                                <label class="mt-2">성별</label>
                                            </div>
                                            <div class="col-md-10 d-flex align-items-center mb-2 form-group"
                                                style="height: 38px;">
                                                <div class="ms-2 me-4 col-md-4">
                                                    <input class="form-check-input" type="radio" name="gender"
                                                        id="flexRadioDefault1" value="0"
                                                        <?= esc($data['gender']) == 0 ? 'checked' : '' ?>>
                                                    <label class="form-check-label ms-2"
                                                        for="flexRadioDefault1">남자</label>
                                                </div>
                                                <div class="mx-4 col-md-4">
                                                    <input class="form-check-input" type="radio" name="gender"
                                                        id="flexRadioDefault2" value="1"
                                                        <?= esc($data['gender']) == 1 ? 'checked' : '' ?>>
                                                    <label class="form-check-label ms-2"
                                                        for="flexRadioDefault2">여자</label>
                                                </div>
                                            </div>

                                            <!-- 전화번호 -->
                                            <div class="col-md-2 form-group">
                                                <label class="pt-2">전화번호</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="phone-number" name="phone" class="form-control"
                                                    value="<?= esc($data['phone']) ?>" required>
                                            </div>

                                            <!-- 생년월일 -->
                                            <div class="col-md-2 form-group">
                                                <label class="pt-2">생년월일</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="birth_date" name="birth_date"
                                                    class="form-control" value="<?= esc($data['birth_date']) ?>"
                                                    placeholder="YYYY-MM-DD" required>
                                            </div>
                                            <!-- 멤버코드 -->
                                            <div class="col-md-2 form-group">
                                                <label class="pt-2">멤버코드</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="member_code" name="member_code"
                                                    class="form-control" value="<?= esc($data['member_code']) ?>"
                                                    readonly>
                                            </div>
                                            <!-- 아이디 -->
                                            <div class="col-md-2 form-group">
                                                <label class="pt-2">아이디</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" class="form-control" name="user_id"
                                                    value="<?= esc($data['user_id']) ?>" required readonly>
                                            </div>

                                            <!-- 비밀번호 -->
                                            <div class="col-md-2 form-group">
                                                <label class="pt-2">비밀번호</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="password" class="form-control" name="password"
                                                    placeholder="비밀번호를 변경하시려면 입력해주세요">
                                            </div>

                                            <!-- 이메일 -->
                                            <div class="col-md-2 form-group">
                                                <label class="pt-2">이메일</label>
                                            </div>
                                            <?php 
                                                $emailParts = explode('@', $data['email']);
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
                                                <!-- <button type="button" id="checkUseremailBtn" class="btn btn-secondary col-md-2 ">중복 확인</button> -->
                                            </div>
                                            <!-- <div class="col-md-2">
                                                </div>
    
                                                <div id ="emailCheckMessage" class="email-message col-md-10"></div> -->

                                            <!-- 우편번호 -->
                                            <div class="col-md-2 form-group">
                                                <label class="pt-2">주소</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <div class="d-flex">
                                                    <input type="text" class="form-control" id="sample6_postcode"
                                                        name="postcode" value="<?= esc($data['postcode']) ?>">
                                                    <button type="button" class="btn btn-secondary ms-2"
                                                        style="width: 200px;" onclick="sample6_execDaumPostcode()">주소
                                                        찾기</button>
                                                </div>
                                            </div>

                                            <!-- 주소 -->
                                            <div class="col-md-2 form-group">
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" class="form-control" id="sample6_address"
                                                    name="address" value="<?= esc($data['address']) ?>">
                                            </div>

                                            <!-- 상세 주소 -->
                                            <div class="col-md-2 form-group">
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" class="form-control" id="sample6_detailAddress"
                                                    name="address_detail" value="<?= esc($data['address_detail']) ?>"
                                                    placeholder="상세주소를 입력해주세요">
                                            </div>

                                            <!-- 메모 -->
                                            <div class="col-md-2 form-group">
                                                <label class="pt-2">메모</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <textarea id="notes" name="notes" class="form-control"
                                                    style="height: 115px; resize: none; overflow:auto;"><?= esc($data['notes']) ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- 버튼 영역 -->
                                    <div class="col-12 d-flex justify-content-center mt-4 gap-3" style="height:45px">
                                        <a href="<?= base_url('/mypage/detail') ?>"
                                            class="btn btn-light-secondary d-flex align-items-center justify-content-center"
                                            style="width: 160px; font-size: 18px;">취소</a>
                                        </a>
                                        <button type="submit"
                                            class="btn btn-primary d-flex align-items-center justify-content-center"
                                            style="width: 160px;font-size: 18px;" id="success1">저장하기</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?= $this->include('templates/footer') ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/rangePlugin.js"></script>
<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script src="<?= base_url('/assets/js/custom/custom.js') ?>"></script>
<script src="<?= base_url('/assets/vendors/sweetalert2/sweetalert2.all.min.js') ?>"></script>
<script>
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
</script>