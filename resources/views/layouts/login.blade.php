<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Page</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background: linear-gradient(to bottom left, black, #282828);
            color: white;
            font-family: Arial, sans-serif;
            overflow: hidden;
            /* Hide overflow to prevent background image from causing scroll bars */
            position: relative;
        }

        #particles-js {
            position: absolute;
            width: 100%;
            height: 100%;
        }

        .background-image {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background-image: url('{{ asset("img/jogja.jpg") }}');
            background-size: cover;
            background-position: center;
            /* Center the background image */
            filter: brightness(50%);
            /* Adjust brightness as needed */
        }

        .card {
            position: relative;
            z-index: 1;
            background-color: rgba(51, 51, 51, 0.3);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1), 0 8px 16px rgba(0, 0, 0, 0.2);
            width: 500px;
            height: 400px;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            transform: translateZ(50px);
            /* Add some depth */
        }

        .card form {
            width: 100%;
        }

        .card input {
            width: calc(100% - 100px);
            padding: 15px;
            margin-bottom: 20px;
            box-sizing: border-box;
            border-radius: 5px;
        }

        .card button {
            background-color: #4CAF50;
            color: white;
            padding: 15px 40px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="background-image"></div>
    <div id="particles-js"></div>
    <div class="card">
        <img src="{{ asset('img/lauwba.png') }}" alt="Image Alt Text" style="width: 100px; height: 100px; border-radius: 50%;">
        <h1>Admin Login</h1>
        <form action="{{ route('login') }}" method="post">
            @csrf
            <input type="email" name="email" placeholder="Email" required>
            <br>
            <input type="password" name="password" placeholder="Password" required>
            <br>
            <button type="submit">Login</button>
        </form>
    </div>

    <script src="{{ asset('js/particles.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>