function openEditPopup(id, firstName, lastName, gender, email, birthdate, address) {
    document.getElementById('editId').value = id;
    document.getElementById('editFirstname').value = firstName;
    document.getElementById('editLastname').value = lastName;
    document.getElementById('editGender').value = gender;
    document.getElementById('editEmail').value = email;
    document.getElementById('editBirthdate').value = birthdate;
    document.getElementById('editAddress').value = address;

    // Display the popup
    document.getElementById('editPopup').style.display = 'block';
}

function closeEditPopup() {
    // Close the popup
    document.getElementById('editPopup').style.display = 'none';
}

