<div class="row login-sec" style="display: none">
    <div class="col-md-4">
        <h2 style="text-align: center">Login form</h2>
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
        <form method="post" id="loginFr" class="login-form">
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1" class="text-uppercase">Email</label>
                <input type="text" class="form-control" placeholder="" name="email" id="inEmail">

            </div>
            <div class="form-group">
                <label for="exampleInputPassword1" class="text-uppercase">Password</label>
                <input type="password" class="form-control" placeholder="" name="password" id="inPass">
            </div>


            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input">
                    <small>Remember Me</small>
                </label>
                <button id="btnLogin" type="submit" value="login" class="btn btn-login float-right">Login</button>
            </div>

        </form>
    </div>

</div>
