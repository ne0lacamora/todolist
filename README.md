# Laravel TODO list APP
~~~
Nueva version muy pronto
Esta aplicación esta creada con Laravel v7 y VueJS v2+ y esta basado en un TODO (Tarea para hacer)
Incluye sistema de inicio de sesion, cada tarea se asigna automaticamente al usuario que la creo
Para hacer que funcione (realizar los siguientes pasos)
~~~
1. __ git clone https://github.com/miguellista10/todolist.git __
> Luego
2. __ composer install __
> Luego
3. __ npm install __
> Luego
4. __ npm run dev __
> Comando de seguridad importante (Razones de seguridad)
4. __ php artisan key:generate __
> Migrar todo a la base de datos (de su preferencia)
5. __ php artisan migrate __
> De ser necesario realizar una migración fresca con seeds para tests (pruebas).
6. __ php artisan migrate:fresh --seed __
