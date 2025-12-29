<?= $this->include('templates/header') ?>
<?= $this->include('templates/sidebar') ?>

<?php if (session()->getFlashdata('success')): ?>
<div class="alert alert-success">
    <?= session()->getFlashdata('success'); ?>
</div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
<div class="alert alert-danger">
    <?= session()->getFlashdata('error'); ?>
</div>
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
                    <h3>대리점 리스트</h3>
                    <p class="text-subtitle text-muted">대리점 상세 조회 및 검색이 가능합니다</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="<?= base_url('/dashboard')?>">메인</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                대리점 관리
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- 대리점 조회 -->

        <section id="basic-horizontal-layouts">
            <div class="row match-height">
                <div class="col-md-12 col-12">
                    <div class="card border">
                        <div class="card-header px-5 pb-2 mt-3">
                            <h4 class="card-title">대리점조회</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-horizontal"
                                    action="<?php echo base_url('user-management/agent/agentlist') ?>">
                                    <div class="form-body px-5">
                                        <div class="row mb-5">
                                            <div class="col-md-1 form-group">
                                                <label class="pt-2">이름</label>
                                            </div>
                                            <div class="col-md-5 form-group pe-5">
                                                <input type="text" id="user_name" class="form-control" name="user_name"
                                                    placeholder="이름을 입력해주세요">
                                            </div>
                                            <div class="col-md-1 form-group">
                                                <label class="pt-2">아이디</label>
                                            </div>
                                            <div class="col-md-5 form-group">
                                                <input type="text" id="user_id" class="form-control" name="user_id"
                                                    placeholder="아이디를 입력해주세요">
                                            </div>
                                            <div class="col-md-1 form-group">
                                                <label class="mt-2">성별</label>
                                            </div>
                                            <div class="col-md-5 form-check pe-0 mt-2 d-flex gap-5 pe-5">
                                                <div class="ms-3 form-group">
                                                    <input class="form-check-input" type="radio" name="gender"
                                                        id="gender0" value="" checked>
                                                    <label class="form-check-label" for="gender0">전체</label>
                                                </div>
                                                <div class="ms-3 form-group">
                                                    <input class="form-check-input" type="radio" name="gender"
                                                        id="gender2" value="0">
                                                    <label class="form-check-label" for="gender2">남자</label>
                                                </div>
                                                <div class="ms-3 form-group">
                                                    <input class="form-check-input" type="radio" name="gender"
                                                        id="gender1" value="1">
                                                    <label class="form-check-label" for="gender1">여자</label>
                                                </div>
                                            </div>
                                            <div class="col-md-1 form-group">
                                                <label class="pt-2">전화번호</label>
                                            </div>
                                            <div class="col-md-5 form-group">
                                                <input type="text" id="phone-number" autocomplete="off"
                                                    class="form-control" name="phone" placeholder="'-' 없이 입력해주세요">
                                            </div>

                                            <div class="col-md-1 form-group">
                                                <label class="pt-2">생년월일</label>
                                            </div>
                                            <div class="col-md-5 form-group pe-5">
                                                <input type="text" id="birth_date" class="form-control"
                                                    name="birth_date" placeholder="날짜를 선택해주세요" autocomplete="off">

                                            </div>
                                            <div class="col-md-1 form-group">
                                                <label class="mt-2">가입기간</label>
                                            </div>

                                            <div class="col-md-5 d-flex gap-2 align-items-center">
                                                <div class="flex-grow-1">
                                                    <input type="text" id="start_date" class="form-control bg-white"
                                                        name="start_date" placeholder="시작일" autocomplete="off">
                                                </div>
                                                <div class="mt-2">~</div>
                                                <div class="flex-grow-1">
                                                    <input type="text" id="end_date" class="form-control bg-white"
                                                        name="end_date" placeholder="종료일" autocomplete="off">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="d-flex justify-content-center gap-2">
                                            <button type="reset"
                                                class="btn btn-light-secondary d-flex align-items-center justify-content-center"
                                                style="width: 160px;font-size: 18px">초기화</button>
                                            <button type="submit"
                                                class="btn btn-primary d-flex align-items-center justify-content-center"
                                                style="width: 160px;font-size: 18px">검색</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 조회 리스트 -->
        <div class="page-heading">
            <section class="section">
                <div class="card border">
                    <div class="card-header px-5 mt-3">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex">
                                <h4>총 대리점수 &nbsp;</h4>
                                <div class="d-flex">
                                    <h4><?=esc($gradeTwoCount)?></h4>
                                    <h4>명</h4>
                                </div>
                            </div>
                            <div>
                                <?php if (session()->get('grade') === 1): ?>
                                <!-- 슈퍼 어드민일 때만 보이게 -->
                                <a href="<?=base_url('/user-management/agent/enroll')?>?ref_menu=agent&ref=agent-enroll"
                                    class="btn btn-primary me-1 mb-1" style="width: 120px;">대리점 등록</a>
                                <?php endif; ?>

                                <!-- <button id="downloadExcel"
                                    class="btn btn-light-primary d-flex align-items-center justify-content-center"
                                    style="width: 160px;font-size: 18px">엑셀 다운로드</button> -->
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-5">
                        <div class="table-responsive">
                            <table
                                class="table table-hover <?php echo session()->get('grade') === 0 ? 'super-admin2' : 'regular-user2'; ?>">
                                <thead>
                                    <tr>
                                        <th class="text-center"><input type="checkbox" id="checkAll"
                                                class="form-check-input"></th>
                                        <th class="text-center">NO</th>
                                        <?php if (session()->get('grade') === 0): ?>
                                        <!-- 슈퍼어드민만 멤버코드 표시 -->
                                        <th class="text-center">멤버코드</th>
                                        <th class="text-center">총판</th>
                                        <?php endif; ?>
                                        <th class="text-center">이름</th>
                                        <th class="text-center">성별</th>
                                        <th class="text-center">생년월일</th>
                                        <th class="text-center">전화번호</th>
                                        <th class="text-center">아이디</th>
                                        <th class="text-center">가입일시</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tbody>
                                    <?php $total = count($agents); // 총 데이터 개수 ?>
                                    <?php if (!empty($agents)): ?>
                                    <?php foreach ($agents as $agent): ?>
                                    <tr class="clickable-row"
                                        data-url="<?= base_url('user-management/agent/agent-detail/' . esc($agent['member_code'])) ?>?ref_menu=agent&ref=agent-list"
                                        style="cursor: pointer;">
                                        <td class="text-center">
                                            <label class="form-check-label w-100" onclick="event.stopPropagation();"
                                                style="cursor: pointer; position:relative; z-index:30;">
                                                <input class="form-check-input row-checkbox" type="checkbox" value="">
                                        </td>
                                        <td class="text-center"><?= esc($agent['no']) ?></td>
                                        <?php if (session()->get('grade') === 0): ?>
                                        <!-- 슈퍼어드민만 멤버코드 표시 -->
                                        <td class="text-center"><?= esc($agent['member_code']) ?></td>
                                        <td class="text-center"><?= esc($agent['parent_distributor_name']) ?? '없음'?>
                                        </td>
                                        <?php endif; ?>
                                        <td class="text-center"><?= esc($agent['user_name']) ?></td>
                                        <td class="text-center"><?= esc($agent['gender']) == 0 ? '남성' : '여성' ?></td>
                                        <td class="text-center"><?= esc($agent['birth_date']) ?></td>
                                        <td class="text-center"><?= esc($agent['phone']) ?></td>
                                        <td class="text-center"><?= esc($agent['user_id']) ?></td>
                                        <td class="text-center"><?= esc($agent['create_at']) ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <?php else: ?>
                                    <tr>
                                        <td colspan="<?= session()->get('grade') == 0 ? 10 : 8 ?>" class="text-center">
                                            대리점이 없습니다.
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>

                            </table>
                        </div>



                    </div>
                    <div class="paging_box">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination pagination-primary justify-content-center">
                                <!-- 처음 버튼 -->
                                <li class="page-item <?= $currentPage > 1 ? '' : 'disabled' ?>">
                                    <a class="page-link" href="?<?= $pageQuery ?>&page=1">처음</a>
                                </li>

                                <!-- 이전 버튼 -->
                                <li class="page-item <?= $currentPage > 1 ? '' : 'disabled' ?>">
                                    <a class="page-link"
                                        href="?<?= $pageQuery ?>&page=<?= $currentPage - 1 ?>">&#60;</a>
                                </li>

                                <!-- 페이지 번호 -->
                                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                <li class="page-item <?= $i == $currentPage ? 'active' : '' ?>">
                                    <a class="page-link" href="?<?= $pageQuery ?>&page=<?= $i ?>"><?= $i ?></a>
                                </li>
                                <?php endfor; ?>

                                <!-- 다음 버튼 -->
                                <li class="page-item <?= $currentPage < $totalPages ? '' : 'disabled' ?>">
                                    <a class="page-link"
                                        href="?<?= $pageQuery ?>&page=<?= $currentPage + 1 ?>">&#62;</a>
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
        </div>
    </div>
    <?= $this->include('templates/footer') ?>
    <script src="<?= base_url('/assets/js/custom/custom.js') ?>"></script>
    <script src="<?= base_url('/assets/vendors/sweetalert2/sweetalert2.all.min.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/rangePlugin.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // 모든 클릭 가능한 행에 대한 클릭 이벤트 설정
        document.querySelectorAll('.clickable-row').forEach(function(row) {
            row.addEventListener('click', function(e) {
                // 체크박스를 클릭한 경우에는 행 클릭 이벤트를 무시
                if (e.target.tagName.toLowerCase() === 'input' && e.target.type ===
                    'checkbox') {
                    return; // 이벤트 중단: 페이지 이동 안 함
                }
                // 체크박스를 제외한 다른 부분 클릭 시 페이지 이동
                window.location = this.dataset.url;
            });
        });

        flatpickr("#birth_date", {
            dateFormat: "Y-m-d", // 날짜 형식 (연-월-일)
            allowInput: true, // 사용자가 직접 입력할 수 있도록 허용
            maxDate: "today", // 생년월일이 미래가 될 수 없도록 오늘 날짜까지만 선택 가능
            defaultDate: null // 기본값을 설정하지 않음

        });

        flatpickr("#start_date", {
            dateFormat: "Y-m-d",
            allowInput: true,
            maxDate: "today", //  오늘 날짜까지만 선택 가능
            plugins: [
                new rangePlugin({
                    input: "#end_date"
                }) // 종료일 input을 지정
            ]
        });
    });

    // 엑셀 다운로드 
    document.getElementById('downloadExcel').addEventListener('click', function() {
        const checkedBoxes = document.querySelectorAll('.row-checkbox:checked');
        if (checkedBoxes.length === 0) {
            alert('다운로드할 데이터를 선택해주세요.');
            return;
        }
        document.getElementById('exportForm').submit();
    });

    // 전체 선택 기능
    document.getElementById('checkAll').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('.row-checkbox');
        checkboxes.forEach((checkbox) => {
            checkbox.checked = this.checked;
        });
    });

    //페이지네이션 , 검색조건 
    document.addEventListener("DOMContentLoaded", function() {
        const urlParams = new URLSearchParams(window.location.search);

        // 검색 필드 자동 채우기
        document.getElementById("user_name").value = urlParams.get("user_name") || "";
        document.getElementById("user_id").value = urlParams.get("user_id") || "";
        document.getElementById("phone").value = urlParams.get("phone") || "";
        document.getElementById("birth_date").value = urlParams.get("birth_date") || "";
        document.getElementById("start_date").value = urlParams.get("start_date") || "";
        document.getElementById("end_date").value = urlParams.get("end_date") || "";

        // 초기화 버튼
        document.querySelector('button[type="reset"]').addEventListener("click", function() {
            window.location.href = "<?= base_url('user-management/agent/agent-list') ?>";
        });
    });
    </script>