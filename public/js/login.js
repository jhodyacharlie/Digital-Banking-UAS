document.addEventListener('DOMContentLoaded', () => {
    const account = document.querySelector('#no_card');
    const pass = document.querySelector('#password');
    const btnContainer = document.querySelector('.btn-container');
    const btn = document.querySelector('#login-btn');
    const form = document.querySelector('form');
    const msg = document.querySelector('.msg');
    const positions = ['shift-left', 'shift-top', 'shift-right', 'shift-bottom'];
    let shiftIndex = 0;

    if (!account || !pass || !btnContainer || !btn || !form || !msg) {
        return;
    }

    btn.disabled = true;

    function setMessage(text, type = '') {
        msg.textContent = text;
        msg.className = `msg ${type}`.trim();
    }

    function removeShiftClasses() {
        btn.classList.remove(...positions);
    }

    function hasEmptyField() {
        return account.value.trim() === '' || pass.value.trim() === '';
    }

    function showMsg() {
        if (hasEmptyField()) {
            btn.disabled = true;
            btn.classList.remove('no-shift');
            setMessage('Lengkapi nomor kartu/email dan password sebelum masuk.', 'error');
            return false;
        }

        btn.disabled = false;
        removeShiftClasses();
        btn.classList.add('no-shift');
        setMessage('Data login siap dikirim.', 'success');
        return true;
    }

    function shiftButton() {
        if (!hasEmptyField()) {
            showMsg();
            return;
        }

        showMsg();
        removeShiftClasses();
        btn.classList.add(positions[shiftIndex]);
        shiftIndex = (shiftIndex + 1) % positions.length;
    }

    btnContainer.addEventListener('mouseenter', shiftButton);
    btn.addEventListener('mouseover', shiftButton);
    btn.addEventListener('touchstart', (event) => {
        if (hasEmptyField()) {
            event.preventDefault();
            shiftButton();
        }
    }, { passive: false });

    form.addEventListener('input', showMsg);
    form.addEventListener('submit', (event) => {
        if (!showMsg()) {
            event.preventDefault();
        }
    });

    showMsg();
});
