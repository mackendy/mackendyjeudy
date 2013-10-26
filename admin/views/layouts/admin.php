
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="/css/bootstrap.min.css">
        <link rel="stylesheet" href="/font-awesome/css/font-awesome.min.css">
        <style>
            /*body {
                padding-top: 60px;
                padding-bottom: 40px;
            }*/
        </style>
        <!--  <link rel="stylesheet" href="/css/bootstrap-responsive.min.css"> -->
        <link href='http://fonts.googleapis.com/css?family=Pacifico|Poiret+One|Ubuntu|Telex|Numans|Raleway+Dots' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="/css/admin.css">
        <link rel="stylesheet" href="/css/validationEngine.jquery.css" type="text/css"/>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
      <!--  <script src="/js/vendor/jquery-1.9.1.min.js"></script>-->
         

    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <!-- This code is taken from http://twitter.github.com/bootstrap/examples/hero.html -->
        <a href="#content" class="sr-only">Skip to content</a>
        
        <header>
            <div class="container">
                <div id="logo" class="pull-left">
                    <h1><a href="/">Mackendy Jeudy Admin</a></h1>
                </div>
                <nav class="pull-right">
                    <ul>
                        <li><a href="/">1</a></li>
                        <li>2</li>
                        <li>3</li>
                        <li><a href="/">4</a></li>
                    </ul>
                </nav>
            </div>
        </header>

        <div id="top-panneau">      
            <div id="top-content">
                <!-- content slide -->
                
            </div>
            <div class="container">
                <div class="open"><i class="icon-double-angle-up"></i></div>  
            </div> 
        </div>

        <div class="clearfix"></div>

        <div class="container" id="content"> 
            <div id="main-content" class="col-md-12 container">
                <?php echo $content_for_layout; ?>
            </div>
        </div>
        <footer>
            <p>
                Copyright &copy; <?php echo date( 'Y' ); ?> <strong>Mackendy Jeudy</strong>. All Rights Reserved.<br />
                Designé, Développé et Administré par <strong>Mackendy Jeudy</strong>.
            </p>
        </footer>

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src=" <?php echo JS.DS.'vendor/jquery-1.9.1.min.js';?>"><\/script>')</script>
        <script src="/js/jquery.validationEngine-fr.js" type="text/javascript" charset="utf-8"></script>
        <script src="/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>

        <script src="/js/vendor/bootstrap.min.js"></script>

        <script src="/js/main.js"></script>

        <script>
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>
    </body>
</html>

