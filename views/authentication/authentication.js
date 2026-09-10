let loginForm = document.getElementById("loginForm");

if (loginForm)
{
    loginForm.addEventListener("submit", function(event)
    {
        event.preventDefault();

        document.getElementById("emailErr").innerHTML = "";
        document.getElementById("passwordErr").innerHTML = "";
        document.getElementById("loginErr").innerHTML = "";

        let email = document.getElementById("email").value.trim();
        let password = document.getElementById("password").value;

        let valid = true;

        if (email == "")
        {
            document.getElementById("emailErr").innerHTML = "Email is required";
            valid = false;
        }

        if (password == "")
        {
            document.getElementById("passwordErr").innerHTML = "Password is required";
            valid = false;
        }

        if (!valid)
        {
            return;
        }

        let formData = new FormData();

        formData.append("email", email);
        formData.append("password", password);

        fetch("../../controllers/loginController.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data =>
        {
            if (data.success)
            {
                if (data.role == "admin")
                {
                    window.location.href = "../admin/dashboard.php";
                }
                else if (data.role == "staff")
                {
                    window.location.href = "../staff/dashboard.php";
                }
                else if (data.role == "student")
                {
                    window.location.href = "../student/dashboard.php";
                }
            }
            else
            {
                document.getElementById("loginErr").innerHTML = data.message;
            }
        })
        .catch(error =>
        {
            document.getElementById("loginErr").innerHTML = "Something went wrong";
        });
    });
}


let forgotPasswordForm = document.getElementById("forgotPasswordForm");

if (forgotPasswordForm)
{
    forgotPasswordForm.addEventListener("submit", function(event)
    {
        event.preventDefault();

        document.getElementById("emailErr").innerHTML = "";
        document.getElementById("passwordErr").innerHTML = "";
        document.getElementById("confirmPasswordErr").innerHTML = "";
        document.getElementById("forgotPasswordErr").innerHTML = "";

        let email = document.getElementById("email").value.trim();
        let password = document.getElementById("password").value;
        let confirmPassword = document.getElementById("confirmPassword").value;

        let valid = true;

        if (email == "")
        {
            document.getElementById("emailErr").innerHTML = "Email is required";
            valid = false;
        }

        if (password == "")
        {
            document.getElementById("passwordErr").innerHTML = "New password is required";
            valid = false;
        }

        if (confirmPassword == "")
        {
            document.getElementById("confirmPasswordErr").innerHTML = "Confirm password is required";
            valid = false;
        }

        if (password != "" && confirmPassword != "" && password != confirmPassword)
        {
            document.getElementById("confirmPasswordErr").innerHTML = "Passwords do not match";
            valid = false;
        }

        if (!valid)
        {
            return;
        }

        let formData = new FormData();

        formData.append("email", email);
        formData.append("password", password);

        fetch("../../controllers/forgotPasswordController.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())

        
        .then(data =>
        {
            if (data.success === true)
            {
                document.getElementById("forgotPasswordErr").style.color = "green";
                document.getElementById("forgotPasswordErr").innerHTML = "Password changed successfully!";

                setTimeout(function()
                {
                    window.location.href = "login.php";
                }, 1500);
            }
            else
            {
                document.getElementById("forgotPasswordErr").style.color = "#d32f2f";

                if (data.message)
                {
                    document.getElementById("forgotPasswordErr").innerHTML = data.message;
                }
                else
                {
                    document.getElementById("forgotPasswordErr").innerHTML = "Password change failed";
                }
            }
        })
        .catch(error =>
        {
            document.getElementById("forgotPasswordErr").style.color = "#d32f2f";
            document.getElementById("forgotPasswordErr").innerHTML = "Something went wrong";
        });
    });
}