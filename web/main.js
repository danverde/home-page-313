/* eslint-env node */

function formSent() {
    var formInputs = [document.querySelector('input[name="sender"]'),
            document.querySelector('input[name="email"]'),
            document.querySelector('textarea[name="message"]')
        ],
        inputValues = formInputs.map((inputEle) => {
            return inputEle.value;
        }),
        msgContainer = document.querySelector('#contact .statusMsg');

        /* remove err msg if it exists */
    if ([...msgContainer.classList].indexOf('errMsg')) {
        msgContainer.classList.remove('errMsg');
    }

    /* if none of the inputs are empty, clear all and display sent message */
    if (inputValues.indexOf('') < 0) {
        formInputs.forEach((inputEle) => {
            inputEle.value = '';
        });
        msgContainer.innerHTML = 'Message Sent';
        msgContainer.classList.toggle('successMsg');
    } else {
        msgContainer.innerHTML = 'No fields can be blank';
        msgContainer.classList.toggle('errMsg');
    }
}

function scrollBox(selector) {
    document.querySelector(selector).classList.toggle('moveIn');
}