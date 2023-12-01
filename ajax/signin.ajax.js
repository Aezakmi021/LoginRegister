const loginButton = document.getElementById("login");

loginButton.addEventListener('click', loginUser);

async function loginUser(e) {
    e.preventDefault();
    let username = document.getElementById("login-username").value;
    let password = document.getElementById("login-password").value;
    let loginParams = {
        "username": username,
        "password": password
    };
    let jsonString = JSON.stringify(loginParams);

    try {
        const response = await fetch("../includes/login.php", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: jsonString
        });
        
        if (response.ok) {
            const data = await response.json();
            
            if (data.error) {
                const currentURL = new URL(window.location.href);
                currentURL.search = ''; // Clears existing query parameters
                currentURL.searchParams.set('error', encodeURIComponent(data.error)); // Sets the new error parameter

                window.history.replaceState(null, null, currentURL.href);

                
                
                if(data.error == "emptyInputUsernameAndPassword")
                {
                    document.getElementById("login-username-paragraph").innerHTML = "This field is required!";
                    document.getElementById("login-password-paragraph").innerHTML = "This field is required!";
                }
                else if(data.error == "emptyInputUsername")
                {
                    document.getElementById("login-username-paragraph").innerHTML = "This field is required!";
                    document.getElementById("login-password-paragraph").innerHTML = "";
                }
                else if(data.error == "emptyInputPassword")
                {
                    document.getElementById("login-username-paragraph").innerHTML = "";
                    document.getElementById("login-password-paragraph").innerHTML = "This field is required!";
                }
                else if(data.error == "userNotFound")
                {
                    document.getElementById("login-username-paragraph").innerHTML = "User not found.";
                    document.getElementById("login-password-paragraph").innerHTML = "";
                }
                else if(data.error == "wrongPassword")
                {
                    document.getElementById("login-username-paragraph").innerHTML = "";
                    document.getElementById("login-password-paragraph").innerHTML = "Invalid password!";
                }

                // Handle the error
            } else if (data.success) {
                // No error, successful login
                console.log("Success");
                window.location.href = "../pages/index.page.php";
            } else {
                console.log("Unknown response format");
            }
        } else {
            console.error("Request failed. Status: " + response.status);
        }
    } catch (error) {
        console.error("Error:", error);
    }
}
