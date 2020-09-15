<div class="row">
    <div class="col-md-4 login-sec" style="display: none">

        <h2>Login Form</h2>


        <form class="modal-content animate" method="post" id="loginFr">
            @csrf
            <div class="imgcontainer">
                <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
                <img src="img_avatar2.png" alt="Avatar" class="avatar">
            </div>

            <div class="container">
                <label for="uname"><b>Email</b></label>
                <input type="text" placeholder="Enter Email" name="email" id="inEmail" required>

                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="password" id="inPass" required>

                <button type="submit">Login</button>
                <label>
                    <input type="checkbox" checked="checked" name="remember"> Remember me
                </label>
            </div>

            <div class="container" style="background-color:#f1f1f1">
                <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">
                    Cancel
                </button>
                <span class="psw">Forgot <a href="#">password?</a></span>
            </div>
        </form>
        @if (count($errors) >0)
            <ul>
                @foreach($errors->all() as $error)
                    <li class="text-danger"> {{ $error }}</li>
                @endforeach
            </ul>
        @endif

        @if (session('status'))
            <ul>
                <li class="text-danger"> {{ session('status') }}</li>
            </ul>
        @endif
    </div>

</div>
