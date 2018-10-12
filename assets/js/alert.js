var AlertBox = function(option) {
    this.show = function(type, msg) {
        var alertArea = document.querySelector('#alert-area');
        var alertBox = document.createElement('DIV');
        var alertContent = document.createElement('DIV');
        var alertClose = document.createElement('A');
        var alertClass = this;
        alertContent.classList.add('alert-content');
        alertContent.innerText = msg;
        alertClose.classList.add('close');
        alertClose.setAttribute('href', '#');
        alertBox.classList.add('alert');
        alertBox.classList.add(type);
        alertBox.appendChild(alertContent);
        if (!option.hideCloseButton || typeof option.hideCloseButton === 'undefined') {
            alertBox.appendChild(alertClose);
        }
        alertArea.appendChild(alertBox);
        alertClose.addEventListener('click', function(event) {
            event.preventDefault();
            alertClass.hide(alertBox);
        });
        if (!option.persistent) {
            var alertTimeout = setTimeout(function() {
                alertClass.hide(alertBox);
                clearTimeout(alertTimeout);
            }, option.closeTime);
        }
    };

    this.hide = function(alertBox) {
        alertBox.classList.add('hide');
        var disperseTimeout = setTimeout(function() {
            alertBox.parentNode.removeChild(alertBox);
            clearTimeout(disperseTimeout);
        }, 500);
    };
};

var alertboxPersistent = new AlertBox({
    closeTime: 5000,
    persistent: true,
    hideCloseButton: false
});
var alertbox = new AlertBox({
    closeTime: 5000,
    persistent: false,
    hideCloseButton: true
});

