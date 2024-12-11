<?php
require_once __DIR__ . '/layout.php';

$content = function () {
?>
    <div class="login-container">
        <h1>Login</h1>
        <form id="loginForm">
            <label for="username">Username</label>
            <input type="text" id="username" placeholder="Username" required>

            <label for="password">Password</label>
            <input type="password" id="password" placeholder="Password" required>

            <button type="submit">Login</button>
        </form>
        <div id="errorMessage"></div>
    </div>

    <script src="/assets/js/login.js"></script>
<?php
};

layout($content);
