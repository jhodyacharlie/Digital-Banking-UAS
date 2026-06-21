const account = document.querySelector('#no_card');
const pass = document.querySelector('#password');
const btn = document.querySelector('#login-btn');
const form = document.querySelector('form');
const msg = document.querySelector('.msg');

function setMessage(text, type = '') {
    msg.textContent = text;
    msg.className = `msg ${type}`.trim();
}

function validateForm() {
    const isEmpty = account.value.trim() === '' || pass.value.trim() === '';

    if (isEmpty) {
        btn.disabled = true;
        setMessage('Lengkapi nomor kartu/email dan password.', 'error');
        return false;
    }

    btn.disabled = false;
    setMessage('Data login siap dikirim.', 'success');
    return true;
}

if (account && pass && btn && form && msg) {
    form.addEventListener('input', validateForm);

    form.addEventListener('submit', (event) => {
        if (!validateForm()) {
            event.preventDefault();
            setMessage('Isi nomor kartu/email dan password terlebih dahulu.', 'error');
        }
    });

    validateForm();
}
