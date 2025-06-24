const questions = [

    {
      type: "text",
      question: "What tag is used to create a line break in HTML?",
      correctAnswer: "br"
    },
    {
      type: "text",
      question: "Which HTML tag is used to insert an image?",
      correctAnswer: "img"
    },   
    {
      type: "text",
      question: "In CSS, which property controls the text size?",
      correctAnswer: "font-size"
    },
    {
      type: "text",
      question: "Which CSS property changes the background color?",
      correctAnswer: "background-color"
    },
    {
      type: "mcq",
      question: "Which HTML element is used for the largest heading?",
      answers: [
        { text: "h1", correct: true },
        { text: "h6", correct: false },
        { text: "heading", correct: false },
        { text: "head", correct: false }
      ]
    },
    {
      type: "mcq",
      question: "Which CSS property is used to make text bold?",
      answers: [
        { text: "font-weight", correct: true },
        { text: "text-style", correct: false },
        { text: "bold", correct: false },
        { text: "font-style", correct: false }
      ]
    },   
    {
      type: "mcq",
      question: "Which HTML tag creates a hyperlink?",
      answers: [
        { text: "a", correct: true },
        { text: "link", correct: false },
        { text: "href", correct: false },
        { text: "hyperlink", correct: false }
      ]
    },
    {
      type: "mcq",
      question: "Which CSS property adds space inside an element, between content and border?",
      answers: [
        { text: "padding", correct: true },
        { text: "margin", correct: false },
        { text: "border", correct: false },
        { text: "spacing", correct: false }
      ]
    }
  ];
  
  const questionElement = document.getElementById("question");
  const answerButtons = document.getElementById("answer-buttons");
  const nextButton = document.getElementById("next-btn");
  
  let currentQuestionIndex = 0;
  let score = 0;
  
  function startQuiz() {
    currentQuestionIndex = 0;
    score = 0;
    nextButton.innerHTML = "Next";
    showQuestion();
  }
  
  function showQuestion() {
    resetState();
    let currentQuestion = questions[currentQuestionIndex];
    let questionNo = currentQuestionIndex + 1;
    questionElement.innerHTML = questionNo + ". " + currentQuestion.question;
  
    if (currentQuestion.type === "mcq") {
      currentQuestion.answers.forEach(answer => {
        const button = document.createElement("button");
        button.innerHTML = answer.text;
        button.classList.add("btn");
        if (answer.correct) {
          button.dataset.correct = answer.correct;
        }
        button.addEventListener("click", selectAnswer);
        answerButtons.appendChild(button);
      });
    } else if (currentQuestion.type === "text") {
      const input = document.createElement("input");
      input.type = "text";
      input.placeholder = "Type your answer here...";
      input.classList.add("text-input");
      input.style.borderRadius = "5px"; 
      input.style.padding = "8px";      
      input.style.margin = "10px 0px";
      answerButtons.appendChild(input);
  
      const submitBtn = document.createElement("button");
      submitBtn.innerHTML = "Submit";
      submitBtn.classList.add("btn");
      submitBtn.addEventListener("click", () => checkTextAnswer(input.value));
      answerButtons.appendChild(submitBtn);
    }
  }
  
  function resetState() {
    nextButton.style.display = "none";
    while (answerButtons.firstChild) {
      answerButtons.removeChild(answerButtons.firstChild);
    }
  }
  
  function selectAnswer(e) {
    const selectedBtn = e.target;
    const isCorrect = selectedBtn.dataset.correct === "true";
    if (isCorrect) {
      selectedBtn.classList.add("correct");
      score++;
    } else {
      selectedBtn.classList.add("incorrect");
    }
    Array.from(answerButtons.children).forEach(button => {
      button.disabled = true;
    });
    nextButton.style.display = "block";
  }
  
  function checkTextAnswer(userAnswer) {
    let currentQuestion = questions[currentQuestionIndex];
    const message = document.createElement("div");
    message.classList.add("result-message");
  
    if (userAnswer.trim().toLowerCase() === currentQuestion.correctAnswer.toLowerCase()) {
      score++;
      message.innerHTML = " Correct!";
      message.style.color = "green";
    } else {
      message.innerHTML = " Wrong answer!";
      message.style.color = "red";
    }
  
    answerButtons.appendChild(message);
    nextButton.style.display = "block";
    Array.from(answerButtons.children).forEach(child => {
      child.disabled = true;
    });
  }
  
  function saveScore() {
  
    fetch("../php/save_score.php", {
      method: "POST",
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'  // This tells the server we're sending form data
    },
      body: `score=${encodeURIComponent(score)}`  // Send score as form data
    })
    .then(response => response.text())
    .then(data => {
      alert("Score saved successfully!");
      console.log("Score saved:", data);
    })
    .catch(error => {
      alert("Error saving score: " + error);
      console.error("Error saving score:", error);
    });
  }
  
  function showScore() {
    resetState();
    questionElement.innerHTML = `You scored ${score} out of ${questions.length}!`;
    nextButton.innerHTML = "Play Again";
    nextButton.style.display = "block";

    saveScore();
  }
  
  function handleNextButton() {
    currentQuestionIndex++;
    if (currentQuestionIndex < questions.length) {
      showQuestion();
    } else {
      showScore();
    }
  }
  
  nextButton.addEventListener("click", () => {
    if (currentQuestionIndex < questions.length) {
      handleNextButton();
    } else {
      startQuiz();
    }
  });
  
  startQuiz();
  
    
  