document.addEventListener("DOMContentLoaded", () => {
  // 오늘 날짜 가져오기
  const today = new Date();
  const weekInMillisec = 7 * 24 * 60 * 60 * 1000;

  // 전화번호 입력 11자 제한
  // - 중간 표시
  const phoneNumberInput = document.getElementById("phone-number");
  if (phoneNumberInput) {
    phoneNumberInput.addEventListener("input", function (event) {
      let input = event.target.value.replace(/\D/g, ""); // 숫자만 남기기

      if (input.length > 11) {
        input = input.slice(0, 11); // 11자 초과하면 자르기
      }

      if (input.length > 3 && input.length <= 7) {
        input = input.slice(0, 3) + "-" + input.slice(3);
      } else if (input.length > 7) {
        input =
          input.slice(0, 3) + "-" + input.slice(3, 7) + "-" + input.slice(7);
      }

      event.target.value = input;
    });
  }

  // 새로운 회원 등록시 아이콘
  // 반복 로직을 처리하는 함수
  function displayNewMemberIcon(tableSelector) {
    document.querySelectorAll(`${tableSelector} tbody tr`).forEach((row) => {
      const joinDateStr = row.getAttribute("data-join");
      if (joinDateStr) {
        const joinDate = new Date(joinDateStr);

        // 가입 일주일 이내인 경우 빨간 점 아이콘 표시
        if (today - joinDate <= weekInMillisec) {
          const newMemberIcon = row.querySelector(".new-member-icon"); // 클래스 선택자로 변경
          if (newMemberIcon) {
            newMemberIcon.classList.remove("d-none"); // 아이콘을 보이게 설정
          }
        }
      }
    });
  }

  // 함수 호출
  displayNewMemberIcon("#table2");


  
});
