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
    <div class="app">

        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>마이페이지 상세정보</h3>
                        <p class="text-subtitle text-muted">사용자의 상세정보를 확인할 수 있습니다.</p>
                    </div>
                </div>
            </div>

            <section id="basic-horizontal-layouts">
                <div class="row match-height">
                    <div class="col-md-12 col-12">
                        <div class="card border">
                            <div class="card-content">
                                <div class="card-body px-5">
                                    <form class="form form-horizontal">
                                        <div class="form-body">
                                            <div class="row">
                                                <!-- 이름 -->
                                                <div class="col-md-2 form-group">
                                                    <label class="pt-2">이름</label>
                                                </div>
                                                <div class="col-md-10 form-group">
                                                    <input type="text" id="user_name" name="user_name"
                                                        class="form-control" value="<?= esc($data['user_name']) ?>"
                                                        readonly>
                                                </div>

                                                <!-- 성별 -->
                                                <div class="col-md-2 form-group">
                                                    <label class="pt-2">성별</label>
                                                </div>
                                                <div class="col-md-10 form-group">
                                                    <input type="text" class="form-control"
                                                        value="<?= esc($data['gender'] == 0 ? '남자' : '여자') ?>" readonly>
                                                </div>

                                                <!-- 전화번호 -->
                                                <div class="col-md-2 form-group">
                                                    <label class="pt-2">전화번호</label>
                                                </div>
                                                <div class="col-md-10 form-group">
                                                    <input type="text" id="phone" name="phone" class="form-control"
                                                        value="<?= esc($data['phone']) ?>" readonly>
                                                </div>

                                                <!-- 생년월일 -->
                                                <div class="col-md-2 form-group">
                                                    <label class="pt-2">생년월일</label>
                                                </div>
                                                <div class="col-md-10 form-group">
                                                    <input type="text" id="birth_date" name="birth_date"
                                                        class="form-control" value="<?= esc($data['birth_date']) ?>"
                                                        readonly>
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
                                                    <input type="text" id="user_id" name="user_id" class="form-control"
                                                        value="<?= esc($data['user_id']) ?>" readonly>
                                                </div>

                                                <!-- 이메일 -->
                                                <div class="col-md-2 form-group">
                                                    <label class="pt-2">이메일</label>
                                                </div>
                                                <?php 
                                                $emailParts = isset($data['email']) ? explode('@', $data['email']) : ['', ''];
                                                $emailLocal = $emailParts[0]; // 이메일 아이디
                                                $emailDomain = isset($emailParts[1]) ? $emailParts[1] : ''; // 이메일 도메인
                                                ?>
                                                <div class="col-md-10 form-group d-flex gap-2" id="emailGroup">
                                                    <!-- 이메일 아이디 -->
                                                    <input type="text" id="email" name="email" class="form-control"
                                                        value="<?= esc($emailLocal) ?>" readonly>
                                                    <span class="d-flex align-items-center">@</span>
                                                    <!-- 도메인 텍스트로 표시 -->
                                                    <input type="text" id="emailDomain" name="email_domain"
                                                        class="form-control" value="<?= esc($emailDomain) ?>" readonly>
                                                </div>

                                                <!-- 우편번호 -->
                                                <div class="col-md-2 form-group">
                                                    <label class="pt-2">우편번호</label>
                                                </div>
                                                <div class="col-md-10 form-group">
                                                    <input type="text" id="postcode" name="postcode"
                                                        class="form-control" value="<?= esc($data['postcode']) ?>"
                                                        readonly>
                                                </div>

                                                <!-- 주소 -->
                                                <div class="col-md-2 form-group">
                                                    <label class="pt-2">주소</label>
                                                </div>
                                                <div class="col-md-10 form-group">
                                                    <input type="text" id="address" name="address" class="form-control"
                                                        value="<?= esc($data['address']) ?>" readonly>
                                                </div>

                                                <!-- 상세 주소 -->
                                                <div class="col-md-2 form-group">
                                                </div>
                                                <div class="col-md-10 form-group">
                                                    <input type="text" id="address_detail" name="address_detail"
                                                        class="form-control" value="<?= esc($data['address_detail']) ?>"
                                                        readonly>
                                                </div>

                                                <!-- 메모 -->
                                                <div class="col-md-2 form-group">
                                                    <label class="pt-2">메모</label>
                                                </div>
                                                <div class="col-md-10 form-group">
                                                    <textarea id="notes" name="notes" class="form-control"
                                                        style="height: 115px; resize:none; overflow:auto;"
                                                        readonly><?= esc($data['notes']) ?></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- 버튼 영역 -->
                                        <div class="d-flex justify-content-center gap-3 pt-4">
                                            <?php if (session()->get('grade') == 1 || session()->get('grade') == 2): ?>
                                            <a href="<?= base_url('/mypage/edit') ?>"
                                                class="btn btn-warning d-flex align-items-center justify-content-center py-2"
                                                style="width: 160px;font-size: 18px">수정하기</a>
                                            <?php endif; ?>
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