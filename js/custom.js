// Add your custom JavaScript code here

// Example: Add click event listener to voting buttons
document.addEventListener("DOMContentLoaded", function() {
    // Get all voting buttons
    var voteButtons = document.querySelectorAll('.btn-primary');

    // Add click event listener to each voting button
    voteButtons.forEach(function(button) {
        button.addEventListener('click', function(event) {
            // Get the selected voting option
            var selectedOption = event.target.closest('.card-body').querySelector('.card-title').innerText;

            // Perform actions based on the selected option
            console.log('Voted for: ' + selectedOption);
            // You can send the vote data to the server using AJAX or perform any other desired actions
        });
    });
});
