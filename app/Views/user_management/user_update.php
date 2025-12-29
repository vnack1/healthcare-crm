<!-- 회원정보 수정 페이지  -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<?= $this->include('templates/header') ?>

<div class="container mt-5 pt-2">

<div class="page-heading mt-5 pt-5">
  <div class="page-title">
    <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
        <h3>회원 정보 수정</h3>
        <p class="text-subtitle text-muted">
         회원 정보를 수정합니다
        </p>
      </div>
    </div>
  </div>

  <!-- 회원조회 -->
  <section id="basic-horizontal-layouts">
    <div class="row match-height">
        <div class="col-md-12 col-12">
            <div class="card">
                <div class="card-content">
                  <div class="card-body">
                      <form class="form form-horizontal" action="<?= base_url('user-management/update/'.esc($user['member_code']))?>" method="post">
                          <div class="form-body">
                              <div class="row">
                                  <div class="col-md-3">
                                      <label class="pt-2">이름</label>
                                  </div>
                                  <div class="col-md-3 form-group">
                                  <input type="text" id="user_name" name="user_name" class="form-control" value="<?= esc($user['user_name']) ?>" required>
                                  </div>
                                  <div class="col-md-6"></div>

                                  <div class="col-md-3">
                                  <label class="mt-2">성별</label>
                                  </div>
                                  <div class="col-md-1 form-check pe-0 mt-2" style="height: 38px;">
                                      <div class="ms-3">
                                          <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault1" value="0" <?= esc($user['gender']) == 0 ? 'checked' : '' ?> > 
                                          <label class="form-check-label" for="flexRadioDefault1">
                                              남자
                                          </label>
                                      </div>
                                  </div>
                                  <div class="col-md-1 form-check pe-0 mt-2">
                                      <div class="ms-3">
                                          <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault2" value="1" <?= esc($user['gender']) == 1 ? 'checked' : '' ?> >
                                          <label class="form-check-label" for="flexRadioDefault2">
                                              여자
                                          </label>
                                      </div>
                                  </div>

                                  <div class="col-md-3"></div>
                                  <div class="col-md-3"></div>

                                  <div class="col-md-3">
                                      <label class="pt-2">전화번호</label>
                                  </div>
                                  <div class="col-md-3 form-group">
                                    <input type="text" id="phone-number" name="phone" class="form-control" value="<?= esc($user['phone']) ?>" required>
                                  </div>
                                  <div class="col-md-6"></div>

                                  <div class="col-md-3 form-group">
                                      <label class="pt-2">생년월일</label>
                                  </div>
                                  <div class="col-md-3">
                                    <input type="text" id="birth_date" name="birth_date" autocomplete="off" class="form-control" value="<?= esc($user['birth_date']) ?>" required>
                                  </div>
                                  <div class="col-md-6"></div>

                                  <div class="col-md-3">
                                    <label class="pt-2">회원코드</label>
                                  </div>
                                  <div class="col-md-3 form-group">
                                    <input type="text" id="member_code" name="member_code" class="form-control" value="<?= esc($user['member_code']) ?>" readonly>
                                  </div>
                                  <div class="col-md-6"></div>

                                  <div class="col-md-3">
                                      <label class="pt-2">이메일</label>
                                  </div>
                                  <div class="col-md-6 form-group d-flex gap-xl-3 gap-3" id="emailGroup">
                                    <input type="text" id="email" name="email" class="form-control" value="<?= esc($user['email']) ?>" required>
                                  </div>
                                  <div class="col-md-3"></div>

                                  <div class="col-md-3">
                                      <label class="pt-2">주소</label>
                                  </div>
                                  <div class="col-md-6 form-group">
                                    <input type="text" id="address" name="address" class="form-control" value="<?= esc($user['address']) ?>" required>
                                  </div>
                                  <div class="col-md-3"></div>




                                    <div class="col-md-3">
                                        <label class="pt-2">메모</label>
                                    </div>
                                    <div class="col-md-6 form-group">
                                      <textarea id="notes" name="notes" class="form-control" style="height: 115px;"> <?= esc($user['notes']) ?> </textarea>
                                    </div>
                              </div>
                          </div>
                          <div class="d-flex justify-content-center gap-2">
                            <a href="<?= base_url('user-management/list')?>" class="btn btn-light-secondary me-1 mb-1 px-4" style="width: 126px">
                              뒤로가기
                            </a>
                            <button type="submit" class="btn btn-primary me-1 mb-1 px-5">수정</button>
                          </div>
                      </form>
                    </div>
                  </div>
        </div>
    </div>   
  </section>
</div>
</div>

<?= $this->include('templates/footer') ?>

<script src="<?= base_url('/assets/js/custom/custom.js') ?>"></script>
<script src="<?= base_url('/assets/vendors/sweetalert2/sweetalert2.all.min.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/rangePlugin.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        flatpickr("#birth_date", {
            dateFormat: "Y-m-d", // 날짜 형식 (연-월-일)
            allowInput: true,    // 사용자가 직접 입력할 수 있도록 허용
            maxDate: "today",    // 생년월일이 미래가 될 수 없도록 오늘 날짜까지만 선택 가능
            defaultDate: null    // 기본값을 설정하지 않음
        });
    });
</script>