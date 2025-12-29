<!-- Include Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<?= $this->include('templates/header') ?>
<?= $this->include('templates/sidebar') ?>



<div id="main">
    <div class="app">

        <div class="page-heading mb-0">
            <div class="page-title pt-5">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>멜로시라 섭취 정보 <?= isset($melosira) ? '수정' : '등록' ?></h3>
                        <p class="text-subtitle text-muted">
                            멜로시라를 섭취하고 있는 회원의 정보를 입력합니다
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <section id="basic-horizontal-layouts">
            <div class="row match-height">
                <div class="col-md-12 col-12">
                    <div class="card border">
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-horizontal" method="post"
                                    action=<?= base_url('/melosira-management/melosira/enroll')?>>
                                    <input type="hidden" name="user_idx" value="<?= esc($user['user_idx']) ?>">
                                    <input type="hidden" name="week_progress" value="<?= esc($week) ?>">
                                    <div class="form-body">
                                        <div class="row">
                                            <!-- 회원 정보 -->
                                            <div class="col-md-3 form-group">
                                                <form method="post" action="/melosira-management/melosira/enroll">
                                                    <label class="pt-2">이름</label>
                                            </div>
                                            <div class="col-md-3 ">
                                                <div class="mt-2 ms-2"><?= esc($user['user_name']) ?></div>
                                            </div>

                                            <div class="col-md-3"></div>
                                            <div class="col-md-3"></div>

                                            <div class="col-md-3 form-group">

                                                <label class="pt-2">진행주차</label>
                                            </div>
                                            <div class="col-md-3 form-group">
                                                <div class="mt-2 ms-2">
                                                    <?= esc($week) ?> 주차</div>
                                            </div>

                                            <div class="col-md-3"></div>
                                            <div class="col-md-3"></div>

                                            <!-- 섭취 정보 등록/수정 폼 -->


                                            <div class="col-md-3 form-group">
                                                <label class="mt-2">시작일</label>
                                            </div>

                                            <!-- Date Input Field -->
                                            <!-- 시작일 -->
                                            <div class="col-md-3">
                                                <input type="date" id="start_date" name="start_date"
                                                    class="form-control" style="background-color: #ffffff;"
                                                    value="<?= isset($melosira['start_date']) ? esc($melosira['start_date']) : '' ?>"
                                                    <?= session()->get('grade') == 0 || session()->get('grade') == 2 ? '' : 'readonly' ?>
                                                    required placeholder="시작일 선택" autocomplete="off">
                                            </div>
                                            <div class="col-md-3"></div>
                                            <div class="col-md-3"></div>
                                            <div class="col-md-3 form-group">
                                                <label class="pt-2">상태</label>
                                            </div>
                                            <div class="col-md-3">
                                                <select id="status" name="status" class="form-control"
                                                    onchange="toggleFrequencyField()"
                                                    <?= session()->get('grade') == 0 || session()->get('grade') == 2 ? '' : 'disabled' ?>
                                                    required>
                                                    <option value="">선택하세요</option>
                                                    <?php if (isset($melosira['status'])): ?>
                                                    <!-- Update : 진행중, 완료 모두 표시 -->
                                                    <option value="1"
                                                        <?= isset($melosira['status']) && $melosira['status'] == 1 ? 'selected' : '' ?>>
                                                        진행중
                                                    </option>
                                                    <option value="2"
                                                        <?= isset($melosira['status']) && $melosira['status'] == 2 ? 'selected' : '' ?>>
                                                        완료</option>
                                                    <?php else: ?>
                                                    <!-- Insert : 진행중만 표시 -->
                                                    <option value="1" selected>진행중</option>
                                                    <?php endif; ?>
                                                </select>

                                            </div>
                                            <div class="col-md-5"></div>
                                            <div class="col-md-3"></div>
                                            <div class="col-md-5">
                                                <small id="frequency-warning" class="text-danger fw-semibold pb-2"
                                                    style="display: <?= isset($melosira['status']) && $melosira['status'] == 2 ? 'none' : 'block' ?>;">
                                                    *완료 상태일 때만 섭취 빈도를 선택할 수 있습니다.*
                                                </small>
                                            </div>
                                            <div class="col-md-3"></div>

                                            <div class="col-md-3 form-group">
                                                <label class="pt-2">섭취빈도</label>
                                            </div>

                                            <div class="col-md-3">
                                                <select id="frequency" name="frequency" class="form-control" <?php if (
                                                            session()->get('grade') != 0 && // 슈퍼어드민이 아닌 경우
                                                            session()->get('grade') != 2   // 대리점이 아닌 경우
                                                        ): ?> disabled <?php endif; ?>
                                                    onchange="checkFrequencyAvailability()">
                                                    <option value="">섭취 빈도를 선택하세요</option>
                                                    <?php for ($i = 0; $i <= 7; $i++): ?>
                                                    <option value="<?= $i ?>"
                                                        <?= isset($melosira['frequency']) && $melosira['frequency'] == $i ? 'selected' : '' ?>>
                                                        주<?= $i ?>회
                                                    </option>
                                                    <?php endfor; ?>
                                                </select>
                                            </div>

                                            <div class="col-md-3"></div>
                                            <div class="col-md-3"></div>
                                            <div class="form-group col-md-3">
                                                <label for="notes" class="pt-2">메모</label>
                                            </div>

                                            <!-- 메모 -->
                                            <div class="col-md-6 form-group">
                                                <textarea id="notes" name="notes" class="form-control" type="text"
                                                    placeholder="메모를 입력해주세요" style="height: 115px; resize: none;"
                                                    rows="4"
                                                    <?= session()->get('grade') == 0 || session()->get('grade') == 2 ? '' : 'readonly' ?>><?=isset($melosira['notes']) ? esc($melosira['notes']) : '' ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- 버튼들 -->
                                    <div class="col-12 d-flex justify-content-center mt-4 gap-3">
                                        <a href="<?= base_url('/melosira-management/all_list/' . esc($user['user_idx'])) ?>"
                                            class="btn btn-danger d-flex align-items-center justify-content-center"
                                            style="width: 160px;font-size: 18px;">취소</a>
                                        <?php if (session()->get('grade') == 0 || session()->get('grade') == 2): ?>
                                        <button type="submit" id="success"
                                            class="btn <?= isset($melosira) ? 'btn-warning' : 'btn-primary' ?> d-flex align-items-center justify-content-center"
                                            style="width: 160px;font-size: 18px"><?= isset($melosira) ? '수정' : '저장' ?></button>
                                        <?php endif; ?>
                                    </div>
                                </form>
                            </div>
        </section>

        <?= $this->include('templates/footer') ?>

    </div>
</div>
<script src="<?= base_url('/assets/js/custom/custom.js') ?>"></script>
<script src="<?= base_url('/assets/vendors/sweetalert2/sweetalert2.all.min.js') ?>"></script>
<!-- Include Flatpickr JS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ko.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Flatpickr 초기화
    flatpickr("#start_date", {
        dateFormat: "Y-m-d",
        locale: "ko",
        maxDate: "today", // 현재 날짜까지만 선택 가능
        allowInput: <?= session()->get('grade') == 0 || session()->get('grade') == 2 ? 'true' : 'false' ?> // 권한 체크
    });

    // 상태 변경 이벤트 설정
    const statusField = document.getElementById('status');
    if (statusField) {
        statusField.addEventListener('change', toggleFrequencyField);
    }

    // 페이지 로드 시 초기 상태 설정
    toggleFrequencyField();
});
document.addEventListener('DOMContentLoaded', function() {
    const successButton = document.getElementById("success");
    const form = document.querySelector("form");

    if (successButton && form) {
        successButton.addEventListener("click", function(event) {
            event.preventDefault(); // 기본 동작 방지
            // SweetAlert 실행
            Swal.fire({
                title: '완료!',
                text: '데이터 저장이 완료되었습니다.',
                icon: 'success',
                confirmButtonText: '확인',
            }).then((result) => {
                if (result.isConfirmed) {
                    // SweetAlert 확인 버튼 클릭 시 폼 제출
                    form.submit();
                } else {
                    // SweetAlert 취소 버튼 클릭 시 동작
                    console.log('저장 취소됨');
                }
            });
        });
    } else {
        console.error("Success button or form not found.");
    }
});

// 상태 변경 시 섭취빈도 필드 활성화 여부 및 경고 메시지 제어
function toggleFrequencyField() {
    const statusField = document.getElementById('status');
    const frequencyField = document.getElementById('frequency');
    const warningMessage = document.getElementById('frequency-warning');

    if (!statusField || !frequencyField || !warningMessage) {
        console.error("Required DOM elements are missing.");
        return;
    }

    const status = statusField.value; // 현재 상태값 가져오기

    // 서버에서 전달된 등급 값
    const grade = <?= session()->get('grade') ?>;

    // 완료(2) 상태일 때 섭취빈도 필드 활성화
    if (status === '2' && (grade === 0 || grade === 2)) {
        frequencyField.disabled = false; // 섭취빈도 필드 활성화
        warningMessage.style.display = "none"; // 경고 메시지 숨김
    } else {
        frequencyField.disabled = true; // 섭취빈도 필드 비활성화
        frequencyField.value = ""; // 섭취빈도 초기화
        warningMessage.style.display = "block"; // 경고 메시지 표시
        warningMessage.style.color = "#FF0000"; // 경고 메시지 색상 설정
    }
}
</script>