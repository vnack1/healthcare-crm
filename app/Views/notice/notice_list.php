<?= $this->include('templates/header') ?>
<?= $this->include('templates/sidebar') ?>


<!-- custom css 연결 -->
<link rel="stylesheet" href="<?php base_url('assets/css/custom/custom.css') ?>">
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
                    <h3>공지사항</h3>
                    <p class="text-subtitle text-muted">공지사항을 확인해주세요</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="<?php echo base_url('/dashboard') ?>">메인</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                공지사항
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Hoverable rows start -->
        <section class="section">
            <div class="row" id="table-hover-row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header justify-content-end d-flex">
                            <?php if (session()->get('grade') === 0): ?>
                            <a href="<?= base_url('notice/notice-write')?>?ref_menu=notice"
                                class="btn btn-primary d-flex align-items-center justify-content-center"
                                style="width: 160px;font-size: 18px">글쓰기</a>
                            <?php endif; ?>
                        </div>
                        <div class="card-content">
                            <!-- table hover -->
                            <div class="mb-5">
                                <table class="table table-hover mb-0 table-responsive" id="notice_table">
                                    
                                    <thead>
                                        <tr class="text-center">
                                            <th>번호</th>
                                            <th>제목</th>
                                            <th>등록일</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        <?php 
                                        $count = count($notices); // 공지사항 개수
                                        foreach ($notices as $notice) :?>
                                        <tr class="notice-row" style="height:50px;"
                                            data-id="<?= $notice['notice_idx']?>">
                                            <td><?php echo $count--; // 역순으로 번호 생성 ?></td>
                                            <td class="text-start">
                                                <a href="<?php echo base_url('notice/notice-detail/' . $notice['notice_idx'])?>?ref_menu=notice"
                                                    class="text-reset" style="font-weight:700">
                                                    <?= $notice['title']; ?>
                                                </a>
                                            </td>
                                            <td><?php echo $notice['create_at']; ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
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
                                            <a class="page-link"
                                                href="?<?= $pageQuery ?>&page=<?= $currentPage + 1 ?>">></a>
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
            </div>
        </section>

        <?= $this->include('templates/footer') ?>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            // 모든 .notice-row에 클릭 이벤트를 추가
            document.querySelectorAll('.notice-row').forEach(function(row) {
                row.addEventListener('click', function() {
                    const url = this.getAttribute('data-url');
                    if (url) {
                        window.location.href = url; // 행의 data-url 값으로 이동
                    }
                });
            });
        });
        </script>