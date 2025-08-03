window.addEventListener('load', () => {
    initOnFormSubmit();
});
function initOnFormSubmit() {
    const form = document.querySelector('#contactUsModel form');

    form.addEventListener('submit', (e) => {
        e.preventDefault();
        console.log(form);

        sendData(form);
    })
}

function sendData(form) {
    const xhr = new XMLHttpRequest();
    const formData = new FormData(form);

    xhr.addEventListener('load', () => {

        const newHtml = xhr.response;
        const divElement = document.createElement('div');
        divElement.innerHTML = newHtml;
        const newModalBody = divElement.querySelector('#contactUsModel .modal-body');
        const oldModalBody = document.querySelector('#contactUsModel .modal-body');
        if (newModalBody) {
            oldModalBody.replaceWith(newModalBody);
            initOnFormSubmit();
        } else {

            const modal = bootstrap.Modal.getInstance(document.getElementById('contactUsModel'));
            modal.hide();
        }

        initOnFormSubmit();
    })

    xhr.addEventListener('error', () => {
        document.querySelector('#contactUsModel .modal-body').innerHTML = 'An error occurred while sending the message. Please try again later.';
    });
    xhr.open('POST', form.getAttribute('action'));
    xhr.send(formData);
}
