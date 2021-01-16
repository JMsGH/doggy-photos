<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://use.fontawesome.com/a859e4e59f.js"></script>
    
    {{-- Bootstrap Datepicker --}}
    <link rel="stylesheet" type="text/css" href="/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
    <script type="text/javascript" src="{{ asset('/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/bootstrap-datepicker/locales/bootstrap-datepicker.ja.min.js') }}"></script>
    
    {{-- Animate --}}
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.1/animate.min.css"
  />
  
    <link rel="stylesheet" href="/css/styles.css">
    
    <title>Doggy-photos</title>
  </head>
  <body class="main-color">

    {{-- ナビゲーションバー --}}
    @include('commons.navbar')

    <div class="container">
      {{--  エラーメッセージ --}}
      @include('commons.error_messages')

      @yield('content')
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

    <script src="{{ asset('/js/main.js') }}"></script>
    
    {{-- bs-custom-file-input --}}
    <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
    <script>
      bsCustomFileInput.init();
    </script>


  </body>
</html>