$(document).ready(function () {
  $("#contact-form").on("submit", function (event) {
    event.preventDefault();

    $("#modalBody").text("Enviando, por favor aguarde..."); 
    $("#responseModal").modal("show"); 

    $.ajax({
      url: "assets/contato.php",
      type: "POST",
      data: $(this).serialize(), 
      dataType: "json",
      success: function (response) {
        if (response.status === "success") {
          $("#modalBody").text(response.message); 
          $("#modalBody").text(response.message); 
        }
      },
      error: function () {
        $("#modalBody").text(
          "Ocorreu um erro ao enviar sua mensagem. Tente novamente mais tarde."
        );
      },
    });
  });
});
