<?= $this->include('templates/header') ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<?= $this->include('templates/sidebar') ?>

<div id="main">
    <div class="app">
        
    <div class="page-heading mb-3 mt-5">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-12 order-md-1 order-last">
                    <h3>멜로시라 회원 상세정보</h3>
                    <div class="d-flex justify-content-between">
                        <p class="text-subtitle text-muted">
                            멜로시라 회원 상세정보를 조회합니다
                        </p>
                        <a href="<?= base_url('user-management/user/detail/'. $user['member_code'])?>" type="submit"
                            class="btn btn-primary me-1 mb-2" style="width: 156px">
                            회원 상세정보
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>


        <!-- 회원 기본 정보 -->
        <!-- Basic Tables start -->
        <section class="section mb-5">
            <div class="row" id="basic-table">
                <div class="col-12 col-md-12">
                    <div class="card mb-2 border">
                        <div class="card-content">
                            <!-- Table with no outer spacing -->
                            <div class="table-responsive m-member-table">
                                <table class="table mb-0 table-lg">
                                    <thead>
                                        <tr class=" text-center">
                                            <th style="width: 170px" class="text-center">
                                                이름
                                            </th>
                                            <th>성별</th>
                                            <th>생년월일</th>
                                            <th>전화번호</th>
                                            <th>시작일</th>
                                            <th>진행회차</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="text-center">
                                            <td><?= esc($user['user_name']) ?></td>
                                            <td> <?= $user['gender'] == 0 ? '남성' : '여성' ?></td>
                                            <td><?= esc($user['birth_date']) ?></td>
                                            <td> <?= esc($user['phone']) ?></td>
                                            <td> <?= isset($latestData['start_date']) ? esc($latestData['start_date']) : '등록되지 않음' ?>
                                            </td>
                                            <td><?= isset($latestData['week_progress']) ? esc($latestData['week_progress']) . '주차' : '등록되지 않음' ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            </div>
        </section>


        <!-- 주차별 상태 표시 테이블 -->
        <section class="section">
            <div class="row" id="basic-table">
                <div class="col-12 col-md-12">
                    <div class="card border mb-2">
                        <div class="card-content">
                            <!-- Table with no outer spacing -->
                            <div class="table-responsive m-detail-table">
                                <table class="table mb-0 table-lg" id="table3">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>
                                                1주차
                                            </th>
                                            <th>
                                                2주차
                                            </th>
                                            <th>
                                                3주차
                                            </th>
                                            <th>
                                                4주차
                                            </th>
                                            <th>
                                                8주차
                                            </th>
                                            <th>
                                                12주차
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>상태</td>
                                            <?php foreach ([1, 2, 3, 4, 8, 12] as $week): ?>
                                            <td  class="<?= isset($inputAllowed[$week]) && $inputAllowed[$week] ? 'clickable' : 'disabled' ?>" 
                                            <?php if (isset($inputAllowed[$week]) && $inputAllowed[$week]): ?>
                                                onclick="location.href='/melosira-management/melosira/enroll?user_idx=<?= esc($user['user_idx']) ?>&week=<?= $week ?>'"
                                                style="cursor: pointer; background-color: #e6f7ec;" <?php else: ?>
                                                style="background-color: #D8D8D8;" <?php endif; ?>>
                                                <?= isset($melosiraByWeek[$week]['status']) 
                                ? ($melosiraByWeek[$week]['status'] == 0 ? '미등록' : 
                                    ($melosiraByWeek[$week]['status'] == 1 ? '진행중' : '완료'))
                                : (isset($inputAllowed[$week]) && $inputAllowed[$week] ? '등록 가능' : '등록 불가') ?>
                                            </td>
                                            <?php endforeach; ?>
                                        </tr>
                                        <tr>
                                            <td>섭취 빈도</td>
                                            <?php foreach ([1, 2, 3, 4, 8, 12] as $week): ?>
                                            <td <?php if (isset($inputAllowed[$week]) && $inputAllowed[$week]): ?>
                                                onclick="location.href='/melosira-management/melosira/enroll?user_idx=<?= esc($user['user_idx']) ?>&week=<?= $week ?>'"
                                                style="cursor: pointer; background-color: #e6f7ec;" <?php else: ?>
                                                style="background-color: #D8D8D8;" <?php endif; ?>>
                                                <?= isset($melosiraByWeek[$week]['frequency']) 
                                ? "주{$melosiraByWeek[$week]['frequency']}회"
                                : (isset($inputAllowed[$week]) && $inputAllowed[$week] ? '등록 가능' : '등록 불가') ?>
                                            </td>
                                            <?php endforeach; ?>
                                        </tr>
                                        <tr>
                                            <td>메모</td>
                                            <?php foreach ([1, 2, 3, 4, 8, 12] as $week): ?>
                                            <td <?php if (isset($inputAllowed[$week]) && $inputAllowed[$week]): ?>
                                                onclick="location.href='/melosira-management/melosira/enroll?user_idx=<?= esc($user['user_idx']) ?>&week=<?= $week ?>'"
                                                style="cursor: pointer; background-color: #e6f7ec;" <?php else: ?>
                                                style="background-color: #D8D8D8;" <?php endif; ?>>
                                                <?= isset($melosiraByWeek[$week]['notes']) 
                                ? esc($melosiraByWeek[$week]['notes'])
                                : (isset($inputAllowed[$week]) && $inputAllowed[$week] ? '등록 가능' : '등록 불가') ?>
                                            </td>
                                            <?php endforeach; ?>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="fs-6 mt-3 ms-4">** 각 주차별 정보를 입력하시려면 <span class="text-danger fw-bolder">초록색</span>으로 표시되는  <span class="text-danger fw-bolder">"등록 가능" 글자를 클릭</span>하세요 (등록 가능한 주차만 선택 가능합니다)</div>
        </section>
        <!-- 버튼들 -->
        <div class="d-flex justify-content-center gap-3 pt-4 pb-3 col-12">
            <a class="btn btn-secondary d-flex align-items-center justify-content-center" style="width: 160px; font-size: 18px"
                href="<?= base_url('melosira-management/all_list')?>">목록으로</a>
        </div>
    </div>
    <?= $this->include('templates/footer') ?>
</div>
</div>
</div>


<script src="<?= base_url('/assets/js/custom/custom.js') ?>"></script>
<script src="<?= base_url('/assets/vendors/sweetalert2/sweetalert2.all.min.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/rangePlugin.js"></script>