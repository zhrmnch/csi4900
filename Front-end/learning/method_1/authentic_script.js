

function nextEmail() {
    toggleButton();
    var timeSpent = Date.now() - questionStart;
    answers.push(currentEmail + " Time: " + timeSpent / 1000 + " seconds");
    answersCSV.push(timeSpent/1000);
    answersCSV.push(hoverQuestion);
    totalHover += hoverQuestion;
    hoverQuestion = 0;

    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
        checkboxes[i].checked = false;
    }
    document.getElementById("result").innerHTML = "";


    if (currentEmail == 8) {
        testTimeSpent = Date.now() - testStart;
        answersCSV.push(testTimeSpent/1000);
        answersCSV.push(totalHover);
        finalAnswerCSV.push(["Q1T","Q1H","Q2T","Q2H","Q3T","Q3H","Q4T","Q4H","Q5T","Q5H","Q6T","Q6H","Q7T","Q7H","Q8T","Q8H","TotalT","TotalH"]);
        finalAnswerCSV.push(answersCSV);
        const jsonString = JSON.stringify(finalAnswerCSV);
        const encodedParam = encodeURIComponent(jsonString);
        answers.push("Quiz Complete. Total time spent: " + testTimeSpent / 1000 + " seconds");
        var xhr = new XMLHttpRequest();
        xhr.open("POST","../../../Back-end/test_info/learning_save_answer.php",true);
        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.send(JSON.stringify(answers.join("\n")));
        alert(answers.join("\n"));
        window.location.href = 'comments.html?data=' + encodedParam;
    } else {
        currentEmail++;
    }
    
    // iframe
    var container = document.getElementById("email-container");
    container.innerHTML = "";
    var iframe = document.createElement("iframe");
    iframe.src = "email_learn/email_" + currentEmail + ".html";
    container.appendChild(iframe);
    questionStart = Date.now();
}

function toggleButton() {
    var button = document.getElementById("next-email");
    if (button.style.visibility === "hidden") {
      button.style.visibility = "visible";
    } else {
      button.style.visibility = "hidden";
    }  
}

document.getElementById("quiz-form").addEventListener("submit", function (event) {
    event.preventDefault();
    let checkboxes = document.querySelectorAll('input[type=checkbox]:checked');
    let selectedAnswers  = [];
    let incorrectAnswers = [];

    for (var i = 0; i < checkboxes.length; i++) {
        selectedAnswers.push(checkboxes[i].name);
    }

    let isCorrect = []
    if (currentEmail === 1) {
        isCorrect = correctAnswers1.every(answer => selectedAnswers.includes(answer));
        incorrectAnswers = correctAnswers1.filter(answer => !selectedAnswers.includes(answer));
    } else if (currentEmail === 2) {
        isCorrect = correctAnswers2.every(answer => selectedAnswers.includes(answer));
        incorrectAnswers = correctAnswers2.filter(answer => !selectedAnswers.includes(answer));
    } else if (currentEmail === 3) {
        isCorrect = correctAnswers3.every(answer => selectedAnswers.includes(answer));
        incorrectAnswers = correctAnswers3.filter(answer => !selectedAnswers.includes(answer));
    } else if (currentEmail === 4) {
        isCorrect = correctAnswers4.every(answer => selectedAnswers.includes(answer));
        incorrectAnswers = correctAnswers4.filter(answer => !selectedAnswers.includes(answer));
    } else if (currentEmail === 5) {
        isCorrect = correctAnswers5.every(answer => selectedAnswers.includes(answer));
        incorrectAnswers = correctAnswers5.filter(answer => !selectedAnswers.includes(answer));
    } else if (currentEmail === 6) {
        isCorrect = correctAnswers6.every(answer => selectedAnswers.includes(answer));
        incorrectAnswers = correctAnswers6.filter(answer => !selectedAnswers.includes(answer));
    } else if (currentEmail === 7) {
        isCorrect = correctAnswers7.every(answer => selectedAnswers.includes(answer));
        incorrectAnswers = correctAnswers7.filter(answer => !selectedAnswers.includes(answer));
    } else if (currentEmail === 8) {
        isCorrect = correctAnswers8.every(answer => selectedAnswers.includes(answer));
        incorrectAnswers = correctAnswers8.filter(answer => !selectedAnswers.includes(answer));
    } 

    for (var i = 0; i < incorrectAnswers.length; i++) {
        incorrectAnswers[i] = answersDict[incorrectAnswers[i]];
    }
    
    if (!isCorrect) {
        document.getElementById("result").innerHTML = `You got the following answers wrong: ${incorrectAnswers.join(', ')}.`;
    } else {
        document.getElementById("result").innerHTML ='Congratulations, you got all the answers correct!';
        toggleButton();
    }
});


let answersDict = {"general-language":"General Language", "spelling-grammatical-errors":"Spelling/Grammatical Errors",
 "spoofed-email-sender":"Spoofed Email Sender", "urgent-language":"Urgent Language", "wrong-redirect":"Wrong Redirect"};
let correctAnswers1 = ["urgent-language", "wrong-redirect"]; // email_93
let correctAnswers2 = ["general-language", "spoofed-email-sender"]; // email_94
let correctAnswers3 = ["general-language", "spelling-grammatical-errors", "wrong-redirect"]; // email_96
let correctAnswers4 = ["spelling-grammatical-errors", "general-language", "urgent-language"]; // email_133
let correctAnswers5 = ["spoofed-email-sender", "wrong-redirect"]; // email_137
let correctAnswers6 = ["wrong-redirect", "urgent-language"]; // email_137
let correctAnswers7 = ["wrong-redirect", "spoofed-email-sender"]; // email_137
let correctAnswers8 = ["general-language", "wrong-redirect", "spoofed-email-sender"]; // email_137

var answers = [];
var answersCSV = [];
var finalAnswerCSV = [];
var hoverTimes = []


// iframe
var currentEmail = 1;
var container = document.getElementById("email-container");
container.innerHTML = "";
var iframe = document.createElement("iframe");
iframe.src = "email_learn/email_1.html";
container.appendChild(iframe);

var questionStart = Date.now();
var testStart = Date.now();
var hoverStart = 0;
var hoverQuestion = 0;
var totalHover = 0;

const labels = document.querySelectorAll('label');
labels.forEach(label => {
  label.addEventListener('mouseenter', () => {
    hoverStart = new Date();
  });

  label.addEventListener('mouseleave', () => {
    const hoverEnd = new Date();
    const hoverTime = (hoverEnd - hoverStart)/1000;
    hoverQuestion += hoverTime;
    console.log(hoverTime)
  });
});
