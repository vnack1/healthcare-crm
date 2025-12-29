<?= $this->include('templates/header') ?>
<?= $this->include('templates/sidebar') ?>

<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
        <style>
        h4 {
            margin-top: 20px;
            font-size: 20px;
            font-weight: bold;
        }

        ol {
            margin-bottom: 20px;
            padding-left: 20px;
        }

        ol[type="a"] {
            padding-left: 40px;
        }

        p {
            margin-bottom: 10px;
            line-height: 1.6;
        }
        </style>
    </header>

    <div class="page-heading">
        <div class="page-title">
            <h3>개인정보 처리방침</h3>
        </div>
    </div>

    <div class="">
        <section class="content">
            <div class="card">
                <div class="card-body">
                    <div class="mb-5">
                        <p>
                            <strong>주식회사 지에스랜드(이하 “회사”)는 멜로라이프 서비스를 제공함에 있어 이용자의 개인정보를 중요시하며, 「개인정보 보호법」 등 관련
                                법령을 준수합니다. 본 방침은
                                개인정보와 관련된 이용자의 권리와 의무, 그리고 회사의 의무를 명확히 하기 위해 작성되었습니다.</strong>
                        </p>
                    </div>
                    <div class="mb-5">
                        <h4>제1조 (개인정보 처리 목적)</h4>
                        <p>
                            회사는 다음의 목적을 위해 개인정보를 처리합니다. 처리하고 있는 개인정보는 다음의 목적 이외의 용도로는 이용되지 않으며, 이용 목적이 변경될 경우에는 개인정보보호법
                            제18조에 따라 별도의 동의를 받는 등 필요한 조치를 수행할 예정입니다.
                        </p>
                        <ol>
                            <li>
                                <strong>회원가입 및 관리</strong><br>
                                멜로라이프 서비스 이용자(총판 및 대리점)의 회원가입 확인, 서비스 제공, 계정 관리, 고지사항 전달 등을 목적으로 개인정보를 처리합니다.
                            </li>
                            <li>
                                <strong>서비스 제공 및 운영</strong><br>
                                고객관리 기능 제공, 데이터 입력 및 조회, 서비스 유지 및 관리, 서비스 개선을 위한 통계 분석 등을 목적으로 개인정보를 처리합니다.
                            </li>
                            <li>
                                <strong>법적 의무 준수</strong><br>
                                관련 법령에 따른 기록 보관 및 자료 제출 등을 목적으로 개인정보를 처리합니다.
                            </li>
                        </ol>
                    </div>

                    <div class="mb-5">
                        <h4>제2조 (처리하는 개인정보의 항목)</h4>
                        <p>회사는 서비스 제공을 위하여 다음 각 호의 기준에 따라 개인정보를 수집·이용합니다.</p>
                        <table class="table table-bordered" style="text-align: center; width: 60%;">
                            <thead>
                                <tr>
                                    <th>수집 목적</th>
                                    <th>수집 항목</th>
                                    <th>보유 및 이용기간</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>회원가입 및 관리</td>
                                    <td>ID, 비밀번호, 이름, 생년월일, 연락처, 이메일 주소, 주소</td>
                                    <td>회원 탈퇴 시까지</td>
                                </tr>
                                <tr>
                                    <td>서비스 제공 및 운영</td>
                                    <td>이름, 연락처, 서비스 이용 기록</td>
                                    <td>회원 탈퇴 시까지</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="mb-5">
                        <h4>제3조 (개인정보의 처리 및 보유 기간)</h4>
                        <p>
                            회사는 법령에 따른 개인정보 보유·이용 기간 또는 정보주체로부터 동의받은 개인정보 보유·이용 기간
                            내에서 개인정보를 처리하고 보유합니다.
                        </p>
                        <table class="table table-bordered" style="text-align: center; width: 60%;">
                            <thead>
                                <tr>
                                    <th>보유 내용</th>
                                    <th>개인정보 항목</th>
                                    <th>보유 기간</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>회원가입 및 관리 기록</td>
                                    <td>ID, 비밀번호, 이름, 생년월일, 연락처, 이메일 주소, 주소</td>
                                    <td>회원 탈퇴 시까지</td>
                                </tr>
                                <tr>
                                    <td>소비자 불만 및 분쟁 처리 기록</td>
                                    <td>상담 기록, 불만 및 분쟁 처리 결과</td>
                                    <td>3년</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="mb-5">
                        <h4>제4조 (개인정보의 제3자 제공)</h4>
                        <p>
                            회사는 이용자의 개인정보를 외부에 제공하지 않습니다. 다만, 법령에 따라 요구될 경우에는 관계 법령에서 정한 절차에 따라 제공합니다.
                        </p>
                    </div>

                    <div class="mb-5">
                        <h4>제5조 (개인정보의 파기)</h4>
                        <p>회사는 보유 기간이 경과하거나 처리 목적이 달성된 개인정보를 지체 없이 파기합니다.</p>
                        <ol>
                            <li>
                                <strong>파기 절차: </strong> 파기 사유가 발생한 개인정보를 개인정보보호책임자의 승인을 받아 폐기합니다.
                            </li>
                            <li>
                                <strong>파기 방법: </strong><br>
                                • 전자 파일 : 복구할 수 없도록 완전 삭제<br>
                                • 문서 및 보조 저장매체 : 분쇄기로 분쇄 또는 소각
                            </li>
                        </ol>
                    </div>

                    <div class="mb-5">
                        <h4>제6조 (이용자의 권리 및 행사 방법)</h4>
                        <p>
                            이용자는 언제든지 개인정보 열람, 정정, 삭제, 처리 정지를 요청할 수 있습니다.<br>
                            <strong>요청 방법 : </strong> 이메일, 우편 등을 통해 요청 가능하며, 회사는 지체 없이 조치합니다.
                        </p>
                    </div>

                    <div class="mb-5">
                        <h4>제7조 (개인정보의 기술적·관리적 보호 대책)</h4>
                        <p>회사는 개인정보 보호를 위해 다음과 같은 조치를 취합니다.</p>
                        <ol>
                            <li>개인정보 암호화</li>
                            <li>접근 제한 및 권한 관리</li>
                            <li>정기적인 보안 점검 및 백업</li>
                        </ol>
                    </div>

                    <div class="mb-5">
                        <h4>제8조 (개인정보 보호 책임자)</h4>
                        <p>
                            <strong>책임자 이름:</strong> 김유신<br>
                            <strong>연락처:</strong> 02-515-2026<br>
                            <strong>이메일:</strong> gsl153@gsland153.com
                        </p>
                    </div>
                    <div>
                        <h4>제9조 (개인정보처리방침 변경)</h4>
                        <p>
                            본 방침은 2024년 12월 24일부터 시행됩니다. 변경 시 사전 공지 후 시행됩니다.<br><br>
                            <strong>• 공고일자 : </strong> 2024년 12월 17일<br>
                            <strong>• 시행일자 : </strong> 2024년 12월 24일
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <?= $this->include('templates/footer') ?>
</div>