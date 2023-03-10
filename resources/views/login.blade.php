<!-- <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
  </head>
  <body>
    <div class="kotak_login">
      <h2 class="tulisan_login">Login Administrator</h2>

      <form action="{{ route('auth')}}" method="POST">
                                @csrf
        <p>Email :</p>
        <input type="text" name="email" class="form_login" />

        <p>Password :</p>
        <input type="password" name="password" class="form_login" />

        <div class="bby">
          <div class="log">
            <button><a style="text-decoration: none"
              >Masuk</a></button>
          </div>

          <div class="button">
            <a style="text-decoration: none" href="/"
              >Batal</a
            >
          </div>
        </div>
      </form>
    </div>
  </body>
</html>

<style>
  .button {
    text-align: right;
    margin-left: 10px;
  }

  .button a {
    font-family: sans-serif;
    font-size: 13px;
    background: orange;
    color: white;
    border-radius: 50px;
    padding: 9px 19px;
    margin-top: 5px;
  }

  .bby {
    display: flex;
    flex-direction: row-reverse;
    margin-top: 20px;
  }

  .but a {
    font-family: sans-serif;
    font-size: 13px;
    background: gray;
    color: white;
    border-radius: 50px;
    padding: 9px 19px;
    margin-top: 5px;
  }

  .tulisan_login {
    text-align: center;
  }

  .kotak_login {
    width: 700px;
    background: rgb(232, 232, 232);
    margin: 80px auto;
    padding: 20px 20px;
  }

  label {
    font-size: 11pt;
  }

  .form_login {
    box-sizing: border-box;
    width: 100%;
    padding: 10px;
    font-size: 11pt;
    margin-bottom: 10px;
  }

  .tombol_login {
    background: #46de4b;
    color: white;
    font-size: 11pt;
    width: 100%;
    border: none;
    border-radius: 3px;
    padding: 10px 20px;
  }

  .link {
    text-decoration: none;
    font-size: 10px;
  }

  @media (max-width: 576px) {
    .kotak_login {
      width: 90%;
      margin: 0;
    }
  }

  @media (max-width: 768px) {
    .kotak_login {
      width: 94%;
      margin: 0;
    }
  }
</style> -->

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Animated Login Form</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="box">
		<form action="{{ route('auth')}}" method="POST" autocomplete="off">
      @csrf
			<h2>Sign in</h2>
			<div class="inputBox">
				<input type="text" name="email" required="required">
				<span>Email</span>
				<i></i>
			</div>
			<div class="inputBox">
				<input type="password" name="password" required="required">
				<span>Password</span>
				<i></i>
			</div>
		
			<input type="submit">
		</form>
	</div>
</body>
</html>


<style>@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');
*
{
	margin: 0;
	padding: 0;
	box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}
body 
{
	display: flex;
	justify-content: center;
	align-items: center;
	min-height: 100vh;
	flex-direction: column;
	background: #23242a;
}
.box 
{
	position: relative;
	width: 380px;
	height: 420px;
	background: #1c1c1c;
	border-radius: 8px;
	overflow: hidden;
}
.box::before 
{
	content: '';
	z-index: 1;
	position: absolute;
	top: -50%;
	left: -50%;
	width: 380px;
	height: 420px;
	transform-origin: bottom right;
	background: linear-gradient(0deg,transparent,#45f3ff,#45f3ff);
	animation: animate 6s linear infinite;
}
.box::after 
{
	content: '';
	z-index: 1;
	position: absolute;
	top: -50%;
	left: -50%;
	width: 380px;
	height: 420px;
	transform-origin: bottom right;
	background: linear-gradient(0deg,transparent,#45f3ff,#45f3ff);
	animation: animate 6s linear infinite;
	animation-delay: -3s;
}
@keyframes animate 
{
	0%
	{
		transform: rotate(0deg);
	}
	100%
	{
		transform: rotate(360deg);
	}
}
form 
{
	position: absolute;
	inset: 2px;
	background: #28292d;
	padding: 50px 40px;
	border-radius: 8px;
	z-index: 2;
	display: flex;
	flex-direction: column;
}
h2 
{
	color: #45f3ff;
	font-weight: 500;
	text-align: center;
	letter-spacing: 0.1em;
}
.inputBox 
{
	position: relative;
	width: 300px;
	margin-top: 35px;
}
.inputBox input 
{
	position: relative;
	width: 100%;
	padding: 20px 10px 10px;
	background: transparent;
	outline: none;
	box-shadow: none;
	border: none;
	color: #23242a;
	font-size: 1em;
	letter-spacing: 0.05em;
	transition: 0.5s;
	z-index: 10;
}
.inputBox span 
{
	position: absolute;
	left: 0;
	padding: 20px 0px 10px;
	pointer-events: none;
	font-size: 1em;
	color: #8f8f8f;
	letter-spacing: 0.05em;
	transition: 0.5s;
}
.inputBox input:valid ~ span,
.inputBox input:focus ~ span 
{
	color: #45f3ff;
	transform: translateX(0px) translateY(-34px);
	font-size: 0.75em;
}
.inputBox i 
{
	position: absolute;
	left: 0;
	bottom: 0;
	width: 100%;
	height: 2px;
	background: #45f3ff;
	border-radius: 4px;
	overflow: hidden;
	transition: 0.5s;
	pointer-events: none;
	z-index: 9;
}
.inputBox input:valid ~ i,
.inputBox input:focus ~ i 
{
	height: 44px;
}
.links 
{
	display: flex;
	justify-content: space-between;
}
.links a 
{
	margin: 10px 0;
	font-size: 0.75em;
	color: #8f8f8f;
	text-decoration: beige;
}
.links a:hover, 
.links a:nth-child(2)
{
	color: #45f3ff;
}
input[type="submit"]
{
	border: none;
	outline: none;
	padding: 11px 25px;
	background: #45f3ff;
	cursor: pointer;
	border-radius: 4px;
	font-weight: 600;
	width: 100px;
	margin-top: 10px;
}
input[type="submit"]:active 
{
	opacity: 0.8;
}</style>