<!doctype html>
<html>
<head>
    @include('includes.head')

    <link href="https://fonts.googleapis.com/css?family=Montserrat|Farsan|Quicksand" rel="stylesheet">

    <!-- VOOR STICKY FOOTER POPOVERS -->
    <style type="text/css" media="screen">
        html {
          position: relative;
          min-height: 100%;
        }

        #main {
          //background-color: #DCF0E4
        }            

        .navbar-fixed-bottom {
          background-color: #FFFFFF
        }
    </style>

    <!-- VOOR GOOGLE IMAGE POPOVERS -->
    <style> 
        body {
            //height: 1000px;
            //padding:10px;
            //text-align:center;
           // background-color: #44bbbb;
        }
        .well{
            max-width: 500px;
            //margin: 0 auto;
            position: fixed;
            top: 10px;
        }
        .popover{
            max-width: 100%; // Max Width of the popover (depending on the container!)
        }

    @font-face {
       font-family: OpenSans;
       src: url(/fonts/OpenSans-Regular.ttf);
    }

    @font-face {
       font-family: OpenSans;
       src: url(OpenSans-Bold.ttf);
       font-weight: bold;
    }

    div {
    font-family: 'Helvetica';
     
     line-height: 200%;
    }
    body {
    font-family: 'Helvetica';
    //background-color: rgba(194,232,255,0.34);
    }
    h1 {
     font-family: 'Helvetica'; 
     letter-spacing: 1px;

    }

    form {
        background-color: #F9FCFB;
        padding: 15px;
    }

form,.col-md-12 {
    background-color: rgba(0,0,0,0.03);
}

        p {
          font-size: 100%;
         }

    </style>

</head>
<body>
<div class="container">
    
    <header class="row">
    @include('includes.header')
    </header>

    <div id="main" class="row">    
    @yield('content')
    </div><br><br><br><br><Br><br>

    <div id="yo" class="row">
    @include('includes.footer') 
    </div>

</div>
</body>
</html>