document.addEventListener('DOMContentLoaded', function () {
    function initAutocomplete(data, idData) {
        var options = {
            data: data,
            onAutocomplete: function (txt) {
                // Obtener el ID del usuario seleccionado desde los datos del usuario
                var selectedUserId = idData[txt];

                // Redirigir a la URL con el ID del usuario
                window.location.href = '/ver_usuario/' + selectedUserId;
            }
        };

        var elems = document.querySelectorAll('.autocomplete');
        var instances = M.Autocomplete.init(elems, options);
    }

    var datos = {};

    $.ajax({
        url: '/buscar_usuarios',
        method: 'get',
        data: datos,
        success: function (data) {
            var nameData = {};
            var idData = {};

            data.forEach(function (usuario) {
                var userName = usuario.name + " " + usuario.apellido_paterno + " " + usuario.apellido_materno;

                // Almacenar el nombre y el ID en objetos separados
                nameData[userName] = usuario.ruta_foto;
                idData[userName] = usuario.id;
            });

            initAutocomplete(nameData, idData);
        },
        error: function (error) {
            console.error('Error al guardar la respuesta: ' + error);
        }
    });
});
