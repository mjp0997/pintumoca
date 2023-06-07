document.addEventListener('DOMContentLoaded', () => {
   const openModalBtns = document.querySelectorAll('.open-modal-btn');

   openModalBtns.forEach(btn => {
      const modalId = btn.dataset.modalId;

      const modal = document.querySelector(`#${modalId}`);

      const closeBtns = modal.querySelectorAll('.modal-close-btn');

      btn.addEventListener('click', () => {
         modal.classList.add('show');
      });

      closeBtns.forEach(btn => {
         btn.addEventListener('click', () => {
            modal.classList.remove('show');
         });
      });

      modal.addEventListener('click', e => {
         if (e.target == modal) {
            modal.classList.remove('show');
         }
      });
   });
});