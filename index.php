<html>
    <head>
        <title>BatSlap!meme generator</title>
        
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
        
        <style>
            .starter-template {
                padding: 62px 15px;
                text-align: center;
            }
            
            .memeThumbnail {
                width: 200px; 
                margin: 10px 10px 0 0;
            }
            
        </style>
        
    </head>

    <body>
        <script>
            window.fbAsyncInit = function() {
                FB.init({
                appId      : '161556983901713',
                xfbml      : true,
                version    : 'v2.0'
                });
            };

            (function(d, s, id){
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) {return;}
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/en_US/sdk.js";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
            
            var global = {
                
            };
            
        </script>

        <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
            <a class="navbar-brand" href="#">BatSlap! <small>meme generator</small></a>
            </div>
            <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">

            </ul>
            </div><!--/.nav-collapse -->
        </div>
        </div>

        <div class="container">

        <div class="starter-template">
            <div class="row">
                <div class="col-md-4"><img id="preview" src="gen.php" class="img-responsive" /></div>
                <div class="col-md-4">
                    <form role="form" action="gen.php" method="GET">
                    <div class="form-group text-left">
                        <label for="r">Robin 1:</label>
                        <input type="text" class="form-control" id="r" name="r" placeholder="">
                    </div>
                    <div class="form-group text-left">
                        <label for="b">Batman 1:</label>
                        <input type="text" class="form-control" id="b" name="b" placeholder="">
                    </div>
                    <div id="extraData" style="display: none;">
                        <div class="form-group text-left">
                            <label for="r">Robin 2:</label>
                            <input type="text" class="form-control" id="r2" name="r2" placeholder="">
                        </div>
                        <div class="form-group text-left">
                            <label for="b">Batman 2:</label>
                            <input type="text" class="form-control" id="b2" name="b2" placeholder="">
                        </div>
                    </div>
                    <input type="hidden" name="d" value="true" />
                    <input type="hidden" name="t" id="t" value="1" />
                    
                    <button type="submit" class="btn btn-default">Descargar</button>
                    <button type="button" id="compartir" class="btn btn-primary">Compartir</button>
                    <button type="button" id="updatePreview" class="btn btn-default">Previsualizar</button>
                    </form>                    
                    
                </div>
                <div class="col-md-4">
                    <div class="form-group text-left">
                        <label for="batSlaptemplate">Plantilla:</label>
                        <select class="form-control" id="batSlaptemplate">
                            <option value="1">Cl&aacute;sico</option>
                            <option value="2">Cl&aacute;sico 4 Vi&ntilde;etas</option>
                        </select>                
                    </div>                
                    <div class="alert alert-info" role="alert">
                        Una creaci&oacute;n de <strong>Mauro Cifuentes</strong><br />
                        <a href="http://www.whitecat.com.ar">www.whitecat.com.ar</a>
                    </div>
                    <div class="fb-like text-left" data-send="true" data-width="370" data-show-faces="true"></div>                    
                </div>
            </div> 
            <div class="row">
                <div class="col-md-12 text-left">
                    <div id="ultimosMemes"></div>
                </div>
            </div>
        </div>

        </div><!-- /.container -->
    
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>    
        <!-- Latest compiled and minified JavaScript -->
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        
        <script>
            $('#updatePreview').click(function() {
                var r = $('#r').val();
                var b = $('#b').val();
                var r2 = $('#r2').val();
                var b2 = $('#b2').val();
                var t = $('#batSlaptemplate').val();
                
                $('#preview').prop("src", "gen.php?t="+ t +"&r="+ r +"&b="+ b +"&r2="+ r2 +"&b2="+ b2);
            });

            $('#compartir').click(function() {
                var r = $('#r').val();
                var b = $('#b').val();
                var r2 = $('#r2').val();
                var b2 = $('#b2').val();
                var t = $('#batSlaptemplate').val();
                
                //$('#preview').prop("src", "gen.php?c=1&t="+ t +"&r="+ r +"&b="+ b +"&r2="+ r2 +"&b2="+ b2);
                
                $.ajax({
                    url: "gen.php?c=1&t="+ t +"&r="+ r +"&b="+ b +"&r2="+ r2 +"&b2="+ b2,
                    success: function(response) {
                        console.log(response);
                        location.href = "https://www.facebook.com/sharer/sharer.php?u="+ response.url;
                    }
                });
            });
            
            
            $('#batSlaptemplate').change(function(event){
                var template = event.target.value;
                $("#t").val(template);
                if(template==2) {
                    $("#extraData").show();
                } else {
                    $("#extraData").hide();
                }
            });
            
            var updateUltimosMemes = function() {
                $.ajax({
                    url : 'list.php',
                    success : function(response) {
                        $("#ultimosMemes").empty();
                        for(var i=0; i<response.length; i++) {
                            $("#ultimosMemes").append('<img src="img/gen/'+ response[i] +'" class="memeThumbnail" />');
                        }
                    }
                });
            };
            
            var t = setInterval(updateUltimosMemes, 20000);
            
            updateUltimosMemes();
            
            //
            //http://whitecat.com.ar/demos/batslap/img/gen/batslap_20140712012508.jpg

        </script>
        
    </body>

</html>