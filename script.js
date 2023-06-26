// Submit the form
function submitForm(event) {
    event.preventDefault();

    // Perform CAPTCHA verification
    const response = grecaptcha.getResponse();
    if (!response || response==='') {
        alert('Please complete the CAPTCHA');
        return;
    }

    // Get form data
    const form = document.getElementById('contact-form');
    const formData = new FormData(form);

    // Add the reCAPTCHA response to the form data
    formData.append('g-recaptcha-response', response);

    // Send form data to the backend (replace with your backend endpoint)
    fetch('process_form.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        form.reset();
        grecaptcha.reset();
    })
    
}

// Attach event listener to form submission
document.getElementById('contact-form').addEventListener('submit', submitForm);
