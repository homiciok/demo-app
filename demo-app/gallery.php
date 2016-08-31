<?php
$obj = Connect::getInstance();
if($_GET['id']) {
  $display = $obj->getImages($_GET['id']);
}else{
  echo "User does not exist!";
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>Gallery</title>
        <meta name="description" content="Gamma Gallery - A Responsive Image Gallery Experiment"/>
        <meta name="keywords" content="html5, responsive, image gallery, masonry, picture, images, sizes, fluid, history api, visibility api"/>
        <meta name="author" content="Codrops"/>
         <link href='https://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="public/css/styleg.css">
        <link rel="stylesheet" type="text/css" href="template/css/style.css"/>
    <script src="template/js/modernizr.custom.70736.js"></script>
    <noscript><link rel="stylesheet" type="text/css" href="template/css/noJS.css"/></noscript>
    <!--[if lte IE 7]><style>.main{display:none;} .support-note .note-ie{display:block;}</style><![endif]-->
    </head>
    <body>
   <div class="container">
      
      <div class="main">
        <header class="clearfix">
        
          <h1>Gallery<span> </h1>

          <div class="support-note">
            <span class="note-ie">Sorry, only modern browsers.</span>
          </div>
        
        </header>
        
        <div class="gamma-container gamma-loading" id="gamma-container">

          <ul class="gamma-gallery">

                <?php for($i=0; $i<count($display); $i++) {
                      echo '<li>
                <div data-description="<h3>Zoom</h3>" data-max-width="1800" data-max-height="1350">
                      <div data-src="http://localhost/demo-app-2/images/'.$display[$i].'"  data-min-width="1300"></div>
                      <div data-src="http://localhost/demo-app-2/images/'.$display[$i].'"  data-min-width="1000"></div>
                      <div data-src="http://localhost/demo-app-2/images/'.$display[$i].'"  data-min-width="700"></div>
                      <div data-src="http://localhost/demo-app-2/images/'.$display[$i].'"  data-min-width="300"></div>
                      <div data-src="http://localhost/demo-app-2/images/'.$display[$i].'"  data-min-width="200"></div>
                      <div data-src="http://localhost/demo-app-2/images/'.$display[$i].'"  data-min-width="140"></div>
                      <div data-src="http://localhost/demo-app-2/images/'.$display[$i].'"></div>
                      <noscript><div data-src="http://localhost/demo-app-2/images/'.$display[$i].'" alt="img03"></div>
                      </noscript>
                </div>
                </li>';
                    }
                    ?>
          </ul>

          <div class="gamma-overlay"></div>

 
        </div>

      </div><!--/main-->
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script src="template/js/jquery.masonry.min.js"></script>
    <script src="template/js/jquery.history.js"></script>
    <script src="template/js/js-url.min.js"></script>
    <script src="template/js/jquerypp.custom.js"></script>
    <script src="template/js/gamma.js"></script>
    <script type="text/javascript">
      
      $(function() {

        var GammaSettings = {
            // order is important!
            viewport : [ {
              width : 1300,
              columns : 5
            }, {
              width : 900,
              columns : 4
            }, {
              width : 500,
              columns : 3
            }, { 
              width : 320,
              columns : 2
            }, { 
              width : 0,
              columns : 2
            } ]
        };

        Gamma.init( GammaSettings, fncallback );


        // Example how to add more items (just a dummy):

        var page = 0,
          items = []

        function fncallback() {

          $( '#loadmore' ).show().on( 'click', function() {

            ++page;
            var newitems = items[page-1]
            if( page <= 1 ) {
              
              Gamma.add( $( newitems ) );

            }
            if( page === 1 ) {

              $( this ).remove();

            }

          } );

        }

      });

    </script> 
  </body>
</html>
