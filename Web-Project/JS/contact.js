window.onload = function() {
    const urlParams = new URLSearchParams(window.location.search);
    const status = urlParams.get('status');

    if (status === 'success') {
        alert('Message sent successfully!');
    }
    else if(status === 'cancel'){
        alert('Message Canceled');
    } 
    else if (status === 'error') {
        alert('Sorry, there was an error sending your message. Please try again.');
    }
};