document.addEventListener("DOMContentLoaded", () => {
  const sections = document.querySelectorAll("#landing-page section, footer");
  const scrollIndicatorButton = document.querySelector(
    ".scroll-indicator .btn"
  );
  const topButton = document.getElementById("topButton");
  let isScrolling = false;

  // 현재 활성 섹션의 인덱스를 찾는 함수
  const getClosestSectionIndex = () => {
    const buffer = 50; // 오차 범위
    return Array.from(sections).findIndex((section) => {
      const rect = section.getBoundingClientRect();
      return rect.top >= -buffer && rect.top < window.innerHeight - buffer;
    });
  };

  // 부드럽게 스크롤 이동하는 함수
  const smoothScrollTo = (target) => {
    const targetPosition = target.offsetTop;
    const startPosition = window.scrollY;
    const distance = targetPosition - startPosition;
    const duration = 400; // 스크롤 지속 시간
    let start = null;

    const step = (timestamp) => {
      if (!start) start = timestamp;
      const progress = Math.min((timestamp - start) / duration, 1);
      window.scrollTo(0, startPosition + distance * progress);

      if (progress < 1) {
        window.requestAnimationFrame(step);
      } else {
        isScrolling = false; // 스크롤 완료 후 플래그 해제
      }
    };

    window.requestAnimationFrame(step);
  };

  // Scroll Indicator 버튼 클릭 이벤트
  if (scrollIndicatorButton) {
    scrollIndicatorButton.addEventListener("click", () => {
      const currentIndex = getClosestSectionIndex();
      if (currentIndex < sections.length - 1) {
        isScrolling = true; // 스크롤 중복 방지 플래그 설정
        smoothScrollTo(sections[currentIndex + 1]); // 다음 섹션으로 부드럽게 이동
      }
    });
  }

  // 휠 스크롤 이벤트 핸들러
  const handleWheel = (e) => {
    if (!isScrolling) {
      isScrolling = true;

      const currentIndex = getClosestSectionIndex();
      if (e.deltaY > 0 && currentIndex < sections.length - 1) {
        smoothScrollTo(sections[currentIndex + 1]);
      } else if (e.deltaY < 0 && currentIndex > 0) {
        smoothScrollTo(sections[currentIndex - 1]);
      }

      setTimeout(() => {
        isScrolling = false;
      }, 400);
    }
  };

  // Top 버튼 표시 및 클릭 이벤트
  window.addEventListener("scroll", () => {
    const currentIndex = getClosestSectionIndex();
    if (currentIndex > 0) {
      topButton.classList.remove("d-none");
    } else {
      topButton.classList.add("d-none");
    }
  });

  topButton.addEventListener("click", () => {
    isScrolling = true; // 스크롤 중복 방지 플래그 설정
    // smoothScrollTo(sections[0]);
    window.scrollTo({
      top: 0,
      behavior: "instant", // 즉시 스크롤
    });
  });

  // 스크롤 이벤트 등록
  window.addEventListener("wheel", handleWheel);

  // 아코디언 효과
  document.querySelectorAll(".accordion-button").forEach((button) => {
    button.addEventListener("click", () => {
      const icon = button.querySelector(".bi");
      if (button.classList.contains("collapsed")) {
        icon?.classList.remove("bi-chevron-up");
        icon?.classList.add("bi-chevron-down");
      } else {
        icon?.classList.remove("bi-chevron-down");
        icon?.classList.add("bi-chevron-up");
      }
    });
  });
});
