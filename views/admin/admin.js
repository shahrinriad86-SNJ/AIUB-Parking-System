document.getElementById("logoutBtn").addEventListener("click", function()
{
fetch("../../controllers/logoutController.php")
.then(function(response)
{
window.location.href = "../authentication/login.php";
})
.catch(function(error)
{
window.location.href = "../authentication/login.php";
});
});
