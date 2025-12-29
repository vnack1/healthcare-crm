<?= $this->include('templates/header') ?>
<?= $this->include('templates/sidebar') ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

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
                    <h3>멜로시라 완료 리스트</h3>
                    <p class="text-subtitle text-muted">
                        멜로시라를 섭취가 완료된 회원의 조회 및 검색이 가능합니다</p>
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

        <!-- 멜로시라 완료 리스트  조회 -->
        <section id="basic-horizontal-layouts">
            <div class="row match-height">
                <div class="col-md-12 col-12">
                    <div class="card border">
                        <div class="card-header px-5 pb-2 mt-3">
                            <h4 class="card-title">회원검색</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-horizontal"
                                    action="<?php echo base_url('melosira-management/complete_list') ?>">
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
                                            <div class="col-md-5 form-check mt-2 d-flex gap-5">
                                                <div class="ms-3 form-group">
                                                    <input class="form-check-input" type="radio" name="gender"
                                                        id="flexRadioDefault1" value="" checked>
                                                    <label class="form-check-label" for="gender">전체</label>
                                                </div>
                                                <div class="ms-3 form-group">
                                                    <input class="form-check-input" type="radio" name="gender"
                                                        id="flexRadioDefault1" value="0">
                                                    <label class="form-check-label" for="gender">남자</label>
                                                </div>
                                                <div class="ms-3 form-group">
                                                    <input class="form-check-input" type="radio" name="gender"
                                                        id="flexRadioDefault2" value="1">
                                                    <label class="form-check-label" for="gender">여자</label>
                                                </div>
                                            </div>
                                            <div class="col-md-1 form-group">
                                                <label class="pt-2">휴대폰</label>
                                            </div>
                                            <div class="col-md-5 form-group pe-5">
                                                <input type="text" id="phone-number" class="form-control" name="phone"
                                                    placeholder="'-' 없이 입력해주세요">
                                            </div>

                                            <div class="col-md-1 form-group">
                                                <label class="pt-2">생년월일</label>
                                            </div>
                                            <div class="col-md-5 form-group">
                                                <input type="text" id="birth_date" class="form-control"
                                                    name="birth_date" placeholder="날짜를 선택해주세요" autocomplete="off">

                                            </div>
                                            <div class="col-md-1 form-group">
                                                <label class="pt-2">섭취 시작일</label>
                                            </div>
                                            <div class="col-md-5 form-group pe-5">
                                                <input type="text" id="start_date" class="form-control"
                                                    name="start_date" placeholder="날짜를 선택해주세요" autocomplete="off">
                                            </div>

                                        </div>
                                        <div class="d-flex justify-content-center gap-2">
                                            <button type="reset"
                                                class="btn btn-light-secondary d-flex align-items-center justify-content-center"
                                                style="width: 160px;font-size: 18px">초기화</button>
                                            <button type="submit"
                                                class="btn btn-primary d-flex align-items-center justify-content-center"
                                                style="width: 160px;font-size: 18px">조회</button>
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
                                <!-- 검색 결과 -->
                                <h4>검색결과 &nbsp;</h4>
                                <div class="d-flex">
                                    <?php if (isset($userList) && count($userList) > 0): ?>
                                    <h4>총 <?= count($userList) ?>명</h4>

                                    <?php endif; ?>
                                </div>
                            </div>
                            <!-- <div>
                        <button id="downloadExcel" class="btn btn-light-primary d-flex align-items-center justify-content-center" style="width: 160px;font-size: 18px">엑셀 다운로드</button>
                    </div> -->
                        </div>
                    </div>
                    <div class="card-body px-5">
                        <div class="table-responsive">
                            <table class="table table-hover" id="m-table">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="checkAll" class="form-check-input"></th>
                                        <th>No</th>
                                        <th>이름</th>
                                        <th>성별</th>
                                        <th>휴대폰</th>
                                        <th>생년월일</th>
                                        <th>시작일</th>
                                        <th>진행주차</th>
                                        <th>섭취빈도</th>
                                        <th>상태</th>
                                        <th>알림</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (isset($userList) && count($userList) > 0): ?>
                                    <?php foreach ($userList as $item): ?>
                                    <tr class="clickable-row"
                                        data-url="<?= base_url('/melosira-management/all_list/') . esc($item['user_idx']) ?>"
                                        style="cursor: pointer;">
                                        <td>
                                            <label class="form-check-label w-100" onclick="event.stopPropagation();"
                                                style="cursor: pointer; position:relative; z-index:30;">
                                                <input class="form-check-input row-checkbox" type="checkbox" value="">
                                        </td>
                                        <td><?= esc($item['no']) ?></td>
                                        <td><?= esc($item['user_name']) ?></td>
                                        <td><?= $item['gender'] == 0 ? '남성' : '여성' ?></td>
                                        <td><?= esc($item['phone']) ?></td>
                                        <td><?= esc($item['birth_date']) ?></td>
                                        <td><?= $item['start_date'] ? esc($item['start_date']) : '정보 없음' ?></td>
                                        <td><?= $item['week_progress'] ? esc($item['week_progress']) . '주차' : '정보 없음' ?>
                                        </td>
                                        <td><?= isset($item['frequency']) ? "주{$item['frequency']}회" : '정보 없음' ?></td>
                                        <td>
                                            <?php
                                            if (isset($item['status'], $item['week_progress']) && $item['status'] === '2' && $item['week_progress'] == 12) {
                                                echo '완료';
                                            } else {
                                                echo '정보 없음';
                                            }
                                            ?>
                                        </td>
                                        <td
                                            style="<?= esc($item['alert_color']) ?> color:#fff; background-color:#9b9b9b;">
                                            <?= esc($item['alert_text']) ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <?php else: ?>
                                    <tr>
                                        <td colspan="11" class="text-center">회원이 없습니다.</td>
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
                                    <a class="page-link" href="?<?= $pageQuery ?>&page=<?= $totalPages ?>">끝</a>
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
        document.addEventListener('DOMContentLoaded', function() {
            // 모든 클릭 가능한 행에 대한 클릭 이벤트 설정
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

            // 성별 라디오 버튼 설정
            const gender = urlParams.get("gender");
            if (gender !== null) {
                document.querySelector(`input[name="gender"][value="${gender}"]`).checked = true;
            }
        });

        document.addEventListener('DOMContentLoaded', function() {

            flatpickr("#birth_date", {
                dateFormat: "Y-m-d", // 날짜 형식 (연-월-일)
                allowInput: true, // 사용자가 직접 입력할 수 있도록 허용
                maxDate: "today", // 생년월일이 미래가 될 수 없도록 오늘 날짜까지만 선택 가능
                defaultDate: null // 기본값을 설정하지 않음

            });

            flatpickr("#start_date", {
                dateFormat: "Y-m-d", // 날짜 형식 (연-월-일)
                allowInput: true, // 사용자가 직접 입력할 수 있도록 허용
                maxDate: "today", //  오늘 날짜까지만 선택 가능
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
        </script>