document.addEventListener('DOMContentLoaded', () => {
   // Estilos
   const alert = Swal.mixin({
      customClass: {
         actions: 'gap-2',
         confirmButton: 'btn btn-success',
         cancelButton: 'btn btn-danger',
         denyButton: 'btn btn-secondary'
      },
      buttonsStyling: false,
      confirmButtonText: 'Confirmar',
      cancelButtonText: 'Cancelar',
   });



   // Definiciones de las alertas
   
   const handleDeleteForms = () => {
      const deleteForms = document.querySelectorAll('.delete-form');
   
      deleteForms.forEach(form => {
         form.addEventListener('submit', (e) => {
            e.preventDefault();
   
            alert.fire({
               title: '¿Estás seguro?',
               text: "No podrás revertir esta acción...",
               icon: 'warning',
               showCancelButton: true,
               reverseButtons: true
            }).then((result) => {
               if (result.isConfirmed) {
                  form.submit();
               }
            })
         });
      });
   }



   // Ejecución
   handleDeleteForms();
});