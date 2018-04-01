function mostrarDatosEstudiante(estudiante) {



    $("#nombres").val(estudiante.nombres);
    $("#apellidos").val(estudiante.apellidos);
    $("#fecha-nacimiento").val(estudiante.fecha_nacimiento);
    $("#sexo").val(estudiante.sexo);
    $("#direccion").val(estudiante.direccion);
    $("#barrio").val(estudiante.barrio);
    $("#tipo-documento").val(estudiante.tipo_documento);
    $("#tipo-sangre").val(estudiante.tipo_sangre);
    $("#zona").val(estudiante.zona);
    $("#estrato").val(estudiante.estrato);
    $("#sisbem").val(estudiante.sisbem);
    $("#ips").val(estudiante.ips);
    $("#eps").val(estudiante.eps);
    $("#lugar-residencia").val(estudiante.lugar_residencia);
    $("#lugar-expedicion").val(estudiante.lugar_expedicion);
    $("#telefono-celular").val(estudiante.telefono_celular);
    $("#telefono-fijo").val(estudiante.telefono_fijo);
    $("#correo-institucional").val(estudiante.correo_institucional);




    $("#desplazado").prop('checked', Boolean(Number(estudiante.desplazado)));
    $("#afro").prop('checked', Boolean(Number(estudiante.afro)));
    $("#indigena").prop('checked', Boolean(Number(estudiante.indigena)));
    $("#rom").prop('checked', Boolean(Number(estudiante.rom)));
    $("#cabeza-familia").prop('checked', Boolean(Number(estudiante.cabeza_familia)));
    $("#embarazada").prop('checked', Boolean(Number(estudiante.embarazada)));
    $("#adulto-mayor").prop('checked', Boolean(Number(estudiante.adulto_mayor)));
    $("#lgbti").prop('checked', Boolean(Number(estudiante.lgbti)));
    $("#otra-poblacion-especial").prop('checked', Boolean(Number(estudiante.otra_poblacion_especial)));
    $("#nombre-otra-poblacion-especial").prop('checked', Boolean(Number(estudiante.nombre_otra_poblacion_especial)));


    $("#discapacidad-auditiva").prop('checked', Boolean(Number(estudiante.discapacidad_auditiva)));
    $("#discapacidad-cognitiva").prop('checked', Boolean(Number(estudiante.discapacidad_cognitiva)));
    $("#discapacidad-fisica").prop('checked', Boolean(Number(estudiante.discapacidad_fisica)));
    $("#otra-discapacidad").prop('checked', Boolean(Number(estudiante.otra_discapacidad)));
    $("#nombre-otra-discapacidad").prop('checked', Boolean(Number(estudiante.nombre_otra_discapacidad)));


    /*
     * Select2
     * */

    $("#nivel-estudios").val(estudiante.nivel_educacion);
    $('#nivel-estudios').trigger('change');
    $('#anio-ultimo-grado-cursado').val(estudiante.anio_ultimo_grado_cursado);
    $('#nivel-estudios').trigger('change');
    $('#ultimo-grado-cursado').val(estudiante.ultimo_grado_cursado);
    $('#ultimo-grado-cursado').trigger('change');


    $('#titulo').val(estudiante.titulo);
    $('#anio-titulo').val(estudiante.anio_titulo);
    $('#institucion').html('<option value="' + estudiante.institucion + '">' + estudiante.nombre_institucion + '</option>');
    $("#institucion").val(estudiante.institucion);



    $('#lugar-residencia').html('<option value="' + estudiante.lugar_residencia + '">' + estudiante.nombre_lugar_residencia + '</option>');
    $("#lugar-residencia").val(estudiante.lugar_residencia);
    $('#lugar-nacimiento').html('<option value="' + estudiante.lugar_nacimiento + '">' + estudiante.nombre_lugar_nacimiento + '</option>');
    $("#lugar-nacimiento").val(estudiante.lugar_nacimiento);
    $('#lugar-expedicion').html('<option value="' + estudiante.lugar_expedicion_documento + '">' + estudiante.nombre_lugar_expedicion_documento + '</option>');
    $("#lugar-expedicion").val(estudiante.lugar_expedicion_documento);






    $("#nombres-madre").val(estudiante.nombres_madre);
    $("#nombres-padre").val(estudiante.nombres_padre);
    $("#nombres-acudiente").val(estudiante.nombres_acudiente);
    $("#telefono-celular-madre").val(estudiante.telefono_celular_madre);
    $("#telefono-celular-padre").val(estudiante.telefono_celular_padre);
    $("#telefono-fijo-madre").val(estudiante.telefono_fijo_madre);
    $("#telefono-fijo-padre").val(estudiante.telefono_fijo_padre);
    $("#telefono-celular-acudiente").val(estudiante.telefono_celular_acudiente);


    $("#copia-documento").prop('checked', Boolean(Number(estudiante.copia_documento)));
    $("#carta-especial").prop('checked', Boolean(Number(estudiante.carta_especial)));
    $("#copia-diploma").prop('checked', Boolean(Number(estudiante.copia_diploma)));
    $("#certificado-estudio").prop('checked', Boolean(Number(estudiante.certificado_estudio)));
    $("#recibo-servicio-publico").prop('checked', Boolean(Number(estudiante.recibo_servicio_publico)));
    $("#foto").prop('checked', Boolean(Number(estudiante.foto)));



    $(".form-control-input").prop("disabled",true);
    $(".form-control-input2").prop("readonly",true);


}