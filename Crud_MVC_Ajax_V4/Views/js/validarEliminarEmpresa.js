function validarEliminarEmpresa(e) {
    e.preventDefault();
    url = e.currentTarget.getAttribute('href');
    alert(url);
    urlArray = url.split("/");
   
    /////INICIA LOS SWEET ALERT /////
    Swal.fire({
        title: "Estas Seguro de Eliminar Este Registro?",
        text: "¡No Podra Revertir los Cambios",
        icon: "warning",
        showCancelButton: true,
        cancelButtonColor: "#d33",
        confirmButtonColor: "#3085d6",
        confirmButtonText: "Eliminar"
    }).then((result) => {
        if (result.isConfirmed) {
            
            ///PREPARACON DE LAS VARIABLES PARA EL AJAX ////
            var id = urlArray[7];
            var datos = new FormData();
            var fila = '#fila' + id;
            var operacion = urlArray[6];
            datos.append("id", id);
            datos.append("ope", operacion);
            
            ///INICIO DEL AJAX ///
            $.ajax({
                url: URLEMPRESA + "ajaxEmpresa.php",
                method: "POST",
                data: datos,
                contentType: false,
                processData: false,
                success: function (respuesta) {
                    //console.log(respuesta);
                    if (respuesta == 'success') {
                        Swal.fire({
                            title: "Registro Eliminado Correctamente!",
                            text: "El Registro Ha Sido Eliminado",
                            icon: "success"
                        });
                        $(fila).remove();
                        ///window.location.href = URLEMPRESA + "empresaGuardias";
                    } else {
                        Swal.fire({
                            title: "¡ERROR! Registro No Eliminado",
                            text: "El Registro No Fue Eliminado",
                            icon: "error"
                        });
                    }
                }
            })
        }
    });
    return false;
}

