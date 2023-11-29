    document.addEventListener('DOMContentLoaded', function () {
        var modalRestablecerContraseña = M.Modal.init(document.getElementById('restablecer_contraseña'));
        var btnRestaurarContraseña = document.getElementById('restaurarContraseñaBtn');
        var btnCancelRestablecer = document.getElementById('cancelarRestablecer');

        btnRestaurarContraseña.addEventListener('click', function () {
            var modalActual = M.Modal.getInstance(document.getElementById('editar_perfil'));
            if (modalActual) {
                modalActual.close();
            }

            modalRestablecerContraseña.open();
        });

        btnCancelRestablecer.addEventListener('click', function () {
            modalRestablecerContraseña.close();

            // Abre el modal de editar
            var modalEditarPerfil = M.Modal.init(document.getElementById('editar_perfil'));
            modalEditarPerfil.open();
        });
    });
