document.getElementById("success").addEventListener("click", (e) => {
  Swal.fire({
    icon: "success",
    title: "등록이 완료되었습니다!",
  }).then((result) => {
    if (result.isConfirmed) {
      // 알림 확인 후 이동할 페이지로 리디렉션
      window.location.replace("<?= base_url('/') ?>");
    }
  });
});
document.getElementById("success1").addEventListener("click", (e) => {
  Swal.fire({
    icon: "success",
    title: "정보 수정이 완료되었습니다!",
  }).then((result) => {
    if (result.isConfirmed) {
      // 알림 확인 후 이동할 페이지로 리디렉션
      window.location.replace("<?= base_url('/') ?>");
    }
  });
});
