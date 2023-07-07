$(document).ready(function() {
   $("#show-hide-filters").on("click",function(){
        if($(".show-filters").is(":visible")){
            $("#button-filters").removeClass("ni ni-bold-up")
            $("#button-filters").addClass("ni ni-bold-down")
        }else if($(".show-filters").is(":hidden")){
            $("#button-filters").removeClass("ni ni-bold-down")
            $("#button-filters").addClass("ni ni-bold-up")
        }
        $(".show-filters").slideToggle();
    });
    // Define variables
    var questionElement = $("#question");
    var choicesElement = $("#choices");
    var submitBtn = $("#start-quiz");
    var feedbackElement = $("#feedback");
    var currentQuestion = 0;
    var score = 0;
    var quiz = [];
  
    // Fetch quiz questions from the API based on user-selected options
    function fetchQuizQuestions(amount, category, type, difficulty) {
      currentQuestion = 0;
      score = 0;
      var apiUrl = GET_QUESTIONS_API +
        "?no_of_questions="+
        amount +
        "&category=" +
        category +
        "&type=" +
        type +
        "&difficulty=" +
        difficulty;
      
      $.ajax({
        url: apiUrl,
        type: "GET",
        dataType: "json",
        success: function(response) {
          if (response.status) {
            var questions = response.data;
            // Process the fetched questions and create a quiz array
            quiz = questions.map(function(question) {
              var choices = JSON.parse(question.choices);
              // Shuffle the choices array using Fisher-Yates algorithm
              var correctAnswer = choices[question.answer];
              for (var i = choices.length - 1; i > 0; i--) {
                var randomIndex = Math.floor(Math.random() * (i + 1));
                var temp = choices[i];
                choices[i] = choices[randomIndex];
                choices[randomIndex] = temp;
              }
  
              var correctAnswer = choices.indexOf(correctAnswer);
  
              return {
                question: question.question,
                choices: choices,
                correctAnswer: correctAnswer
              };
            });
  
              
            startQuiz(); // Start the quiz
          } else {
            console.log("Failed to fetch quiz questions");
          }
        },
        error: function(error) {
          console.log("Error:", error);
        }
      });
    }
  
    // Fetch the list of categories from the API
    function fetchCategories() {
      
      $.ajax({
        url: GET_CATEGORIES_API,
        type: "GET",
        dataType: "json",
        success: function(response) {
          if (response.data) {
            var categories = response.data;
            // Populate the category dropdown
            var categoryDropdown = $("#category_id");
            categoryDropdown.empty();
  
            $.each(categories, function(index, category) {
              categoryDropdown.append($("<option>").val(index).text(category));
            });
          } else {
            console.log("Failed to fetch categories.");
          }
        },
        error: function(error) {
          console.log("Error:", error);
        }
      });
    }
  
    // Start the quiz
    function startQuiz() {
      // Display the current question and choices
      function showQuestion() {
        var question = quiz[currentQuestion];
  
        // Update question and choices
          if (question) {
          questionElement.html(question.question);
          choicesElement.empty();
  
          // Create radio buttons for choices
          for (var i = 0; i < question.choices.length; i++) {
              var choice = question.choices[i];
              var radioBtn = $("<div class='form-check mb-3'><input class='form-check-input' type='radio' name='choice' id='choice_" + i + "' value='" + i + "'><label class='custom-control-label' for='choice_" + i + "'>"+choice+"</label></div>");
              // var listItem = $("<li>").text(choice);
              // listItem.prepend(radioBtn);
              choicesElement.append(radioBtn);
          }
          }
      }
  
      // Check the selected answer and provide feedback
      function checkAnswer() {
        var selectedChoice = $("input[name='choice']:checked").val();
        if (selectedChoice === undefined) {
          feedbackElement.removeClass('badge-success').addClass('badge-warning').text("Please select an answer.");
        } else {
          var question = quiz[currentQuestion];
          var correctAnswer = question.correctAnswer;
          if (parseInt(selectedChoice) === correctAnswer) {
            score++;
            feedbackElement.removeClass('badge-warning').addClass('badge-success').text("Correct!");
          } else {
            feedbackElement.removeClass('badge-success').addClass('badge-warning').text("Wrong answer. The correct answer is: " + question.choices[correctAnswer]);
          }
  
          currentQuestion++;
  
          if (currentQuestion < quiz.length) {
            showQuestion();
          } else {
            showResult();
          }
        }
      }
  
      // Display the final score
      function showResult() {
        questionElement.text("Quiz completed!");
        choicesElement.empty();
        $('#checkBtn').hide();
        $('#lottieAnimation').show();
        if(score >= quiz.length-1){
            var animation = lottie.loadAnimation({
              container: document.getElementById('lottieAnimation'),
              renderer: 'svg',
              loop: false,
              autoplay: true,
              path: '{{ asset("assets") }}/img/defaults/success.json'
            });
            feedbackElement.removeClass('badge-warning').addClass('badge-success').text("Your score: " + score + "/" + quiz.length);
          }else {
              var animation = lottie.loadAnimation({
              container: document.getElementById('lottieAnimation'),
              renderer: 'svg',
              loop: false,
              autoplay: true,
              path: '{{ asset("assets") }}/img/defaults/failed.json'
            });            
            feedbackElement.removeClass('badge-success').addClass('badge-warning').text("Your score: " + score + "/" + quiz.length);
          }
  
        // Prepare the data to be sent
        var category = $("#category_id").val();
        var candidate_id = $("#candidate_id").val();
          var postData = {
            candidate_id:candidate_id,
            category_id: category,
            total: quiz.length,
            score: score
          };
  
          $.ajax({
            url: COMPLETE_QUIZ_API,
            type: "POST",
            data: postData,
            success: function(response) {
              console.log(response);
            },
            error: function(error) {
              console.log("Error:", error);
            }
          });
      }
  
      // Handle button click event for checking the answer
      $("#checkBtn").off("click").on("click", checkAnswer);
  
      // Display the first question
      showQuestion();
  
      $('#checkBtn').show();
      $('.quiz-section').show();
      $('#lottieAnimation').empty().hide();
      $('#feedback').empty();
    }
  
    // Handle button click event for starting the quiz
    submitBtn.click(function() {
      var amount = $("#question_no").val();
      var category = $("#category_id").val();
      var type = $("#type").val();
      var difficulty = $("#difficulty").val();
  
      fetchQuizQuestions(amount, category, type, difficulty);
    });
  
    // Fetch the categories when the page is loaded
    fetchCategories();
  });