
### Prueba tecnica connectib
Requerimiento general:
La empresa “XXXXXX S.A.” desea realizar una aplicación web que permita administrar la información
de sus usuarios, por seguridad de la información el usuario tendrá que autenticarse en la aplicación
con sus credenciales, para esto el personal a cargo del proyecto ha identificado los siguientes
requerimientos:
Consideraciones Generales
- Escribir código legible.
- No olvidar realizar comentarios en el código.
- Realizar migraciones y seeders.
- Todas las relaciones del diseño de la base de datos deben verse reflejadas en los modelos de
Laravel.
Requerimientos Técnicos
La empresa desea que su software sea desarrollado con el lenguaje de programación PHP haciendo
uso de su framework Laravel.
- Se desea conocer el avance del proyecto desde su inicio hasta la entrega, por ello solicita que el
código sea versionado mediante una plataforma git pública.
Requerimiento Funcionales
 Administración
Se desea que los datos del usuario administrador del sistema sean ingresados mediante un
seeder. Cuando el administrador se haya logueado, puede ver sus datos y la opción de cerrar
sesión.
 Autenticación
Con base en la autenticación que ofrece Laravel, se debe permitir el acceso a los usuarios de la
empresa por medio de email y una contraseña, una vez logueado, el usuario puede ver sus datos y
la opción de cerrar sesión.
Por seguridad de la aplicación, se solicita que se realicen las validaciones correspondientes de los
campos de inicio de sesión.
 Módulo de usuarios
Este módulo será visible solo para el administrador del sistema.
Ingreso de usuarios en el sistema por el rol administrador
Para el formulario de registro de usuarios se necesitan los siguientes campos con sus respectivas
validaciones y mensajes de error:
- Identificador. - Dato obligatorio, numérico.
- Email. - Dato obligatorio, debe ser único, se debe verificar que el email ingresado sea
válido.
- Contraseña. - Dato obligatorio, mínimo de 8 caracteres, debe contener al menos un
número,
una letra mayúscula, un carácter especial.
- Verificación de contraseña. - El usuario debe verificar su contraseña.
- Nombre. - Dato obligatorio, longitud de 100 caracteres.
- Número Celular. - Dato opcional de 10 dígitos
- Cédula. - Dato de tipo texto, obligatorio con longitud máxima de 11 caracteres.
- Fecha de nacimiento. - Dato obligatorio, el usuario no puede ser menor de 18 años.
- Código de Ciudad. - Dato obligatorio de tipo numérico.
El formulario debe considerar tres campos de tipo select o autocompletado (anidados),
destinados a la selección de país, departamento y ciudad, estos campos deben cargarse en ese
orden mediante una petición ajax, la ciudad seleccionada será relacionada al usuario.
Cuando el formulario sea llenado de forma exitosa, el sistema debe guardar la contraseña del
usuario de forma encriptada.
 Visualización de Datos
Para visualizar los datos de los usuarios de forma ágil, se requiere la realización de una interfaz
que contenga una tabla de datos o DataTable, debe contener una sección de filtros y paginación
bajo el siguiente detalle:
- Se solicita un filtro general (campo de texto) que busque por nombre, cédula, email,
celular.
- La tabla de datos debe ordenarse por columnas.
- La tabla de datos debe mostrar todos los campos de los usuarios excepto el password.
- La tabla de datos debe visualizar una columna de edad, aunque no se guarde en base de
datos.
- La tabla de datos debe tener una paginación del lado del servidor (server side) y debe ser
configurable la cantidad de registros por página.
 Actualización y Eliminación de Usuarios
Desde la interfaz de visualización de datos el administrador debe ser capaz de editar su
información o eliminar un registro de ser pertinente.
Cuando se realice la edición de información se solicita la siguiente restricción: no se debe
permitir cambiar la cédula ni el email del usuario.
Consumo API-Rest
Utilice el api publicada alojada en:
https://jsonplaceholder.typicode.com/
- Listar los post realizados por un usuario.
-En el encabezado debe ir la información relacionada al usuario.
-En el cuerpo de página deben ir los post realizados por usuario. (Se considerará positivamente la
presentación de los mismos).
-Incluir un campo “User ID” para realizar el filtrado de los post.

## Deploy
 Si utiliza docker
docker-compose build -d o docker-compose up -d 
## Si no
Crear archivo .env : 

DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=connectib
DB_USERNAME=root
DB_PASSWORD=root
APP_DEBUG=true
APP_KEY= 

crear base de datos connectib o ejecutar el backup ubicado en public/backup
composer install
php artisan key:generate
php artisan migrate 
php artisan db:seed 

http://localhost/connectib/public/index.php/login
email : admin@admin.com
password: admin




