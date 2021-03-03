//Printing the invoice

$(document).ready(function () {
  fetch();
  $(document).on('click', '.print-profile', function () {
    swal.fire("Done!", "Your file is ready", "success");

    var element = document.getElementById("dvContents");
    html2pdf(element, {
      margin: 1,
      filename: "Profile.pdf",
      image: {
        type: "jpeg",
        quality: 1
      },
      html2canvas: {
        scale: 3,
        logging: true
      },
      jsPDF: {
        unit: "pt",
        format: "a6",
        orientation: "p"
      }
    });

    /*setTimeout(function () {
      window.location.href = "../dashboard.php";
    }, 5000);*/
  });
});