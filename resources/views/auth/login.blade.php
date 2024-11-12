<!DOCTYPE html>
<html lang="en">
<head>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="logo-jti.png" type="image">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f3f5fc;
            font-family: 'DM Sans', sans-serif;
        }

        .login-container {
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            text-align: center;
        }

        .login-container img {
            width: 90px;
            margin-bottom: 20px;
        }

        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            text-align: left;
        }

        .form-group label {
            width: 100px;
            font-size: 16px;
            color: #333;
            margin-right: 10px;
            text-align: right;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .login-container button {
            width: 30%;
            padding: 20px;
            background-color: rgb(255, 255, 255);
            color: rgb(0, 0, 0);
            border: 3px solid black;
            border-radius: 12px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
            font-family: 'DM Sans', sans-serif;
            
        }

        .login-container button:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <div class="login-container">
      <img src="{{ asset('logo-jti.png') }}">
        <form action="{{ url('login') }}" method="POST" id="form-login">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>