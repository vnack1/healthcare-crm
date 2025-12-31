## **HealthCare CRM (PHP CodeIgniter 4)**

**고객 건강관리 CRM** — 참여자의 이력·세션·메모를 관리하고, 단계별 권한 구조(superadmin-총판-대리점-회원)를 반영한 **권한 기반 접근제어 시스템을** 갖춘 CRM 시스템

### **배포 주소**

- **URL**: http://gsl-agency.com/

### **역할**

- CodeIgniter 4 기반 MVC 아키텍처 전반 구현
- 사용자 권한 구조(superadmin-총판-대리점) 설계 및 권한 기반 라우팅 적용
- 컨트롤러·모델 로직 및 DB 쿼리 최적화 작업 담당

### **기술 스택**

- **Backend Framework**: PHP 8.1+, CodeIgniter 4
- **Database**: MySQL
- **구성요소**: Controllers, Models, Routes,  Views

### **아키텍처**

- **MVC 구조**: Controller → Service/Model → View 표준 흐름
- **권한 계층**:
    - Superadmin: 전체 사용자 관리, 총판 관리
    - 총판: 소속 대리점 관리
    - 대리점: 소속 회원 관리

### **핵심 기능**

- **대시보드**: 주차별/주기별 관리 해야 할 대상의 상태관리 표기 및 To Do List 확인 가능
- 건강기능식품 회원별 1~8주차 섭취 기록 관리
- 검사 결과 기록(1~3회차)
- **공지/회원 관리**: 로그인, 마이페이지, 공지사항 등

### **차별점(강점)**

- 단계별 권한 설정으로 분리
- 최신 레코드 우선 조회/리포팅 지향 DB 설계
- CI4 경량성과 라우팅 규칙 활용으로 모듈식 유지보수 용이성 확보
