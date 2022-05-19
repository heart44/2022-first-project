<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <title>로그인</title>
</head>
<body>
    <div class="container">
        <header>
            <a href="../main/main.php">← MAIN</a>        
        </header>
        <fieldset>
            <legend><h2>🌼 로그인 🌼</h2></legend>
            <form action="login_proc.php" method="post" autocomplete="off">
                <div><input type="text" name="u_nick" id="u_nick" class="box" placeholder="닉네임" autofocus></div>
                <div><input type="password" name="u_pw" id="u_pw" class="box" placeholder="비밀번호"></div>
                <div><input type="submit" class="button" onclick="pw_check()" value="로그인"></div>
            </form>        
        </fieldset>        
    </div>
    <small><a href="join.php">처음 오셨나요?</a></small>
</body>
</html>