<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login </title>
    <link rel="icon" href="logo-jti.png" type="image">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap');

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background-color: #f3f5fc;
            font-family: 'DM Sans', sans-serif;
        }

        .login-container {
            background-color: white;
            padding: 3rem;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            width: 100%;
            max-width: 420px;
            text-align: center;
        }

        .login-container img {
            width: 120px;
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
            color: #333;
            font-weight: 700;
        }

        .form-group ::placeholder {
            font-size: 15px;
        }

        .form-group input {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #eaeaea;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-sizing: border-box;
        }

        .form-group input:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .error-text {
            color: red;
            font-size: 0.85rem;
            margin-top: 0.25rem;
            display: block;
        }

        button {
            width: 100%;
            max-width: 200px;
            padding: 0.875rem 1.5rem;
            background-color: #fff;
            color: #000;
            border: 2px solid #000;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'DM Sans', sans-serif;
        }

        button:hover {
            background-color: #000;
            color: #fff;
            transform: translateY(-1px);
        }

        button:active {
            transform: translateY(1px);
        }
    </style>
</head>

<body>
    <div class="login-container">
        <img src="{{ asset('logo-jti.png') }}" alt="JTI Logo">
        <form action="{{ url('login') }}" method="POST" id="form-login">
            @csrf
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Masukkan Username" required>
                <small class="error-text"></small>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Masukkan Password" required>
                <small class="error-text"></small>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/additional-methods.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function () {
            $("#form-login").validate({
                rules: {
                    username: {
                        required: true,
                        minlength: 4,
                        maxlength: 20
                    },
                    password: {
                        required: true,
                        minlength: 6,
                        maxlength: 20
                    }
                },
                messages: {
                    username: {
                        required: "Username wajib diisi",
                        minlength: "Username minimal 4 karakter",
                        maxlength: "Username maksimal 20 karakter"
                    },
                    password: {
                        required: "Password wajib diisi",
                        minlength: "Password minimal 6 karakter",
                        maxlength: "Password maksimal 20 karakter"
                    }
                },
                errorElement: 'small',
                errorPlacement: function (error, element) {
                    error.addClass('error-text');
                    error.insertAfter(element);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
</body>

</html>
