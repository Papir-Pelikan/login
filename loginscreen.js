document.addEventListener('DOMContentLoaded', function() {
    // Input focus effects
    const inputs = document.querySelectorAll('input');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });
        
        input.addEventListener('blur', function() {
            if (this.value === '') {
                this.parentElement.classList.remove('focused');
            }
        });
        
        // Check if inputs have values on page load (for browser autofill)
        if (input.value !== '') {
            input.parentElement.classList.add('focused');
        }
    });
    
    // Role buttons
    const roleButtons = document.querySelectorAll('.role-btn');
    roleButtons.forEach(button => {
        button.addEventListener('click', function() {
            roleButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
        });
    });
    
    // Form submission
    const form = document.querySelector('.card-form');
    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const button = this.querySelector('.login-btn');
        const buttonText = button.querySelector('span');
        const originalText = buttonText.textContent;
        
        // Animáció indítása
        button.style.transform = 'scale(0.95)';
        buttonText.textContent = 'Bejelentkezés...';
        
        // Adatok összegyűjtése - EMAIL használata
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        
        try {
            // PHP backend hívása - helyes endpoint és formátum
            const response = await fetch('/api/login', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json'
              },
              body: JSON.stringify({
                'email': email,
                'password': password
              })
            });

            const data = await response.json();
            
            if (response.ok) {
                // Sikeres bejelentkezés
                buttonText.textContent = 'Sikeres bejelentkezés!';
                button.style.background = 'linear-gradient(90deg, #4CAF50 0%, #2E7D32 100%)';
                button.querySelector('.btn-overlay').style.background = 'linear-gradient(90deg, #2E7D32 0%, #4CAF50 100%)';
                
                // Átirányítás
                setTimeout(() => {
                    window.location.href = data.redirect;
                }, 1500);
                
            } else {
                throw new Error(data.error || 'error');
            }
            
        } catch (error) {
            // Hiba kezelése
            buttonText.textContent = error.message;
            button.style.background = 'linear-gradient(90deg, #f44336 0%, #d32f2f 100%)';
            button.querySelector('.btn-overlay').style.background = 'linear-gradient(90deg, #d32f2f 0%, #f44336 100%)';
            
            setTimeout(() => {
                buttonText.textContent = originalText;
                button.style.background = 'linear-gradient(90deg, #394E59 0%, #2a3a42 100%)';
                button.querySelector('.btn-overlay').style.background = 'linear-gradient(90deg, #2a3a42 0%, #394E59 100%)';
                button.style.transform = 'scale(1)';
            }, 2000);
        }
    });
});