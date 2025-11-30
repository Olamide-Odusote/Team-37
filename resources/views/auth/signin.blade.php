<!DOCTYPE html 5px>
<link rel="stylesheet" href="{{ asset('css/design1.css') }}">
<link rel="stylesheet" href="app.js">
<html lang="en">
    <meta head>
    <title>OmniCart</title>
</head>
<body class="body">
    <div class="login">
        <img src="{{ asset('images/OmniCart_Logo.png') }}" class="logo">
<div class="signInText">sign in to your account.</div>
<div class="input"> 
        
        <input type="text" placeholder="Email or username"/>
        <input type="password" placeholder="Password"/></div>
<button class="signInButton">sign in</button>
<p class="forgotPassword">
        Forgot your password <a href="changePass.html">click here ></a>
</p>
<div class="gab"></div>
            <p class="newToOmni">New to Omni?</p>
            <button class="registerInButton" href="{{ route('register.post') }}">Create account</button></a>
</body>
</html>
