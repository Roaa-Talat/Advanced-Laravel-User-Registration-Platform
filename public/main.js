// Define variables for form fields
let fullName = document.getElementById("fullname");
let username = document.getElementById("username");
let birthdate = document.getElementById("birthdate");
let email = document.getElementById("email");
let phoneNumber = document.getElementById("phoneNumber");
let address = document.getElementById("address");
let password = document.getElementById("password");
let confirmPassword = document.getElementById("confirmPassword");

// Define variables for error messages
let mailErrorMsg = document.querySelector(".mail-error-msg");
let phoneNumberErrorMsg = document.querySelector(".phone-error-msg");
let passwordErrorMsg = document.querySelector(".password-error-msg");
let confirmPasswordErrorMsg = document.querySelector(".confirm-password-error-msg");
let birthdateErrorMsg = document.querySelector(".birthdate-error-msg");

// Function to validate email
function validateEmail(email) {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  if (email.value === "") {
    email.classList.add("wrong");
    mailErrorMsg.innerHTML = "Email is required";
    mailErrorMsg.classList.remove("d-none");
    mailErrorMsg.classList.add("error");
    return false;
  }

  if (!emailRegex.test(email.value)) {
    email.classList.add("wrong");
    mailErrorMsg.innerHTML = "Email must be in the format: example@example.com";
    mailErrorMsg.classList.remove("d-none");
    mailErrorMsg.classList.add("error");
    return false;
  }

  email.classList.remove("wrong");
  mailErrorMsg.classList.add("d-none");
  mailErrorMsg.innerHTML = "";

  return true;
}

// Function to validate phone number
function validatePhoneNumber(phoneNumber) {
  const phoneRegex = /^01[1250][0-9]{8}$/;

  if (phoneNumber.value === "") {
    phoneNumber.classList.add("wrong");
    phoneNumberErrorMsg.innerHTML = "Phone number is required";
    phoneNumberErrorMsg.classList.remove("d-none");
    phoneNumberErrorMsg.classList.add("error");
    return false;
  }

  if (!phoneRegex.test(phoneNumber.value)) {
    phoneNumber.classList.add("wrong");
    phoneNumberErrorMsg.innerHTML = "Phone number must be in the format: 01XXXXXXXXX";
    phoneNumberErrorMsg.classList.remove("d-none");
    phoneNumberErrorMsg.classList.add("error");
    return false;
  }

  phoneNumber.classList.remove("wrong");
  phoneNumberErrorMsg.classList.add("d-none");
  phoneNumberErrorMsg.innerHTML = "";
  return true;
}

// Function to validate password
function validatePassword(password) {
  const passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[$%&@!]).{8,}$/;

  if (password.value === "") {
    password.classList.add("wrong");
    passwordErrorMsg.innerHTML = "Password is required";
    passwordErrorMsg.classList.remove("d-none");
    passwordErrorMsg.classList.add("error");
    return false;
  }

  if (!passwordRegex.test(password.value)) {
    password.classList.add("wrong");
    passwordErrorMsg.innerHTML = "Password must contain at least 8 characters, including letters and numbers";
    passwordErrorMsg.classList.remove("d-none");
    passwordErrorMsg.classList.add("error");
    return false;
  }

  password.classList.remove("wrong");
  passwordErrorMsg.classList.add("d-none");
  passwordErrorMsg.innerHTML = "";
  return true;
}

// Function to check password confirmation
function checkRepassword() {
  if (confirmPassword.value === password.value) {
    confirmPassword.classList.remove("wrong");
    confirmPasswordErrorMsg.classList.add("d-none");
    confirmPasswordErrorMsg.innerHTML = "";
    return true;
  } else {
    confirmPassword.classList.add("wrong");
    confirmPasswordErrorMsg.classList.remove("d-none");
    confirmPasswordErrorMsg.classList.add("error");
    confirmPasswordErrorMsg.innerHTML = "Passwords do not match";
    return false;
  }
}

// Function to validate birthdate
function validateBirthdate(birthdate) {
  if (birthdate.value === "") {
    birthdate.classList.add("wrong");
    birthdateErrorMsg.innerHTML = "Birthdate is required";
    birthdateErrorMsg.classList.remove("d-none");
    birthdateErrorMsg.classList.add("error");
    return false;
  }

  const currentDate = new Date();
  const enteredDate = new Date(birthdate.value);
  const ageDiff = currentDate.getFullYear() - enteredDate.getFullYear();

  if (ageDiff < 18) {
    birthdate.classList.add("wrong");
    birthdateErrorMsg.innerHTML = "You must be at least 18 years old";
    birthdateErrorMsg.classList.remove("d-none");
    birthdateErrorMsg.classList.add("error");
    return false;
  }

  birthdate.classList.remove("wrong");
  birthdateErrorMsg.classList.add("d-none");
  birthdateErrorMsg.innerHTML = "";
  return true;
}

// Event listener for checking email validity
email.addEventListener("input", () => {
  validateEmail(email);
});

email.addEventListener("blur", () => {
  validateEmail(email);
});

// Event listener for checking phone number validity
phoneNumber.addEventListener("input", () => {
  validatePhoneNumber(phoneNumber);
});

phoneNumber.addEventListener("blur", () => {
  validatePhoneNumber(phoneNumber);
});

// Event listener for checking password validity
password.addEventListener("input", () => {
  validatePassword(password);
});

password.addEventListener("blur", () => {
  validatePassword(password);
});

// Event listener for checking password confirmation
confirmPassword.addEventListener("input", () => {
  checkRepassword();
});

confirmPassword.addEventListener("blur", () => {
  checkRepassword();
});

// Event listener for checking birthdate validity
birthdate.addEventListener("input", () => {
  validateBirthdate(birthdate);
});

birthdate.addEventListener("blur", () => {
  validateBirthdate(birthdate);
});

// Event listener for showing names on button click
document.addEventListener("DOMContentLoaded", function () {
  document.getElementById("show_names_button").addEventListener("click", function () {
    var birthdateValue = document.getElementById("birthdate").value;
    if (!validateBirthdate(birthdate)) {
      return false;
    }
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../../Service/api.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        var modal = document.getElementById("customPopup");
        var popupContent = document.getElementById("popupContent");
        popupContent.innerHTML = xhr.responseText;
        modal.style.display = "block";

        var closeBtn = document.getElementsByClassName("close")[0];
        closeBtn.onclick = function () {
          modal.style.display = "none";
        }
      }
    };
    xhr.send("birthdate=" + birthdateValue);
  });
});

document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("userImage").addEventListener("change", function() {
        var formData = new FormData();
        var userImage = document.getElementById("userImage").files[0];
        formData.append("userImage", userImage);

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../../Service/Upload.php", true);

        // Set the appropriate headers
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    var contentType = xhr.getResponseHeader("Content-Type");
                    if (contentType && contentType.indexOf("application/json") !== -1) {
                        var response = JSON.parse(xhr.responseText);
                        if (response.status === 'success') {
                            alert(response.message);
                        } else {
                            alert(response.message);
                        }
                    } else {
                        // Handle image response here
                        console.log("Image uploaded successfully!");
                    }
                } else {
                    console.log('Error occurred during the upload. Please try again.');
                }
            }
        };
        xhr.send(formData);
    });
});


function previewImage() {
  const preview = document.getElementById('imagePreview');
  const fileInput = document.getElementById('userImage');
  const file = fileInput.files[0];
  const reader = new FileReader();

  reader.onload = function(event) {
      document.getElementById('chooseImageText').style.display = 'none';
      preview.style.display = 'block';
      preview.src = event.target.result;
  };

  if (file) {
      reader.readAsDataURL(file);
  }
}