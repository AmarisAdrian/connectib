/* Detecta el cambio del select de pais y consulta sus estados o departamentos en la vista de crear usuario*/
$(document).on("change", ".pais", function () {
    var Id = $(this).val();
    var url = $(this).data("url");
    $.get(url + Id, function (data) {
      $(".departamento").empty();
      $.each(data, function (index, element) {
        $(".departamento").append(
          "<option value='" +
            element.id +
            "' data-id='"+element.id+"'>" +
            element.name +
            "</option>"
        );
      });
    });

  });
/* Detecta el cambio del select de departamento y consulta sus ciudades en la vista de crear usuario*/
  $(document).on("change", ".departamento", function () {
    var Id = $(this).find("option:selected").data("id");
    var url = $(this).data("url");
    $.get(url + Id, function (data) {
      $(".codigo_ciudad").empty();
      $.each(data, function (index, element) {
        $(".codigo_ciudad").append(
          "<option value='" +
            element.id +
            "'>" +
            element.name +
            "</option>"
        );
      });
    });
  });

  /* Detecta el evento click del boton actualizar usuario y abre el modal con los datos cargado */
  $(function(){
    $('.btn_modal_actualizar_usuario').click(function(){
      $('.body_actualizar_usuario').empty()
      var url = $(this).data('url');
      $('.body_actualizar_usuario').load(url,function(){
        $('#modal_actualizar_usuario').modal({show:true});
      });
    });
  });

  /* Abre un sweet alert que elimina un usuario  */
  $(".btn_eliminar_usuario").on("click", function () {
    var url = $(this).data("url");
    swal.fire({
      title: '¿Estas seguro de eliminar este usuario?',
      text: "No pódras deshacer esta decision",
      icon: "warning",
      showDenyButton: true,
      confirmButtonText: 'Eliminar',
  }).then((result) => {
    if (result.isConfirmed) {
        $.getJSON(url, function (data) {
         if(data.status==201){
            swal.fire(data.msg,'',"success");
          }else{
            swal.fire(data.msg,'',"error");
         }
       });
    } else if (result.isDenied) {
       Swal.fire('No se eliminó el usuario', '', 'info')
    }
 
  });
});