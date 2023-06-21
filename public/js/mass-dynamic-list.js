document.addEventListener('DOMContentLoaded', () => {
   const rows = document.querySelectorAll('.products-list-element');

   rows.forEach(row => {
      const deleteBtn = row.querySelector('.btn-action-delete');

      deleteBtn.addEventListener('click', () => deleteBtn.parentElement.parentElement.parentElement.remove());
   });
});