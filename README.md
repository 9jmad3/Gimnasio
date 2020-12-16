# Gimnasio
 Practica final de la primera evaluación PHP.
    
    CONTRASEÑA DE TODOS LOS USUARIOS DE LA BASE DE DATOS: 0aRaprueba


    📋 PRIMEROS PASOS AL DESCARGAR.
        - Ejecutar Composer init para cargar todo lo relacionado con generar pfd. (vendor)
        - Cambiar las variables que se encuentran en config/database por las que se tenga en phpMyAdmin

    📦 EXPLICACION

        En la carpeta config se encuentran los dos ficheros que contienen 
        variables que se usan en el programa para llamar vista, bbdd y demás.

        En la carpeta controladores se encuentran los cuatro controladores 
        que se comunican con el modelo y que con ellos se comunican las vistas.

        En la carpeta core se encuentran los controladores principales que no se han tocado 
        para la realización de esta practica, además de la vista, el base model y el dbmanager que 
        también están sin editar. El archivo captcha.php es el que se encarga de la captcha del 
        registro de usuarios.

        En la carpeta modelos se encuentra el unico modelo que ha sido utilizado. 
        Con el se comunican los controladores y el se comunica con la base de datos.

        En la carpeta documentacion se encuentra toda la documentación generado con phpdocumentor. 
        (iniciar index). También se encuentra una breve guía de usuario de la aplicación.

        En la carpeta fotos se guardan las fotos de perfil que suben los usuarios a sus cuentas.

        En la carpeta img hay imagenes relacionadas con la construcción de la página.

        En la carpeta vistas se encuetran todas las vistas que a su vez se componen de includes 
        que se encuetran en la carpeta del mismo nombre que se encuetra en la carpeta vistas.

        Las carpetas css, js, font y scss están tal y como las facilita mdbootstrap en su 
        plantilla. -> https://mdbootstrap.com/docs/b4/jquery/getting-started/download/

        El archivo debug.log se crea en visual studio code.

        El archivo qr.php es para generar el qr de la página y no se puede ejecutar normalmente. 
        Requiere una modificación de código para su utilización.

        El archivo index.php ejecuta la aplicación.

