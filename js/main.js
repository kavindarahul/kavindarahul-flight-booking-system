function confPopup(status, msg, callback) {

    var infoPopupContainer = document.createElement('div');
    infoPopupContainer.className = "model-container";
    var infoPopup = document.createElement('div');
    infoPopup.className = "model";
    var title = document.createElement('h2');
    title.textContent = status;
    var message = document.createElement('p');
    message.textContent = msg;
    var btnGroup = document.createElement('div');
    btnGroup.className = "btn-group";
    var okButton = document.createElement('button');
    okButton.textContent = "OK";
    var cancelButton = document.createElement('button');
    cancelButton.textContent = "Cancel";

    cancelButton.style.background = "#d4d4d4";
    cancelButton.style.color = "#000";
    cancelButton.style.marginLeft = "0.25rem";
    okButton.style.marginRight = "0.25rem";

    // Assemble the elements
    btnGroup.appendChild(okButton);
    btnGroup.appendChild(cancelButton);
    infoPopup.appendChild(title);
    infoPopup.appendChild(message);
    infoPopup.appendChild(btnGroup);
    infoPopupContainer.appendChild(infoPopup);

    // Append the popup form to the document body
    document.body.appendChild(infoPopupContainer);

    okButton.addEventListener('click', function () {
        callback(true); // Call the callback function with true when OK is clicked
        infoPopupContainer.remove(); // Remove the popup from the DOM
    });

    cancelButton.addEventListener('click', function () {
        infoPopupContainer.remove(); // Remove the popup from the DOM
    });

}

function infoPopup(status, msg) {

    var infoPopupContainer = document.createElement('div');
    infoPopupContainer.className = "model-container";
    var infoPopup = document.createElement('div');
    infoPopup.className = "model";
    var title = document.createElement('h2');
    title.textContent = status;
    var message = document.createElement('p');
    message.textContent = msg;
    var btnGroup = document.createElement('div');
    btnGroup.className = "btn-group";
    var okButton = document.createElement('button');
    okButton.textContent = "OK";
    okButton.style.marginRight = "0.25rem";

    // Assemble the elements
    btnGroup.appendChild(okButton);
    infoPopup.appendChild(title);
    infoPopup.appendChild(message);
    infoPopup.appendChild(btnGroup);
    infoPopupContainer.appendChild(infoPopup);

    // Append the popup form to the document body
    document.body.appendChild(infoPopupContainer);

    okButton.addEventListener('click', function () {
        infoPopupContainer.remove();
        location.reload();
    });

}

function removeUpdate() {
    var updateForm = document.getElementById("update-form");
    var newForm = document.getElementById("new-form");
    updateForm.style.display = "none";
    newForm.style.display = "block";
}


