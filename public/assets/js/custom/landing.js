document.addEventListener("DOMContentLoaded", () => {
  // 모든 버튼에 대해 이벤트 추가
  document.querySelectorAll(".accordion-button").forEach((button) => {
    button.addEventListener("click", () => {
      const icon = button.querySelector(".bi");
      if (button.classList.contains("collapsed")) {
        // 버튼이 닫힐 때
        icon.classList.remove("bi-chevron-up");
        icon.classList.add("bi-chevron-down");
      } else {
        // 버튼이 열릴 때
        icon.classList.remove("bi-chevron-down");
        icon.classList.add("bi-chevron-up");
      }
    });
  });

  // Scroll Indicator 버튼 클릭
  document
    .querySelector(".scroll-indicator .btn")
    .addEventListener("click", () => {
      const nextSection = document.querySelector("section:nth-of-type(2)");
      nextSection.scrollIntoView({ behavior: "smooth" });
    });

  // 휠 이벤트 처리
  let ticking = false;
  window.addEventListener("wheel", (e) => {
    if (!ticking) {
      ticking = true;

      setTimeout(() => {
        const sections = document.querySelectorAll("#landing-page section");
        const currentScroll = window.scrollY;
        const viewportHeight = window.innerHeight;

        let closestSectionIndex = 0;
        sections.forEach((section, index) => {
          const sectionTop = section.offsetTop;
          if (currentScroll >= sectionTop - viewportHeight / 2) {
            closestSectionIndex = index;
          }
        });

        if (e.deltaY > 0) {
          const nextSection = sections[closestSectionIndex + 1];
          if (nextSection) {
            nextSection.scrollIntoView({ behavior: "smooth" });
          }
        } else if (e.deltaY < 0) {
          const prevSection = sections[closestSectionIndex - 1];
          if (prevSection) {
            prevSection.scrollIntoView({ behavior: "smooth" });
          }
        }

        ticking = false;
      }, 100);
    }
  });

  // Top 버튼
  const topButton = document.getElementById("topButton");
  const secondSection = document.querySelector(
    "#landing-page section:nth-of-type(2)"
  );
  const navbar = document.querySelector("#landing-page .navbar");

  const navbarHeight = navbar ? navbar.offsetHeight : 0;
  const secondSectionStart = secondSection.offsetTop - navbarHeight;

  window.addEventListener("scroll", () => {
    const scrollPosition = window.scrollY;

    if (scrollPosition >= secondSectionStart) {
      topButton.classList.remove("d-none");
    } else {
      topButton.classList.add("d-none");
    }
  });

  // Top 버튼 클릭 시 모든 아코디언 닫고 맨 위로 이동
  topButton.addEventListener("click", () => {
    // 모든 아코디언 닫기
    const openAccordions = document.querySelectorAll(
      ".accordion-collapse.show"
    );
    openAccordions.forEach((accordion) => {
      accordion.classList.remove("show");
      const button =
        accordion.previousElementSibling.querySelector(".accordion-button");
      button.classList.add("collapsed");
      const icon = button.querySelector(".bi");
      if (icon) {
        icon.classList.remove("bi-chevron-up");
        icon.classList.add("bi-chevron-down");
      }
    });

    // 바로 맨 위로 이동
    window.scrollTo({ top: 0, behavior: "smooth" });
  });
});
