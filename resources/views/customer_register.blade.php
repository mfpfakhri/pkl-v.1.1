@extends('layouts.side')

@section('title', 'Customer Registration')

@section('content')
		
		<div class="account-pages"></div>
        <div class="clearfix"></div>
        <div class="wrapper-page">
            <div class="text-center">
                <a href="index.html" class="logo"><span>NEKANEKA</span></span></a>
                <h5 class="text-muted m-t-0 font-600">The Right Tour for The Right Traveller</h5>
            </div>
        	<div class="m-t-40 card-box">
                <div class="text-center">
                    <h4 class="text-uppercase font-bold m-b-0">Register</h4>
                </div>
                <div class="panel-body">
                    <form method="POST" class="form-horizontal m-t-20" action="{{ URL('registercustomerprocess') }}" accept-charset="UTF-8">
                    {{ csrf_field() }}
						<div class="form-group ">
							<div class="col-xs-12">
								<input class="form-control" name="username" type="username" required="" placeholder="Username">
							</div>
						</div>
						<div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" name="password" id="password" type="password" required="" placeholder="Password">
                            </div>
                        </div>
						<div class="form-group">
							<div class="col-xs-12">
								<div class="checkbox checkbox-custom">
									<input id="checkbox-signup" type="checkbox" checked="checked">
									<label for="checkbox-signup">I accept <a href="#">Terms and Conditions</a></label>
								</div>
							</div>
						</div>
						<div class="form-group text-center m-t-40">
							<div class="col-xs-12">
								<button class="btn btn-custom btn-bordred btn-block waves-effect waves-light" type="submit">
									Register
								</button>
							</div>
						</div>
					</form>
                </div>
            </div>
            <!-- end card-box -->

			<div class="row">
				<div class="col-sm-12 text-center">
					<p class="text-muted">Already have account?<a href="page-login.html" class="text-primary m-l-5"><b>Sign In</b></a></p>
				</div>
			</div>

        </div>
        <!-- end wrapper page -->
@stop