# Roles y Permisos

Se utiliza Sapitie para administrar los roles, se implemente en el sistema a base de roles, por lo tanto se necesita crear los permisos, asignar los a los roles y el rol asignarlo a los usuarios.

## Guia de Uso

-   Crear los roles necesarios en la seccion "Administrar Roles" dale un nombre descriptivo.
-   Crear el permiso en la seccion "Administrar Permisos" con el siguiente formato NOMBRE_DEL_AREA#acciones, por ejemplo AULAS_AREAS#crear, esto solo por temas visuales en el sistema.
-   Asginar el permiso a el rol en la seccion "Administrar Roles" buscando el Rol y dadon clic en el botón Relacionar Permisos.
-   Elegir los permisos necesarios y dar clic en el botón Guardar.

## Implementación en el Código.

utilizar la directiva de blade @can @endcan para delimiar las secciones de las plantillas de blade.

```sh
@can('NOMBRE_DE_AREA#accion')
    <div>Algo Fabuloso</div>
@endcad
```

## Notas

Los roles se almacenan en cache, si crea un rol, se elimina y no se reflejan los cambios en tiempo de ejecucion ejecute:

```sh
php artisan cache:clear
```
