$("#subscribeForm").on("submit", function (e) {
  e.preventDefault();
  submitForm();
});

function submitForm() {
  let btn = $("#subscribeBtn");
  btn.html("Please wait...");
  btn.prop('disable', true);
  let formData = $("#subscribeForm").serialize();

  // AJAX submit
  $.ajax({
    type: "POST",
    url: "mailscript.php",
    data: formData,
    dataType: "json",
    async: true,
    encode: true,
  }).done(function (data) {
    if (data["msgType"] == true) {
      Swal.fire({
        icon: "success",
        title: "Success",
        text: "Thank you for subscribe",
      }).then(() => {
        btn.html("Subscribe");
        btn.prop('disable', false);
        $("#subscribeForm")[0].reset();
      });
    } else {
      Swal.fire({
        icon: "error",
        title: "Error",
        text: "Failed to subscribe",
      }).then(() => {
        btn.html("Subscribe");
        btn.prop('disable', false);
      });
    }

    console.log(data);
  });
}
