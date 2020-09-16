<div class="row register" style="display: none">
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title" style="text-align: center">Please sign up</h3>
            </div>
            <div class="panel-body">
                <form method="post" role="form" id="registerFrm">
                    @csrf
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <input type="text" name="firstname" id="firstname" class="form-control input-sm"
                                       placeholder="First Name">
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <input type="text" name="lastname" id="lastname" class="form-control input-sm"
                                       placeholder="Last Name">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <input type="text" name="phone" id="phone" class="form-control input-sm"
                                       placeholder="Phone number">
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="cars">Choose a gender:</label>
                                <select id="gender" name="gender">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <input type="email" name="email" id="email" class="form-control input-sm"
                                       placeholder="Email Address">
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <input type="date" name="birthday" id="birthday" onblur="ValidateDOB()"
                                       class="form-control input-sm">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <input type="password" name="password" id="password"
                                       class="form-control input-sm" placeholder="Password">
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                       class="form-control input-sm" placeholder="Confirm Password">
                            </div>
                        </div>
                    </div>

                    <input type="submit" value="Register" class="btn btn-info btn-block" id="btnRegister">

                </form>
            </div>
        </div>
    </div>
</div>
