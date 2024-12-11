document.getElementById('loginForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    const response = await fetch('/api/login', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            username,
            password
        }),
    });

    if (response.ok) {
        const result = await response.json();
        console.log('Token received:', result.token); // Verifica il token ricevuto
        sessionStorage.setItem('token', result.token); // Salva il token nella sessione
        console.log('Token saved:', sessionStorage.getItem('token')); // Verifica che il token sia salvato
        window.location.href = '/breweries'; // Reindirizza
    } else {
        document.getElementById('errorMessage').innerText = 'Login failed!';
    }
});