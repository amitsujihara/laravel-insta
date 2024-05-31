<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insta app</title>
    <style>
        body{
            padding: 50px;
            text-align: center;
            justify-content: center;
            align-items: center;

        }

        .email-header{
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #ddd;
        }

        .email-header h1{
            font-size: 24px;
            color: #ff6928;
            margin: 0;
        }
        .email-header h2{
            font-size: 24px;
            color: #00f;
            margin: 0;
        }

        .email-body p {
            font-size: 16px;
            color: #666;
            line-height: 1.5;
            margin: 0 0 5px;

        }
        .email-body .body{
            border: 2px solid #666;
            width: 300px;
            height: 100px;
            /* align-items: center;
            justify-content: center;
            text-align: center; */
            margin: auto;
            /* add */
            padding-top: 20px;

        }

        .email-footer{
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #ddd;
        }

        .email-footer p{
            font-size: 14px;
            color: #999;
            margin: 0;
        }

        .button{
            display: inline-block;
            padding: 10px 20px;
            background-color: #ff6928;
            color: #fff;
            text-decoration: none;
            font-size: 16px;
            border-radius: 5px;
            margin-top: 10px;
            margin-bottom: 10px;

        }
    </style>
</head>
<body>
    <div class="email-header">
        <!-- Post owner name -->
        <h1>Hi there, {{ $name}}!</h1>
        <h2>You have a new message.</h2>
    </div>

    <div class="email-body">
        <h3>Here is the new comment below.</h3>
        <p>Sent by {{ $commented_user}}</p>

        <p class="body" >{{ $comment_body}}</p>

    
        <p><a href="{{ route('post.show', $user->id)}}" class="button">Go to this post now!</a></p>

        <p>Best regards, <br>Kredo Team</p>
    </div>

    <div class="email-footer">
        <p>&copy; 2024 Kredo Insta App. All rights reserved.</p>
    </div>
    
</body>
</html>