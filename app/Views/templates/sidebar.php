<!-- sidebar.php -->
<div id="sidebar" class="active">
    <div class="sidebar-wrapper active position-fixed">
        <div class="sidebar-header pb-0">
            <div class="d-flex align-items-center mb-4 justify-content-between" style="height: 48px;">
                <div class="logo">
                    <a href="<?= base_url('/dashboard') ?>">
                        <img src="<?= base_url('assets/images/logo/logo.png') ?>" alt="Logo"
                            style="width:230px; height:35px; ">
                    </a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block">
                        <i class="bi bi-x bi-middle"></i>
                    </a>
                </div>
            </div>
            <!-- 로그인 시작 -->
            <div class="row gap-2">
                <div class="col-md-3 pe-0">
                    <div class="align-middle">
                        <img class="rounded-circle" style="width:53px; height:53px; object-fit: cover; cursor:pointer;"
                            <?php if (session()->get('grade') == 0): ?>
                            src="<?= base_url('assets/images/faces/5.jpg') ?>" alt="Face 0" />
                        <?php elseif (session()->get('grade') == 1): ?>
                        src="<?= base_url('assets/images/faces/6.jpg') ?>" alt="Face 1" onclick="window.location.href='<?= base_url('/mypage/detail') ?>'"/>
                        <?php elseif (session()->get('grade') == 2): ?>
                        src="<?= base_url('assets/images/faces/7.jpg') ?>" alt="Face 2" onclick="window.location.href='<?= base_url('/mypage/detail') ?>'"/>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="name col-md-8" style="font-size: 1rem;">
                    <span class="rounded-2 px-2 py-1 bg-light-primary" style="font-size:13px">
                        <?php if (session()->get('grade') == 0): ?>
                        최고관리자
                        <?php elseif (session()->get('grade') == 1): ?>
                        총판
                        <?php elseif (session()->get('grade') == 2): ?>
                        대리점
                        <?php else: ?>
                        <script>
                        alert('권한이 없습니다. 로그인 화면으로 이동합니다.');
                        window.location.href = "<?= base_url('/login') ?>";
                        </script>
                        <?php endif; ?>
                    </span>
                    <h5 class="mt-2" style="white-space:nowrap;"><?= session()->get('user_name') ?>님
                    </h5>
                    <h6 class="d-flex align-items-center gap-1">
                        <a href="<?= base_url('/login') ?>" class="text-muted mb-0 hover-effect">로그아웃</a>

                        <?php if (session()->get('grade') == 1 || session()->get('grade') == 2): ?>
                        <div style="border-left: 2px solid #cbcbcb; height: 16px; margin: 0 5px;"></div>
                        <a href="<?= base_url('/mypage/detail') ?>" class="text-muted hover-effect">마이페이지</a>
                        <?php endif; ?>
                    </h6>
                </div>
            </div>
            <!-- 로그인 끝 -->
        </div>

        <div class="sidebar-menu">
            <!-- 사이드바 메뉴 리스트 -->
            <ul class="menu" style="margin-top:1.3rem">
                <li class="sidebar-item">
                    <a href="<?= base_url('dashboard') ?>" class="sidebar-link" data-url="<?= base_url('dashboard') ?>">
                        <i class="bi bi-grid-fill"></i>
                        <span>홈</span>
                    </a>
                </li>
            </ul>

            <!-- 추가 메뉴들 -->
            <ul class="menu">
                <?php
                $refMenu = $_GET['ref_menu'] ?? ''; // 상위 메뉴 활성화를 위한 변수
                $ref = $_GET['ref'] ?? '';         // 하위 메뉴 활성화를 위한 변수
                ?>
                <?php if (session()->get('grade') === 0): ?>
                <!-- 슈퍼 어드민: 총판 관리 -->
                <li class="sidebar-title">총판 관리</li>
                <li class="sidebar-item has-sub <?= $refMenu === 'distributer' ? 'active show' : '' ?>">
                    <a href="#" class="sidebar-link <?= $refMenu === 'distributer' ? 'active' : '' ?>">
                        <i class="bi bi-collection-fill"></i>
                        <span>총판</span>
                    </a>
                    <ul class="submenu" style="<?= $refMenu === 'distributer' ? 'display: block;' : '' ?>">
                        <li class="submenu-item <?= $ref === 'distributer-list' ? 'active' : '' ?>">
                            <a
                                href="<?= base_url('user-management/distributer/distributerlist') ?>?ref_menu=distributer&ref=distributer-list">총판
                                리스트</a>
                        </li>
                        <li class="submenu-item <?= $ref === 'distributer-enroll' ? 'active' : '' ?>">
                            <a
                                href="<?= base_url('user-management/distributer/enroll') ?>?ref_menu=distributer&ref=distributer-enroll">총판
                                등록</a>
                        </li>
                    </ul>
                </li>
                <?php endif; ?>

                <?php if (session()->get('grade') === 0 || session()->get('grade') === 1): ?>
                <!-- 슈퍼 어드민 & 총판: 대리점 관리 -->
                <li class="sidebar-title">대리점 관리</li>
                <li class="sidebar-item has-sub <?= $refMenu === 'agent' ? 'active show' : '' ?>">
                    <a href="#" class="sidebar-link <?= $refMenu === 'agent' ? 'active' : '' ?>">
                        <i class="bi bi-grid-1x2-fill"></i>
                        <span>대리점</span>
                    </a>
                    <ul class="submenu" style="<?= $refMenu === 'agent' ? 'display: block;' : '' ?>">
                        <li class="submenu-item <?= $ref === 'agent-list' ? 'active' : '' ?>">
                            <a href="<?= base_url('user-management/agent/agentlist') ?>?ref_menu=agent&ref=agent-list">대리점
                                리스트</a>
                        </li>
                        <?php if (session()->get('grade') === 1 || session()->get('grade') === 2): ?>
                        <li class="submenu-item <?= $ref === 'agent-enroll' ? 'active' : '' ?>">
                            <a href="<?= base_url('user-management/agent/enroll') ?>?ref_menu=agent&ref=agent-enroll">대리점
                                등록</a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php endif; ?>

                <?php if (session()->get('grade') === 0 || session()->get('grade') === 1 || session()->get('grade') === 2): ?>
                <!-- 슈퍼 어드민, 총판, 대리점: 회원 관리 -->
                <li class="sidebar-title">회원 관리</li>
                <li class="sidebar-item has-sub <?= $refMenu === 'user' ? 'active show' : '' ?>">
                    <a href="#" class="sidebar-link <?= $refMenu === 'user' ? 'active' : '' ?>">
                        <i class="bi bi-person-fill mb-2" style="font-size: 21px"></i>
                        <span>회원</span>
                    </a>
                    <ul class="submenu" style="<?= $refMenu === 'user' ? 'display: block;' : '' ?>">
                        <li class="submenu-item <?= $ref === 'user-list' ? 'active' : '' ?>">
                            <a href="<?= base_url('user-management/user/list') ?>?ref_menu=user&ref=user-list">회원
                                리스트</a>
                        </li>
                        <li class="submenu-item <?= $ref === 'user-recent' ? 'active' : '' ?>">
                            <a href="<?= base_url('user-management/user/recent') ?>?ref_menu=user&ref=user-recent">신규회원
                                리스트</a>
                        </li>
                        <?php if (session()->get('grade') === 2): ?>
                        <li class="submenu-item <?= $ref === 'user-enroll' ? 'active' : '' ?>">
                            <a href="<?= base_url('user-management/user/enroll') ?>?ref_menu=user&ref=user-enroll">회원
                                등록</a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php endif; ?>

                <li class="sidebar-title">건강관리</li>

                <li class="sidebar-item">
                    <a href="<?= base_url('healthcare_management/dashboard') ?>" class="sidebar-link"
                        data-url="<?= base_url('healthcare_management/dashboard') ?>">
                        <!-- <i class="bi bi-chat-dots-fill"></i> -->
                        <i class="bi bi-bar-chart-fill mb-1" style="font-size:19px;"></i>
                        <span>대시보드</span>
                    </a>
                </li>
                <?php
                    // URL에서 ref 파라미터 확인
                    $referrer = $_GET['ref'] ?? ''; 
                    // 완료 리스트와 전체 리스트에서 왔는지 확인
                    $isFromAllList = $referrer === 'all';
                    $isFromCompleteList = $referrer === 'complete';
                    // 멜로시라 메뉴 활성화 여부
                    $isMelosiraMenuActive = $isFromCompleteList || $isFromAllList;

                    // icu
                    $referrerIcu = $_GET['ref_icu'] ?? '';
                    $isFromIcuAllList = $referrerIcu === 'all';
                    $isFromIcuCompleteList = $referrerIcu === 'complete';
                    $isIcuMenuActive = $isFromIcuAllList || $isFromIcuCompleteList;
                ?>
                <!-- 멜로시라 메뉴 -->
                <li class="sidebar-item has-sub <?= $isMelosiraMenuActive ? 'active show' : '' ?>">
                    <a href="#" class="sidebar-link <?= $isMelosiraMenuActive ? 'active' : '' ?>">
                        <i class="bi bi-egg-fill"></i>
                        <span>멜로시라</span>
                    </a>
                    <ul class="submenu" style="<?= $isMelosiraMenuActive ? 'display: block;' : '' ?>">
                        <!-- 전체 리스트 -->
                        <li class="submenu-item <?= $isFromAllList ? 'active' : '' ?>">
                            <a href="<?= base_url('melosira-management/all_list') ?>"
                                data-url="<?= base_url('melosira-management/all_list') ?>">전체 리스트</a>
                        </li>
                        <!-- 완료 리스트 -->
                        <li class="submenu-item <?= $isFromCompleteList ? 'active' : '' ?>">
                            <a href="<?= base_url('melosira-management/complete_list') ?>"
                                data-url="<?= base_url('melosira-management/complete_list') ?>">완료 리스트</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item has-sub <?= $isIcuMenuActive ? 'active show' : '' ?>">
                    <a href="#" class="sidebar-link <?= $isIcuMenuActive ? 'active' : '' ?>">
                        <i class="bi bi-pentagon-fill"></i>
                        <span>양자파동기</span>
                    </a>
                    <ul class="submenu" style="<?= $isIcuMenuActive ? 'display: block;' : '' ?>">
                        <!-- 전체 리스트 -->
                        <li class="submenu-item <?= $isFromIcuAllList ? 'active' : '' ?>">
                            <a href="<?= base_url('healthcare_management/icu/iculist') ?>"
                                data-url="<?= base_url('healthcare_management/icu/iculist') ?>">전체 리스트</a>
                        </li>
                        <!-- 완료 리스트 -->
                        <li class="submenu-item <?= $isFromIcuCompleteList ? 'active' : '' ?>">
                            <a href="<?= base_url('healthcare_management/icu/icusuccesslist') ?>"
                                data-url="<?= base_url('healthcare_management/icu/icusuccesslist') ?>">완료 리스트</a>
                        </li>
                    </ul>
                </li>

                <!-- 공지사항 -->
                <li class="sidebar-title">공지사항</li>

                <li class="sidebar-item <?= $refMenu === 'notice' ? 'active' : '' ?>">
                    <a href="<?= base_url('/notice/notice-list') ?>?ref_menu=notice"
                        class="sidebar-link <?= $refMenu === 'notice' ? 'active' : '' ?>"
                        data-url="<?= base_url('/notice/notice-list') ?>">
                        <i class="bi bi-envelope-fill"></i>
                        <span>공지사항</span>
                    </a>
                </li>
            </ul>
        </div>
        <button class="sidebar-toggler btn x">
            <i data-feather="x"></i>
        </button>
    </div>
</div>

<script>
// document.addEventListener('DOMContentLoaded', () => {
//     // 현재 페이지 URL
//     const currentUrl = window.location.href;

//     // 모든 .sidebar-item 및 .submenu-item 찾기
//     const sidebarItems = document.querySelectorAll('.sidebar-item');
//     const submenuItems = document.querySelectorAll('.submenu-item');

//     // 1. .submenu-item 활성화
//     submenuItems.forEach(item => {
//         const link = item.querySelector('a');
//         if (link && currentUrl.includes(link.getAttribute('data-url'))) {
//             item.classList.add('active'); // 클릭한 .submenu-item에 active 추가

//             // 2. 해당 .submenu에 active 추가
//             const submenu = item.closest('.submenu');
//             if (submenu) {
//                 submenu.classList.add('active');
//             }

//             // 3. 상위 .sidebar-item에 active 추가
//             const sidebarItem = item.closest('.sidebar-item');
//             if (sidebarItem) {
//                 sidebarItem.classList.add('active');
//             }
//         }
//     });

//     // 4. .sidebar-item 활성화 (메인 메뉴 클릭 시)
//     sidebarItems.forEach(item => {
//         const link = item.querySelector('a');
//         if (link && currentUrl.includes(link.getAttribute('data-url'))) {
//             item.classList.add('active');
//         }
//     });
// });

document.addEventListener('DOMContentLoaded', () => {
    // 현재 페이지 URL
    const currentUrl = window.location.href;

    // 모든 .sidebar-item 및 .submenu-item 찾기
    const sidebarItems = document.querySelectorAll('.sidebar-item');
    const submenuItems = document.querySelectorAll('.submenu-item');

    // 기존 active 클래스 제거
    const clearActiveClasses = () => {
        submenuItems.forEach(item => item.classList.remove('active'));
        sidebarItems.forEach(item => item.classList.remove('active'));
        document.querySelectorAll('.submenu').forEach(submenu => submenu.classList.remove('active'));
    };

    // 활성화 함수
    const activateMenu = () => {
        submenuItems.forEach(item => {
            const link = item.querySelector('a');
            if (link && currentUrl.includes(link.getAttribute('data-url'))) {
                clearActiveClasses(); // 기존 active 제거
                item.classList.add('active'); // .submenu-item에 active 추가

                // 상위 .submenu와 .sidebar-item에도 active 추가
                const submenu = item.closest('.submenu');
                if (submenu) {
                    submenu.classList.add('active');
                }
                const sidebarItem = item.closest('.sidebar-item');
                if (sidebarItem) {
                    sidebarItem.classList.add('active');
                }
            }
        });

        // 메인 메뉴 클릭 활성화
        sidebarItems.forEach(item => {
            const link = item.querySelector('a');
            if (link && currentUrl.includes(link.getAttribute('data-url'))) {
                clearActiveClasses(); // 기존 active 제거
                item.classList.add('active');
            }
        });
    };

    activateMenu(); // 초기 활성화 호출
});
</script>