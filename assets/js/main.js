$("#subscribeForm").on("submit", function (e) {
  e.preventDefault();
  submitForm();
});

function submitForm() {
  let btn = $("#subscribeBtn");
  btn.text("Please wait...");
  let data = $('#subscribeForm').serialize();

  Swal.fire({
    icon: "success",
    title: "Success",
    text: "Than you for subscribe",
  }).then(() => {
    btn.text("Subscribe");
    console.log(data);
  });
}
