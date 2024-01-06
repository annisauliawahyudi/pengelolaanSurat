@include('layouts.header')

<div class="container ">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row justify-content-center">
                        
                        <div class="col-lg-6 ">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                </div>
                                <form class="user" action="{{ route('login-auth') }}" method="POST">
                                    @csrf
                                    @if (Session::get('failed'))
                                        <div class="alert alert-danger">{{ Session::get('failed') }}</div>
                                    @endif
                                    @if (Session::get('logout'))
                                        <div class="alert alert-primary">{{ Session::get('logout') }}</div>
                                    @endif
                                    @if (Session::get('canAccess'))
                                        <div class="alert alert-danger">{{ Session::get('canAccess') }}</div>
                                    @endif
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user"
                                            id="exampleInputEmail" aria-describedby="emailHelp"
                                            placeholder="Enter Email Address..." name="email">
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="Password" name="password">
                                        @error('password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <button class="btn btn-primary btn-user btn-block">Login</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
