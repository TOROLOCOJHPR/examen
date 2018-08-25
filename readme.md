<strong>Instalación de dependencias</strong>

+ descargar e instalar composer https://getcomposer.org/download/
+ en tu consola de comandos dirigete a la raiz del proyecto y ejecuta el comando: <strong>composer install</strong>
<br> para descargar las dependencias necesarias para que se ejecute correctamente el proyecto


<strong>Creación de la base de datos</strong>

+ crear una base de datos
+ copiar el archivo .env.example y renombrarlo por .env
+ en el archivo .env añadir tu usuario, contraseña y la base de datos que has creado
+ en tu consola de comandos dirigete al directorio raíz del proyecto y ejecuta el siguiente comando:  <strong>php artisan migrate</strong>



<strong>Tu host debe apuntar a la carpeta public no a la raíz del directorio</strong>
