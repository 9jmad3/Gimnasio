# Gimnasio
 Practica final de la primera evaluación PHP.
    
    CONTRASEÑA DE TODOS LOS USUARIOS DE LA BASE DE DATOS: 0aRaprueba


    PRIMEROS PASOS AL DESCARGAR.
        - Ejecutar Composer init para cargar todo lo relacionado con generar pfd.
        - Cambiar las variables que se encuentran en config/database por las que se tenga en phpMyAdmin

    EXPLICACION:

    En la carpeta config se encuentran los dos ficheros que contienen variables que se usan en el programa para llamar vista, bbdd y demás.
    En la carpeta controladores se encuentran los cuatro controladores que se comunican con el modelo y que con ellos se comunican las vistas.
    En la carpeta core se encuentran los controladores principales que no se han tocado para la realización de esta practica, además de la vista, el base model y el dbmanager que 
    también están sin editar. El archivo captcha.php es el que se encarga de la captcha del registro de usuarios.
    En la carpeta modelos se encuentra el unico modelo que ha sido utilizado. Con el se comunican los controladores y el se comunica con la base de datos.
    En la carpeta documentacion se encuentra toda la documentación generado con phpdocumentor. (iniciar index)
    En la carpeta fotos se guardan las fotos de perfil que suben los usuarios a sus cuentas.
    En la carpeta img hay imagenes relacionadas con la construcción de la página.
    En la carpeta vistas se encuetran todas las vistas que a su vez se componen de includes que se encuetran en la carpeta del mismo nombre que se encuetra en la carpeta vistas.
    Las carpetas css, js, font y scss están tal y como las facilita mdbootstrap en su plantilla. -> https://mdbootstrap.com/docs/b4/jquery/getting-started/download/

    El archivo debug.log se crea en visual studio code.
    El archivo qr.php es para generar el qr de la página y no se puede ejecutar normalmente. Requiere una modificación de código para su utilización.
    El archivo index.php ejecuta la aplicación.

    



 
Título del Proyecto
Acá va un párrafo que describa lo que es el proyecto

Comenzando 🚀
Estas instrucciones te permitirán obtener una copia del proyecto en funcionamiento en tu máquina local para propósitos de desarrollo y pruebas.

Mira Deployment para conocer como desplegar el proyecto.

Pre-requisitos 📋
Que cosas necesitas para instalar el software y como instalarlas

Da un ejemplo
Instalación 🔧
Una serie de ejemplos paso a paso que te dice lo que debes ejecutar para tener un entorno de desarrollo ejecutandose

Dí cómo será ese paso

Da un ejemplo
Y repite

hasta finalizar
Finaliza con un ejemplo de cómo obtener datos del sistema o como usarlos para una pequeña demo

Ejecutando las pruebas ⚙️
Explica como ejecutar las pruebas automatizadas para este sistema

Analice las pruebas end-to-end 🔩
Explica que verifican estas pruebas y por qué

Da un ejemplo
Y las pruebas de estilo de codificación ⌨️
Explica que verifican estas pruebas y por qué

Da un ejemplo
Despliegue 📦
Agrega notas adicionales sobre como hacer deploy

Construido con 🛠️
Menciona las herramientas que utilizaste para crear tu proyecto

Dropwizard - El framework web usado
Maven - Manejador de dependencias
ROME - Usado para generar RSS
Contribuyendo 🖇️
Por favor lee el CONTRIBUTING.md para detalles de nuestro código de conducta, y el proceso para enviarnos pull requests.

Wiki 📖
Puedes encontrar mucho más de cómo utilizar este proyecto en nuestra Wiki

Versionado 📌
Usamos SemVer para el versionado. Para todas las versiones disponibles, mira los tags en este repositorio.

Autores ✒️
Menciona a todos aquellos que ayudaron a levantar el proyecto desde sus inicios

Andrés Villanueva - Trabajo Inicial - villanuevand
Fulanito Detal - Documentación - fulanitodetal
También puedes mirar la lista de todos los contribuyentes quíenes han participado en este proyecto.

Licencia 📄
Este proyecto está bajo la Licencia (Tu Licencia) - mira el archivo LICENSE.md para detalles

Expresiones de Gratitud 🎁
Comenta a otros sobre este proyecto 📢
Invita una cerveza 🍺 o un café ☕ a alguien del equipo.
Da las gracias públicamente 🤓.
etc.