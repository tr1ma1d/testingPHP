document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('loginForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;

        fetch('./php/login.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ username: username, password: password })
        })
            .then(response => {
                console.log(response);
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text();
            })
            .then(text => {
                console.log('Response text:', text);  // Логирование текста ответа
                if (!text) {
                    throw new Error('Empty response');
                }
                return JSON.parse(text);
            })
            .then(data => {
                console.log('Parsed JSON:', data);
                if (data.success) {
                    window.location.href = 'welcome.html';
                } else {
                    document.getElementById('error-message').textContent = data.message || 'Invalid username or password';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('error-message').textContent = 'Error occurred. Please try again later.';
            });
    });
});
