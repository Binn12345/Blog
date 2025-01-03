<script>
    
    $(document).ready(function () {
      $('#create').click(function (event) {
        event.preventDefault();
      
        var formData = $('#serial input, #serial select, #serial textarea').serialize();

        const feedbackElement = document.getElementById("usernameFeedback");
        const emailFeedback = document.getElementById("emailFeedback");
       
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
                  timer: 5000,
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
                $('#yourUsername').val('');
                $('#yourPassword').val('');
                $('#acceptTerms').prop('checked', false);
                feedbackElement.style.display = "none";
                emailFeedback.style.display = "none";
              } else {
              const Toast = Swal.mixin({
                              toast: true,
                              position: 'bottom-end',
                              showConfirmButton: false,
                              timer: 5000,
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
            // console.log(response);
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

        var formData = $('#login input, #login select, #login textarea').serialize();

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
                  timer: 2000,
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
                              timer: 5000,
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
                }
            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
                alert('An error occurred while creating the account.');
            }
          
         
        });
        
        // alert('Login successful');
        // console.log(formData);
    });


   
     
  </script>