<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf8_general_ci">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <title>ENCAP | Validación de certificados</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../public/css/font-awesome.css">
   
    <!-- Theme style -->
    <link rel="stylesheet" href="../public/css/AdminLTE.min.css">

    <!-- sweetalert2 -->
  <link rel="stylesheet" href="../public/css/sweetalert.min.css" />
  <!-- Icono Web -->
    <link rel="icon" href="../files/ENCAP.ico">
  </head>

  
<body class="hold-transition" style="background-image: url(../files/blue.jpg); background-size: 100% 100%; background-attachment: fixed">

  <section class="content">        
      <!-- centro -->
    <div class="panel-body">
        <div class="row">
           <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12" >            
     
          </div>

            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12" style="padding: 80px 30px 30px 30px">
                <div class="row">
                  <div class="col-lg-12 col-md-6 col-sm-12 col-xs-12" style="text-align:center">
                      <a href="">
                      <img src="../files/encap blanco.png" alt="logo encap" width="120px" height="100%">
                      </a>                
                  </div><br>

                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 100px 0px 20px 0px">
                    <form method="post" id="frmAcceso" >       
                
                      <div class="row">
                        <h1 style="color:#fff; padding: 20px ;text-align:center;">VALIDACIÓN DE CERTIFICADO</h1><br>
                          <div class="row">
                            <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">              
                              <input type="text" id="consultar" name="consultar" class="form-control" style="font-size: 18px; height:44px;border-radius: 10px;" placeholder="Ingresa su Código de matricula">      
                            
                            </div>                                    
                            <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">                      
                                <button name="btnBuscar" type="submit" style="color:#fff; font-size: 18px; border-radius: 10px;" class="btn btn-success btn-block btn-lg"><i class="fa fa-search"></i> Buscar</button>
                            </div> 
                             
                          </div><!-- /.col -->
                          <br> <br> <br>
                        <div class="row">
                          <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12" ></div>

                          <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12" style="font-size: 16px; color:#fff; padding: 15px;border: radius 30px; text-align: center; border: 2px solid #EBB10D;">                       
                          <strong > Valida si has estudiado con nosotros (desde enero del año 2022) </strong >
                                        
                          </div> 
                          <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12" ></div>          
                      </div>
                      </div>
                  </form>
                            
                 </div>
              </div>       
            </div>                    
            <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12" >
            </div>
            
            </div>                          
        </div>  
  </section>

    <!-- jQuery -->
    <script src="../public/js/jquery-3.1.1.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../public/js/bootstrap.min.js"></script>
     <!-- Bootbox -->
    <script src="../public/js/bootbox.min.js"></script>	

  <script type="text/javascript">

   /* function Consulta(){
      consultar=$("#consultar").val();
      $(location).attr("href","http://localhost/SISt_ENCAP_V2/certificados/certificados.php?consultarid="+consultar);

    }*/


    $("#frmAcceso").on('submit',function(e)
            {
                e.preventDefault();
                consultar=$("#consultar").val();

                $.post("../controladores/validacion.php?op=verificar",
                    {"consultar":consultar},
                    function(data)
                {
                    if (data!="null")
                    {         
                        $(location).attr("href","https://sistemas.encap.edu.pe/certificadosprueba/certificados.php?consultarid="+consultar);
                    }
                    else
                    {
                        swal("Digite un código de matricula correcto...","","error");
                    }
                });
            })

 

      
      
    </script>

<!-- sweetalert2 -->
<script src="../public/js/sweetalert.min.js"></script>
<!-- AdminLTE App -->
<script src="../public/js/app.min.js"></script>
<script src="../public/js/bootstrap-select.min.js"></script>
<!-- sweetalert2 -->
<script src="../public/js/sweetalert.min.js"></script>  
</body>
</html>
