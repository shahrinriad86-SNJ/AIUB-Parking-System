document.getElementById("parkingBtn").addEventListener("click", function()
{
    document.getElementById("dashboardSection").style.display = "none";
    document.getElementById("parkingSection").style.display = "block";
    document.getElementById("bookingSection").style.display = "none";
});

document.getElementById("bookingBtn").addEventListener("click", function()
{
    document.getElementById("dashboardSection").style.display = "none";
    document.getElementById("parkingSection").style.display = "none";
    document.getElementById("bookingSection").style.display = "block";
});

document.getElementById("backFromParking").addEventListener("click", function()
{
    document.getElementById("dashboardSection").style.display = "block";
    document.getElementById("parkingSection").style.display = "none";
    document.getElementById("bookingSection").style.display = "none";
});

document.getElementById("backFromBooking").addEventListener("click", function()
{
    document.getElementById("dashboardSection").style.display = "block";
    document.getElementById("parkingSection").style.display = "none";
    document.getElementById("bookingSection").style.display = "none";
});

document.getElementById("logoutBtn").addEventListener("click", function()
{
    window.location.href = "../../controllers/logoutController.php";
});