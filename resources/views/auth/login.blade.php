<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
</head>

<body>
    <form id="loginForm">
        @csrf
        <input type="phone" name="phone" placeholder="phone" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>

    <div id="tokenResult" style="margin-top: 20px;"></div>

    <!-- Tambahkan tombol logout -->
    <div id="logoutBtn" style="margin-top: 20px; display: none;">
        <button id="doLogout">Logout</button>
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();

            fetch('/api/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        phone: e.target.phone.value,
                        password: e.target.password.value
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.access_token) {
                        document.getElementById('tokenResult').innerHTML = `
                        <h4>Login Berhasil!</h4>
                        <p>Token: ${data.access_token}</p>
                        <p>Role: ${data.roles.join(', ')}</p>
                    `;
                        // Tampilkan tombol logout
                        document.getElementById('logoutBtn').style.display = 'block';
                        // Simpan token di localStorage (opsional, untuk logout)
                        localStorage.setItem('token', data.access_token);
                    } else {
                        document.getElementById('tokenResult').innerHTML =
                            '<p style="color:red">Login Gagal!</p>';
                    }
                })
                .catch(error => {
                    document.getElementById('tokenResult').innerHTML = '<p style="color:red">Login Gagal!</p>';
                });
        });

        // Logout
        document.getElementById('doLogout').addEventListener('click', function() {
            const token = localStorage.getItem('token');
            if (!token) {
                alert('Anda belum login!');
                return;
            }

            fetch('/api/logout', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + token
                    }
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    localStorage.removeItem('token');
                    document.getElementById('logoutBtn').style.display = 'none';
                    document.getElementById('tokenResult').innerHTML = '';
                })
                .catch(error => {
                    alert('Logout gagal: ' + error);
                });
        });
    </script>
</body>

</html>
