<!-- flatpickr연결  -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<?= $this->include('templates/header') ?>
<?= $this->include('templates/sidebar') ?>

<div id="main">
    <div class="app">
        <div class="page-heading mb-0">
            <div class="page-title pt-5">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>양자파동기 사용 정보 <?= isset($icuData) ? '수정' : '등록' ?></h3>
                        </h3>
                        <p class="text-subtitle text-muted">
                            양자파동기 사용 회원의 정보를 입력합니다
                        </p>
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
                                            action="<?= base_url('healthcare_management/icu/session-save/' . $user['user_idx'] . '/' . $progressTime) ?>"
                                            method="POST">

                                            <input type="hidden" name="user_idx" value="<?= esc($user['user_idx']) ?>">
                                            <input type="hidden" name="progress_time" value="<?= esc($progressTime) ?>">
                                            <!-- Hidden input으로 ref_icu 전달 -->
                                            <input type="hidden" name="ref_icu"
                                                value="<?= esc($_GET['ref_icu'] ?? 'all') ?>">

                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-2 form-group">
                                                        <label class="pt-2">이름</label>
                                                    </div>
                                                    <div class="col-md-10 form-group px-0">
                                                        <div class="mt-2 ms-2"><?= esc($user['user_name'])?></div>
                                                    </div>


                                                    <div class="col-md-2 form-group">
                                                        <label class="pt-2">진행회차</label>
                                                    </div>

                                                    <div class="col-md-10 form-group px-0">
                                                        <div class="mt-2 ms-2"><?=esc ($progressTime)?>회차</div>
                                                    </div>


                                                    <div class="col-md-2 form-group">
                                                        <label class="mt-2">검사날짜</label>
                                                    </div>

                                                    <div class="col-md-7 px-0">
                                                        <input type="text" id="test_date"
                                                            class="form-control bg-white form-group" name="test_date"
                                                            placeholder="검사일을 선택해주세요" autocomplete="off"
                                                            value="<?= isset($icuData['test_date']) ? esc($icuData['test_date']) : '' ?>"
                                                            <?= session()->get('grade') == 0 || session()->get('grade') == 2 ? '' : 'readonly' ?>>
                                                    </div>

                                                    <div class="col-md-3"></div>

                                                    <div class="col-md-2 form-group">
                                                        <label class="pt-2">검사결과</label>
                                                    </div>
                                                    
                                                    <!-- 소화기관 선택 시작 -->
                                                    <div class="col-md-7 form-group pt-3 px-3 rounded-2" style="border: 1px solid #dce7f1; margin-bottom:0.7rem;">
                                                        <?php foreach ($inspectionNames as $index => $inspection): ?>
                                                            <?php if (isset($inspection['inspect_idx'])): ?>
                                                                <input type="hidden" name="inspection_ids[]"
                                                            value="<?= esc($inspection['inspect_idx']) ?>">

                                                        <!-- 기존 검사 결과를 설정 -->
                                                        <?php
                                                        $assessmentValue = '';
                                                        if (isset($testResults)) {
                                                            foreach ($testResults as $result) {
                                                                if ($result['inspect_idx'] == $inspection['inspect_idx']) {
                                                                    $assessmentValue = $result['assessment'];
                                                                    break;
                                                                    }
                                                                }
                                                            }
                                                        ?>

                                                        <!-- 검사 결과 체크박스 -->
                                                            <div>
                                                                <label class="mb-2 fw-bold" style="color: #565656">[<?= esc($inspection['inspection_name']) ?>]</label>
                                                                <div class="d-flex mb-3 <?= esc($inspection['inspection_name']) === '호흡계' ? 'no-border' : '' ?>" style="border-bottom:1px solid #dce7f1; gap: 1.8rem;">
                                                                    <div class="form-check form-check-inline mb-3">
                                                                    <label style="color: #565656;">
                                                                        <input class="form-check-input" type="radio" name="inspection_results[<?= esc($inspection['inspect_idx']) ?>]" value="1"
                                                                            <?= $assessmentValue === '1' ? 'checked' : '' ?> <?= session()->get('grade') == 0 || session()->get('grade') == 2 ? '' : 'disabled' ?>>
                                                                        좋음 <i class="bi bi-emoji-smile"  style="vertical-align:middle;"></i>
                                                                    </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                    <label style="color: #565656;">
                                                                        <input class="form-check-input" type="radio" name="inspection_results[<?= esc($inspection['inspect_idx']) ?>]" value="0"
                                                                            <?= $assessmentValue === '0' ? 'checked' : '' ?> <?= session()->get('grade') == 0 || session()->get('grade') == 2 ? '' : 'disabled' ?>>
                                                                        보통 <i class="bi bi-emoji-expressionless" style="vertical-align:middle;"></i>
                                                                    </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                    <label style="color: #565656;">
                                                                        <input class="form-check-input"  type="radio" name="inspection_results[<?= esc($inspection['inspect_idx']) ?>]" value="-1"
                                                                            <?= $assessmentValue === '-1' ? 'checked' : '' ?> <?= session()->get('grade') == 0 || session()->get('grade') == 2 ? '' : 'disabled' ?>>
                                                                        나쁨 <i class="bi bi-emoji-frown"  style="vertical-align:middle;"></i>
                                                                    </label>

                                                                    </div>
                                                                    <hr>

                                                                </div>
                                                            </div>
                                            <?php endif; ?>
                                            <?php endforeach; ?>
                                                                                                             
                                                </form>
                                   
                                </div>
                                <div class="col-md-2"></div>
                                <div class="col-md-2 form-group">
                                    <label class="mt-2">메모</label>
                                </div>
                                <div class="col-md-7 form-group px-0">
                                    <textarea type="text" id="notes" class="form-control"
                                        name="notes" placeholder="메모를 입력해주세요"
                                        style="height: 115px; resize: none;"
                                        <?= session()->get('grade') == 0 || session()->get('grade') == 2 ? '' : 'readonly' ?>><?= isset($icuData['notes']) ? esc($icuData['notes']) : '' ?></textarea>
                                </div>
                            <!-- </div>
                        </div> -->
    
                        <div class="col-12 d-flex justify-content-center mt-4 gap-3">
                            <a href="<?= base_url('healthcare_management/icu/icu-detail/'. esc($user['member_code']))?> ?ref_icu=<?= esc($_GET['ref_icu'] ?? 'all') ?>"
                                class="btn btn-danger d-flex align-items-center justify-content-center"
                                style="width: 160px;font-size: 18px;">취소</a>
                            <?php if (session()->get('grade') == 0 || session()->get('grade') == 2): ?>
                            <button type="submit" id="success2"
                                class="btn btn-primary d-flex align-items-center justify-content-center"
                                style="width: 160px;font-size: 18px"><?= isset($icuData) ? '수정' : '저장' ?>
                            </button>
                            <?php endif; ?>
                        </div>
                            </div>
                </section>
                <!--회원조회 끝 !-->
        </div>
    </div>

    <?= $this->include('templates/footer') ?>
</div>
<!--flatpicker-->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/rangePlugin.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ko.js"></script>

<script src=<?= base_url('assets/vendors/sweetalert2/sweetalert2.all.min.js')?>></script>


<script>
document.addEventListener("DOMContentLoaded", function() {
    // flatpickr 초기화
    flatpickr("#test_date", {
        dateFormat: "Y-m-d",
        locale: "ko", // 한국어 로케일 설정
        maxDate: "today", // 현재 날짜까지만 선택 가능
        allowInput: <?= json_encode(session()->get('grade') == 0 || session()->get('grade') == 2) ?>
    });

//     const form = document.querySelector("form");

// form.addEventListener("submit", function (e) {
//     e.preventDefault(); // 기본 제출 동작 방지

//     const formData = new FormData(form);
//     const entries = {};
//     for (const [key, value] of formData.entries()) {
//         if (entries[key]) {
//             if (!Array.isArray(entries[key])) {
//                 entries[key] = [entries[key]];
//             }
//             entries[key].push(value);
//         } else {
//             entries[key] = value;
//         }
//     }

//     console.log("Form Data:", entries);

    // 폼 제출을 다시 활성화하려면 아래 줄의 주석을 제거
    // form.submit();
// });

    const successButton = document.getElementById("success2");

    if (successButton) {
        successButton.addEventListener("click", (e) => {
            e.preventDefault(); // 기본 동작 방지

            // 폼 데이터 유효성 검사
            const form = document.querySelector("form");
            const dateInput = document.querySelector("#test_date");
            const radioGroups = document.querySelectorAll("[name^='inspection_results']");

            // 검사 날짜 확인
            if (!dateInput.value) {
                Swal.fire({
                    icon: "warning",
                    title: "검사 날짜를 입력해주세요",
                    confirmButtonText: "확인",
                });
                return;
            }

            // 검사 결과 확인
            const groupNames = new Set(); // 모든 검사 항목의 그룹 이름 저장
            const checkedGroups = new Set(); // 선택된 검사 항목의 그룹 이름 저장

            // 그룹 이름 추출
            radioGroups.forEach((radio) => {
                groupNames.add(radio.name); // 모든 그룹 이름 저장
                if (radio.checked) {
                    checkedGroups.add(radio.name); // 체크된 그룹만 저장
                }
            });

            if (checkedGroups.size !== groupNames.size) {
                Swal.fire({
                    icon: "warning",
                    title: "모든 검사 항목을 선택해주세요",
                    confirmButtonText: "확인",
                });
                return;
            }

            // 모든 유효성 검사가 통과된 경우
            Swal.fire({
                icon: "success",
                title: "저장이 완료되었습니다",
                confirmButtonText: "확인",
            }).then((result) => {
                if (result.isConfirmed) {
                    // SweetAlert 확인 후 폼 제출
                    form.submit();
                }
            });
        });
    } else {
        console.error('"success2" button not found.');
    }
});
</script>