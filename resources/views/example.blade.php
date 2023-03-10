<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nav</title>
    <style>
        *{
            margin: 0;
        }
        ul{
            display: flex;
            justify-content: end;
            align-items: center;
        }
        li{
            list-style-type: none;
            padding: 20px;
        }
        li:hover{
            border-bottom: 1px solid;
            color: #fff;
        }
        nav{
            background-color: turquoise;
            width: 100%;
            padding-bottom: 20px;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li>Home</li>
                <li>Contact Us</li>
                <li>About us</li>
                <li>Login | Sign Up</li>
            </ul>
        </nav>
    </header>
</body>
</html>