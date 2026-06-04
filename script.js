// Initial login state
let isLogedIn = false;

// Function to check login status for navbar access
function checkLogin(event) {
    if (!isLogedIn) {
        event.preventDefault(); // Prevent navigation
        showMessage("Login to our site to access this feature.");
    }
}

// Function to show message
function showMessage(text) {
    const messageBox = document.getElementById("login-message");
    if (messageBox) {
        messageBox.textContent = text;
        messageBox.classList.add("show");
        setTimeout(() => {
            messageBox.classList.remove("show");
        }, 3000); // Hide after 3 seconds
    } else {
        alert(text);
    }
}

// Optional form validation for contact form
document.addEventListener('DOMContentLoaded', () => {
    const contactForm = document.querySelector('.contact-form');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            const name = document.getElementById('name')?.value;
            const email = document.getElementById('email')?.value;
            const message = document.getElementById('message')?.value;

            if (!name || !email || !message) {
                e.preventDefault();
                alert('Please fill out all fields!');
            }
        });
    }

    // Handle scroll for info section
    const infoSection = document.getElementById("info-section");
    if (infoSection) {
        window.addEventListener("scroll", () => {
            const scrollPosition = window.scrollY;
            if (scrollPosition > 200) {
                infoSection.classList.add("show");
            }
        });
    }
});
