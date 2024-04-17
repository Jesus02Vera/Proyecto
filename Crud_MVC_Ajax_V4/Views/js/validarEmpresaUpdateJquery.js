///VALIDACION DE ACTUALIZACION DEL USUARIO UTILIZANDO JQUERY PLUGIN VALIDATION///

$(document).ready(function () {
    $("#formEmpresaUpdate").validate({
        rules: {
            nombre: {
                maxlength: 15,
                required: true
            },
            direccion: {
                required: true
            },
            telefono: {
                maxlength: 10,
                required: true
            },
            email: {
                required: true,
                email: true
            }
        },
        messages: {
            nombre: {
                maxlength: "El nombre de al emprea debe ser de maximo 15 caracteres",
                required: "Este campo es obligatorio"
            },
            direccion: {
                required: "Este campo es obligatorio"
            },
            telefono: {
                maxlength: "El telefono de al emprea debe ser de maximo 10 caracteres",
                required: "Este campo es obligatorio"
            },
            email: {
                required: "El E-mail es obligatorio",
                email: "Digite un correo electronico valido"
            }
        }
    })
})

/////VALIDAR DATOS PRODUCTO /////

$(document).ready(function () {
    $("#formEmpresaGuardiaUpdate").validate({
        rules: {
            nombre: {
                maxlength: 50,
                required: true
            },
            cantidad: {
                required: true,
            },
        },
        messages: {
            nombre: {
                maxlength: "El nombre del usuario debe ser de maximo 50 caracteres",
                required: "Este campo es obligatorio"
            },
            cantidad: {
                required: "La Cantidad de Producto es Obligatoria",
            },
        }
    });
})