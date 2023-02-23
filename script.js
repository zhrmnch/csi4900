// Define a variable to keep track of the current email index
var currentEmail = 1;

// Define an array to keep track of the user's answers
var answers = [];

// Define a function to embed the next email
function nextEmail() {

    // Get the value of the selected radio button
    var selectedValue = document.querySelector('input[name="phishing"]:checked');

    if (!selectedValue) {
        alert("Please select an option");
        return;
    }

    selectedValue = selectedValue.value;
    // Calculate the time spent on the question
    var timeSpent = Date.now() - questionStart;

    // Check if the selected value matches the answer for the current email
    if ((selectedValue === "phishing" && currentEmail === 1) ||
        (selectedValue === "non-phishing" && currentEmail === 2)) {
        answers.push(currentEmail + " -> Correct -> Time: " + timeSpent / 1000 + " seconds");
    } else {
        answers.push(currentEmail + " -> Wrong -> Time: " + timeSpent / 1000 + " seconds");
    }

    // Clear radio button values
    var ele = document.querySelectorAll("input[type=radio]");
    for (var i = 0; i < ele.length; i++) {
        ele[i].checked = false;
    }

    if (currentEmail == 2) {
        // Display the user's results when they reach the end of the emails
        alert("Quiz complete! Results:\n" + answers.join("\n"));
        currentEmail = 1;
    } else {
        currentEmail++;
    }

    // Find the email container element
    var container = document.getElementById("email-container");

    // Remove the previous iframe element from the container, if any
    container.innerHTML = "";

    // Create an iframe element to embed the email HTML file
    var iframe = document.createElement("iframe");
    iframe.src = "emails/email" + currentEmail + ".html";

    // Add the iframe element to the container
    container.appendChild(iframe);

    // Record the start time for the next question
    questionStart = Date.now();
}

// Embed the first email on page load
// Find the email container element
var container = document.getElementById("email-container");

// Remove the previous iframe element from the container, if any
container.innerHTML = "";

// Create an iframe element to embed the email HTML file
var iframe = document.createElement("iframe");
iframe.src = "emails/email1.html";

// Add the iframe element to the container
container.appendChild(iframe);

// Record the start time for the first question
var questionStart = Date.now();