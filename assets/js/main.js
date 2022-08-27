$("#subscribeForm").on("submit", function (e) {
  e.preventDefault();
  submitForm();
});

function submitForm() {
  let btn = $("#subscribeBtn");
  btn.text("Please wait...");
  let formData = $("#subscribeForm").serialize();

  // AJAX submit
  $.ajax({
    type: "POST",
    url: "mailscript.php",
    data: formData,
    dataType: "json",
    async: false,
    encode: true,
  }).done(function (data) {
    if (data["msgType"] == true) {
      Swal.fire({
        icon: "success",
        title: "Success",
        text: "Than you for subscribe",
      }).then(() => {
        btn.text("Subscribe");
        $("#subscribeForm")[0].reset();
      });
    } else {
      Swal.fire({
        icon: "error",
        title: "Error",
        text: "Failed to subscribe",
      }).then(() => {
        btn.text("Subscribe");
      });
    }

    console.log(data);
  });
}
