<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$subject}}</title>

    <style>

    </style>
</head>
<body>
    <center>
    <h3 style="">{{$subject}}</h3>
    <img src="https://wgc.com.au/wp-content/uploads/2023/09/Thumbs-Up.png" alt="thumpsup" width="50px" height="50px" style="display: block;margin-bottom:50px;">
    </center>
    <p style="margin-bottom:55px;">Hello {{$mailmessage}},<br><br>
    Thanks for joining.We're excited to have you on board.</p>
    <center style="margin-bottom:60px">
    <a href="{{ url('/home') }}" style="background-color:#4080bf;color:white;padding:10px;text-decoration:none;">LOGIN TO YOUR ACCOUNT</a>
    <p></center>
    <b>Have a question?</b><br>
    Check out <a href="/" style="color:#4080bf">Knowledge Base</a> for a quick answer.


</body>
</html>