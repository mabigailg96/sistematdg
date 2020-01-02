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
                                    <ul class="list-group">
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
                                        <h4>Video Tutoriales sobre el uso del sistema.</h4>

                                    <div id="accordion">
                                        <div class="card">
                                            <div class="card-header">

                                            </div>

                                        </div>

                                    </div>



                                </div>

                              </div>

                </div>

            </div>
        </div>

    </div>

</div>

@endsection
