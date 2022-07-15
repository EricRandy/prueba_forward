# prueba_forward - Eric Randy Martinez ..::: RM :::..

Pasos para correr el proyecto

1.- crear una bd en mysql con nombre prueba_forward o ejecutar el sql adjunto al proyecto

2.- una vez clonado el proyecto debera posicionar dentro del proyecto desde la terminal y ejecutar 
composer update

3.- ejecutar php artisan migrate para cargar las tablas a la bd
php artisan migrate

4.- ejecutar php artisan serve para correr el proyecto, tambien se puede montar en apache
php artisan serve

Nota: El usuario administrador es email: forward@forward.com password: forward123
Para los demas usuarios que se vallan creando su password por default sera forward123