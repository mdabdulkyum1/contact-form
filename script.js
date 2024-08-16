document.getElementById("contactForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent the form from submitting the traditional way

    const formData = new FormData(this);

    fetch("send_email.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Email sent successfully!");
            // Optionally, you can clear the form fields here
            document.getElementById("contactForm").reset();
        } else {
            alert("Failed to send email: " + data.error);
        }
    })
    .catch(error => {
        alert("An error occurred: " + error.message);
    });
});
