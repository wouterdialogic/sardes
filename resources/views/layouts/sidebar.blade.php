
<!doctype html>
<html>
<head>
    @include('includes.head')
</head>
<body>

   
        @include('includes.header')

<div class="container-fluid">
    <div id="main" class="row">
        <!-- sidebar content -->
        <div id="sidebar" class="col-md-2">
            @include('includes.sidebar')
        </div>
        <!-- main content -->
        <div id="content" class="col-md-10">
               
        </div>
    </div>
    <footer class="row">
        @include('includes.footer')
    </footer>

</div>
</body>


</html>