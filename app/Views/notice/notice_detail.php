<?= $this->include('templates/header') ?>
<?= $this->include('templates/sidebar') ?>



<!-- quill css 연결  -->
<link rel="stylesheet" href="<?php echo base_url('assets/vendors/quill/quill.snow.css') ?>">

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
                                <a href="<?php echo base_url('/dashboard')?>">메인</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                공지사항
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Basic Tables start -->
        <section class="section">
            <div class="row" id="basic-table">
                <div class="col-12 col-md-12">
                    <div class="card p-5 border">
                        <div class="d-flex justify-content-between align-items-center pb-0">
                            <h3><?= esc($notice['title']) ?></h3>
                            <p class="fs-5 my-1"><?= esc($notice['create_at']) ?></p>
                        </div>
                        <hr />
                        <!-- 공지사항 내용 -->
                        <div class="card body notice-content mb-3">
                            <div id="content-display" class="ql-editor px-3 pt-4 pb-5 fs-4">
                                <?= htmlspecialchars_decode($notice['content']) ?>
                            </div>
                        </div>

                        <!-- 버튼 영역에 스타일 추가 -->
                        <div class="card-footer px-0 pb-0">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex gap-2">
                                    <?php if ($previousNotice): ?>
                                    <a href="<?= base_url('notice/notice-detail/' . $previousNotice['notice_idx']) ?>?ref_menu=notice"
                                        class="btn btn-light-secondary d-flex align-items-center justify-content-center gap-2"
                                        style="width: 160px;font-size: 18px">
                                        <i class="bi bi-arrow-left mb-1"></i>
                                        이전글
                                    </a>
                                    <?php endif; ?>

                                    <?php if ($nextNotice): ?>
                                    <a href="<?= base_url('notice/notice-detail/' . $nextNotice['notice_idx']) ?>?ref_menu=notice"
                                        class="btn btn-light-secondary d-flex align-items-center justify-content-center gap-2"
                                        style="width: 160px;font-size: 18px">
                                        다음글
                                        <i class="bi bi-arrow-right mb-1"></i>
                                    </a>
                                    <?php endif; ?>

                                </div>
                                <div class="d-flex justify-content-center gap-2">

                                    <?php if (session()->get('grade') === 0): ?>
                                    <a href="<?= base_url('/notice/notice-modify/' .$notice['notice_idx']); ?>?ref_menu=notice"
                                        class="btn btn-warning d-flex align-items-center justify-content-center"
                                        style="width: 160px;font-size: 18px">
                                        수정
                                    </a>
                                    <?php endif; ?>
                                    <?php if (session()->get('grade') === 0): ?>
                                    <a href="<?= base_url('/notice/delete/'.$notice['notice_idx']); ?>?ref_menu=notice"
                                        class="btn btn-danger d-flex align-items-center justify-content-center"
                                        style="width: 160px;font-size: 18px">
                                        삭제
                                    </a>

                                    <?php endif; ?>
                                    <a href="<?php echo base_url('/notice/notice-list') ?>?ref_menu=notice"
                                        class="btn btn-primary d-flex align-items-center justify-content-center gap-2"
                                        style="width: 160px;font-size: 18px">
                                        <i class="bi bi-justify align-middle mb-1"></i>
                                        목록
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <?= $this->include('templates/footer') ?>
        <!-- Basic Tables end -->
    </div>
</div>



<script src="<?= base_url('/assets/vendors/quill/quill.min.js'); ?>"></script>