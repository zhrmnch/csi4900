// Define a variable to keep track of the current email index
var currentEmail = 1;

// Define an array to keep track of the user's answers
var answers = [];
var answersCSV = [];
var finalAnswerCSV = [];

function downloadCSV(array) {
    const csv = array.map(row => row.join(",")).join("\n");
    const blob = new Blob([csv], {type: "text/csv"});
    const url = URL.createObjectURL(blob);
    const a = document.createElement("a");
    a.href = url;
    a.download = "results.csv";
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    URL.revokeObjectURL(url);
  }

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
    if ((selectedValue === "phishing" && currentEmail === 1) || // email_60
        (selectedValue === "phishing" && currentEmail === 2)|| // email_73
        (selectedValue === "non-phishing" && currentEmail === 3) || // email_35
        (selectedValue === "phishing" && currentEmail === 4) || // email_51
        (selectedValue === "non-phishing" && currentEmail === 5) || // email_48
        (selectedValue === "phishing" && currentEmail === 6) || // email_58
        (selectedValue === "phishing" && currentEmail === 7) || // email 63
        (selectedValue === "non-phishing" && currentEmail === 8) // email_67
        ) {
        answers.push(currentEmail + " -> Correct -> Time: " + timeSpent / 1000 + " seconds");
        answersCSV.push("Correct");
    } else {
        answers.push(currentEmail + " -> Wrong -> Time: " + timeSpent / 1000 + " seconds");
        answersCSV.push("Wrong");
    }
    answersCSV.push(timeSpent/1000)

    // Clear radio button values
    var ele = document.querySelectorAll("input[type=radio]");
    for (var i = 0; i < ele.length; i++) {
        ele[i].checked = false;
    }

    if (currentEmail == 8) {
        // Display the user's results when they reach the end of the emails
        testTimeSpent = Date.now() - testStart;
        answersCSV.push(testTimeSpent/1000);
        finalAnswerCSV.push(["Q1A","Q1T","Q2A","Q2T","Q3A","Q3T","Q4A","Q4T","Q5A","Q5T","Q6A","Q6T","Q7A","Q7T","Q8A","Q8T","TotalT"])
        finalAnswerCSV.push(answersCSV)
        console.log(finalAnswerCSV)
        downloadCSV(finalAnswerCSV);
        answers.push("Quiz Complete. Total time spent: " + testTimeSpent / 1000 + " seconds");
        alert(answers.join("\n"));
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
    iframe.src = "email_test1/email_" + currentEmail + ".html";

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
iframe.src = "email_test1/email_1.html";

// Add the iframe element to the container
container.appendChild(iframe);

// Record the start time for the first question
var questionStart = Date.now();

// Record the start time for the test
var testStart = Date.now();