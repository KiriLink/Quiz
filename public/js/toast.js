function toast(mensaje){
    document.addEventListener('DOMContentLoaded', function () {
        // Verifica la condición antes de mostrar el toast
        // Reemplaza "mostrarToast" con tu condición real
        M.toast({
            html: mensaje, classes: 'indigo accent-2 rounded',
            displayLength: 5000
        });

    })
};