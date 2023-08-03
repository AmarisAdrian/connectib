$(document).on("change", "#pais", function () {
    var Id = $(this).val();
    var url = $(this).data("url");
    $.get(url + Id, function (data) {
      $("#departamento").empty();
      $.each(data, function (index, element) {
        $("#departamento").append(
          "<option value='" +
            element.id +
            "' data-id='"+element.id+"'>" +
            element.name +
            "</option>"
        );
      });
    });
  });

  $(document).on("change", "#departamento", function () {
    var Id = $(this).find("option:selected").data("id");
    var url = $(this).data("url");
    $.get(url + Id, function (data) {
      $("#ciudad").empty();
      $.each(data, function (index, element) {
        $("#ciudad").append(
          "<option value='" +
            element.id +
            "'>" +
            element.name +
            "</option>"
        );
      });
    });
  });