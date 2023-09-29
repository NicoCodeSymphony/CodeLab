function submitForm() {
        // Collect form data
        const formData = new FormData(document.getElementById('submitForm'));

        // Send the form data via AJAX
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    alert('New Record created Successfully');
                    // Clear the form after successful submission if needed
                    document.getElementById('submitForm').reset();
                } else {
                    alert('Error: ' + xhr.responseText);
                }
            }
        };

        xhr.open('POST', 'index.php', true);
        xhr.send(formData);
    }


    function deleteRecord(id) {
        if (confirm('Are you sure you want to delete this entry?')) {
            // Send an AJAX request to delete the record
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == XMLHttpRequest.DONE) {
                    if (xhr.status == 200) {
                        // Display a success message or handle as needed
                        // Reload the page after deletion
                        window.location.reload();
                    } else {
                        // Handle deletion error if needed
                        alert('Error deleting record: ' + xhr.responseText);
                    }
                }
            };
            xhr.open('POST', 'index.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.send('delete_id=' + id);
        }
    }