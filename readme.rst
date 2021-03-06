1- Para instalar la aplicacion se debe copiar la carpeta "summa" en el directorio raiz del servidor local.

2- Para acceder se debe ingresar en la siguiente url "http://localhost/summa/".

3- La aplicacion se encuentra dentro de la carpeta "application" y dentro de controlles, models y views se encuentran
   los archivos php.

4- Dentro de la carpeta "summa" existe un archivo llamado "summa.sql" donde se encuentra el script de la base de datos 
   y las tablas que la componen.

5- Existen 5 tablas, "empresa", "empleado", "especialidad", "profesion" y "tipo_empleado".
   La tabla "empresa" contiene "id" como PK y "nombre".
   La tabla "empleado" posee todos los datos asociados al empleado, tiene un "id" como PK y posee dos FK
   "tipo_empleado" y "empresa".
   La tabla "tipo_empleado" relaciona las profesiones y las especialidades, tiene un "id" como PK y dos FK
   "id_profesion" y "id_especialidad".
   La tabla "profesion" almacena los id y nombres de cada profesion.
   La tabla "especialidad" almacena los id y nombres de las especialidades.

6- Existen validaciones hechas en el frontend y en el backend.  


-El framework utilizado para hacer el desarrollo fue CodeIgniter, el motivo por el que se eligio este framework, 
fue para implementar el patron mvc y obtener las ventajas que nos proporciona.

-Pasos realizados para solucionar los requerimientos solicitados:
Se crearon las clases Empresa y Empleado, tambien se creo la clase Programador y Disenador las cuales heredan los metodos 
y atributos de Empleado.
Se crearon dos controladores cada uno para manejar las solicitudes correspondientes a su clase y se crearon las vistas necesarias. 
Además, se implemento el uso de AJAX para desplegar opciones nuevas en los formularios para agregar un nuevo empleado y se persistieron
los datos de los empleados y empresas en una base de datos llamada summa.


###################
What is CodeIgniter
###################

CodeIgniter is an Application Development Framework - a toolkit - for people
who build web sites using PHP. Its goal is to enable you to develop projects
much faster than you could if you were writing code from scratch, by providing
a rich set of libraries for commonly needed tasks, as well as a simple
interface and logical structure to access these libraries. CodeIgniter lets
you creatively focus on your project by minimizing the amount of code needed
for a given task.

*******************
Release Information
*******************

This repo contains in-development code for future releases. To download the
latest stable release please visit the `CodeIgniter Downloads
<https://codeigniter.com/download>`_ page.

**************************
Changelog and New Features
**************************

You can find a list of all changes for each release in the `user
guide change log <https://github.com/bcit-ci/CodeIgniter/blob/develop/user_guide_src/source/changelog.rst>`_.

*******************
Server Requirements
*******************

PHP version 5.6 or newer is recommended.

It should work on 5.3.7 as well, but we strongly advise you NOT to run
such old versions of PHP, because of potential security and performance
issues, as well as missing features.

************
Installation
************

Please see the `installation section <https://codeigniter.com/user_guide/installation/index.html>`_
of the CodeIgniter User Guide.

*******
License
*******

Please see the `license
agreement <https://github.com/bcit-ci/CodeIgniter/blob/develop/user_guide_src/source/license.rst>`_.

*********
Resources
*********

-  `User Guide <https://codeigniter.com/docs>`_
-  `Language File Translations <https://github.com/bcit-ci/codeigniter3-translations>`_
-  `Community Forums <http://forum.codeigniter.com/>`_
-  `Community Wiki <https://github.com/bcit-ci/CodeIgniter/wiki>`_
-  `Community IRC <https://webchat.freenode.net/?channels=%23codeigniter>`_

Report security issues to our `Security Panel <mailto:security@codeigniter.com>`_
or via our `page on HackerOne <https://hackerone.com/codeigniter>`_, thank you.

***************
Acknowledgement
***************

The CodeIgniter team would like to thank EllisLab, all the
contributors to the CodeIgniter project and you, the CodeIgniter user.
