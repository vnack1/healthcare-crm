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
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>건강관리 대시보드</h3>
                    <p class="text-subtitle text-muted">
                        멜로시라의 및 양자파동기의 진행 현황을 확인할 수 있습니다
                    </p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="<?= base_url('dashboard')?>">메인</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                건강관리
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- 멜로시라 진행 시작-->
        <section id="list-group-contextual">
            <div class="row match-height">
                <div class="col-lg-12 col-md-12">
                    <div class="card border px-3">
                        <div class="card-header d-flex justify-content-between">
                            <h4 class="card-title mt-2">멜로시라 진행 현황</h4>
                            <a href="<?= base_url('melosira-management/all_list')?>"
                                class="btn btn-primary d-flex align-items-center justify-content-center"
                                style="width: 160px;font-size: 18px">조회</a>
                        </div>
                        <div class="card-content">
                            <div class="card-body pt-0">

                                <div class="list-group list-group-horizontal-sm mb-3 text-center" role="tablist">
                                    <a class="list-group-item list-group-item-action active" id="ongoing-table-list"
                                        data-bs-toggle="list" href="#ongoing-table" role="tab">진행중</a>

                                    <a class="list-group-item list-group-item-action" id="finish-table-list"
                                        data-bs-toggle="list" href="#finish-table" role="tab">완료</a>
                                </div>
                                <div class="tab-content text-justify">
                                    <div class="tab-pane fade show active" id="ongoing-table" role="tabpanel"
                                        aria-labelledby="ongoing-table-list">
                                        <!-- 표 시작 -->
                                        <table class="table table-bordered text-center mb-2" id="ongoing-table">
                                            <tbody>
                                                <!-- 진행중 리스트  -->

                                                <tr class="bg-light-primary">
                                                    <td class="no-hover">1주차</td>
                                                    <td class="no-hover">2주차</td>
                                                    <td class="no-hover">3주차</td>
                                                    <td class="no-hover">4주차</td>
                                                    <td class="no-hover">8주차</td>
                                                    <td class="no-hover">12주차</td>
                                                </tr>
                                                <tr>
                                                    <td onclick="location.href='<?=base_url('melosira-management/all_list') . '?week_progress=1&status=1' ?>';"
                                                        class="clickable-cell hover-effect">
                                                        <?= esc($progressCounts['1']['status_1'] ?? 0) ?>명
                                                    </td>
                                                    <td onclick="location.href='<?=base_url('melosira-management/all_list') . '?week_progress=2&status=1' ?>';"
                                                        class="clickable-cell hover-effect">
                                                        <?= esc($progressCounts['2']['status_1'] ?? 0) ?>명
                                                    </td>
                                                    <td onclick="location.href='<?=base_url('melosira-management/all_list') . '?week_progress=3&status=1' ?>';"
                                                        class="clickable-cell hover-effect">
                                                        <?= esc($progressCounts['3']['status_1'] ?? 0) ?>명
                                                    </td>
                                                    <td onclick="location.href='<?=base_url('melosira-management/all_list') . '?week_progress=4&status=1' ?>';"
                                                        class="clickable-cell hover-effect">
                                                        <?= esc($progressCounts['4']['status_1'] ?? 0) ?>명
                                                    </td>
                                                    <td onclick="location.href='<?=base_url('melosira-management/all_list') . '?week_progress=8&status=1' ?>';"
                                                        class="clickable-cell hover-effect">
                                                        <?= esc($progressCounts['8']['status_1'] ?? 0) ?>명
                                                    </td>
                                                    <td onclick="location.href='<?=base_url('melosira-management/all_list') . '?week_progress=12&status=1' ?>';"
                                                        class="clickable-cell hover-effect">
                                                        <?= esc($progressCounts['12']['status_1'] ?? 0) ?>명
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <!-- 끝 -->
                                    </div>


                                    <div class="tab-pane fade" id="finish-table" role="tabpanel"
                                        aria-labelledby="finish-table-list">
                                        <table class="table table-bordered text-center mb-2" id="finish-table">
                                            <tbody>
                                                <!-- 완료 리스트 -->
                                                <tr class="bg-light-primary">
                                                    <td class="no-hover">1주차</td>
                                                    <td class="no-hover">2주차</td>
                                                    <td class="no-hover">3주차</td>
                                                    <td class="no-hover">4주차</td>
                                                    <td class="no-hover">8주차</td>
                                                    <td class="no-hover">12주차</td>
                                                </tr>
                                                <!-- 두 번째 줄 -->
                                                <tr>
                                                    <td onclick="location.href='<?= base_url('melosira-management/all_list') . '?week_progress=1&status=2' ?>';"
                                                        class="clickable-cell hover-effect">
                                                        <?= esc($progressCounts['1']['status_2'] ?? 0) ?>명
                                                    </td>
                                                    <td onclick="location.href='<?= base_url('melosira-management/all_list') . '?week_progress=2&status=2' ?>';"
                                                        class="clickable-cell hover-effect">
                                                        <?= esc($progressCounts['2']['status_2'] ?? 0) ?>명
                                                    </td>
                                                    <td onclick="location.href='<?= base_url('melosira-management/all_list') . '?week_progress=3&status=2' ?>';"
                                                        class="clickable-cell hover-effect">
                                                        <?= esc($progressCounts['3']['status_2'] ?? 0) ?>명
                                                    </td>
                                                    <td onclick="location.href='<?= base_url('melosira-management/all_list') . '?week_progress=4&status=2' ?>';"
                                                        class="clickable-cell hover-effect">
                                                        <?= esc($progressCounts['4']['status_2'] ?? 0) ?>명
                                                    </td>
                                                    <td onclick="location.href='<?= base_url('melosira-management/all_list') . '?week_progress=8&status=2' ?>';"
                                                        class="clickable-cell hover-effect">
                                                        <?= esc($progressCounts['8']['status_2'] ?? 0) ?>명
                                                    </td>
                                                    <td onclick="location.href='<?= base_url('melosira-management/complete_list?week_progress=12&status=2') ?>';"
                                                        class="clickable-cell hover-effect">
                                                        <?= isset($progressCounts['12']['status_2']) ? esc($progressCounts['12']['status_2']) : 0 ?>명
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <!-- 끝 -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- 멜로시라 진행 끝-->

        <!-- iseeyou 진행 시작-->
        <section id="list-group-contextual">
            <div class="row match-height">
                <div class="col-lg-12 col-md-12">
                    <div class="card border px-3">
                        <div class="card-header d-flex justify-content-between">
                            <h4 class="card-title mt-2">양자파동기 진행 현황</h4>
                            <a href="<?= base_url('healthcare_management/icu/iculist')?>"
                                class="btn btn-primary d-flex align-items-center justify-content-center"
                                style="width: 160px;font-size: 18px">조회</a>
                        </div>
                        <div class="card-content">
                            <div class="card-body pt-0">
                                <!-- 표 시작 -->
                                <table class="table table-bordered text-center mb-2">
                                    <tbody>

                                        <!-- 첫 번째 줄 -->
                                        <tr class="bg-light-primary">
                                            <td class="no-hover">1회차</td>
                                            <td class="no-hover">2회차</td>
                                            <td class="no-hover">3회차</td>
                                        </tr>
                                        <!-- 두 번째 줄 -->
                                        <tr>
                                            <td onclick="location.href='<?= base_url('healthcare_management/icu/iculist?progress_time=1') ?>';"
                                                class="iseeyou-hover hover-effect">

                                                <?= esc($progressTimeCounts['1']) ?>명
                                            </td>
                                            <td onclick="location.href='<?= base_url('healthcare_management/icu/iculist?progress_time=2') ?>';"
                                                class="iseeyou-hover hover-effect">

                                                <?= esc($progressTimeCounts['2']) ?>명
                                            </td>
                                            <td onclick="location.href='<?= base_url('healthcare_management/icu/icusuccesslist?progress_time=3') ?>';"
                                                class="iseeyou-hover hover-effect">

                                                <?= esc($progressTimeCounts['3']) ?>명
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!-- 끝 -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- iseeyou 진행끝-->
    </div>



    <?= $this->include('templates/footer') ?>