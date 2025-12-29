<?= $this->include('templates/header') ?>
<?= $this->include('templates/sidebar') ?>

<?php if (session()->getFlashdata('error')) : ?>
<script>
alert('<?= esc(session()->getFlashdata('error')) ?>');
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
                    <h3>양자파동기 완료 리스트</h3>
                    <p class="text-subtitle text-muted">
                        양자파동기를 사용을 완료한 회원의 상세 조회 및 검색이 가능합니다</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="<?= base_url('/dashboard')?>">메인</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">양자파동기 리스트</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- 양자파동 리스트  조회 -->
        <section id="basic-horizontal-layouts">
            <div class="row match-height">
                <div class="col-md-12 col-12">
                    <div class="card">
                        <div class="card-header px-5 pb-2 mt-3">
                            <h4 class="card-title">회원조회</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-horizontal"
                                    action="<?php echo base_url('healthcare_management/icu/icusuccesslist') ?>">
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
                                            <div class="col-md-5 form-check pe-0 mt-2 d-flex gap-5">
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
                                                <label class="pt-2">전화번호</label>
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
                                                <label class="pt-2">검사일</label>
                                            </div>
                                            <div class="col-md-5 form-group pe-5">
                                                <input type="text" id="test_date" class="form-control" name="test_date"
                                                    placeholder="날짜를 선택해주세요" autocomplete="off">
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
                <div class="card">
                    <div class="card-header px-5 mt-3">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex">
                                <h4>검색 결과 &nbsp;</h4>
                                <div class="d-flex">
                                    <?php if (isset($icuUsers) && count($icuUsers) > 0): ?>
                                    <h4>총</h4>
                                    <h4><?= $totalRecords ?></h4>
                                    <h4>명</h4>
                                    <?php endif; ?>
                                    <!-- 추가된 endif -->
                                </div>
                            </div>
                            <!-- <div>
                                <button id="downloadExcel" class="btn btn-light-primary d-flex align-items-center justify-content-center" style="width: 160px;font-size: 18px">엑셀 다운로드</button>
                            </div> -->
                        </div>
                    </div>
                    <div class="card-body px-5">
                        <div class="table-responsive">
                            <table class="table table-hover" id="s-member-table">
                                <thead>
                                    <tr>
                                        <th class="text-center"><input type="checkbox" id="checkAll"
                                                class="form-check-input"></th>
                                        <th class="text-center">순번</th>
                                        <th class="text-center">이름</th>
                                        <th class="text-center">성별</th>
                                        <th class="text-center">생년월일</th>
                                        <th class="text-center">전화번호</th>
                                        <th class="text-center">검사일</th>
                                        <th class="text-center">진행 회차</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($icuUsers)): ?>
                                    <?php $no = $totalRecords - (($currentPage - 1) * $perPage); ?>
                                    <?php foreach ($icuUsers as $icuUser): ?>
                                    <tr class="clickable-row"
                                        data-url="<?= base_url('/healthcare_management/icu/icu-detail/' . esc($icuUser['member_code'])) ?>?ref_icu=complete"
                                        style="cursor: pointer;">
                                        <td class="text-center">
                                            <label class="form-check-label w-100" onclick="event.stopPropagation();"
                                                style="cursor: pointer; position:relative; z-index:30;">
                                                <input class="form-check-input row-checkbox" type="checkbox" value="">
                                        </td>
                                        <td class="text-center"><?= $no-- ?></td> <!-- 역순으로 번호 감소 -->
                                        <td class="text-center"><?= esc($icuUser['user_name']) ?></td>
                                        <td class="text-center"><?= esc($icuUser['gender']) == 0 ? '남성' : '여성' ?></td>
                                        <td class="text-center"><?= esc($icuUser['birth_date']) ?></td>
                                        <td class="text-center"><?= esc($icuUser['phone']) ?></td>
                                        <td class="text-center"><?= esc($icuUser['test_date']) ?></td>
                                        <td class="text-center"><?= esc($icuUser['progress_time']) .'회차'?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <?php else: ?>
                                    <tr>
                                        <td colspan="8" class="text-center">회원이 없습니다.</td>
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

    document.addEventListener("DOMContentLoaded", function() {
        const urlParams = new URLSearchParams(window.location.search);

        // 검색 필드 자동 채우기
        document.getElementById("user_name").value = urlParams.get("user_name") || "";
        document.getElementById("phone-number").value = urlParams.get("phone") || "";
        document.getElementById("birth_date").value = urlParams.get("birth_date") || "";
        document.getElementById("test_date").value = urlParams.get("test_date") || "";

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

        flatpickr("#test_date", {
            dateFormat: "Y-m-d",
            allowInput: true,
            maxDate: "today", //  오늘 날짜까지만 선택 가능
            defaultDate: null // 기본값을 설정하지 않음

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