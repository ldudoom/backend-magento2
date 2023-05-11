# Proyecto de Backend de Magento 2.4
***

Vamos a generar componentes y funcionalidades en Magento, o a extender funcionalidad
base de Magento para adecuarlo al negocio que se necesite.

Para eso, lo primero es saber como es la estructura del proyecto, y donde deber&iacute;amos 
colocar nuestro c&oacute;digo.

## Creando nuestro primer modulo
***

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


## Nuestra primera pagina personalizada
***

Vamos ahora a generar nuestra primera pagina personalizada, basicamente un hola mundo, 
lo vamos a crear, lo vamos a registrar y se va a poder visualizar desde Magento.

Cuando desarrollamos nuestros componentes, debemos tener en cuenta que Magento est&aacute;
construido usando un patrón arquitectónico MVC, por lo cual deberemos definir la
o las rutas de nuestro componente, el controlador, la capa de negocio, la capa de acceso
a datos, y las vistas, en Magento existen 2 tipos de vista

- **<span style="color:#00CCFF">FRONTEND:</span>** Son las vistas que se muestran a los usuarios que visitan el frontend de nuestra tienda 
- **<span style="color:#AA0000">ADMINHTML:</span>** Son las vistas que se veran en el panel de administraci&oacute;n de la tienda Magento

Actualmente nuestro proyecto se ejecuta en la URL http://myapp.magento.com/ porque así 
la configuramos en nuestro servidor local, lo que vamos a hacer es generar una pantalla
en la URL http://myapp.magento.com/buhoo 

Para lograr esto, vamos a colocar nuestro código en el ModuloBasico que configuramos en los pasos anteriores:

1. En primer lugar vamos a generar la URL para nuestra nueva pagina personalizada, esto lo hacemos configurando la ruta dentro del directorio **/app/code/Buhoo/ModuloBasico/etc/**
   
    ```shell
    # Creamos el directorio frontend dentro de etc
    $ mkdir app/code/Buhoo/ModuloBasico/etc/frontend
   
   # Ahora creamos el archivo routes.xml dentro de este directorio
   $ touch app/code/Buhoo/ModuloBasico/etc/frontend/routes.xml
    ``` 

2. Ahora colocamos el siguiente código en el archivo de rutas:
    
    **/app/code/Buhoo/ModuloBasico/etc/frontend/routes.xml**
    ```xml
    <?xml version="1.0"?>
    <config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:framework:App/etc/routes.xsd">
        <router id="standard">
            <route id="buhoo" frontName="buhoo">
                <module name="Buhoo_ModuloBasico" />
            </route>
        </router>
    </config>
    ```
   
3. Ahora vamos a desarrollar nuestro controlador, para eso generamos nuestra estructura de directorios de la siguiente manera:

    ```shell
    $ mkdir app/code/Buhoo/ModuloBasico/Controller
    $ mkdir app/code/Buhoo/ModuloBasico/Controller/Index
    ```

4. Generamos el archivo Index.php dentro de estos directorios para poder continuar con la codificación

    ```shell
    $ touch app/code/Buhoo/ModuloBasico/Controller/Index/Index.php
    ```
5. La clase ***Index.php*** debe tener el siguiente codigo

    ```php
    <?php
    namespace Buhoo\ModuloBasico\Controller\Index;
    
    class Index extends \Magento\Framework\App\Action\Action
    {
        /**
         * @var \Magento\Framework\View\Result\PageFactory
         */
        protected $resultPageFactory;
    
        public function __construct(
            \Magento\Framework\App\Action\Context $context,
            \Magento\Framework\View\Result\PageFactory $resultPageFactory
        ){
            $this->resultPageFactory = $resultPageFactory;
            parent::__construct($context);
        }
    
        /**
         * Index action
         *
         * @return $this
         */
        public function execute()
        {
            $resultPage = $this->resultPageFactory->create();
            return $resultPage;
        }
    }
    ```
   
6. Vamos ahora a generar la estructura de directorios donde vamos a colocar nuestras vistas:

    ```shell
    $ mkdir app/code/Buhoo/ModuloBasico/view
    $ mkdir app/code/Buhoo/ModuloBasico/view/frontend
    $ mkdir app/code/Buhoo/ModuloBasico/view/frontend/layout
    $ mkdir app/code/Buhoo/ModuloBasico/view/frontend/templates
    ```

7. Y vamos a crear nuestro archivo de vista y nuestro archivo de configuracion para poder trabajar sobre ellos posteriormente

    ```shell
    $ touch app/code/Buhoo/ModuloBasico/view/frontend/layout/buhoo_index_index.xml
    $ touch app/code/Buhoo/ModuloBasico/view/frontend/templates/hello.phtml
    ```

    > **IMPORTANTE:** El nombre del archivo xml de configuración debe tener la siguiente estructura
    > 1. El primer segmento del nombre debe ser el id de la ruta que colocamos en el archivo routes.xml, es decir **buhoo**
    > 2. El siguiente segnmento corresponde al nombre del directorio generado dentro de **Controller** es decir **index**
    > 3. Por ultimo, debe tener el nombre de la clase Controller, en nuestro ejemplo, tambien es **index**
    > 4. Con lo cual el nombre del archivo de configuracion de esta pantalla debe ser: **buhoo_index_index.xml**

8. En el archivo de layout **buhoo_index_index.xml** colocamos el siguiente codigo

    ```xml
    <?xml version="1.0"?>
    <page layout="1column" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:framework:View/Layout/etc/page_configuration.xsd">
        <body>
            <referenceContainer name="content">
                <block class="Buhoo\ModuloBasico\Block\Buhoo" name="content.buhoo" template="Buhoo_ModuloBasico::hello.phtml" />
            </referenceContainer>
        </body>
    </page>
    ```
   
    > **NOTA:** El atributo **template** del tag **block** tiene el llamado al archivo phtml que vamos a generar, y debe tener esta estructura
    > 1. Nombre del namespace, en nuestro caso **Buhoo**
    > 2. Precedido de un guión bajo "_" el nombre del modulo, en nuestro caso **ModuloBasico**
    > 3. El caracter **::**
    > 4. El nombre del archivo phtml, en nuestro caso **hello.phtml 
    >
    > De esta manera, Magento sabrá que tiene que buscar el archivo **buhoo_hello.phtml** dentro de **/app/code/Buhoo/ModuloBasico/view/frontend/templates/** 
   
9. En el archivo **buhooHello.phtml** colocamos el siguiente c&oacute;digo

    ```html
    <div class="content">
        <div class="conteText">
            <strong>Hola <i>Buhoo</i></strong>
            <a href="/home">Ir al HOME</a>
        </div>
    </div>
    ```
10. Generamos el directorio y la clase que indicamos en el archivo de configuracion **buhooHolaMundo_index_index.xml**

```shell
$ mkdir app/code/Buhoo/ModuloBasico/Block
$ touch app/code/Buhoo/ModuloBasico/Block/Buhoo.php
```

11. La clase **Buhoo.php** que acabamos de generar, debe tener el siguiente codigo:

    ```php
    <?php
    namespace Buhoo\ModuloBasico\Block;
    
    use Magento\Framework\View\Element\Template;
    use Magento\Framework\View\Element\Template\Context;
    
    class Buhoo extends Template
    {
        public function __construct(Context $context, array $data = [])
        {
            parent::__construct($context, $data);
        }
    }    
    ```

12. Por &uacute;ltimo vamos a hacer un render del proyecto y vamos a ver el resultado final en el navegador

    ```shell
    # Eliminamos los directorios /var/cache y /var/view_preprocessed/
    $ rm -Rf var/cache var/view_preprocessed
    
    # Ahora ejecutamos una serie de comandos que referscan y renderizan todo en el proyecto de Magento, para que podamos ver nuestro desarrollo
    $ php bin/magento indexer:reindex && php bin/magento se:up && php bin/magento se:s:d -f && php bin/magento c:f
    ```
    Ahora ya podemos ir a verificar como quedo nuestra pagina personalizada en la URL http://myapp.magento.com/buhoo
