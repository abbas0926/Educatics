<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Register - Brand</title>
    <link rel="stylesheet" href="{{ asset('onboarding/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css">
    <link rel="stylesheet" href="{{ asset('onboarding/css/styles.min.css') }}">
</head>

<body>
    <main class="page registration-page">
        <section class="clean-block clean-form dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">{{ __('Create an account') }}</h2>
                </div>
                <form id="registerForm" method="post" action="{{ route('onboarding.processForm') }}">
                    @csrf @method('post')
                    <input type="text" hidden name="honeypot">


                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="subdomain">{{ __('Subdomain') }}    <span class="text-danger">*</span> </label>
                            <div class="input-group ">
                                <input class="form-control item @error('subdomain') is-invalid @enderror " type="text"
                                    name="subdomain">
                                <span class="input-group-text">.educatics.app</span>
                            </div>
                            @error('subdomain')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                            <span class="text-danger d-none"
                                id="subdomainAlert">{{ __('subdomain already in use') }}</span>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="mb-3">
                                <label for="name" class="form-label">{{ __('Your First name') }}   <span class="text-danger">*</span> </label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                                    aria-describedby="nameHelp" placeholder="">
                                @error('name')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="mb-3">
                                <label for="last_name" class="form-label">{{ __('Your Last name') }}   <span class="text-danger">*</span> </label>
                                <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" id="last_name"
                                    aria-describedby="last_nameHelp" placeholder="">
                                @error('last_name')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-12 ">
                            <div class="mb-3">
                                <label for="phone" class="form-label">{{ __('Your Phone number') }}   <span class="text-danger">*</span> </label>
                                <div class="input-group">
                                    <span class="input-group-text">+213</span>
                                    <input type="tel" class="form-control item @error('phone') is-invalid @enderror" name="phone" id="phone" pattern="[567]{1}[0-9]{8}">
                                </div>                              
                                @error('phone')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('Your email address') }}   <span class="text-danger">*</span> </label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email"
                                    aria-describedby="emailHelp" placeholder="">
                                @error('email')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="password" class="form-label">{{ __('Your password') }}   <span class="text-danger">*</span> </label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password"
                                        aria-describedby="passwordHelp" placeholder="">
                                    @error('password')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                    </div>



                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="d-grid gap-2">
                                <button type="button" name="loginBtn" id="loginBtn"
                                    class="btn btn-outline-secondary">{{ __('Login') }}</button>
                            </div>
                        </div>
                        <div class="col-md-6 d-block">
                            <div class="d-grid gap-2">
                                <button type="submit" name="registerBtn" id="registerBtn"
                                    class="btn btn-primary">{{ __('Create account') }}</button>
                            </div>

                        </div>

                    </div>
                </form>
            </div>
        </section>
    </main>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('onboarding/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('onboarding/js/baguetteBox.min.js') }}"></script>
    <script src="{{ asset('onboarding/js/script.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            let subdomain = $('input[name=subdomain]');
            subdomain.focusout(function() {
                
                $.ajax({
                    url: `/check-domain/${$(this).val()}`,
                    success: function(response) {
                        
                        subdomain.toggleClass('is-invalid', response.domainExist);
                        $('#subdomainAlert').toggleClass('d-none', !response.domainExist);
                        $('#registerBtn').attr('disabled',response.domainExist)

                    }
                });
            });
        });
    </script>
</body>

</html>
