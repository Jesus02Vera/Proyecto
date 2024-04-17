/*///VALIDAR Empresa//*/

var empresaExiste = "no";
var direccionExiste = "no";
var telefonoExiste = "no";
var emailExiste = "no";

document.getElementById("formEmpresaUpdate").addEventListener("submit", function (event) {
    event.preventDefault();

    var nombre = document.querySelector("#nombre").value;
    var direccion = document.querySelector("#direccion").value;
    var telefono = document.querySelector("#telefono").value;
    var email = document.querySelector("#email").value;
    

    var expresion = /^[a-zA-Z0-15]*$/;
    var expEmail = /[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$/;
    var expTel = /^\d{10}$/;
    

    /*VALIDAR QUE LA EMPRESA */

    if (empresaExiste == "si") {
        document.querySelector("label[for='nombre'] span").innerHTML =
                "<br>Esta empresa ya existe";
        $("label[for='nombre'] span").css('color', 'red');
        return false;
    }

    if (nombre.length == 0) {
        document.querySelector("label[for='nombre']").innerHTML +=
                "<br>Digite su empresa con un maximo de 15 carateres";
        return false;
    }
    if (nombre.length > 15) {
        document.querySelector("label[for='nombre']").innerHTML +=
                "<br>Digite un maximo de 15 carateres";
        return false;
    } else if (!expresion.test(nombre)) {
        document.querySelector("label[for='nombre']").innerHTML +=
                "<br>Digite solo numeros y caracteres en minuscula y/o mayuscula";
        return false;
    }


    /*VALIDAR DIRECCION*/   
    if (direccionExiste == "si") {
        $("label[for='direccion'] span").html("<br>Esta Direccion ya existe");
        $("label[for='email'] span").css('color', 'red');
        return false;
    }
    
    /*VALIDAR TELEFONO*/
    if (!expTel.test(telefono)) {
        document.querySelector("label[for='telefono']").innerHTML +=
                "<br>Digite un telefono valido";
        return false;
    }

    if (telefonoExiste == "si") {
        $("label[for='telefono'] span").html("<br>Este Telefono ya existe");
        $("label[for='telefono'] span").css('color', 'red');
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
    
    this.submit();

});

///UTUILIZANDO AJAX /////

$("#nombre").change(function () {
    var nombre = $("#nombre").val();
    var datos = new FormData();
    datos.append('nombre', nombre);
    $.ajax({
        url: "http://localhost/Crud_MVC_Ajax_V4/views/modules/empresaGuardias/ajaxEmpresa.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {
            if (respuesta == 'si') {
                $("label[for='nombre'] span").html("<br>Esta empresa ya existe");
                $("label[for='nombre'] span").css('color', 'red');
                empresaExiste = "si";
            }
            else{
                $("label[for='nombre'] span").html("");
                empresaExiste = "no";
            }
        }
    })
})

$("#direccion").change(function () {
    var direccion = $("#direccion").val();
    var datos = new FormData();
    datos.append('direccion', direccion);
    $.ajax({
        url: "http://localhost/Crud_MVC_Ajax_V4/views/modules/empresaGuardias/ajaxEmpresa.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {
            if (respuesta == 'si') {
                $("label[for='direccion'] span").html("<br>Esta direccion ya existe");
                $("label[for='direccion'] span").css('color', 'red');
                direccionExiste = "si";
            }
            else{
                $("label[for='nombre'] span").html("");
                direccionExiste = "no";
            }
        }
    })
})

$("#telefono").change(function () {
    var telefono = $("#telefono").val();
    var datos = new FormData();
    datos.append('telefono', telefono);
    $.ajax({
        url: "http://localhost/Crud_MVC_Ajax_V4/views/modules/empresaGuardias/ajaxEmpresa.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {
            if (respuesta == 'si') {
                $("label[for='telefono'] span").html("<br>Este telefono ya existe");
                $("label[for='telefono'] span").css('color', 'red');
                telefonoExiste = "si";
            }
            else{
                $("label[for='nombre'] span").html("");
                telefonoExiste = "no";
            }
        }
    })
})

$("#email").change(function () {
    var email = $("#email").val();
    var datos = new FormData();
    datos.append('email', email);
    $.ajax({
        url: "http://localhost/Crud_MVC_Ajax_V4/views/modules/empresaGuardias/ajaxEmpresa.php",
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
            }
            else{
                $("label[for='email'] span").html("");
                emailExiste = "no";
            }
        }
    })
})

