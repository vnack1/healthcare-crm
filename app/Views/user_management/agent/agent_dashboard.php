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
                <h3>회원관리 대시보드</h3>
                <p class="text-subtitle text-muted">
                  전체 회원 수 현황 및 최근 가입한 회원을 확인할 수 있습니다
                </p>
              </div>
              <div class="col-12 col-md-6 order-md-2 order-first">
                <nav
                  aria-label="breadcrumb"
                  class="breadcrumb-header float-start float-lg-end"
                >
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                      <a href="index.html">메인</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                      회원관리
                    </li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>

          <!-- 회원 수 시작-->
          <section id="list-group-contextual">
            <div class="row match-height">
              <div class="col-lg-12 col-md-12">
                <div class="card">
                  <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title mt-2">전체 회원 수 현황</h4>
                    <div>
                      <a href="/user-management/user/list" class="btn btn-primary px-4"
                        >회원 조회</a
                      >
                    </div>
                  </div>
                  <div class="card-content">
                    <div class="card-body pt-0">
                      <!-- 표 시작 -->
                      <table class="table table-bordered text-center mb-2">
                        <tbody>
                          <!-- 첫 번째 줄 -->
                          <tr class="bg-light-primary">
                            <td>회원</td>
                          </tr>
                          <tr>
                            <td><?php if (isset($memberCount)): ?>
                                <p><?= $memberCount ?> 명</p>
                                <?php endif; ?>
                            </td>
                          </tr>
                        </tbody>
                      </table>
<section id="list-group-contextual">
            <div class="row match-height">
              <div class="col-lg-12 col-md-12">
                <div class="card">
                  <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title mt-2">최근 가입한 회원</h4>
                    <div>
                      <a href="/user-management/recent">
                        <div class="d-flex">
                          <div>더보기</div>
                          <i
                            class="bi bi-chevron-right"
                            style="margin-top: 2px"
                          ></i>
                        </div>
                      </a>
                    </div>
                  </div>
                  <div class="card-content">
                    <div class="card-body pt-0">
                      <!-- 표 시작 -->
                      <table class="table table-bordered text-center mb-2">
                        <tbody>
                          <!-- 첫 번째 줄 -->
                          <tr class="bg-light-primary">
                            <td>순번</td>
                            <td>이름</td>
                            <td>성별</td>
                            <td>생년월일</td>
                            <td>가입 날짜</td>
                          </tr>
    <tbody id="recent-users-table">
        <?php foreach ($recentUsers as $index => $user): ?>
        <tr>
            <td><?= $index + 1 ?></td>
            <td><?= $user['user_name'] ?></td>
            <td><?= $user['gender'] == 0 ? '남' : '여' ?></td>
            <td><?= $user['birth_date'] ?></td>
            <td><?= $user['create_at'] ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
                    </div>
                  </div>

        </section>
                    </div>
                  </div>
                </div>
<?= $this->include('templates/footer') ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let recentUsersTable = document.getElementById('recent-users-table');
    let rows = recentUsersTable.getElementsByTagName('tr');
    for (let i = 5; i < rows.length; i++) {
        rows[i].style.display = 'none';
    }
});
</script>

