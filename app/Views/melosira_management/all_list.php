<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<?= $this->include('templates/header') ?>
<?= $this->include('templates/sidebar') ?>




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
                    <h3>멜로시라 전체 리스트</h3>
                    <p class="text-subtitle text-muted">
                        멜로시라를 섭취하고 있는 회원의 상세 조회 및 검색이 가능합니다</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="<?= base_url('/dashboard')?>">메인</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">멜로시라 리스트</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- 멜로시라 리스트 조회 -->
        <section id="basic-horizontal-layouts">
            <div class="row match-height">
                <div class="col-md-12 col-12">
                    <div class="card border">
                        <div class="card-header px-5 pb-2 mt-3">
                            <h4 class="card-title">회원조회</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <!-- 검색 폼 시작 -->
                                <form class="form form-horizontal" method="get"
                                    action="<?= base_url('melosira-management/all_list') ?>">
                                    <div class="form-body px-5">
                                        <div class="row mb-5">
                                            <!-- 이름 -->
                                            <div class="col-md-1 form-group">
                                                <label class="pt-2">이름</label>
                                            </div>
                                            <div class="col-md-5 form-group pe-5">
                                                <input type="text" id="user_name" class="form-control" name="user_name"
                                                    placeholder="이름을 입력해주세요">
                                            </div>

                                            <!-- 성별 -->
                                            <div class="col-md-1 form-group">
                                                <label class="mt-2">성별</label>
                                            </div>
                                            <div class="col-md-5 form-check pe-5 mt-2 d-flex gap-5">
                                                <div class="ms-3 form-group">
                                                    <input class="form-check-input" type="radio" name="gender"
                                                        id="gender_all" value="" checked>
                                                    <label class="form-check-label" for="gender_all">전체</label>
                                                </div>
                                                <div class="ms-3 form-group">
                                                    <input class="form-check-input" type="radio" name="gender"
                                                        id="gender_male" value="0">
                                                    <label class="form-check-label" for="gender_male">남자</label>
                                                </div>
                                                <div class="ms-3 form-group">
                                                    <input class="form-check-input" type="radio" name="gender"
                                                        id="gender_female" value="1">
                                                    <label class="form-check-label" for="gender_female">여자</label>
                                                </div>
                                            </div>

                                            <!-- 휴대폰 -->
                                            <div class="col-md-1 form-group">
                                                <label class="pt-2">전화번호</label>
                                            </div>
                                            <div class="col-md-5 form-group pe-5">
                                                <input type="text" id="phone-number" class="form-control" name="phone"
                                                    placeholder="'-' 없이 입력해주세요">
                                            </div>

                                            <!-- 생년월일 -->
                                            <div class="col-md-1 form-group">
                                                <label class="pt-2">생년월일</label>
                                            </div>
                                            <div class="col-md-5 form-group">
                                                <input type="text" id="birth_date" class="form-control"
                                                    name="birth_date" placeholder="날짜를 선택해주세요" autocomplete="off">
                                            </div>

                                            <!-- 섭취 시작일 -->
                                            <div class="col-md-1 form-group">
                                                <label for="start_date" class="pt-2">섭취 시작일</label>
                                            </div>
                                            <div class="col-md-5 form-group pe-5">
                                                <input type="date" id="start_date" class="form-control"
                                                    name="start_date" placeholder="날짜를 선택해주세요" autocomplete="off">
                                            </div>

                                            <!-- 진행 주차 -->
                                            <div class="col-md-1 form-group">
                                                <label class="pt-2">진행 주차</label>
                                            </div>
                                            <div class="col-md-5 form-group">
                                                <select class="form-select" id="week-list" name="week_progress">
                                                    <option value="">주차 선택</option>
                                                    <option value="1">1주차</option>
                                                    <option value="2">2주차</option>
                                                    <option value="3">3주차</option>
                                                    <option value="4">4주차</option>
                                                    <option value="8">8주차</option>
                                                    <option value="12">12주차</option>
                                                </select>
                                            </div>

                                            <!-- 상태 -->
                                            <div class="col-md-1 form-group">
                                                <label class="pt-2">상태</label>
                                            </div>
                                            <div class="col-md-5 form-group pe-5">
                                                <select id="status" name="status" class="form-select">
                                                    <option value="">전체</option>
                                                    <option value="0">미등록</option>
                                                    <option value="1">진행중</option>
                                                    <option value="2">완료</option>
                                                </select>
                                            </div>
                                            <!-- 상태별 알림 -->
                                            <div class="col-md-1 form-group">
                                                <label class="pt-2">상태별 알림</label>
                                            </div>
                                            <div class="col-md-5 form-group">
                                                <select id="alert_status" name="alert_status" class="form-select">
                                                    <option value="">전체</option>
                                                    <option value="섭취진행중">섭취진행중</option>
                                                    <option value="전화예정 D-1">전화예정 D-1</option>
                                                    <option value="전화대상자">전화대상자</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- 버튼 -->
                                    <div class="d-flex justify-content-center gap-2">
                                        <button type="reset"
                                            class="btn btn-light-secondary d-flex align-items-center justify-content-center"
                                            style="width: 160px;font-size: 18px">초기화</button>
                                        <button type="submit"
                                            class="btn btn-primary d-flex align-items-center justify-content-center"
                                            style="width: 160px;font-size: 18px">검색</button>
                                    </div>
                                </form> <!-- 검색 폼 끝 -->
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
                                <h4>검색결과 &nbsp;</h4>
                                <div class="d-flex">
                                    <?php if (isset($userList) && count($userList) > 0): ?>
                                    <h4>총</h4>
                                    <h4><?= esc($totalRecords) ?></h4>
                                    <h4>명</h4>
                                    <?php endif; ?>
                                    <!-- 추가된 endif -->
                                </div>
                            </div>
                            <!-- <div>
                                <button id="downloadExcel"
                                    class="btn btn-light-primary d-flex align-items-center justify-content-center"
                                    style="width: 160px;font-size: 18px">엑셀 다운로드</button>
                            </div> -->
                        </div>
                    </div>
                    <div class="card-body px-5">
                        <div class="table-responsive">
                            <table class="table table-hover" id="m-table">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            <input type="checkbox" id="checkAll" class="form-check-input">
                                        </th>
                                        <th class="text-center">NO</th>
                                        <th class="text-center">이름</th>
                                        <th class="text-center">성별</th>
                                        <th class="text-center">전화번호</th>
                                        <th class="text-center">생년월일</th>
                                        <th class="text-center">시작일</th>
                                        <th class="text-center">진행주차</th>
                                        <th class="text-center">섭취빈도</th>
                                        <th class="text-center">상태</th>
                                        <th class="text-center">알림</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (isset($userList) && count($userList) > 0): ?>
                                    <?php foreach ($userList as $item): ?>
                                    <tr class="clickable-row"
                                        data-url="<?= base_url('/melosira-management/melosira-detail/' . esc($item['user_idx'])) ?>?ref=all"
                                        style="cursor: pointer;">
                                        <td class="text-center">
                                            <label class="form-check-label w-100" onclick="event.stopPropagation();"
                                                style="cursor: pointer; position:relative; z-index:30;">
                                                <input class="form-check-input row-checkbox" type="checkbox" value="">
                                        </td>
                                        <td class="text-center"><?= esc($item['no']) ?></td>
                                        <td class="text-center"><?= esc($item['user_name']) ?></td>
                                        <td class="text-center"><?= $item['gender'] == 0 ? '남성' : '여성' ?></td>
                                        <td class="text-center"><?= esc($item['phone']) ?></td>
                                        <td class="text-center"><?= esc($item['birth_date']) ?></td>
                                        <td class="text-center">
                                            <?= $item['start_date'] ? esc($item['start_date']) : '미등록' ?></td>
                                        <td class="text-center">
                                            <?= $item['week_progress'] ? esc($item['week_progress']) . '주차' : '미등록' ?>
                                        </td>
                                        <td class="text-center">
                                            <?= isset($item['frequency']) && $item['frequency'] !== null 
                                                ? "주{$item['frequency']}회" 
                                                : '미등록' ?>
                                        </td>
                                        <td class="text-center">
                                            <?php
                                            if (isset($item['status'])) {
                                                switch ($item['status']) {
                                                    case 0:
                                                        echo '미등록';
                                                        break;
                                                    case 1:
                                                        echo '진행중';
                                                        break;
                                                    case 2:
                                                        echo '완료';
                                                        break;
                                                    default:
                                                        echo '미등록';
                                                }
                                            } else {
                                                echo '미등록';
                                            }
                                            ?>
                                        </td>
                                        <td class="text-center" style="<?= esc($item['alert_color']) ?>">
                                            <?= esc($item['alert_text']) ?>
                                        </td> <!-- 알림 칸 추가 -->
                                    </tr>

                                    <?php endforeach; ?>
                                    <?php else: ?>
                                    <tr>
                                        <td colspan=11" class="text-center">회원이 없습니다.</td>
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
        </div>

        <?= $this->include('templates/footer') ?>

        <script src="<?= base_url('/assets/js/custom/custom.js') ?>"></script>
        <script src="<?php echo base_url('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/vendors/simple-datatables/simple-datatables.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/main.js') ?>"></script>
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

        document.addEventListener('DOMContentLoaded', function() {

            // URLSearchParams로 쿼리 파라미터 읽기 및 폼에 값 채우기
            const urlParams = new URLSearchParams(window.location.search);

            // 검색 필드 자동 채우기
            document.getElementById("user_name").value = urlParams.get("user_name") || "";
            document.getElementById("phone-number").value = urlParams.get("phone") || "";
            document.getElementById("birth_date").value = urlParams.get("birth_date") || "";
            document.getElementById("start_date").value = urlParams.get("start_date") || "";
            document.getElementById("week-list").value = urlParams.get("week-list") || "";
            document.getElementById("status").value = urlParams.get("status") || "";
            document.getElementById("alert_status").value = urlParams.get("alert_status") || "";

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
                dateFormat: "Y-m-d", // 날짜 형식 (연-월-일)
                allowInput: true, // 사용자가 직접 입력할 수 있도록 허용
                maxDate: "today", // 오늘 날짜까지만 선택 가능
                defaultDate: null // 기본값을 설정하지 않음
            });



            // URL 파라미터를 제거하여 페이지를 초기 상태로 유지
            if (window.location.search) {
                window.history.replaceState({}, document.title, window.location.pathname);
            }
        });

        // 전체 선택 기능
        document.getElementById('checkAll').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.row-checkbox');
            checkboxes.forEach((checkbox) => {
                checkbox.checked = this.checked;
            });
        });
        //    // 엑셀 다운로드 
        //    document.getElementById('downloadExcel').addEventListener('click', function() {
        //             const checkedBoxes = document.querySelectorAll('.row-checkbox:checked');
        //             if (checkedBoxes.length === 0) {
        //                 alert('다운로드할 데이터를 선택해주세요.');
        //                 return;
        //             }
        //             document.getElementById('exportForm').submit();
        //         });

        document.addEventListener('DOMContentLoaded', function() {
            const weekList = document.getElementById('week-list');
            const statusSelect = document.getElementById('status');

            // 원래 상태 옵션 저장
            const originalStatusOptions = Array.from(statusSelect.options);

            weekList.addEventListener('change', function() {
                const selectedWeek = weekList.value;

                // 진행 주차가 12주차일 경우 상태 필드 옵션 변경
                if (selectedWeek === '12') {
                    // 상태를 미등록(0)과 진행중(1)만으로 제한
                    statusSelect.innerHTML = `
                <option value="">전체</option>
                <option value="0">미등록</option>
                <option value="1">진행중</option>
            `;
                } else {
                    // 원래 상태 옵션으로 복원
                    statusSelect.innerHTML = '';
                    originalStatusOptions.forEach(option => {
                        statusSelect.add(option);
                    });
                }
            });
        });
        </script>