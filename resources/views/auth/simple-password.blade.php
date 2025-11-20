<!DOCTYPE html>
<html>
<head>
    <title>Password Required</title>
</head>
<body style="text-align:center; margin-top:100px;">

<h2>Masukkan Password</h2>

<form method="GET">
    <input 
        type="password" 
        name="password" 
        placeholder="Password"
        style="padding:10px; width:250px;">

    <br><br>

    <button type="submit" style="padding:10px 25px;">
        Masuk
    </button>

    @if(isset($error))
        <p style="color:red; margin-top:10px;">{{ $error }}</p>
    @endif
</form>

</body>
</html>
