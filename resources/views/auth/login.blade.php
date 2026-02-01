<!doctype html>

<html
  lang="en"
  class=" layout-wide  customizer-hide"
  dir="ltr"
  data-skin="default"
  data-bs-theme="light"
  data-assets-path="{{ asset('public/backend/assets/') }}"
  data-template="vertical-menu-template">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="robots" content="noindex, nofollow" />
    <title>Demo: Login Basic - Pages | Vuexy - Bootstrap Dashboard PRO</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('public/backend/assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
      rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('public/backend/assets/vendor/fonts/iconify-icons.css') }}" />

    <script src="{{ asset('public/backend/assets/vendor/libs/@algolia/autocomplete-js.js') }}"></script>

    <!-- Core CSS -->
    <!-- build:css assets/vendor/css/theme.css  -->

    <link rel="stylesheet" href="{{ asset('public/backend/assets/vendor/libs/node-waves/node-waves.css') }}" />

    <link rel="stylesheet" href="{{ asset('public/backend/assets/vendor/libs/pickr/pickr-themes.css') }}" />

    <link rel="stylesheet" href="{{ asset('public/backend/assets/vendor/css/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/backend/assets/css/demo.css') }}" />

    <!-- Vendors CSS -->

    <link rel="stylesheet" href="{{ asset('public/backend/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <!-- endbuild -->

    <!-- Vendor -->
    <link rel="stylesheet" href="{{ asset('public/backend/assets/vendor/libs/@form-validation/form-validation.css') }}" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('public/backend/assets/vendor/css/pages/page-auth.css') }}" />

    <!-- Helpers -->
    <script src="{{ asset('public/backend/assets/vendor/js/helpers.js') }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->

    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="{{ asset('public/backend/assets/vendor/js/template-customizer.js') }}"></script>

    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->

    <script src="{{ asset('public/backend/assets/js/config.js') }}"></script>
  </head>

  <body>
    <!-- Content -->

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-6">
          <!-- Login -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center mb-6">
                <a href="index.html" class="app-brand-link">
                  <img src="{{ asset('public/frontend/assets/img/logo_alertf.png') }}" alt="logo">
                </a>
              </div>
              <!-- /Logo -->
              <h4 class="mb-1 text-center">Espace Administration</h4>
              <p class="mb-6 text-center">Veuillez remplir les champs</p>

              <form id="formAuthentication" class="mb-4" action="{{ route('login') }}" method="POST">
                @csrf

                <div class="mb-6 form-control-validation">
                  <label for="email" class="form-label">Email or Username</label>
                  <input class="form-control" type="email" name="email" value="{{ old('name') }}" placeholder="Email" autofocus>
                  @error('email')
                    <p class="text-red-500 mt-2">{{ $message }}</p>
                @enderror
                </div>
                <div class="mb-6 form-password-toggle form-control-validation">
                  <label class="form-label" for="password">Password</label>
                  <div class="input-group input-group-merge">
                    
                    <input class="form-control" id="password" type="password" name="password" placeholder="Mot de passe" aria-describedby="password">
                    @error('password')
                        <p class="text-red-500 mt-2">{{ $message }}</p>
                    @enderror
                    <span class="input-group-text cursor-pointer"><i class="icon-base ti tabler-eye-off"></i></span>
                  </div>
                </div>
                <div class="my-8">
                  <div class="d-flex justify-content-between">
                    <div class="form-check mb-0 ms-2">
                      <input class="form-check-input" type="checkbox" id="remember-me" />
                      <label class="form-check-label" for="remember-me"> Se souvenir de moi </label>
                    </div>
                    <a href="{{ route('password.request') }}">
                      <p class="mb-0">Mot de passe oublié?</p>
                    </a>
                  </div>
                </div>
                <div class="mb-6">
                  <button class="btn btn-primary d-grid w-100" type="submit">Se connecter</button>
                </div>
              </form>

              <p class="text-center">
                {{-- <span>New on our platform?</span> --}}
                <a href="{{ route('register') }}">
                  <span>S'inscrire</span>
                </a>
              </p>

              {{-- <div class="divider my-6">
                <div class="divider-text">or</div>
              </div>

              <div class="d-flex justify-content-center">
                <a href="javascript:;" class="btn btn-icon rounded-circle btn-text-facebook me-1_5">
                  <i class="icon-base ti tabler-brand-facebook-filled icon-20px"></i>
                </a>

                <a href="javascript:;" class="btn btn-icon rounded-circle btn-text-twitter me-1_5">
                  <i class="icon-base ti tabler-brand-twitter-filled icon-20px"></i>
                </a>

                <a href="javascript:;" class="btn btn-icon rounded-circle btn-text-github me-1_5">
                  <i class="icon-base ti tabler-brand-github-filled icon-20px"></i>
                </a>

                <a href="javascript:;" class="btn btn-icon rounded-circle btn-text-google-plus">
                  <i class="icon-base ti tabler-brand-google-filled icon-20px"></i>
                </a> --}}
              </div>
            </div>
          </div>
          <!-- /Login -->
        </div>
      </div>
    </div>

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/theme.js  -->

    <script src="{{ asset('public/backend/assets/vendor/libs/jquery/jquery.js') }}"></script>

    <script src="{{ asset('public/backend/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('public/backend/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('public/backend/assets/vendor/libs/node-waves/node-waves.js') }}"></script>

    <script src="{{ asset('public/backend/assets/vendor/libs/pickr/pickr.js') }}"></script>

    <script src="{{ asset('public/backend/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('public/backend/assets/vendor/libs/hammer/hammer.js') }}"></script>

    <script src="{{ asset('public/backend/assets/vendor/libs/i18n/i18n.js') }}') }}"></script>

    <script src="{{ asset('public/backend/assets/vendor/js/menu.js') }}"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('public/backend/assets/vendor/libs/@form-validation/popular.js') }}"></script>
    <script src="{{ asset('public/backend/assets/vendor/libs/@form-validation/bootstrap5.js') }}"></script>
    <script src="{{ asset('public/backend/assets/vendor/libs/@form-validation/auto-focus.js') }}"></script>

    <!-- Main JS -->

    <script src="{{ asset('public/backend/assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('public/backend/assets/js/pages-auth.js') }}"></script>
  </body>
</html>
