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
                    <h3>회원 리스트</h3>
                    <p class="text-subtitle text-muted">회원 상세 조회 및 검색이 가능합니다</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="<?= base_url('/dashboard')?>">메인</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">회원 관리</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- 회원 조회 -->
        <section id="basic-horizontal-layouts">
            <div class="row match-height">
                <div class="col-md-12 col-12">
                    <div class="card border">
                        <div class="card-header px-5 pb-2 mt-3">
                            <h4 class="card-title">회원조회</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-horizontal"
                                    action="<?php echo base_url('user-management/user/list') ?>">
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
                                                <label class="mt-2">성별</label>
                                            </div>
                                            <div class="col-md-5 form-check pe-0 mt-2 d-flex gap-5 pe-5">
                                                <div class="ms-3 form-group">
                                                    <input class="form-check-input" type="radio" name="gender"
                                                        id="flexRadioDefault1" value="" checked>
                                                    <label class="form-check-label" for="flexRadioDefault1">전체</label>
                                                </div>
                                                <div class="ms-3 form-group">
                                                    <input class="form-check-input" type="radio" name="gender"
                                                        id="flexRadioDefault2" value="0">
                                                    <label class="form-check-label" for="flexRadioDefault2">남자</label>
                                                </div>
                                                <div class="ms-3 form-group">
                                                    <input class="form-check-input" type="radio" name="gender"
                                                        id="flexRadioDefault3" value="1">
                                                    <label class="form-check-label" for="flexRadioDefault3">여자</label>
                                                </div>
                                            </div>
                                            <div class="col-md-1 form-group">
                                                <label class="pt-2">전화번호</label>
                                            </div>
                                            <div class="col-md-5 form-group pe-5">
                                                <input type="text" id="phone-number" class="form-control" name="phone"
                                                    autocomplete="off" placeholder="'-' 없이 입력해주세요">
                                            </div>

                                            <div class="col-md-1 form-group">
                                                <label class="pt-2">생년월일</label>
                                            </div>
                                            <div class="col-md-5 form-group">
                                                <input type="text" id="birth_date" class="form-control"
                                                    name="birth_date" placeholder="날짜를 선택해주세요" autocomplete="off">

                                            </div>
                                            <div class="col-md-1 form-group">
                                                <label class="mt-2">가입기간</label>
                                            </div>

                                            <div class="col-md-5 d-flex gap-2 align-items-center pe-5">
                                                <div class="flex-grow-1">
                                                    <input type="text" id="start_date" class="form-control bg-white"
                                                        name="start_date" placeholder="시작일 선택" autocomplete="off">
                                                </div>
                                                <div class="mt-2">~</div>
                                                <div class="flex-grow-1">
                                                    <input type="text" id="end_date" class="form-control bg-white"
                                                        name="end_date" placeholder="종료일 선택" autocomplete="off">
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
                                <h4>총 회원 수 &nbsp;</h4>
                                <div class="d-flex">
                                    <h4> <?= esc($gradeThreeCount) ?></h4>
                                    <h4>명</h4>
                                </div>
                            </div>
                            <div class="d-flex gap-2">
                                <?php if (session()-> get('grade') === 2 ):?>
                                <a href="<?=base_url('user-management/user/enroll')?>?ref_menu=user&ref=user-enroll"
                                    class="btn btn-primary d-flex align-items-center justify-content-center"
                                    style="width: 160px;font-size: 18px">회원 등록</a>
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
                                class="table table-hover <?php echo session()->get('grade') === 0 ? 'super-admin' : 'regular-user'; ?>">
                                <thead>
                                    <tr>
                                        <th class="text-center"><input type="checkbox" id="checkAll"
                                                class="form-check-input"></th>
                                        <th class="text-center">NO</th>
                                        <?php if (session()->get('grade') === 0): ?>
                                        <!-- 슈퍼어드민만 멤버코드 표시 -->
                                        <th class="text-center">멤버코드</th>
                                        <?php endif; ?>
                                        <th class="text-center">대리점</th>
                                        <th class="text-center">이름</th>
                                        <th class="text-center">성별</th>
                                        <th class="text-center">전화번호</th>
                                        <th class="text-center">생년월일</th>
                                        <th class="text-center">가입일시</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($users)): ?>
                                    <?php foreach ($users as $user): ?>
                                    <tr class="clickable-row"
                                        data-url="<?= base_url('user-management/user/detail/' . esc($user['member_code'])) ?>?ref_menu=user&ref=user-list"
                                        data-join="<?= date('Y-m-d', strtotime($user['create_at'])) ?>"
                                        style="cursor: pointer;">
                                        <td class="text-center">
                                            <label class="form-check-label w-100" onclick="event.stopPropagation();"
                                                style="cursor: pointer; position:relative; z-index:30;">
                                                <input class="form-check-input row-checkbox" type="checkbox" value="">
                                            </label>
                                        </td>
                                        <td class="text-center"><?= esc($user['no']) ?></td>
                                        <?php if (session()->get('grade') === 0): ?>
                                        <!-- 슈퍼어드민만 멤버코드 표시 -->
                                        <td class="text-center"><?= esc($user['member_code']) ?></td>
                                        <?php endif; ?>
                                        <td class="text-center"><?= esc($user['parent_agent_name']) ?? '없음' ?></td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center align-items-center">
                                                <?php if (isset($user['isRecent']) && $user['isRecent']): ?>
                                                <div class="pe-1 text-primary new-member-icon" style="font-size: 10px;">
                                                    ●</div>
                                                <?php endif; ?>
                                                <span><?= esc($user['user_name']); ?></span>

                                            </div>
                                        </td>
                                        <td class="text-center"><?= esc($user['gender']) == 0 ? '남성' : '여성' ?></td>
                                        <td class="text-center"><?= esc($user['phone']) ?></td>
                                        <td class="text-center"><?= esc($user['birth_date']) ?></td>
                                        <td class="text-center"><?= esc($user['create_at']) ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <?php else: ?>
                                    <tr>
                                        <td colspan="<?= session()->get('grade') == 0 ? 9 : 8 ?>" class="text-center">
                                            대리점이 없습니다.
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <?php 
                        // 최근 가입한 회원이 있는지 확인
                        $hasRecentUsers = false;
                        foreach ($users as $user) {
                            if (isset($user['isRecent']) && $user['isRecent']) {
                                $hasRecentUsers = true;
                                break; // 최근 가입 회원을 찾으면 더 이상 순회하지 않음
                            }
                        }
                        ?>
                        <?php if ($hasRecentUsers): ?>
                        <div class="ms-2">
                            <span class="text-primary align-middle" style="font-size: 10px;">●</span>
                            표시는 신규 회원임을 나타내며 가입일로부터 2주일간 표시됩니다
                        </div>
                        <?php endif; ?>
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
    // Row click event to navigate to detail page
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.clickable-row').forEach(function(row) {
            row.addEventListener('click', function() {
                window.location.assign(row.getAttribute('data-url'));
            });
        });
    });

    //페이지네이션 , 검색조건 
    document.addEventListener("DOMContentLoaded", function() {
        // URLSearchParams로 쿼리 파라미터 읽기
        const urlParams = new URLSearchParams(window.location.search);

        // 검색 필드 자동 채우기
        document.getElementById("user_name").value = urlParams.get("user_name") || "";
        document.getElementById("phone-number").value = urlParams.get("phone") || "";
        document.getElementById("birth_date").value = urlParams.get("birth_date") || "";
        document.getElementById("start_date").value = urlParams.get("start_date") || "";
        document.getElementById("end_date").value = urlParams.get("end_date") || "";
        // 성별 라디오 버튼 설정
        const gender = urlParams.get("gender");
        if (gender !== null) {
            document.querySelector(`input[name="gender"][value="${gender}"]`).checked = true;
        }

    });

    document.addEventListener("DOMContentLoaded", function() {

        flatpickr("#birth_date", {
            dateFormat: "Y-m-d", // 날짜 형식 (연-월-일)
            allowInput: true, // 사용자가 직접 입력할 수 있도록 허용
            maxDate: "today", // 생년월일이 미래가 될 수 없도록 오늘 날짜까지만 선택 가능
            defaultDate: null // 기본값을 설정하지 않음

        });

        flatpickr("#start_date", {
            dateFormat: "Y-m-d",
            allowInput: true,
            maxDate: "today", // 생년월일이 미래가 될 수 없도록 오늘 날짜까지만 선택 가능
            plugins: [
                new rangePlugin({
                    input: "#end_date"
                }) // 종료일 input을 지정
            ]
        });

        // URL 파라미터를 제거하여 페이지를 초기 상태로 유지
        if (window.location.search) {
            window.history.replaceState({}, document.title, window.location.pathname);
        }

    });

    // // 엑셀 다운로드 
    // document.getElementById('downloadExcel').addEventListener('click', function() {
    //     const checkedBoxes = document.querySelectorAll('.row-checkbox:checked');
    //     if (checkedBoxes.length === 0) {
    //         alert('다운로드할 데이터를 선택해주세요.');
    //         return;
    //     }
    //     document.getElementById('exportForm').submit();
    // });

    // 전체 선택 기능
    document.getElementById('checkAll').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('.row-checkbox');
        checkboxes.forEach((checkbox) => {
            checkbox.checked = this.checked;
        });
    });
    </script>