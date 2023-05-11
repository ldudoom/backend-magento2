# Proyecto de Backend de Magento 2.4
***

Vamos a generar componentes y funcionalidades en Magento, o a extender funcionalidad
base de Magento para adecuarlo al negocio que se necesite.

Para eso, lo primero es saber como es la estructura del proyecto, y donde deber&iacute;amos 
colocar nuestro c&oacute;digo.

Todo el c&oacute;digo que generemos deberemos colocarlo dentro del directorio **/app**
y dentro de este directorio necesitamos el directorio **code**, si no existe debemos 
crearlo.

```shell
$ mkdir app/code
```

Una vez que tenemos el directorio **/app/code**, vamos a generar un directorio con 
el nombre del m&oacute;dulo o de la empresa que desarrolla el m&oacute;dulo, para 
este ejemplo lo vamos a llamar Buhoo

```shell
$ mkdir app/code/Buhoo
```
Por &uacute;ltimo, dentro de este directorio, que en este caso es el nombre de una 
empresa, vamos a crear un directorio en el que vamos a construir nuestro primer 
m&oacute;dulo 

```shell
$ mkdir app/code/Buhoo/ModuloBasico
```

Lo hacemos de esta manera debido a que asi está definido el estándar de Magento
por lo cual, seguimos el estandar, que son buenas prácticas para hacer desarrollos
en Magento.

A partir del directorio **/app/code/Buhoo/ModuloBasico** vamos a generar todo el 
código necesario para construir nuestro módulo.

Y lo que vamos a hacer a continuación es crear un directorio llamado **etc** y 
un archivo llamado registration.php 

```shell
$ mkdir app/code/Buhoo/ModuloBasico/etc

$ touch app/code/Buhoo/ModuloBasico/registration.php
```

Dentro del directorio **app/code/Buhoo/ModuloBasico/etc** vamos a crear un archivo
de configuración llamado **module.xml**

```shell
$ touch app/code/Buhoo/ModuloBasico/etc/module.xml
```

Ahora vamos a proceder a colocar el contenido que debera tener cada archivo:

**/app/code/Buhoo/ModuloBasico/etc/module.xml**
```xml
<?xml version="1.0"?>
<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:framework:Module/etc/module.xsd">
    <module name="Buhoo_ModuloBasico" setup_version="1.0.0"></module>
</config>
```

**/app/code/Buhoo/ModuloBasico/registration.php**
```php
<?php

\Magento\Framework\Component\ComponentRegistrar::register(
    \Magento\Framework\Component\ComponentRegistrar::MODULE,
    'Buhoo_ModuloBasico',
    __DIR__
);
```

Con esta pequeña configuración, tenemos lista la primera parte, de esta manera
vamos a poder registrar el modulo en magento, activarlo o desactivarlo usando
los comandos pre-definidos en Magento.
