///VALIDACION DE ACTUALIZACION DEL USUARIO UTILIZANDO JQUERY PLUGIN VALIDATION///

$(document).ready(function () {
    $("#formUsuarioUpdate").validate({
        rules: {
            nombre: {
                maxlength: 8,
                required: true
            },
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 6,
                maxlength: 10
            }
        },
        messages: {
            nombre: {
                maxlength: "El nombre del usuario debe ser de maximo 8 caracteres",
                required: "Este campo es obligatorio"
            },
            email: {
                required: "El E-mail es obligatorio",
                email: "Digite un correo electronico valido"
            },
            password: {
                required: "El campo de contraseña es obligatorio",
                minlength: "La contraseña debe tener minimo 6 caracteres",
                maxlength: "La contraseña debe tener maximo 10 caracteres"

            }
        }
    })
})

/////VALIDAR DATOS PRODUCTO /////

$(document).ready(function () {
    $("#formProducto").validate({
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