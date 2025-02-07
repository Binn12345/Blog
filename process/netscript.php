<script>
    // alert('')
  $(document).ready(function () {
      const feedbackElement = document.getElementById("usernameFeedback");
      const emailFeedback = document.getElementById("emailFeedback");
      const nameFeedback = document.getElementById("nameFeedback");
      const ppFeedback = document.getElementById("pFeedback");
      $('#create').click(function (event) {
        event.preventDefault();
        
        
        var formData = $('#serial input, #serial select, #serial textarea').serialize();

        
        $.ajax({
          url: 'process/dynamic.php',
          type: 'POST',
          data: formData,
          success: function (response) {
            // alert(response);
            if (response.status != 0) {
                const Toast = Swal.mixin({
                  toast: true,
                  position: 'bottom-end',
                  showConfirmButton: false,
                  timer: 2000,
                  background: '#59b259',
                  color: '#ffff',
                  timerProgressBar: true,
                  didOpen: (toast) => {
                    // Apply custom font size directly to the toast elements
                    const title = Swal.getTitle();
                    title.style.fontSize = '12.5px';
                    title.style.lineHeight  = '1.50'; // Change this to your desired font size

                    toast.addEventListener('mouseenter', Swal.resumeTimer);
                    toast.addEventListener('mouseleave', Swal.resumeTimer);
                  }
                });

                Toast.fire({
                  icon: 'success',
                  title: response.message
                });

                // Reset form fields
                $('#yourName').val('');
                $('#yourEmail').val('');
                $('#yourUsernameR').val('');
                $('#yourPassword').val('');
                $('#acceptTerms').prop('checked', false);
                feedbackElement.style.display = "none";
                emailFeedback.style.display = "none";
                playNotificationSoundAllFieldsIn();
              } else {
              const Toast = Swal.mixin({
                              toast: true,
                              position: 'bottom-end',
                              showConfirmButton: false,
                              timer: 2000,
                              background: '#f64341',
                              color: '#ffff',
                              timerProgressBar: true,
                              didOpen: (toast) => {
                                  // Apply custom font size directly to the toast elements
                                  const title = Swal.getTitle();
                                  title.style.fontSize = '12.5px';
                                  title.style.lineHeight  = '1.50'; // Change this to your desired font size

                                  toast.addEventListener('mouseenter', Swal.resumeTimer);
                                  toast.addEventListener('mouseleave', Swal.resumeTimer);
                              }
                          });
                          Toast.fire({
                              icon: 'warning',
                              title: response.message
                          });

                          feedbackElement.style.display = response.css;
                          emailFeedback.style.display = response.css;
                          nameFeedback.style.display = response.css;
                          ppFeedback.style.display = response.css;
                          playNotificationSoundAllFields();

            }
    
          },
          error: function (xhr, status, error) {
            console.error('Error:', error);
            alert('An error occurred while creating the account.');
          }
        });
      });


      




  });

  function checkUserEmailVal(key,val) {

      const feedbackElement = document.getElementById("usernameFeedback");
      const emailFeedback = document.getElementById("emailFeedback");
      
      var usernameContent = {
        hjob: "toUsername",
        key : key,
        value: val,
      }

      $.ajax({
        url: 'process/dynamic.php', 
        type: 'POST',
        data: usernameContent,
        success: function (response) {
    
          if(response.key == 'e'){
            if (response.status != 1 ) {
              /* css nya kumabaga append */
              emailFeedback.textContent = response.message;
              emailFeedback.style.color = "red";
              emailFeedback.style.display = "block";
            } else {
              
              emailFeedback.textContent = response.message;
              emailFeedback.style.color = "green";
              emailFeedback.style.display = "block";

            }
          } else {
            if (response.status != 1 ) {
              /* css nya kumabaga append */
              feedbackElement.textContent = response.message;
              feedbackElement.style.color = "red";
              feedbackElement.style.display = "block";
            } else {
              feedbackElement.textContent = response.message;
              feedbackElement.style.color = "green";
              feedbackElement.style.display = "block";

            }
          }
          


        },
        error: function (xhr, status, error) {
          console.error('Error:', error);
          alert('An error occurred while checking the username.');
        }
      });
      
  }

  $('#doLogin').click(function(e){
      e.preventDefault();
      const UsernameElement = document.getElementById("username-feedback");
      const PasswordElement = document.getElementById("password-feedback");

      // alert($('#yourUsername').val())
      if($('#yourUsername').val() == ""){
        // alert('Please enter your username');
        UsernameElement.textContent = "Please enter your username";
        UsernameElement.style.color = "red";
        UsernameElement.style.display = "block";
        return false;
      } else if ($('#yourPassword').val() == "") {

        PasswordElement.textContent = "Please enter your password";
        PasswordElement.style.color = "red";
        PasswordElement.style.display = "block";
        return false;

      } else if ($('#yourPassword').val() == "" && $('#yourPassword').val() == ""){
        // alert('Please enter your username and password');
        UsernameElement.textContent = "Please enter your username";
        UsernameElement.style.color = "red";
        UsernameElement.style.display = "block";
        PasswordElement.textContent = "Please enter your password";
        PasswordElement.style.color = "red";
        PasswordElement.style.display = "block";
        return false;
      } else {
        var formData = $('#login input, #login select, #login textarea').serialize();
        // console.log(formData[0]);
        $.ajax({
            url: 'process/dynamic.php',
            method : 'POST',
            data : formData,
            success: function (data) {
                console.log(data.messsage);
                if (data.status === 1) {
                    // Login successful


                    const Toast = Swal.mixin({
                  toast: true,
                  position: 'bottom-end',
                  showConfirmButton: false,
                  timer: 1500,
                  background: '#59b259',
                  color: '#ffff',
                  timerProgressBar: true,
                  didOpen: (toast) => {
                    // Apply custom font size directly to the toast elements
                    const title = Swal.getTitle();
                    title.style.fontSize = '15px';
                    title.style.lineHeight  = '1.50'; // Change this to your desired font size

                    toast.addEventListener('mouseenter', Swal.resumeTimer);
                    toast.addEventListener('mouseleave', Swal.resumeTimer);
                  }
                });

                Toast.fire({
                  icon: 'success',
                  title: data.message
                }).then(() => {
                      
                        window.location.href = 'site/';
                    });;
                    playNotificationSound();


                
                    // Swal.fire({
                    //     icon: 'success',
                    //     title: 'Success',
                    //     text: data.message,
                    //     timer: 3000,
                    //     showConfirmButton: false
                    // }).then(() => {
                    //     // Redirect to the welcome page
                    //     window.location.href = 'site/';
                    // });
                } else {
                    // Login failed
                    // Swal.fire({
                    //     icon: 'error',
                    //     title: 'Error',
                    //     text: data.message
                    // });

                        const Toast = Swal.mixin({
                              toast: true,
                              position: 'bottom-end',
                              showConfirmButton: false,
                              timer: 1500,
                              background: '#f64341',
                              color: '#ffff',
                              timerProgressBar: true,
                              didOpen: (toast) => {
                                  // Apply custom font size directly to the toast elements
                                  const title = Swal.getTitle();
                                  title.style.fontSize = '12.5px';
                                  title.style.lineHeight  = '1.50'; // Change this to your desired font size

                                  toast.addEventListener('mouseenter', Swal.resumeTimer);
                                  toast.addEventListener('mouseleave', Swal.resumeTimer);
                              }
                          });
                          Toast.fire({
                              icon: 'warning',
                              title: data.message
                          });
                          playLoginSound();
                          
                }
            },
            error: function (xhr, status, error) {
                console.error(error,status,error);
                alert('An error occurred while login the account.');

                playNotificationSoundE();
            }
          
          
        });
      }
      

    
      
      // alert('Login successful');
      // console.log(formData);

    
  });

  $(document).ready(function() {
      /* from login */
      const emailInput = document.getElementById("yourEmail");
      const emailElement = document.getElementById("emailFeedback");
      const UsernamelInput = document.getElementById("yourUsername");
      const usernamelElement = document.getElementById("username-feedback");
      /* from register */
      const usernameInput = document.getElementById('yourUsernameR');
      const passwordInput = document.getElementById('yourPassword');
      const UsernameElementE = document.getElementById("usernameFeedback");
      const PasswordElementE = document.getElementById("password-feedback");

      $('#yourEmail').click(function (e) {
        
          if ($(this).val() == "") {
            
            emailElement.textContent = "Please enter your email address";
            emailElement.style.color = "red";
            emailElement.style.display = "block";
          } else {
          
            if(emailElement.style.color == "red"){
              emailElement.style.color = "red";
              emailElement.style.display = "none";
            } else {
              emailElement.style.display = "block";
            }
          
          }
      });

      $('#yourUsername').click(function (e) {
        // console.log($(this).val());
        $('#yourUsername').on('input', function (e) {
          const inputValue = $(this).val(); 
          if (inputValue != "") {
            
            usernamelElement.textContent = "Please enter your username";
            usernamelElement.style.color = "red";
            usernamelElement.style.display = "none";
          }
        });
  
          if ($(this).val().trim() === "") {
            
            usernamelElement.textContent = "Please enter your username";
            usernamelElement.style.color = "red";
            usernamelElement.style.display = "block";
          } else {
    
            if(usernamelElement.style.color == "red"){
              usernamelElement.style.color = "red";
              usernamelElement.style.display = "none";
            } else {
              usernamelElement.style.display = "block";
            }
          
          }
      });


      if(usernameInput != null) {
        usernameInput.addEventListener('keypress', function (event) {
          $('#yourUsernameR').on('click', function (event) {
            if(UsernameElementE.style.color == "red"){
              UsernameElementE.style.display = "none";
            } else {
              UsernameElementE.style.display = "block";
            }
            return false;
          });
          UsernameElementE.style.display = "none";
          return false;
        });
      }

      // UsernamelInput.addEventListener('keypress', function (event) {
      //   // alert($(this).val());
      //   if($(this).val()){
      //     usernamelElement.style.display = "none";
      //   }
      // });
        
        // UsernamelInput.addEventListener('keypress', function (event) {
        //   $('#yourUsername').on('click', function (event) {
        //     if(usernamelElement.style.color == "red"){
        //       usernamelElement.style.display = "none";
        //     } else {
        //       usernamelElement.style.display = "block";
        //     }
        //     return false;
        //   });
        //   usernamelElement.style.display = "none";
        //   return false;
        // });
      
      
      
    
      
          
      // /* from register here */         // Attach the onkeypress event listener
      // usernameInput.addEventListener('keypress', function (event) {
      //   alert('Please enter your username');
      //       // UsernameElementE.style.display = "none";
      //       return false;
      // });
      // alert(passwordInput)
      if (PasswordElementE){
        passwordInput.addEventListener('keypress', function (event) {
            PasswordElementE.style.display = "none";
            return false;
        });
      }
  
      /* end of register trigger here */ 
  });

  document.addEventListener('DOMContentLoaded', function () {
    // Add event listener to the form
    const loginForm = document.getElementById('login');

    if (loginForm) {
      loginForm.addEventListener('keypress', function (event) {
        // Check if the Enter key was pressed
        if (event.key === 'Enter') {
          event.preventDefault(); // Prevent the default action
          const loginButton = document.getElementById('doLogin');
          if (loginButton) {
            loginButton.click(); // Simulate button click
          }
        }
      });
    }
  });

  var audio = new Audio('path/sound/denied.mp3');
  audio.muted = true;
  function playLoginSound() {
    audio.muted = false; // Unmute before playing
    audio.play().catch(function (error) {
      // Handle the error
      // console.error("Failed to play audio: " + error.message);
    });
  }

  function playNotificationSound() {
      var audio = new Audio('path/sound/granted.mp3');
      audio.play().catch(function(error) {
          // Handle playback errors
          console.error('Error playing notification sound: ' + error);
      });
  }

  function playNotificationSoundE() {
      var audio = new Audio('path/sound/error.mp3');
      audio.play().catch(function(error) {
          // Handle playback errors
          console.error('Error playing notification sound: ' + error);
      });
  }

  function playNotificationSoundAllFields() {
      var audio = new Audio('path/sound/error3.mp3');
      audio.play().catch(function(error) {
          console.error('Error playing notification sound: ' + error);
      });
  }

  function playNotificationSoundAllFieldsIn() {
      var audio = new Audio('path/sound/reg2.WAV');
      audio.play().catch(function(error) {
          console.error('Error playing notification sound: ' + error);
      });
  }

  document.getElementById('togglePassword').addEventListener('click', function () {
    const passwordInput = document.getElementById('yourPassword');
    const icon = this.querySelector('i');
  
    if (passwordInput.type === 'password') {
      passwordInput.type = 'text';
      icon.classList.remove('fa-eye');
      icon.classList.add('fa-eye-slash');
    } else {
      passwordInput.type = 'password';
      icon.classList.remove('fa-eye-slash');
      icon.classList.add('fa-eye');
    }
  });

</script>