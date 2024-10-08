<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/loginstyle.css') }}">
    <title>Document</title>

</head>
<body>
<div class="container">
    <div class="row">
        <div class="column">
            <div class="image-container">
                <img src="{{ asset('img/isu.png') }}" alt="First Image" class="image" >
                <img src="{{ asset('img/ict.png') }}" alt="Second Image" class="image1" style="top:9px">
                <p class="bottom-text">ISUE CANNER</p>
                <p class="bottom-text1">
                    <span style="font-size: 28px;">C</span>ontrol of 
                    <span style="font-size: 28px;">A</span>rchival and 
                    <span style="font-size: 28px;">N</span>otification of 
                    <span style="font-size: 28px;">N</span>etwork 
                    <span style="font-size: 28px;">E</span>vents 
                    <span style="font-size: 28px;">R</span>ecords.
                </p>
            </div>
        </div>
        <div class="column1">
            <p style="font-size: 25px; font-weight:bold; margin-left: -100px; margin-top: 10px; margin-bottom: 70px"> Login to your <span style="font-weight: 10;">Account</span></p>
            <form method="post" action="{{route('admin.logins')}}">
                @csrf
                @method('post')
                <div class = "field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="username" autocomplete="off" required>
                </div>
                <div class="field input"> 
                    <label for="password" style="margin-bottom: -10px; margin-top: 25px">password</label><br>
                    <input type="text" id="password" name="password" required>
                    <input type="checkbox" id="showPassword" style="margin-top:  0px"> Show Password
                </div>
                <div class="field">
                    <button type="submit" class="btn">Login</button>
                    <p>Have already account? <a href="{{url('/signup')}}" style="color: #0f965e;">Sign Up here</a></p>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('showPassword').addEventListener('change', function() {
            var passwordField = document.getElementById('passcode');
            if (passwordField) { // Check if the password field exists
                if (this.checked) {
                    passwordField.type = 'text';
                } else {
                    passwordField.type = 'password';
                }
            } else {
                console.error('Password field not found');
            }
        });
    });
</script>


</body>
</html>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('showPassword').addEventListener('change', function() {
            var passwordField = document.getElementById('password');
            if (passwordField) { // Check if the password field exists
                if (this.checked) {
                    passwordField.type = 'text';
                } else {
                    passwordField.type = 'password';
                }
            } else {
                console.error('Password field not found');
            }
        });
    });
</script>


</body>
</html>
