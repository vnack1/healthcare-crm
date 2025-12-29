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
                    <h3>신규회원 리스트</h3>
                    <p class="text-subtitle text-muted">
                        최근 가입한 회원을 확인할 수 있습니다
                    </p>
                </div>

                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="index.html">메인</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                회원 관리
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- 최근가입한 회원 시작-->
        <section id="list-group-contextual">
            <div class="row match-height">
                <div class="col-lg-12 col-md-12">
                    <div class="card px-3">
                        <div class="card-header d-flex">
                            <h3 class="card-title mt-2">최근 가입한 회원 수 &nbsp;<?= esc($totalRecords)?>명</h3>

                        </div>
                        <div class="card-content">
                            <div class="card-body pt-0">
                                <!-- 표 시작 -->
                                <table class="table table-bordered table-hover text-center mb-2">
                                    <thead>
                                        <tr class="bg-light-primary">
                                            <th>No</th>
                                            <th>가입일시</th>
                                            <th>이름</th>
                                            <th>성별</th>
                                            <th>생년월일</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($recentUsers)) : ?>
                                        <?php foreach ($recentUsers as $index => $user) : ?>
                                        <tr class="clickable-row"
                                            data-url="<?= base_url('user-management/user/detail/' .$user['member_code']) ?>"
                                            style="cursor: pointer;">
                                            <td><?= $totalRecords - (($currentPage - 1) * $perPage) - $index ?>
                                            </td>
                                            <td><?= date('Y-m-d H:i:s', strtotime($user['create_at'])) ?></td>
                                            <td><?= esc($user['user_name']) ?></td>
                                            <td><?= $user['gender'] == 0 ? '남' : '여' ?></td>
                                            <td><?= esc($user['birth_date']) ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <?php else : ?>
                                        <tr>
                                            <td colspan="5" class="text-center">최근 가입한 회원이 없습니다.</td>
                                        </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
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
                                        <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
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
                                            <a class="page-link" href="?<?= $pageQuery ?>&page=<?= $totalPages ?>">끝</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
        <!-- 최근가입한 회원 끝-->
        <?= $this->include('templates/footer') ?>
    </div>




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
    </script>