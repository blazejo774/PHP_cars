function toggleEditMode() {
var viewMode = document.getElementById("viewMode");
var editMode = document.getElementById("editMode");
          
    if (viewMode.style.display === "none") {
        viewMode.style.display = "block";
        editMode.style.display = "none";
    } 
    else {
        viewMode.style.display = "none";
        editMode.style.display = "block";
    }
}

function showAlert(message) {
    var modal = document.getElementById("alert");
    var modalContent = document.getElementById("modal-content-text");
    modalContent.innerText = message;
    modal.style.display = "block";
}

function closeModal() {
    var modal = document.getElementById("alert");
    modal.style.display = "none";
}

function handleSave() {
    toggleEditMode();
    showAlert("Data updated!");
}

function handleAcc() {
    showAlert("New account created!");
}

function handleCancel() {
    toggleEditMode();
    showAlert("Action canceled");
}