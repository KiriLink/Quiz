document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.modal');
    var instances = M.Modal.init(elems);

    var botonesEliminar = document.querySelectorAll('.eliminar-btn');
    botonesEliminar.forEach(function(boton) {
      boton.addEventListener('click', function() {
        var filaId = this.closest('tr').getAttribute('data-id-pregunta');
        // Ahora tienes el ID de la fila en la variable 'filaId'
        // Puedes utilizarlo para realizar la eliminación o cualquier otra acción específica para esa fila
        console.log('Se hizo clic en el botón Eliminar en la fila con ID:', filaId);
      });
    });

    document.getElementById('confirmarEliminar').addEventListener('click', function() {
      // Lógica para eliminar la pregunta o realizar otras acciones
    });
  });