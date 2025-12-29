<?= $this->include('templates/header') ?>
<?= $this->include('templates/sidebar') ?>

<body>
    <div id="main">
        <div class="app mb-5">
            <div class="page-heading mb-3 mt-5">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-12 order-md-1 order-last">
                            <h3>양자파동기 회원 상세정보</h3>
                            <div class="d-flex justify-content-between">
                                <p class="text-subtitle text-muted">양자파동기 회원 상세정보를 조회합니다</p>
                                <a href="<?= base_url('user-management/user/detail/'. $user['member_code'])?>?ref_icu=<?= esc($_GET['ref_icu'] ?? 'all') ?>"
                                    type="button"
                                    class="btn btn-primary d-flex align-items-center justify-content-center"
                                    style="width: 160px;font-size: 18px;">
                                    회원 상세정보
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Basic Tables start -->
            <section class="section mb-5">
                <div class="row" id="basic-table">
                    <div class="col-12 col-md-12">
                        <div class="card mb-2 border">
                            <div class="card-content">
                                <div class="table-responsive s-table">
                                    <table class="table mb-0 table-lg text-center">
                                        <thead>
                                            <tr>
                                                <th>이름</th>
                                                <th>성별</th>
                                                <th>생년월일</th>
                                                <th>전화번호</th>
                                                <th>진행회차</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center"><?= esc($user['user_name']) ?></td>
                                                <td><?= esc($user['gender']) == 0 ? '남' : '여' ?></td>
                                                <td><?= esc($user['birth_date']) ?></td>
                                                <td><?= esc($user['phone']) ?></td>
                                                <td><?= isset($icuInfo['progress_time']) ? esc($icuInfo['progress_time']) . '회차' : '0회차' ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Basic Tables end -->

            <!-- Detail Table -->
            <section class="section">
                <div class="row" id="basic-table">
                    <div class="col-12 col-md-12">
                        <div class="card border mb-0">
                            <div class="card-content">
                                <div class="table-responsive m-detail-table">
                                    <table class="table mb-0 table-lg" id="s-detail-table">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <?php 
                                                $previousRegistered = true;
                                                foreach ([1, 2, 3] as $progress_time): ?>
                                                <th>
                                                    <?= $progress_time ?>회차
                                                </th>
                                                <!-- <th <?= $previousRegistered ? "onclick=\"location.href='" . base_url('healthcare_management/icu/session-input/' . $user['member_code'] . '/' . $progress_time) . "'\"" : '' ?>
                                                    style="cursor: <?= $previousRegistered ? 'pointer' : 'not-allowed'; ?>;">
                                                    <?= $progress_time ?>회차
                                                </th> -->
                                                <?php endforeach; ?>
                                            </tr>
                                        </thead>
                                        <?php
                                        $referrerIcu = $_GET['ref_icu'] ?? 'all'; // ref_icu가 없으면 기본값을 'all'로 설정
                                        ?>
                                        <tbody>
                                            <!-- 검사 날짜 -->
                                            <tr>
                                                <td class="font-bold">검사날짜</td>
                                                <?php 
                                                $previousRegistered = true; // 첫 번째 회차는 등록 가능
                                                foreach ([1, 2, 3] as $progress_time): 
                                                    $foundResult = array_filter($testResults, function($result) use ($progress_time) {
                                                        return $result['progress_time'] == $progress_time;
                                                    });

                                                    $isCurrentAllowed = $previousRegistered && empty($foundResult); // 이전 회차 등록 확인
                                                    $isPreviousRegistered = !empty($foundResult); // 현재 회차가 이미 등록된 경우
                                                    $bgColor = $isCurrentAllowed || $isPreviousRegistered ? '#caf4c7' : '#D8D8D8'; // 배경색
                                                    // 초록색 배경일 때 hover-enabled 클래스 추가
                                                     $hoverClass = $bgColor === '#caf4c7' ? 'hover-enabled' : '';
                                                    $url = $isCurrentAllowed || $isPreviousRegistered 
                                                        ? base_url('healthcare_management/icu/session-input/' . $user['member_code'] . '/' . $progress_time . '?ref_icu=' . $referrerIcu)
                                                        : null;
                                                ?>
                                                <td class="<?= $hoverClass ?>"
                                                    style="cursor: <?= $isCurrentAllowed || $isPreviousRegistered ? 'pointer' : 'not-allowed' ?>; background-color: <?= $bgColor ?>;"
                                                    <?= $isCurrentAllowed || $isPreviousRegistered ? "onclick=\"location.href='" . $url . "'\"" : '' ?>>
                                                    <?= !empty($foundResult) 
                                                        ? esc(reset($foundResult)['test_date'] ?? '데이터 있음') 
                                                        : ($isCurrentAllowed ? '등록 가능' : '등록 불가') ?>
                                                </td>
                                                <?php 
                                                    $previousRegistered = $previousRegistered && !empty($foundResult); // 등록 상태 업데이트
                                                endforeach; 
                                                ?>
                                            </tr>
                                            <!-- 검사 결과 -->
                                            <tr>
                                                <td class="font-bold">검사결과</td>
                                                <?php 
                                                $previousRegistered = true; // 이전 진행 상태를 추적
                                                foreach ([1, 2, 3] as $progress_time): 
                                                    // 검사 결과 필터링
                                                    $foundResults = array_filter($testResults, function($result) use ($progress_time) {
                                                        return (int)$result['progress_time'] === (int)$progress_time; // 타입 강제 변환 후 비교
                                                    });

                                                    $isCurrentAllowed = $previousRegistered && empty($foundResults); 
                                                    $isPreviousRegistered = !empty($foundResults);
                                                    $bgColor = $isCurrentAllowed || $isPreviousRegistered ? '#caf4c7' : '#D8D8D8';
                                                    // 초록색 배경일 때 hover-enabled 클래스 추가
                                                    $hoverClass = $bgColor === '#caf4c7' ? 'hover-enabled' : '';
                                                    $url = $isCurrentAllowed || $isPreviousRegistered 
                                                        ? base_url('healthcare_management/icu/session-input/' . $user['member_code'] . '/' . $progress_time . '?ref_icu=' . $referrerIcu)
                                                        : null;
                                                ?>
                                                <td class="<?= $hoverClass ?>"
                                                    style="cursor: <?= $isCurrentAllowed || $isPreviousRegistered ? 'pointer' : 'not-allowed' ?>; background-color: <?= $bgColor ?>; font-weight:500;"
                                                    <?= $isCurrentAllowed || $isPreviousRegistered ? "onclick=\"location.href='" . $url . "'\"" : '' ?>>
                                                    <?php if (!empty($foundResults)): ?>
                                                    <?php foreach ($foundResults as $result): ?>
                                                    <div>
                                                        <span><?= esc($result['inspection_name']) ?></span>:
                                                        <span>
                                                            <?php 
                                                            switch ($result['assessment']) {
                                                                case 1: echo '좋음'; break;
                                                                case 0: echo '보통'; break;
                                                                case -1: echo '나쁨'; break;
                                                                default: echo '알 수 없음';
                                                            }
                                                            ?>
                                                        </span>
                                                    </div>
                                                    <?php endforeach; ?>
                                                    <?php else: ?>
                                                    <?= $isCurrentAllowed ? '등록 가능' : '등록 불가' ?>
                                                    <?php endif; ?>
                                                </td>
                                                <?php 
                                                    $previousRegistered = $previousRegistered && !empty($foundResults); 
                                                endforeach; 
                                                ?>
                                            </tr>

                                            <!-- 메모 -->
                                            <tr>
                                                <td class="font-bold">메모</td>
                                                <?php 
                                                $previousRegistered = true;
                                                foreach ([1, 2, 3] as $progress_time): 
                                                    $foundResult = array_filter($testResults, function($result) use ($progress_time) {
                                                        return $result['progress_time'] == $progress_time;
                                                    });

                                                    $isCurrentAllowed = $previousRegistered && empty($foundResult); 
                                                    $isPreviousRegistered = !empty($foundResult);
                                                    $bgColor = $isCurrentAllowed || $isPreviousRegistered ? '#caf4c7' : '#D8D8D8';
                                                    // 초록색 배경일 때 hover-enabled 클래스 추가
                                                    $hoverClass = $bgColor === '#caf4c7' ? 'hover-enabled' : '';
                                                    $url = $isCurrentAllowed || $isPreviousRegistered 
                                                        ? base_url('healthcare_management/icu/session-input/' . $user['member_code'] . '/' . $progress_time . '?ref_icu=' . $referrerIcu)
                                                        : null;
                                                ?>
                                                <td class="<?= $hoverClass ?>"
                                                    style="cursor: <?= $isCurrentAllowed || $isPreviousRegistered ? 'pointer' : 'not-allowed' ?>; background-color: <?= $bgColor ?>;"
                                                    <?= $isCurrentAllowed || $isPreviousRegistered ? "onclick=\"location.href='" . $url . "'\"" : '' ?>>
                                                    <?= !empty($foundResult) 
                                                        ? esc(reset($foundResult)['notes']) 
                                                        : ($isCurrentAllowed ? '등록 가능' : '등록 불가') ?>
                                                </td>
                                                <?php 
                                                    $previousRegistered = $previousRegistered && !empty($foundResult); 
                                                endforeach; 
                                                ?>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="fs-6 mt-3 ms-4">** 각 주차별 정보를 입력하시려면 <span class="text-danger fw-bolder">초록색</span>으로 표시되는
                    <span class="text-danger fw-bolder">"등록 가능" 박스를 클릭</span>하세요 (등록 가능한 주차만 선택 가능합니다)
                </div>

            </section>

            <div class="d-flex justify-content-center pt-5 pb-3 col-12">
                <a href="<?= $referrerIcu === 'complete' 
                    ? base_url('healthcare_management/icu/icusuccesslist') 
                    : base_url('healthcare_management/icu/iculist') ?>" type="button"
                    class="btn btn-secondary d-flex align-items-center justify-content-center"
                    style="width: 160px;font-size: 18px;">목록으로</a>
            </div>
        </div>
        <?= $this->include('templates/footer') ?>
    </div>

    <script src="assets/js/bootstrap.bundle.min.js"></script>