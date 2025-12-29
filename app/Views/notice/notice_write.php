<?= $this->include('templates/header') ?>
<?= $this->include('templates/sidebar') ?>

<!-- custom css 연결 -->
<link rel="stylesheet" href="<?= base_url('/assets/css/custom/custom.css')?>" />
<link rel="stylesheet" href="<?php echo base_url('assets/vendors/quill/quill.snow.css') ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/custom/custom.css') ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/vendors/sweetalert2.sweetalert2.min.css') ?>">

<!-- 공지사항 작성 화면 콘텐츠 -->

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
                    <h3>공지사항 글쓰기</h3>
                    <p class="text-subtitle text-muted">
                        공지사항에 대한 글을 작성할 수 있습니다
                    </p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="<?php echo base_url('/dashboard') ?>">메인</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                공지 글쓰기
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- full editor 글쓰기 폼 -->
        <form action="<?php echo base_url('notice/store'); ?>" method="POST">
            <input type="hidden" name="ref_menu" value="notice">
            <!-- CSRF 토큰 추가 -->
            <?php echo csrf_field() ?>

            <section class="section">


                <!-- <div class="card mx-auto" style="max-width: 900px; min-width: 300px;"> -->
                <div class="card border">
                    <div class="card-body p-5 pb-4">
                        <!-- 제목 입력란 -->
                        <div class="form-group row align-items-center fs-5">
                            <label class="col-lg-1 col-md-2 col-form-label text-right" for="title">제목</label>
                            <div class="col-lg-11 col-md-10">
                                <input type="text" name="title" id="title" class="form-control" required
                                    placeholder="제목을 입력하세요">
                            </div>
                        </div>

                        <!-- 내용 입력란 -->
                        <div class="form-group pb-4">
                            <label for="content"></label>
                            <div id="quill-editor" style="height: 500px; background-color: white;"
                                class="fs-5 text-black"></div>
                            <textarea name="content" id="content" style="display: none;"></textarea>
                        </div>

                        <!-- 등록 및 취소 버튼 -->
                        <div class="d-flex justify-content-center gap-3 mt-5">
                            <a href="<?php echo base_url('notice/notice-list') ?>?ref_menu=notice"
                                class="btn btn-secondary d-flex align-items-center justify-content-center"
                                style="width: 160px;font-size: 18px">취소</a>
                            <button class="btn btn-primary d-flex align-items-center justify-content-center"
                                style="width: 160px;font-size: 18px" type="submit">등록</button>
                        </div>
                    </div>
                </div>
            </section>
            <?= $this->include('templates/footer') ?>
        </form>
    </div>
</div>
<script src="<?= base_url('/assets/vendors/quill/quill.min.js '); ?>"></script>
<script src="<?= base_url('/assets/js/pages/form-editor.js'); ?>"></script>
<script src="<?= base_url('/assets/vendors/sweetalert2/sweetalert2.all.min.js'); ?>"></script>

<script>
// Quill 에디터 초기화
var quill = new Quill('#quill-editor', {
    theme: 'snow',
    modules: {
        toolbar: [
            ['bold', 'italic', 'underline', 'strike'], // 텍스트 꾸미기
            [{
                'header': [1, 2, 3, false]
            }], // 헤더 (H1, H2, H3)
            [{
                'list': 'ordered'
            }, {
                'list': 'bullet'
            }], // 리스트
            [{
                'align': []
            }], // 정렬
            [{
                'size': ['small', false, 'large', 'huge']
            }], // 글자 크기
            [{
                'color': []
            }, {
                'background': []
            }], // 텍스트 색상
            ['blockquote', 'code-block'], // 블록 인용, 코드 블록
            ['link', 'image', ], // 링크, 이미지, 비디오 추가
            ['clean'] // 포맷 제거
        ]
    },
    placeholder: '내용을 입력해주세요',
});


// 폼 제출 시 Quill 에디터의 내용을 textarea에 복사
document.querySelector('form').onsubmit = function() {
    // const contentElm = document.querySelector("#content");
    // var content = contentElm.value;

    var content = quill.root.innerHTML;
    // HTML 태그 제거 (Plain text로 변환)
    // var plainTextContent = quill.getText().trim();
    // content를 textarea에 설정
    document.querySelector('#content').value = content;
    console.log(document.querySelector('#content').value);
};
</script>