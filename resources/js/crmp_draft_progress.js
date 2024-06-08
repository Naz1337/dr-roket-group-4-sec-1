import { Modal } from 'bootstrap';

const btn = document.getElementById('modalTgl')
btn.addEventListener('click', function () {
    const myModal = new Modal(document.getElementById('feedbackModals'));
    myModal.show();
});
