const logoutButton = document.getElementById("logout-button");


logoutButton.addEventListener('click', logoutUser);

async function logoutUser(e)
{
    e.preventDefault();

    try {
        const response = await fetch("../includes/logout.php", {
            method:"GET",
            headers:{
                "Content-type": "application,json"
            }
        });

        if (response.ok)
        {
            window.location.href = "../pages/loginRegister.page.php";
        }
        else
        {
            console.error("Request failed. Status: " + response.status);
        }
    } catch (error) {
        console.error("Error:", error);
    }

}

