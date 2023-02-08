
                function Buscar(){//73319840
                
                  var ndni= document.getElementById("num_documento").value;
                  var inputNombre= document.getElementById("nombre1");
                  var tipoDoc=document.getElementById("idtipo_documento");
                  var direccion=document.getElementById("direccion");
                  var provincia=document.getElementById("ciudad");
                  var departamento=document.getElementById("departamento");
                  var pais=document.getElementById("idpais");
                  var seltipoDoc= tipoDoc.options[tipoDoc.selectedIndex].text;
                    
                  inputNombre.value="Cargando consulta...";

                  pais.selectedIndex=2;
                  console.log(seltipoDoc);
                  var nombre;
                  $('#idpais').val('2').change();

                  if(ndni.length<5){
                    console.log("Debe ingresar mas de 8 digitos.");
                    return false;
                  }


                  switch(seltipoDoc){

                    case "DNI":

                       const options = {
                          method: 'POST',
                          headers: {Accept: 'application/json', 'Content-Type': 'application/json'},
                          body: JSON.stringify({token: 'IXb85lyvR2hEkF3iRuhTnSJVgemqaZERuhep0OA5TN29I4RNyhGeYn3Sexdr', dni: ndni})
                        };

                        fetch('https://api.migo.pe/api/v1/dni', options)
                          .then(response => response.json()              
                  
                          )
                          .then(response =>{
                            if(response.success==false){
                              inputNombre.value="No se encontró el documento.";
                              direccion.value="";
                            provincia.value="";
                            departamento.value="";
                            }else{
                              nombre=response.nombre;
                            dni=response.dni;
                            inputNombre.value=nombre;
                            direccion.value="";
                            provincia.value="";
                            departamento.value="";
                            }
                           
                          } 
                            
                          )
                          .catch(err => {
                            console.error(err);
                            
                          });

                      break;


                    case "RUC":

                      const options2 = {
                        method: 'POST',
                        headers: {Accept: 'application/json', 'Content-Type': 'application/json'},
                        body: JSON.stringify({token: 'IXb85lyvR2hEkF3iRuhTnSJVgemqaZERuhep0OA5TN29I4RNyhGeYn3Sexdr', ruc: ndni})
                      };

                      fetch('https://api.migo.pe/api/v1/ruc', options2)
                        .then(response => response.json())
                        .then(response =>{
                          if(response.success==false){
                            inputNombre.value="No se encontró el documento.";
                            direccion.value="";
                            provincia.value="";
                            departamento.value="";
                          }else{
                            nombre=response.nombre_o_razon_social;
                          inputNombre.value=nombre;
                          direccion.value=response.direccion;
                          provincia.value=response.provincia;
                          departamento.value=response.departamento;
                  
                          }
                        
                        })
                        .catch(err => console.error(err));

                      break;



                  }


            

                
             
                }


      