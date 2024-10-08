$(document).ready(function() {
    $('#generate-btn').click(function() {
        const inputData = $('#qr-input').val();
        $('#qr-code').empty(); // Clear previous QR code
        if (inputData) {
            $('#qr-code').qrcode({
                text: inputData,
                width: 200,
                height: 200,
            });
        } else {
            alert("Please enter a valid text or URL.");
        }
    });
});
