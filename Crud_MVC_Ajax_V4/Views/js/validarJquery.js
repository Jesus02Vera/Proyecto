$("#nombre").change(function () {
    var nombre = $("#nombre").val();
    var datos = new FormData();
    datos.append('nombre', nombre);
    $.ajax({
        url: "views/modules/ajaxUsuario.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {
            if (respuesta == 'si') {
                $("label[for='nombre'] span").html("<br>Este usuario ya existe");
                $("label[for='nombre'] span").css('color', 'red');
            }
        }
    })
})

$("#email").change(function () {
    var email = $("#email").val();
    var datos = new FormData();
    datos.append('email', email);
    $.ajax({
        url: "views/modules/ajaxUsuario.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {
            if (respuesta == 'si') {
                $("label[for='email'] span").html("<br>Este E-Mail ya existe");
                $("label[for='email'] span").css('color', 'red');
            }
        }
    })
})