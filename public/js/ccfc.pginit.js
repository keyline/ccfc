$(function () {
    const form = document.getElementById("payment-form");
    const log = document.querySelector("#log");

    form.addEventListener(
        "submit",
        (event) => {
            const data = new FormData(form);
            let amountInput = data.get('amount');
            let route = getCheckedPG('exampleRadios');
            if (route.length === 0 || route !== null) {
                log.innerText = "Please check one of payment gateway before making payment";
                return false;
            }

            if (checkAmount(amountInput)) {
                log.innerText = "Amount not valid!";
                return false
            }
            event.preventDefault();
        },
        false
    );
})();

function getCheckedPG(groupName) {
    var radios = document.getElementsByName(groupName);
    for (i = 0; i < radios.length; i++) {
        if (radios[i].checked) {
            return radios[i].value;
        }
    }
    return null;
}

function checkAmount(amount) {
    const amountRegex = '(?!0)\d+';
    return amountRegex.test(amount);
}