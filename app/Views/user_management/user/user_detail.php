<!-- 회원정보 수정 페이지  -->
<?= $this->include('templates/header') ?>
<?= $this->include('templates/sidebar') ?>

<script src="<?= base_url('/assets/vendors/sweetalert2/sweetalert2.all.min.js')?>"></script>
<script>
// 플래시 데이터 확인 및 SweetAlert로 메시지 표시
<?php if (session()->getFlashdata('success')): ?>
Swal.fire({
    title: '성공!',
    text: '<?= session()->getFlashdata('success') ?>',
    icon: 'success',
    confirmButtonText: '확인'
});
<?php endif; ?>
</script>

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
                    <h3>회원 상세정보</h3>
                    <p class="text-subtitle text-muted">
                        회원의 상세정보를 조회합니다
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
                                                    value="<?= esc($user['user_name']) ?>" readonly>
                                            </div>

                                            <!-- 성별 -->
                                            <div class="col-md-2 form-group">
                                                <label class="pt-2">성별</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" class="form-control"
                                                    value="<?= esc($user['gender'] == 0 ? '남자' : '여자') ?>" readonly>
                                            </div>
                                            <!-- 멤버코드 -->
                                            <div class="col-md-2 form-group">
                                                <label class="pt-2">멤버코드</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="member_code" name="member_code"
                                                    class="form-control" value="<?= esc($user['member_code']) ?>"
                                                    readonly>
                                            </div>

                                            <div class="col-md-2 form-group">
                                                <label class="pt-2">생년월일</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="birth_date" name="birth_date"
                                                    class="form-control" value="<?= esc($user['birth_date']) ?>"
                                                    placeholder="YYYY-MM-DD" readonly>
                                            </div>


                                            <div class="col-md-2 form-group">
                                                <label class="pt-2 ">전화번호</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="phone-number" name="phone" class="form-control"
                                                    value="<?= esc($user['phone']) ?>" readonly>
                                            </div>

                                            <div class="col-md-2 form-group">
                                                <label class="pt-2">이메일</label>
                                            </div>
                                            <div class="col-md-10 form-group d-flex gap-2">
                                                <?php 
                                                    // 이메일 분리
                                                    $emailParts = explode('@', esc($user['email']));
                                                    $emailId = $emailParts[0] ?? ''; // 아이디 부분
                                                    $emailDomain = $emailParts[1] ?? ''; // 도메인 부분
                                                ?>
                                                <!-- 아이디 입력 -->
                                                <input type="text" id="email_id" name="email_id" class="form-control"
                                                    value="<?= esc($emailId) ?>" readonly>
                                                <span class="d-flex align-items-center">@</span>
                                                <!-- 도메인 입력 -->
                                                <input type="text" id="email_domain" name="email_domain"
                                                    class="form-control" value="<?= esc($emailDomain) ?>" readonly>
                                            </div>

                                            <!-- 주소 입력 -->
                                            <div class="col-md-2 form-group">
                                                <label class="pt-2">주소</label>
                                            </div>
                                            <div class="col-md-10 form-group">

                                                <input type="text" class="form-control" id="sample6_postcode"
                                                    name="postcode" value="<?= esc($user['postcode']) ?>" disabled>
                                                <!-- <button type="button" class="btn btn-secondary ms-2"
                                                        style="width: 200px;" onclick="sample6_execDaumPostcode()">주소
                                                        찾기</button> -->

                                            </div>

                                            <!-- 주소 -->
                                            <div class="col-md-2 form-group">
                                            </div>

                                            <div class="col-md-10 form-group">
                                                <input type="text" class="form-control" id="sample6_address"
                                                    name="address" value="<?= esc($user['address']) ?>" readonly>
                                            </div>

                                            <!-- 상세 주소 -->
                                            <div class="col-md-2 form-group">
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" class="form-control" id="sample6_detailAddress"
                                                    name="address_detail" value="<?= esc($user['address_detail']) ?>"
                                                    placeholder="상세주소를 입력해주세요" readonly>
                                            </div>


                                            <div class="col-md-2 form-group">
                                                <label class="pt-2">메모</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <textarea id="notes" name="notes" class="form-control"
                                                    style="height: 115px; resize:none; overflow:auto;"
                                                    readonly><?= esc($user['notes']) ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center gap-3 pt-4 pb-3 col-12">
                                        <a href="<?= base_url('user-management/user/list')?>?ref_menu=user&ref=user-list"
                                            class="btn btn-light-secondary d-flex align-items-center justify-content-center py-2"
                                            style="width: 160px; font-size: 18px">
                                            목록으로
                                        </a>
                                        <?php if (session()->get('grade') === 0 || session()->get('grade') === 2): // 슈퍼어드민과 대리점만 수정 가능 ?>
                                        <a href="<?= base_url('user-management/user/user-edit/'.esc($user['member_code'])) ?>?ref_menu=user&ref=user-list"
                                            class="btn btn-warning d-flex align-items-center justify-content-center py-2"
                                            style="width: 160px;font-size: 18px">수정하기</a>
                                        <?php endif; ?>
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