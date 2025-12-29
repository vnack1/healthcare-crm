<?= $this->include('templates/header') ?>
<?= $this->include('templates/sidebar') ?>


<script src="<?= base_url('/assets/vendors/sweetalert2/sweetalert2.all.min.js')?>"></script>
<script>
<?php if (session()->getFlashdata('success')): ?>
Swal.fire({
    title: '성공!',
    text: '<?= session()->getFlashdata('success') ?>',
    icon: 'success',
    confirmButtonText: '확인'
});
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <
    script >
    Swal.fire({
        title: '오류!',
        text: '<?= session()->getFlashdata('error') ?>',
        icon: 'error',
        confirmButtonText: '확인'
    });
</script>
<?php endif; ?>

</script>
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
                    <h3>총판 상세정보</h3>
                    <p class="text-subtitle text-muted">
                        총판 상세정보를 조회합니다
                    </p>
                </div>
            </div>
        </div>

        <!-- 총판조회 -->
        <section id="basic-horizontal-layouts">
            <div class="row match-height">
                <div class="col-md-12 col-12">
                    <div class="card border">
                        <div class="card-content">
                            <div class="card-body px-5">
                                <form class="form form-horizontal"
                                    action="<?= base_url('user-management/distributer/update/'.esc($distributer['member_code']))?>"
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
                                                    value="<?= esc($distributer['user_name']) ?>" readonly>
                                            </div>

                                            <!-- 성별 -->
                                            <div class="col-md-2 form-group">
                                                <label class="pt-2">성별</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" class="form-control"
                                                    value="<?= esc($distributer['gender'] == 0 ? '남자' : '여자') ?>"
                                                    readonly>
                                            </div>

                                            <!-- 전화번호 -->
                                            <div class="col-md-2 form-group">
                                                <label class="pt-2">전화번호</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="phone-number" name="phone" class="form-control"
                                                    value="<?= esc($distributer['phone']) ?>" readonly>
                                            </div>

                                            <!-- 생년월일 -->
                                            <div class="col-md-2 form-group">
                                                <label class="pt-2">생년월일</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="birth_date" name="birth_date"
                                                    class="form-control" value="<?= esc($distributer['birth_date']) ?>"
                                                    placeholder="YYYY-MM-DD" readonly>
                                            </div>
                                            <!-- 멤버코드 -->
                                            <div class="col-md-2 form-group">
                                                <label class="pt-2">멤버코드</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" id="member_code" name="member_code"
                                                    class="form-control" value="<?= esc($distributer['member_code']) ?>"
                                                    readonly>
                                            </div>
                                            <!-- 아이디 -->
                                            <div class="col-md-2 form-group">
                                                <label class="pt-2">아이디</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" class="form-control" name="user_id"
                                                    value="<?= esc($distributer['user_id']) ?>" readonly>
                                            </div>

                                            <!-- 이메일 -->
                                            <div class="col-md-2 form-group">
                                                <label class="pt-2">이메일</label>
                                            </div>
                                            <div class="col-md-10 form-group d-flex gap-2">
                                                <?php 
                                                    // 이메일 분리
                                                    $emailParts = explode('@', esc($distributer['email']));
                                                    $emailId = $emailParts[0] ?? ''; // 아이디 부분
                                                    $emailDomain = $emailParts[1] ?? ''; // 도메인 부분
                                                ?>
                                                <!-- 아이디 부분 -->
                                                <input type="text" id="email_id" name="email_id" class="form-control"
                                                    value="<?= esc($emailId) ?>" readonly>
                                                <span class="d-flex align-items-center">@</span>
                                                <!-- 도메인 부분 -->
                                                <input type="text" id="email_domain" name="email_domain"
                                                    class="form-control" value="<?= esc($emailDomain) ?>" readonly>
                                            </div>

                                            <!-- 우편번호 -->
                                            <div class="col-md-2 form-group">
                                                <label class="pt-2">우편번호</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <div class="d-flex">
                                                    <input type="text" class="form-control" id="sample6_postcode"
                                                        name="postcode" value="<?= esc($distributer['postcode']) ?>"
                                                        disabled>
                                                </div>
                                            </div>

                                            <!-- 주소 -->
                                            <div class="col-md-2 form-group">
                                                <label class="pt-2">주소</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" class="form-control" id="sample6_address"
                                                    name="address" value="<?= esc($distributer['address']) ?>" readonly>
                                            </div>

                                            <!-- 상세 주소 -->
                                            <div class="col-md-2 form-group">
                                                <label class="pt-2">상세주소</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" class="form-control" id="sample6_detailAddress"
                                                    name="address_detail"
                                                    value="<?= esc($distributer['address_detail']) ?>" placeholder=""
                                                    readonly>
                                            </div>

                                            <!-- 메모 -->
                                            <div class="col-md-2 form-group">
                                                <label class="pt-2">메모</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <textarea id="notes" name="notes" class="form-control"
                                                    style="height: 115px; resize:none; overflow:auto;"
                                                    readonly><?= esc($distributer['notes']) ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- 버튼 영역 -->
                                    <div class="d-flex gap-3 pt-4 pb-3 justify-content-center">
                                        <a href="<?= base_url('user-management/distributer/distributerlist') ?>?ref_menu=distributer&ref=distributer-list"
                                            class="btn btn-light-secondary me-1 mb-1 px-4 d-flex align-items-center justify-content-center py-2"
                                            style="width: 160px; font-size:18px;">
                                            목록으로
                                        </a>
                                        <a href="<?= base_url('user-management/distributer/distributer-edit/'.esc($distributer['member_code'])) ?>?ref_menu=distributer&ref=distributer-list"
                                            class="btn btn-warning d-flex align-items-center me-1 mb-1 px-4 justify-content-center py-2"
                                            style="width: 160px;font-size: 18px">수정하기</a>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 소속 대리점 리스트 -->
        <section id="agent-list">
            <div class="card border">
                <div class="card-header d-flex justify-content-between">
                    <h4>소속 대리점 리스트 (총 <?= esc($totalRecords) ?>명)</h4>
                </div>
                <div class="card-body">
                    <table class="table table-hover" id="more-list-table">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>이름</th>
                                <th>성별</th>
                                <th>휴대폰</th>
                                <th>아이디</th>
                                <th>가입일</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($agents)): ?>
                            <?php foreach ($agents as $agent): ?>
                            <tr class="clickable-row"
                                data-url="<?= base_url('user-management/agent/agentlist/'.esc($agent['member_code'])) ?>?ref_menu=agent&ref=agent-list"
                                style="cursor: pointer;">
                                <td><?= esc($agent['no']) ?></td>
                                <td><?= esc($agent['user_name']) ?></td>
                                <td><?= esc($agent['gender'] == 0 ? '남성' : '여성') ?></td>
                                <td><?= esc($agent['phone']) ?></td>
                                <td><?= esc($agent['user_id']) ?></td>
                                <td><?= esc($agent['create_at']) ?></td>
                            </tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">소속 대리점이 없습니다.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <!-- 페이지네이션 -->
                <div class="paging_box">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination pagination-primary justify-content-center">
                            <!-- 처음 버튼 -->
                            <li class="page-item <?= $currentPage > 1 ? '' : 'disabled' ?>">
                                <a class="page-link" href="?<?= $pageQuery ?>&page=1">처음</a>
                            </li>
    
                            <!-- 이전 버튼 -->
                            <li class="page-item <?= $currentPage > 1 ? '' : 'disabled' ?>">
                                <a class="page-link" href="?<?= $pageQuery ?>&page=<?= $currentPage - 1 ?>">
                                    < </a>
                            </li>
    
                            <!-- 페이지 번호 -->
                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <li class="page-item <?= $i == $currentPage ? 'active' : '' ?>">
                                <a class="page-link" href="?<?= $pageQuery ?>&page=<?= $i ?>"><?= $i ?></a>
                            </li>
                            <?php endfor; ?>
    
                            <!-- 다음 버튼 -->
                            <li class="page-item <?= $currentPage < $totalPages ? '' : 'disabled' ?>">
                                <a class="page-link" href="?<?= $pageQuery ?>&page=<?= $currentPage + 1 ?>">></a>
                            </li>
    
                            <!-- 마지막 버튼 -->
                            <li class="page-item <?= $currentPage < $totalPages ? '' : 'disabled' ?>">
                                <a class="page-link px-3" href="?<?= $pageQuery ?>&page=<?= $totalPages ?>">끝</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </section>


        <?= $this->include('templates/footer') ?>

        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/rangePlugin.js"></script>
        <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
        <script src="<?= base_url('/assets/js/custom/custom.js') ?>"></script>
        <script src="<?= base_url('/assets/vendors/sweetalert2/sweetalert2.all.min.js') ?>"></script>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            // 클릭 가능한 행에 대한 클릭 이벤트 설정
            document.querySelectorAll('.clickable-row').forEach(function(row) {
                row.addEventListener('click', function() {
                    const url = this.dataset.url; // data-url 속성에서 URL 가져오기
                    if (url) {
                        window.location.href = url; // 해당 URL로 이동
                    }
                });
            });
        });
        </script>