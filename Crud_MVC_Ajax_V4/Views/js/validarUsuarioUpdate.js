/*///VALIDAR USUARIO//*/

var usuarioExiste = "no";
var emailExiste = "no";

document.getElementById("formUsuarioUpdate").addEventListener("submit", function (event) {
    event.preventDefault();

    var nombre = document.querySelector("#nombre").value;
    var email = document.querySelector("#email").value;
    var password = document.querySelector("#password").value;

    var expresion = /^[a-zA-Z0-9]*$/;
    var expEmail = /[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$/;
    var expClave = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/;

    /*VALIDAR QUE EL USUARIO */

    if (usuarioExiste == "si") {
        document.querySelector("label[for='nombre'] span").innerHTML =
                "<br>Este usuario ya existe";
        $("label[for='nombre'] span").css('color', 'red');
        return false;
    }

    if (nombre.length == 0) {
        document.querySelector("label[for='nombre']").innerHTML +=
                "<br>Digite su usuario con un maximo de 8 carateres";
        return false;
    }
    if (nombre.length > 8) {
        document.querySelector("label[for='nombre']").innerHTML +=
                "<br>Digite un maximo de 8 carateres";
        return false;
    } else if (!expresion.test(nombre)) {
        document.querySelector("label[for='nombre']").innerHTML +=
                "<br>Digite solo numeros y caracteres en minuscula y/o mayuscula";
        return false;
    }


    /*VALIDAR EMAIL*/
    if (!expEmail.test(email)) {
        document.querySelector("label[for='email']").innerHTML +=
                "<br>Digite un correo electronico valido";
        return false;
    }

    if (emailExiste == "si") {
        $("label[for='email'] span").html("<br>Este E-Mail ya existe");
        $("label[for='email'] span").css('color', 'red');
        return false;
    }

    /*VALIDAR PASSWORD */
    if (!expClave.test(password)) {
        document.querySelector("label[for='password']").innerHTML +=
                "<br>La clave debe contener al menos un número y una letra mayúscula y minúscula, y al menos 6 o más caracteres";
        return false;
    }

    this.submit();
    // window.location.href = 'http://localhost/Crud_MVC_Ajax_V2/editar/127';

});

///UTUILIZANDO AJAX /////

$("#nombre").change(function () {
    var nombre = $("#nombre").val();
    var url = window.location.pathname;
    var datos = new FormData();
    datos.append('nombre', nombre);
    datos.append('url', url);
    $.ajax({
        url: "http://localhost/Crud_MVC_Ajax_V2/views/modules/ajaxUsuario.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {
            if (respuesta == 'si') {
                $("label[for='nombre'] span").html("<br>Este usuario ya existe");
                $("label[for='nombre'] span").css('color', 'red');
                usuarioExiste = "si";
            } else {
                $("label[for='nombre'] span").html("");
                usuarioExiste = "no";
            }
        }
    })
})

$("#email").change(function () {
    var email = $("#email").val();
    var url = window.location.pathname;
    var operacion = "update";
    var datos = new FormData();
    datos.append('email', email);
    datos.append('operacion', operacion);
    datos.append('url', url);
    $.ajax({
        url: "http://localhost/Crud_MVC_Ajax_V2/views/modules/ajaxUsuario.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {
            if (respuesta == 'si') {
                $("label[for='email'] span").html("<br>Este E-Mail ya existe");
                $("label[for='email'] span").css('color', 'red');
                emailExiste = "si";
            } else {
                $("label[for='email'] span").html("");
                emailExiste = "no";
            }
        }
    })
})
