// Select all required elements
var contentDiv = document.getElementById('content');
var signOutBtn = document.getElementById('signOutBtn');
var loginBtn = document.getElementById('loginBtn');
var signUpBtn = document.getElementById('signUpBtn');
var addCarBtn = document.getElementById('addCarBtn');
var adminBtn = document.getElementById('adminBtn');

// Function to run on page load
function onLoad() {
    // Fetch authentication status from the server
    fetch('resources/php/authentication/verifyAuth.php')
        .then(response => response.json()) // Parse the response as JSON
        .then(function(data) {
            if (data.auth) {
                // Access the username from the data object
                contentDiv.innerHTML = "Welcome back, " + data.username;
                loginBtn.style.display = "none"; // Hide login button
                signUpBtn.style.display = "none"; // Hide sign-up button
                signOutBtn.style.display = "inline-block"; // Show sign-out button
                addCarBtn.style.display = "inline-block"; // Show add car button
                adminBtn.style.display = "inline-block"; // Show admin button
            } else {
                contentDiv.innerHTML = "Welcome! Please login or sign up.";
                signOutBtn.style.display = "none";  // Hide sign-out button
                addCarBtn.style.display = "none";  // Hide add car button
                adminBtn.style.display = "none";  // Hide admin button
                loginBtn.style.display = "inline-block"; // Show login button
                signUpBtn.style.display = "inline-block"; // Show sign-up button
            }
        })

    // Sign-out button functionality
    signOutBtn.onclick = function() {
        fetch('resources/php/authentication/signout.php')
            .then(function() {
                //location.reload();
                location.href = "index.php";
            });
    };
}