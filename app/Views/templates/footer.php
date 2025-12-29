<footer>
    <div class="footer mb-0 text-muted">
        <div class="d-flex gap-5" style="height:28px; ">
            <p style="white-space: nowrap;"><strong>회사명</strong> (주)지에스랜드</p>
            <p style="white-space: nowrap;" class="ms-4"><strong>대표자명</strong> 김유신</p>
            <p style="white-space: nowrap;"><strong>사업자등록번호</strong> 331-81-11769</p>
            <p style="white-space: nowrap;"><strong>법인등록번호</strong> 110111-8175013</p>
            <p style="white-space: nowrap;"><strong>주소</strong> 서울특별시 강남구 학동로 309, 6층</p>
            <p style="white-space: nowrap;"><strong>개인정보보호책임자</strong> 김유신</p>
        </div>
        <div class="d-flex gap-5 mb-2" style="height:28px; ">
            <p style="white-space: nowrap;"><strong>대표 전화</strong> 02-515-2026</p>
            <p style="white-space: nowrap;"><strong>대표 이메일</strong> gsl153@gsland153.com</p>
        </div>
                <a href="<?= base_url('terms') ?>">이용약관</a> |
                <a href="<?= base_url('privacy') ?>">개인정보 처리방침</a>
            
           
        <p class="copyright mt-4">© 2024 주식회사 지에스랜드. All rights reserved.</p>
    </div>
</footer>

<!-- Bootstrap JavaScript and dependencies -->
<script src="<?= base_url('/assets/js/bootstrap.bundle.min.js'); ?>"></script>
<script src="<?= base_url('/assets/js/main.js'); ?>"></script>
<script src="<?= base_url('/assets/js/custom/custom.js')?>"></script>
<script src="<?= base_url('/assets/js/extensions/sweetalert2.js')?>"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const year = new Date().getFullYear();
    document.querySelector(".copyright").innerHTML =
        `© ${year} MelosiraLife Co., Ltd. All rights reserved.`; // 매년 연도를 자동으로 갱신
});
</script>