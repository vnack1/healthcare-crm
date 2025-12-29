<?= $this->include('templates/header') ?>
<link rel="stylesheet" href="<?= base_url('assets/vendors/iconly/bold.css')?>">
<?= $this->include('templates/sidebar') ?>



<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>
    <div class="page-heading">
        <h3>회원관리 프로그램</h3>
    </div>
    <div class="page-content p-0">
        <section class="row">
            <div class="col-12 col-lg-12">
                <div class="row">
                    <?php if ($grade === 0): ?>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card border card-hover">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon purple">
                                            <i class="bi bi-house-door-fill me-2"
                                                style="margin-bottom: 0.8rem; font-size:1.5rem;"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">총판</h6>
                                        <?php if (isset($distributerCount)): ?>
                                        <h6 class="font-extrabold mb-0 hover-effect"
                                            onclick="window.location.href='<?= base_url('user-management/distributer/distributerlist') ?>'"
                                            style="cursor: pointer;">
                                            <?= $distributerCount ?>명
                                        </h6>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <!-- 총판, 대리점, 회원 수를 표시 -->
                    <?php if ($grade !== 2): ?>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card border card-hover">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon blue">
                                            <i class="bi bi-chat-dots-fill me-2 mb-3" style="font-size:1.5rem;"></i>
                                            <!-- <i class="bi bi-house-fill mb-3" style="margin-right:0.7rem;"></i> -->
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">대리점</h6>
                                        <?php if (isset($agentCount)): ?>
                                        <h6 class="font-extrabold mb-0 hover-effect"
                                            onclick="window.location.href='<?= base_url('user-management/agent/agentlist') ?>'">
                                            <?= $agentCount ?>명</h6>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card border card-hover">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon green">
                                            <i class="iconly-boldProfile"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">회원</h6>
                                        <?php if (isset($memberCount)): ?>
                                        <h6 class="font-extrabold mb-0 hover-effect"
                                            onclick="window.location.href='<?= base_url('user-management/user/list') ?>'">
                                            <?= $memberCount ?>명</h6>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- 최근 가입 회원 수는 모든 등급에서 표시 가능 -->
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card border card-hover">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon red">
                                            <i class="iconly-boldAdd-User"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">
                                            최근 가입 회원
                                        </h6>
                                        <h6 class="font-extrabold mb-0 hover-effect"
                                            onclick="window.location.href='<?= base_url('user-management/user/recent') ?>'">
                                            <?= $recentUserCount; ?>명</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if (session('grade') === 2): ?>
                    <!--할일들 !-->
                    <div class="col-lg-3 col-md-6 col-6">
                        <div class="card border card-hover">
                            <div class="px-4 py-3" style="height: 112px;">
                                <!-- <div class="pt-4 ps-4">
                                    <h4 style="font-size: 1.2rem; font-weight:700;">오늘 할 일</h4>
                                </div> -->
                                
                                    <div class="card-content">
                                            <h6 class="pb-2">오늘 할일</h6>
                                        <!-- 전화예정 D-1 -->
                                        <div class="recent-message d-flex justify-content-between hover-effect"
                                            onclick="window.location.href='<?= base_url('melosira-management/all_list?alert_status=전화예정 D-1') ?>'">
                                            <div class="name">
                                                <h6 class="text-muted">전화예정 D-1</h6>
                                            </div>
                                            <h6>
                                                <?= isset($alertCounts['전화예정 D-1']) ? esc($alertCounts['전화예정 D-1']) : 0 ?>명
                                            </h6>
                                        </div>
                                        <!-- 전화대상자 -->
                                        <div class="recent-message d-flex justify-content-between hover-effect"
                                            onclick="window.location.href='<?= base_url('melosira-management/all_list?alert_status=전화대상자') ?>'">
                                            <div class="name">
                                                <h6 class="text-muted mb-0">전화대상자</h6>
                                            </div>
                                            <h6 class="mb-0">
                                                <?= isset($alertCounts['전화대상자']) ? esc($alertCounts['전화대상자']) : 0 ?>명
                                            </h6>
                                        </div>
                                    </div>
                                
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- 차트부분     -->
                    <div class="col-lg-9 col-md-9 col-12">
                        <div class="row">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="card border">
                                    <div class="card-header">
                                        <h4>멜로시라 진행 현황</h4>
                                    </div>
                                    <div class="card-body">
                                        <div id="chart-profile-visit"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="card border" style="height:421.41px">
                                    <div class="card-header" style="padding-bottom:0.3rem;">
                                        <div class="d-flex justify-content-between">
                                            <h4>공지사항</h4>
                                            <div>
                                                <a href="<?= base_url('notice/notice-list') ?>">
                                                    <div class="d-flex">
                                                        <div>더보기</div>
                                                        <i class="bi bi-chevron-right" style="margin-top: 2px"></i>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-lg" style="margin-bottom:13px;">
                                                <tbody>
                                                    <?php if (!empty($notices)): ?>
                                                    <?php foreach ($notices as $notice): ?>
                                                    <tr style="cursor: pointer;"
                                                        onclick="window.location.href='<?= base_url('notice/notice-detail/' . $notice['notice_idx']) ?>'">
                                                        <td class="col-8">
                                                            <div class="d-flex align-items-center">
                                                                <p class="font-bold mb-0">
                                                                    <span class="h6"
                                                                        style="font-size:17px; font-weight:500;"><?= esc($notice['title']) ?></span>
                                                                </p>
                                                            </div>
                                                        </td>
                                                        <td class="col-auto d-flex justify-content-end">
                                                            <p class="mb-0" style="font-size:17px; font-weight:500;">
                                                                <?= date('Y-m-d', strtotime($notice['create_at'])) ?>
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    <?php endforeach; ?>
                                                    <?php else: ?>
                                                    <tr>
                                                        <td colspan="2" class="text-center"
                                                            style="font-size:17px; font-weight:500;">최근 공지사항이 없습니다.</td>
                                                    </tr>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-12 col-lg-3 col-md-3">
                        <!--멜로시라 섭취 -->
                        <div class="card border">
                            <div class="card-header">
                                <h4>멜로시라 종합 현황</h4>
                                <h6 class="text-muted mb-0" style="font-weight:500;">현재 멜로시라 섭취 프로그램에 참여 중인 회원들의 주차별 전체
                                    진행 상태입니다</h6>
                            </div>
                            <div class="card-content p-4 pt-0">
                                <!-- 미등록 -->
                                <div class="recent-message d-flex py-3 d-flex justify-content-between hover-effect"
                                    onclick="window.location.href='<?= base_url('melosira-management/all_list?status=0') ?>'">
                                    <div class="name">
                                        <h5 class="mb-1 text-muted">미등록</h5>
                                    </div>
                                    <h5 class="mb-0"><?= isset($statusZeroCount) ? esc($statusZeroCount) : 0 ?>명</h5>
                                </div>

                                <!-- 진행중 -->
                                <div class="recent-message d-flex py-4 d-flex justify-content-between hover-effect"
                                    onclick="window.location.href='<?= base_url('melosira-management/all_list?status=1') ?>'">
                                    <div class="name">
                                        <h5 class="mb-1 text-muted">진행중</h5>
                                    </div>
                                    <h5 class="mb-0"><?= isset($statusOneCount) ? esc($statusOneCount) : 0 ?>명</h5>
                                </div>

                                <!-- 완료 -->
                                <div class="recent-message d-flex py-3 d-flex justify-content-between hover-effect"
                                    onclick="window.location.href='<?= base_url('melosira-management/all_list?status=2') ?>'">
                                    <div class="name">
                                        <h5 class="mb-1 text-muted">완료</h5>
                                    </div>
                                    <h5 class="mb-0"><?= isset($statusTwoCount) ? esc($statusTwoCount) : 0 ?>명</h5>
                                </div>

                                <!-- 상세보기 버튼 -->
                                <div>
                                    <a class="btn btn-block btn-xl btn-light-primary font-bold mt-4 d-flex justify-content-center"
                                        href="<?=base_url('melosira-management/all_list')?>">
                                        <div>상세보기</div>
                                        <i class="bi bi-chevron-right ms-2" style="margin-top: 2px"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!--양자파동기 -->
                        <div class="card border">
                            <div class="card-header">
                                <h4>양자파동기 진행 현황</h4>
                                <h6 class="text-muted mb-0" style="font-weight:500;">현재 양자파동기 프로그램에 참여 중인 회원들의 주차별 전체 진행
                                    상태입니다</h6>
                            </div>
                            <div class="card-content p-4 pt-0">
                                <!-- 1회차 -->
                                <div class="recent-message d-flex py-3 d-flex justify-content-between hover-effect">
                                    <div class="name">
                                        <h5 class="mb-1 text-muted">1회차</h5>
                                    </div>
                                    <h5 class="mb-0"
                                        onclick="window.location.href='<?= base_url('healthcare_management/icu/iculist?progress_time=1') ?>'"
                                        style="cursor: pointer;"><?= esc($progressTimeCounts['1']) ?>명</h5>
                                </div>

                                <!-- 2회차 -->
                                <div class="recent-message d-flex py-4 d-flex justify-content-between hover-effect">
                                    <div class="name">
                                        <h5 class="mb-1 text-muted">2회차</h5>
                                    </div>
                                    <h5 class="mb-0"
                                        onclick="window.location.href='<?= base_url('healthcare_management/icu/iculist?progress_time=2') ?>'"
                                        style="cursor: pointer;"><?= esc($progressTimeCounts['2']) ?>명</h5>
                                </div>

                                <!-- 3회차 -->
                                <div class="recent-message d-flex py-3 d-flex justify-content-between hover-effect">
                                    <div class="name">
                                        <h5 class="mb-1 text-muted">3회차</h5>
                                    </div>
                                    <h5 class="mb-0"
                                        onclick="window.location.href='<?= base_url('healthcare_management/icu/icusuccesslist?progress_time=3') ?>'"
                                        style="cursor: pointer;"><?= esc($progressTimeCounts['3']) ?>명</h5>
                                </div>

                                <!-- 상세보기 버튼 -->
                                <div>
                                    <a class="btn btn-block btn-xl btn-light-primary font-bold mt-4 d-flex justify-content-center"
                                        href="<?= base_url('healthcare_management/icu/iculist')?>">
                                        <div>상세보기</div>
                                        <i class="bi bi-chevron-right ms-2" style="margin-top: 2px"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>



        </section>
        <?= $this->include('templates/footer') ?>
    </div>
</div>




<script>
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".btn-group-custom button").forEach(button => {
        button.addEventListener("click", () => {
            const status = button.getAttribute("data-status");
            fetchStatus(status);

            const rows = document.querySelectorAll("tr[data-url]");

            rows.forEach((row) => {
                row.addEventListener("click", () => {
                    const url = row.getAttribute("data-url");
                    if (url) {
                        window.location.href = url;
                    }
                });
            });

        });
    });
});

function fetchStatus(status) {
    fetch(`/home/filterStatus/${status}`)
        .then(response => response.json())
        .then(data => {
            const tbody = document.querySelector("#progressTable");
            tbody.innerHTML = "";
            let row = "<tr>";
            data.forEach(item => {
                row += `<td>${item.count}명</td>`;
            });
            row += "</tr>";
            tbody.innerHTML = row;
        })
        .catch(error => console.error("Error fetching data:", error));
}
</script>
<!-- apexcharts 표현 -->
<!-- PHP 데이터를 JavaScript로 전달 -->
<script>
// PHP에서 전달된 데이터를 JavaScript 전역 변수로 설정
let statusOneData = <?= json_encode([
        isset($progressCounts['1']['status_1']) ? $progressCounts['1']['status_1'] : 0,
        isset($progressCounts['2']['status_1']) ? $progressCounts['2']['status_1'] : 0,
        isset($progressCounts['3']['status_1']) ? $progressCounts['3']['status_1'] : 0,
        isset($progressCounts['4']['status_1']) ? $progressCounts['4']['status_1'] : 0,
        isset($progressCounts['8']['status_1']) ? $progressCounts['8']['status_1'] : 0,
        isset($progressCounts['12']['status_1']) ? $progressCounts['12']['status_1'] : 0,
    ]) ?>;
</script>
<!-- JavaScript 파일 포함 -->
<script src="<?= base_url('assets/js/pages/dashboard.js') ?>"></script>
<script src="<?= base_url('assets/vendors/apexcharts/apexcharts.js')?>"></script>