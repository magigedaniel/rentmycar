<div class="modal fade" id="myModal5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-info">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body modal-spa">
                <div class="sign-grids">
                    <div class="sign">
                        <div class="sign-left">
                            <ul>
                                <li><a class="fb" href="#"><i></i>Sign in with Facebook</a></li>
                                <li><a class="goog" href="#"><i></i>Sign in with Google</a></li>
                                <li><a class="linkin" href="#"><i></i>Sign in with Linkedin</a></li>
                            </ul>
                        </div>
                        <div class="sign-right">
                            <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                                {{ csrf_field() }}

                                <h3>Create your account </h3>
                                <input type="text" name="name" id="name" required="" placeholder="Name">
                                <input type="text" required="" id="phone" name="phone" placeholder="Phone Number">
                                <input type="email" id="email" name="email" required="" placeholder="Email">
                                <input type="password" id="password" name="password" required="" placeholder="Password">
                                <input type="password" id="confirm-password" name="confirm-password" required="" placeholder="Confirm Password">
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            Register
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <p>By logging in you agree to our <span>Terms and Conditions</span> and
                        <span>Privacy Policy</span></p>
                </div>
            </div>
        </div>
    </div>
</div>