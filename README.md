## 멜로시라 관리 시스템 (Melosira Management System)

> 건강관리 제품의 계층적 사용자 관리 및 섭취 관리 시스템

접속 링크 : http://gsl-agency.com/dashboard

## 📋 프로젝트 개요

멜로시라 관리 시스템은 건강관리 제품의 **계층적 사용자 관리**와 **12주차 섭취 프로그램 관리**를 위한 웹 기반 관리 시스템입니다. 

- **4단계 계층적 사용자 구조**: 슈퍼어드민 → 총판 → 대리점 → 회원
- **12주차 섭취 프로그램**: 주차별 진행 상황 추적 및 관리
- **3회차 건강검진**: ICU 검사 결과 관리
- **개인정보 보호**: 데이터 마스킹을 통한 보안 강화

## ✨ 주요 기능

### 👥 계층적 사용자 관리
- **4단계 권한 체계**: 각 등급별 차등화된 접근 권한
- **멤버 코드 시스템**: 6자리 고유 코드로 사용자 식별
- **계층별 데이터 필터링**: 상위 사용자는 하위 사용자 데이터만 조회 가능

### 🍃 멜로시라 섭취 관리
- **12주차 프로그램**: 주차별 섭취 진행 상황 관리
- **상태별 알림 시스템**: 
  - 섭취진행중 (초록색)
  - 전화예정 D-1 (노란색) 
  - 전화대상자 (빨간색)
- **완료 리스트**: 12주차 완료 사용자 별도 관리

### 🏥 건강검진 관리 (ICU)
- **3회차 검진 시스템**: 회차별 검사 결과 저장
- **검사 항목별 평가**: 다양한 검사 항목에 대한 상세 결과 기록
- **진행 상황 추적**: 미등록, 진행중, 완료 상태 관리

### 📊 대시보드 및 통계
- **등급별 맞춤 대시보드**: 사용자 등급에 따른 차별화된 통계
- **실시간 데이터 집계**: 총판/대리점/회원 수, 최근 가입자 현황
- **페이지네이션**: 대용량 데이터 효율적 처리

## 🛠 기술 스택

### Backend
- **PHP 8.1+** - 서버 사이드 언어
- **CodeIgniter 4** - PHP 웹 프레임워크
- **MySQL** - 관계형 데이터베이스

### Frontend
- **HTML5, CSS3** - 마크업 및 스타일링
- **JavaScript** - 클라이언트 사이드 로직
- **Bootstrap 5** - 반응형 UI 프레임워크

### 기타
- **Composer** - 의존성 관리
- **PHPUnit** - 단위 테스트
- **Git** - 버전 관리

## 🏗 시스템 아키텍처

┌─────────────────┐ ┌─────────────────┐ ┌─────────────────┐
│ 슈퍼어드민 │ │ 총판 │ │ 대리점 │
│ (Grade 0) │───▶│ (Grade 1) │───▶│ (Grade 2) │
└─────────────────┘ └─────────────────┘ └─────────────────┘
│
▼
┌─────────────────┐
│ 회원 │
│ (Grade 3) │
└─────────────────┘


## 🗄 데이터베이스 설계

### 주요 테이블
- **user**: 사용자 정보 (계층적 구조)
- **melosira**: 멜로시라 섭취 데이터
- **icu**: 건강검진 데이터
- **test_results**: 검사 결과 상세 정보
- **inspection_list**: 검사 항목 마스터

## 보안 기능

### 개인정보 보호
- **데이터 마스킹**: 이름, 전화번호, 생년월일 자동 마스킹
- **권한 기반 접근**: 등급별 데이터 접근 제한
- **세션 관리**: 안전한 로그인 상태 관리

### 입력 검증
- **이메일 검증**: 유효한 이메일 형식 확인
- **중복 검사**: 아이디, 이메일, 멤버코드 중복 방지
- **SQL 인젝션 방지**: CodeIgniter ORM 사용

## 🚀 설치 및 실행

### 요구사항
- PHP 8.1 이상
- MySQL 5.7 이상
- Composer
- Apache/Nginx 웹서버

### 설치 과정

1. **저장소 클론**
```bash
git clone https://github.com/yourusername/melosira-management-system.git
cd melosira-management-system
```

2. **의존성 설치**
```bash
composer install
```

3. **환경 설정**
```bash
cp .env.example .env
# .env 파일에서 데이터베이스 설정 수정
```

4. **데이터베이스 설정**
```bash
# MySQL에서 데이터베이스 생성
CREATE DATABASE melosira_management;

# 스키마 및 샘플 데이터 import
mysql -u username -p melosira_management < database_schema.sql
```

5. **서버 실행**
```bash
php spark serve
```

## 📁 프로젝트 구조

melosira-management-system/
├── app/
│ ├── Controllers/ # 컨트롤러
│ │ ├── Auth.php # 인증 처리
│ │ ├── UserManagement.php # 사용자 관리
│ │ ├── MelosiraController.php # 멜로시라 관리
│ │ └── IcuController.php # ICU 관리
│ ├── Models/ # 데이터 모델
│ │ ├── UserModel.php
│ │ ├── MelosiraModel.php
│ │ └── IcuModel.php
│ ├── Views/ # 뷰 템플릿
│ │ ├── auth/ # 인증 관련 뷰
│ │ ├── user_management/ # 사용자 관리 뷰
│ │ └── melosira_management/ # 멜로시라 관리 뷰
│ └── Config/ # 설정 파일
├── public/ # 웹 루트
├── assets/ # 정적 자원
└── database_schema.sql # 데이터베이스 스키마


## 🎯 주요 기술적 도전

### 1. 복잡한 계층적 데이터 구조
- **서브쿼리 활용**: 최신 데이터 조회를 위한 복합 쿼리
- **LEFT JOIN**: 데이터 누락 방지
- **동적 필터링**: 검색 조건에 따른 유연한 쿼리 구성

### 2. 개인정보 보호
- **정규표현식**: 안전한 데이터 마스킹 처리
- **권한 체크**: 등급별 데이터 접근 제어
- **세션 관리**: 안전한 사용자 인증

### 3. 사용자 경험 최적화
- **반응형 디자인**: 모바일 친화적 UI
- **실시간 검색**: AJAX를 활용한 중복 확인
- **직관적 네비게이션**: 계층적 메뉴 구조

##  성능 최적화

- **페이지네이션**: 대용량 데이터 효율적 처리
- **인덱스 활용**: 데이터베이스 쿼리 최적화
- **캐싱**: 세션 및 데이터 캐싱 활용

##  향후 개선 계획

- [ ] RESTful API 개발 (모바일 앱 연동)
- [ ] 실시간 알림 시스템 (WebSocket)
- [ ] 데이터 시각화 (Chart.js)
- [ ] 단위 테스트 확대 (PHPUnit)
- [ ] Docker 컨테이너화

## 스크린샷

> 스크린샷은 `docs/screenshots/` 폴더에서 확인할 수 있습니다.

## 🤝 기여하기

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

##  라이선스

이 프로젝트는 MIT 라이선스 하에 배포됩니다. 자세한 내용은 `LICENSE` 파일을 참조하세요.

---

⭐ 이 프로젝트가 도움이 되었다면 Star를 눌러주세요!
