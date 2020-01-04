@extends('layouts.app')
@section('javascript')
@endsection
@section('content')
<div class="container">
    <div class=" row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">
                    Ayuda y documentos de apoyo.
                </div>
                <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="media border p-3">
                            <div class="media-body">
                                    <a  href="/ayudaDocs/Reglamento_Específico_de_Procesos_de_Graduacion_FIA.pdf"><h4>Reglamento Específico de Procesos de Graduación  FIA <span class="oi oi-cloud-download"> </h4></a>

                              <div class="media p-3">
                                    <ul class="list-group" id= "recursosAyuda">
                                        <a href="/ayudaDocs/Anexo_A_Formato_para_presentacion_de_perfil.docx"><h4><small><i>Formato para presentación de perfil  <span class="oi oi-cloud-download"></i></small></h4></a>
                                        <a href="/ayudaDocs/Anexo_B_Formato_resumen_del_perfil.docx"><h4><small><i>Formato de resumen del perfil <span class="oi oi-cloud-download"> </i></small></h4></a>
                                        <a href="/ayudaDocs/Anexo_C_Formatos_para_Bitacora.docx"><h4><small><i>Formatos para bitácoras  <span class="oi oi-cloud-download"></i></small></h4></a>
                                        <a href="/ayudaDocs/Anexo_D_Formato_para_presentacion_informe_seguimiento.docx"><h4><small><i>Formato de informe de seguimiento del Trabajo de Graduación   <span class="oi oi-cloud-download"></i></small></h4></a>
                                        <a href="/ayudaDocs/Anexo_E_Formato_de_solicitud_de_cambio_de_nombre.docx"><h4><small><i>Formato de Solicitud de cambio de nombre del Trabajo de Graduación  <span class="oi oi-cloud-download"></i></small></h4></a>
                                        <a href="/ayudaDocs/Anexo_F_Formato_de_solicitud_de_prorroga_de_TDG.docx"><h4><small><i>Formato de solicitud de prórroga y extensión de prórroga para finalizar el trabajo de graduación  <span class="oi oi-cloud-download"></i></small></h4></a>
                                        <a href="/ayudaDocs/Anexo_G_Formato_de_solicitud_de_defensa_final.docx"><h4><small><i>Formato de solicitud de defensa final ante Tribunal Calificador  <span class="oi oi-cloud-download"></i></small></h4></a>
                                        <a href="/ayudaDocs/Anexo_H_Formato_de_acta_de_registro_de_calificacion_etapa_III.docx"><h4><small><i>Formato de acta de registro de resultados de defensa final por el Tribunal Calificador  <span class="oi oi-cloud-download"></i></small></h4></a>
                                        <a href="/ayudaDocs/Anexo_I_Formato_de_solicitud_de_ratificación_de_notas.docx"><h4><small><i>Formato de solicitud de ratificación de calificaciones del Trabajo de Graduación  <span class="oi oi-cloud-download"></i></small></h4></a>
                                        <a href="/ayudaDocs/Anexo_J_Indicaciones_para_formato_de_portada_de_TDG.doc"><h4><small><i>Indicaciones para formato de portada de TDG  <span class="oi oi-cloud-download"></i></small></h4></a>
                                        <a href="/ayudaDocs/Anexo_K_Instrucciones_para_redacción_de_artículos_tecnicos.docx"><h4><small><i>Instrucciones para redacción de artículos tecnicos  <span class="oi oi-cloud-download"></i></small></h4></a>
                                        <a href="/ayudaDocs/Guia_de_estilo_para_edicion_de_TDG.docx"><h4><small><i>Guia de estilo para edición de TDG  <span class="oi oi-cloud-download"></i></small></h4></a>
                                        <a href="/ayudaDocs/Procedimiento_entrega_de_ejemplares.docx"><h4><small><i>Procedimiento entrega de ejemplares  <span class="oi oi-cloud-download"></i></small></h4></a>

                                    </ul>
                                    </div>



                            </div>

                          </div>
                          <br>
                          <br>
                          <div class="media border p-3">
                                <div class="media-body">
                                        <h4>Video Tutoriales.</h4>
                                 
                                @can('student.ingresar')
                                
                                            <div id="26">
                                                <a class="card-link" data-toggle="collapse" href="#collapse26">
                                                    Ver Acuerdos  <span class="oi oi-play-circle">
                                                  </a>
                                                   <div id="collapse26" class="collapse" >
                                                    <center>
                                                    <video width="640" height="380" controls>
                                                        <source src="/videos/Coordinador general y de escuela/Ver acuerdos.mp4" type="video/mp4">
                                                        
                                                      </video>
                                                    </center>
                                                  </div>
                                            </div>
                                            
                                                <div id="1">
                                                    <a class="card-link" data-toggle="collapse" href="#collapse1">
                                                        Ingreso de estudiantes al sistema   <span class="oi oi-play-circle">
                                                    </a>
                                                    <div id="collapse1" class="collapse" >
                                                        <center>
                                                            <video width="640" height="380" controls>
                                                                <source src="/videos/Academica/Ingresar estudiantes por archivo de excel.mp4" type="video/mp4">
                                                            </video>
                                                        </center>
                                                        
                                                    </div>
                                                </div>
                                                
                                @endcan
                                      
                                   @can('tdg.ingresar')
                                  
                                    
                                               
                                                <div id="2">
                                                    <a class="card-link" data-toggle="collapse" href="#collapse2">
                                                        Asignar grupo  <span class="oi oi-play-circle">
                                                      </a>
                                                       <div id="collapse2" class="collapse" >
                                                           <center>
                                                        <video width="640" height="380" controls>
                                                            <source src="/videos/Coordinador de escuela/Asignar grupo.mp4" type="video/mp4">
                                                            
                                                          </video>
                                                           </center>
                                                      </div>
                                                </div>

                                                <div id="3">
                                                    <a class="card-link" data-toggle="collapse" href="#collapse3">
                                                        Generar reportes  <span class="oi oi-play-circle">
                                                      </a>
                                                       <div id="collapse3" class="collapse" >
                                                           <center>
                                                        <video width="640" height="380" controls>
                                                            <source src="/videos/Coordinador de escuela/Generar reportes.mp4" type="video/mp4">
                                                            
                                                          </video>
                                                           </center>
                                                      </div>
                                                </div>

                                                <div id="4">
                                                    <a class="card-link" data-toggle="collapse" href="#collapse4">
                                                        Gestionar TDG - Introducción a Gestionar TDG e imprimir TDG  <span class="oi oi-play-circle">
                                                      </a>
                                                       <div id="collapse4" class="collapse" >
                                                           <center>
                                                        <video width="640" height="380" controls>
                                                            <source src="/videos/Coordinador de escuela/Gestionar TDG - Introducción a Gestionar TDG e imprimir TDG.mp4" type="video/mp4">
                                                            
                                                          </video>
                                                           </center>
                                                      </div>
                                                </div>

                                                <div id="5">
                                                    <a class="card-link" data-toggle="collapse" href="#collapse5">
                                                        Gestionar TDG - Notificar abandono de estudiante de tdg  <span class="oi oi-play-circle">
                                                      </a>
                                                       <div id="collapse5" class="collapse" >
                                                        <center>
                                                        <video width="640" height="380" controls>
                                                            <source src="/videos/Coordinador de escuela/Gestionar TDG - Notificar abandonó de estudiante de tdg.mp4" type="video/mp4">
                                                            
                                                          </video>
                                                        </center>
                                                      </div>
                                                </div>

                                                <div id="6">
                                                    <a class="card-link" data-toggle="collapse" href="#collapse6">
                                                        Gestionar TDG - Notificar abandonó de tdg  <span class="oi oi-play-circle">
                                                      </a>
                                                       <div id="collapse6" class="collapse" >
                                                        <center>
                                                        <video width="640" height="380" controls>
                                                            <source src="/videos/Coordinador de escuela/Gestionar TDG - Notificar abandonó de tdg.mp4" type="video/mp4">
                                                            
                                                          </video>
                                                        </center>
                                                      </div>
                                                </div>

                                                <div id="7">
                                                    <a class="card-link" data-toggle="collapse" href="#collapse7">
                                                        Ingresar perfil  <span class="oi oi-play-circle">
                                                      </a>
                                                       <div id="collapse7" class="collapse" >
                                                        <center>
                                                        <video width="640" height="380" controls>
                                                            <source src="/videos/Coordinador de escuela/Ingresar perfil.mp4" type="video/mp4">
                                                            
                                                          </video>
                                                        </center>
                                                      </div>
                                                </div>

                                                <div id="8">
                                                    <a class="card-link" data-toggle="collapse" href="#collapse8">
                                                        Solicitud de cambio de nombre  <span class="oi oi-play-circle">
                                                      </a>
                                                       <div id="collapse8" class="collapse" >
                                                        <center>
                                                        <video width="640" height="380" controls>
                                                            <source src="/videos/Coordinador de escuela/Solicitud de cambio de nombre.mp4" type="video/mp4">
                                                            
                                                          </video>
                                                        </center>
                                                      </div>
                                                </div>

                                                <div id="9">
                                                    <a class="card-link" data-toggle="collapse" href="#collapse9">
                                                        Solicitud de extensión de prórroga  <span class="oi oi-play-circle">
                                                      </a>
                                                       <div id="collapse9" class="collapse" >
                                                        <center>
                                                        <video width="640" height="380" controls>
                                                            <source src="/videos/Coordinador de escuela/Solicitud de extensión de prórroga.mp4" type="video/mp4">
                                                            
                                                          </video>
                                                        </center>
                                                      </div>
                                                </div>

                                                <div id="10">
                                                    <a class="card-link" data-toggle="collapse" href="#collapse10">
                                                        Solicitud de nombramiento de tribunal  <span class="oi oi-play-circle">
                                                      </a>
                                                       <div id="collapse10" class="collapse" >
                                                        <center>
                                                        <video width="640" height="380" controls>
                                                            <source src="/videos/Coordinador de escuela/Solicitud de nombramiento de tribunal.mp4" type="video/mp4">
                                                            
                                                          </video>
                                                        </center>
                                                      </div>
                                                </div>

                                                <div id="11">
                                                    <a class="card-link" data-toggle="collapse" href="#collapse11">
                                                        Solicitud de prórroga especial  <span class="oi oi-play-circle">
                                                      </a>
                                                       <div id="collapse11" class="collapse" >
                                                        <center>
                                                        <video width="640" height="380" controls>
                                                            <source src="/videos/Coordinador de escuela/Solicitud de prórroga especial.mp4" type="video/mp4">
                                                            
                                                          </video>
                                                        </center>
                                                      </div>
                                                </div>
                                                
                                                <div id="12">
                                                    <a class="card-link" data-toggle="collapse" href="#collapse12">
                                                        Solicitud de prórroga  <span class="oi oi-play-circle">
                                                      </a>
                                                       <div id="collapse12" class="collapse" >
                                                        <center>
                                                        <video width="640" height="380" controls>
                                                            <source src="/videos/Coordinador de escuela/Solicitud de prórroga.mp4" type="video/mp4">
                                                            
                                                          </video>
                                                        </center>
                                                      </div>
                                                </div>
                                                
                                                <div id="13">
                                                    <a class="card-link" data-toggle="collapse" href="#collapse13">
                                                        Solicitud de ratificación de resultados  <span class="oi oi-play-circle">
                                                      </a>
                                                       <div id="collapse13" class="collapse" >
                                                        <center>
                                                        <video width="640" height="380" controls>
                                                            <source src="/videos/Coordinador de escuela/Solicitud de ratificación de resultados.mp4" type="video/mp4">
                                                            
                                                          </video>
                                                        </center>
                                                      </div>
                                                </div>

                                                <div id="14">
                                                    <a class="card-link" data-toggle="collapse" href="#collapse14">
                                                        Ver las solicitudes  <span class="oi oi-play-circle">
                                                      </a>
                                                       <div id="collapse14" class="collapse" >
                                                        <center>
                                                        <video width="640" height="380" controls>
                                                            <source src="/videos/Coordinador de escuela/Ver solicitudes (falta terminar).mp4" type="video/mp4">
                                                            
                                                          </video>
                                                        </center>
                                                      </div>
                                                </div>


                                   
                                   @endcan
                                     
                                   @can('agreement.ingresar')
                                   
                                    
                                               
                                                <div id="15">
                                                    <a class="card-link" data-toggle="collapse" href="#collapse15">
                                                         Administracion - Editar tiempo de prórrogas  <span class="oi oi-play-circle">
                                                      </a>
                                                       <div id="collapse15" class="collapse" >
                                                        <center>
                                                        <video width="640" height="380" controls>
                                                            <source src="/videos/Coordinador general/Administrar - Editar prórrogas.mp4" type="video/mp4">
                                                            
                                                          </video>
                                                        </center>
                                                      </div>
                                                </div>

                                                <div id="16">
                                                    <a class="card-link" data-toggle="collapse" href="#collapse16">
                                                        Administracion - Gestion de usuarios  <span class="oi oi-play-circle">
                                                      </a>
                                                       <div id="collapse16" class="collapse" >
                                                        <center>
                                                        <video width="640" height="380" controls>
                                                            <source src="/videos/Coordinador general/Administrar - gestionar usuarios.mp4" type="video/mp4">
                                                            
                                                          </video>
                                                        </center>
                                                      </div>
                                                </div>

                                                <div id="17">
                                                    <a class="card-link" data-toggle="collapse" href="#collapse17">
                                                        Administracion - Ingreso de inicio de ciclo  <span class="oi oi-play-circle">
                                                      </a>
                                                       <div id="collapse17" class="collapse" >
                                                        <center>
                                                        <video width="640" height="380" controls>
                                                            <source src="/videos/Coordinador general/Administrar - Ingresar inicio de ciclo.mp4" type="video/mp4">
                                                            
                                                          </video>
                                                        </center>
                                                      </div>
                                                </div>

                                                <div id="18">
                                                    <a class="card-link" data-toggle="collapse" href="#collapse18">
                                                        Edición - Cambiar nombre de perfil  <span class="oi oi-play-circle">
                                                      </a>
                                                       <div id="collapse18" class="collapse" >
                                                        <center>
                                                        <video width="640" height="380" controls>
                                                            <source src="/videos/Coordinador general/Edición - Cambiar nombre.mp4" type="video/mp4">
                                                            
                                                          </video>
                                                        </center>
                                                      </div>
                                                </div>

                                                <div id="19">
                                                    <a class="card-link" data-toggle="collapse" href="#collapse19">
                                                        Edición - Deshabilitar perfiles  <span class="oi oi-play-circle">
                                                      </a>
                                                       <div id="collapse19" class="collapse" >
                                                        <center>
                                                        <video width="640" height="380" controls>
                                                            <source src="/videos/Coordinador general/Edición - Deshabilitar perfiles.mp4" type="video/mp4">
                                                            
                                                          </video>
                                                        </center>
                                                      </div>
                                                </div>

                                                <div id="20">
                                                    <a class="card-link" data-toggle="collapse" href="#collapse20">
                                                        Edición - Editar asignación de grupo  <span class="oi oi-play-circle">
                                                      </a>
                                                       <div id="collapse20" class="collapse" >
                                                        <center>
                                                        <video width="640" height="380" controls>
                                                            <source src="/videos/Coordinador general/Edición - Editar asignación de grupo.mp4" type="video/mp4">
                                                            
                                                          </video>
                                                        </center>
                                                      </div>
                                                </div>

                                                <div id="21">
                                                    <a class="card-link" data-toggle="collapse" href="#collapse21">
                                                        Envio de correo electronico  <span class="oi oi-play-circle">
                                                      </a>
                                                       <div id="collapse21" class="collapse" >
                                                        <center>
                                                        <video width="640" height="380" controls>
                                                            <source src="/videos/Coordinador general/Enviar correo.mp4" type="video/mp4">
                                                            
                                                          </video>
                                                        </center>
                                                      </div>
                                                </div>

                                                <div id="22">
                                                    <a class="card-link" data-toggle="collapse" href="#collapse22">
                                                        Generacion de reportes  <span class="oi oi-play-circle">
                                                      </a>
                                                       <div id="collapse22" class="collapse" >
                                                        <center>
                                                        <video width="640" height="380" controls>
                                                            <source src="/videos/Coordinador general/Generar reportes.mp4" type="video/mp4">
                                                            
                                                          </video>
                                                        </center>
                                                      </div>
                                                </div>

                                                <div id="23">
                                                    <a class="card-link" data-toggle="collapse" href="#collapse23">
                                                        Ratificación de solicitudes  <span class="oi oi-play-circle">
                                                      </a>
                                                       <div id="collapse23" class="collapse" >
                                                        <center>
                                                        <video width="640" height="380" controls>
                                                            <source src="/videos/Coordinador general/Ratificación de solicitudes.mp4" type="video/mp4">
                                                            
                                                          </video>
                                                        </center>
                                                      </div>
                                                </div>

                                                <div id="24">
                                                    <a class="card-link" data-toggle="collapse" href="#collapse24">
                                                        Ver detalles e imprimir un TDG  <span class="oi oi-play-circle">
                                                      </a>
                                                       <div id="collapse24" class="collapse" >
                                                        <center>
                                                        <video width="640" height="380" controls>
                                                            <source src="/videos/Coordinador general/Ver detalles e imprimir un TDG.mp4" type="video/mp4">
                                                            
                                                          </video>
                                                        </center>
                                                      </div>
                                                </div>
                                                <div id="26">
                                                  <a class="card-link" data-toggle="collapse" href="#collapse26">
                                                      Ver Acuerdos  <span class="oi oi-play-circle">
                                                    </a>
                                                     <div id="collapse26" class="collapse" >
                                                      <center>
                                                      <video width="640" height="380" controls>
                                                          <source src="/videos/Coordinador general y de escuela/Ver acuerdos.mp4" type="video/mp4">
                                                          
                                                        </video>
                                                      </center>
                                                    </div>
                                              </div>

                                                <div id="25">
                                                    <a class="card-link" data-toggle="collapse" href="#collapse25">
                                                        Ver solicitudes  <span class="oi oi-play-circle">
                                                      </a>
                                                       <div id="collapse25" class="collapse" >
                                                        <center>
                                                        <video width="640" height="380" controls>
                                                            <source src="/videos/Coordinador general/Ver solicitudes (falta solicitud de cambio de nombre).mp4" type="video/mp4">
                                                            
                                                          </video>
                                                        </center>
                                                      </div>
                                                </div>
                                                
                                         

                                   
                                   @endcan

                                    
                                
                                   
                                                <div id="27">
                                                    <a class="card-link" data-toggle="collapse" href="#collapse27">
                                                        Área de ayuda  <span class="oi oi-play-circle">
                                                      </a>
                                                       <div id="collapse27" class="collapse" >
                                                        <center>
                                                        <video width="640" height="380" controls>
                                                            <source src="/videos/Generales/Área de ayuda.mp4" type="video/mp4">
                                                            
                                                          </video>
                                                        </center>
                                                      </div>
                                                </div>

                                                <div id="28">
                                                    <a class="card-link" data-toggle="collapse" href="#collapse28">
                                                        Iniciar y cerrar sesión  <span class="oi oi-play-circle">
                                                      </a>
                                                       <div id="collapse28" class="collapse" >
                                                        <center>
                                                        <video width="640" height="380" controls>
                                                            <source src="/videos/Generales/Iniciar y cerrar sesión.mp4" type="video/mp4">
                                                            
                                                          </video>
                                                        </center>
                                                      </div>
                                                </div>

                                   
                                   
                                   
                                   @can('professor.ingresar')
                                   
                                               
                                                <div id="29">
                                                    <a class="card-link" data-toggle="collapse" href="#collapse29">
                                                        Administracion de docentes  <span class="oi oi-play-circle">
                                                      </a>
                                                       <div id="collapse29" class="collapse">
                                                        <center>
                                                        <video width="640" height="380" controls>
                                                            <source src="/videos/Secretaria de escuela/Administrar docentes.mp4" type="video/mp4">
                                                            
                                                          </video>
                                                        </center>
                                                      </div>
                                                </div>

                                                
                                      
                                   @endcan


                                  

                                   


                                    

                                   


                                </div>

                                

                              </div>

                </div>

            </div>
        </div>

    </div>

</div>

@endsection
