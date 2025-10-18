// Hamburger Menu
const toggleBtn = document.querySelector(".sidebar-toggle");
const sidebar = document.querySelector(".sidebar");

toggleBtn.addEventListener("click", function () {
    sidebar.classList.toggle("show-sidebar");
});

// Dashboard Greetings
const time = document.querySelector(".time");

let companyName = "John";

let data = [
        [18, "Good evening"],
        [12, "Good afternoon"],
        [0, "Good morning"],
    ],
    hour = new Date().getHours();
for (let i = 0; i < data.length; i++) {
    if (hour >= data[i][0]) {
        time.innerHTML = `${data[i][1]}, ${companyName}`;
        break;
    }
}

const dropdowns = document.querySelectorAll(".dropdown-btn");

dropdowns.forEach((dropdown) => {
    dropdown.addEventListener("click", function () {
        // pass the event into the function
        // toggle the class on the clicked button
        dropdown.classList.toggle("active");
    });
});
