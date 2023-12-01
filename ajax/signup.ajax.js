const signupBtn = document.getElementById("register");

signupBtn.addEventListener('click', createUser);

async function createUser(e) {
    e.preventDefault();
    let username = document.getElementById("signup-username").value;
    let email = document.getElementById("signup-email").value;
    let password = document.getElementById("signup-password").value;
    let confirmPassword = document.getElementById("signup-confirmpassword").value;

    let signupParams = {
        "username": username,
        "email": email,
        "password": password,
        "confirmPassword": confirmPassword 
    };

    let jsonString = JSON.stringify(signupParams);

    try {
        const response = await fetch("../includes/signup.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: jsonString
        });

        if (response.ok) {
            const data = await response.json();

            if(data.error)
            {
                const currentURL = new URL(window.location.href);
                currentURL.search = ''; // Clears existing query parameters
                currentURL.searchParams.set('error', encodeURIComponent(data.error)); // Sets the new error parameter

                window.history.replaceState(null, null, currentURL.href);

                if(data.error == "emptyInput")
                {
                    document.getElementById("signup-username-paragraph").innerHTML = "All field are required!";
                    document.getElementById("signup-email-paragraph").innerHTML = "";
                    document.getElementById("signup-password-paragraph").innerHTML = "";
                    document.getElementById("signup-confirmpassword-paragraph").innerHTML = "";
                }else if(data.error == "invalidUsername")
                {
                    document.getElementById("signup-username-paragraph").innerHTML = "This username is invalid!";
                    document.getElementById("signup-email-paragraph").innerHTML = "";
                    document.getElementById("signup-password-paragraph").innerHTML = "";
                    document.getElementById("signup-confirmpassword-paragraph").innerHTML = "";
                }else if(data.error == "invalidEmail")
                {
                    document.getElementById("signup-username-paragraph").innerHTML = "";
                    document.getElementById("signup-email-paragraph").innerHTML = "This email is invalid!";
                    document.getElementById("signup-password-paragraph").innerHTML = "";
                    document.getElementById("signup-confirmpassword-paragraph").innerHTML = "";
                }else if(data.error == "passwordMatch")
                {
                    document.getElementById("signup-username-paragraph").innerHTML = "";
                    document.getElementById("signup-email-paragraph").innerHTML = "";
                    document.getElementById("signup-password-paragraph").innerHTML = "";
                    document.getElementById("signup-confirmpassword-paragraph").innerHTML = "Passwords must match!";
                }else if(data.error == "usernameTaken")
                {
                    document.getElementById("signup-username-paragraph").innerHTML = "This username is taken!";
                    document.getElementById("signup-email-paragraph").innerHTML = "";
                    document.getElementById("signup-password-paragraph").innerHTML = "";
                    document.getElementById("signup-confirmpassword-paragraph").innerHTML = "";
                }

            }else if(data.success)
            {
                const signupForm = document.getElementById("signup-form");

                // Reset the form to clear input fields
                signupForm.reset();

                // You can also clear the error messages if any
                document.getElementById("signup-username-paragraph").innerHTML = "";
                document.getElementById("signup-email-paragraph").innerHTML = "";
                document.getElementById("signup-password-paragraph").innerHTML = "";
                document.getElementById("signup-confirmpassword-paragraph").innerHTML = "";

                alert("User succesfully created!");

            }else
            {
                console.log("Unknown response format");
            }

        }

    } catch (error) {
        console.error("Error:", error);
    }
}
