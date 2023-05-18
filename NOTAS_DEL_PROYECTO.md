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



## Desarrollo para Backend
***

Magento por defecto tiene habilitados muchos niveles de seguridad, sobre todo en el backend, incluido un hash para asegurar las URLs, de esta manera
siempre se genera una URL aleatoriamente. Sin embargo, mientras hacemos el desarrollo de un modulo de backend, vamos a deshabilitar esta opcion.

1. Vamos a ingresar al panel de administración de Magento, en nuestro caso es http://myapp.magento.com/admin 
2. Ingresamos utilizando las credenciales con las que instalamos nuestro Magento
3. Vamos a seleccionar en el menu del lado izquierdo **"Stores -> Settings -> Configuration"**
4. Una vez que estamos en esta pantalla seleccionamos **"ADVANCED -> Admin"**
5. Ahora buscamos y desplegamos la sección **"Security"**
6. Colocamos el valor de **"NO"** en la opción **"Add Secret Key to URLs"**
7. Guardamos este cambio en la configuración
8. Limpiamos el cache del proyecto desde la consola con el comando ```$ php bin/magento c:f```, o directamente desde el panel de administracion


Ahora si podemos empezar a crear nuestro modulo de backend desde el codigo.

La diferencia entre un modulo de backend y de frontend es que las vistas y la configuraci&oacute;n de frontend las creamos dentro de los directorios **frontend**
en cambio las vistas y la configuracion del backend (adminhtml) las vamos a crear en los directorios **adminhtml**, pero los controladores y demas componentes los podemos
colocar en las mismas rutas antes mencionadas cuando generamos el modulo basico de frontend. 

Para lo cual, vamos a hacer lo siguiente:

1. Lo primero que vamos a hacer es crear el directorio **adminhtml** dentro de **etc** para, ah&iacute; dentro, construir nuestro archivo de rutas

    ```shell
    $ mkdir app/code/Buhoo/ModuloBasico/etc/adminhtml
    ```

2. Ahora vamos a generar el archivo de rutas de backend, dentro de este directorio

    ```shell
    $ touch app/code/Buhoo/ModuloBasico/etc/adminhtml/routes.xml
    ```

3. Ahora colocamos el c&oacute;digo de nuestro archivo de rutas, que es muy similar al de front, pero tiene pequeñas diferencias

    ```xml
    <?xml version="1.0" ?>
    <config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:framework:App/etc/routes.xsd">
        <router id="admin">
            <route id="buhooadmin" frontName="buhooadmin">
                <module name="Buhoo_ModuloBasico" before="Magento_Backend" />
            </route>
        </router>
    </config>
    ```
   
    > - La primera diferencia es que esta ruta ya no tiene un id->standard sino que es id->admin, ya que es una ruta de backend
    > - Luego, tenemos que en el tag **module** se agrega el atributo **before** donde le indicamos que esta ruta se hereda de **Magento_Backend**


4. Lo siguiente es construir el controlador, para eso, lo primero que hacemos es generar el directorio **Adminhtml** 

    ```shell
    $ mkdir app/code/Buhoo/ModuloBasico/Controller/Adminhtml
    ```
   
5. Ahora vamos a crear el directorio **Index** y la clase **Index.php** dentro de **Adminhtml**

```shell
$ mkdir app/code/Buhoo/ModuloBasico/Controller/Adminhtml/Index
$ touch app/code/Buhoo/ModuloBasico/Controller/Adminhtml/Index/Index.php
```

6. Ahora vamos a construir la Clase **Index.php** del backend de nuestro m&oacute;dulo b&aacute;sico

    ```php
    <?php
    
    namespace Buhoo\ModuloBasico\Controller\Adminhtml\Index;
    
    use Magento\Backend\App\Action\Context;
    use Magento\Framework\View\Result\PageFactory;
    
    use Magento\Backend\App\Action;
    
    class Index extends Action
    {
        protected PageFactory $resultPageFactory;
    
        public function __construct(
            Context $context,
            PageFactory $resultPageFactory
        ){
            parent::__construct($context);
            $this->resultPageFactory = $resultPageFactory;
        }
    
        public function execute()
        {
            return $this->resultPageFactory->create();
        }
    }
    ```

En este punto ya debemos hacer algo diferente a lo que hicimos en el frontend, ya que ahora estamos en el panel de administraci&oacute;n, y los usuarios para poder
llegar hasta ac&aacute; ya deben haberse logueado en el sistema, y nosotros debemos validar presisamente eso, que el usuario este autenticado, para esto, procedemos asi.

7. Vamos a crear un archivo de configuraci&oacute;n xml, este archivo nos va a ayudar a colocar un acceso hacia nuestro componente, desde el menu de Magento.

    ```shell
    $ touch app/code/Buhoo/ModuloBasico/etc/adminhtml/menu.xml
    ```
8. Y vamos a realizar la configuración en este archivo de la siguiente manera:

    ```xml
    <?xml version="1.0"?>
    <config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:module:Magento_Backend:etc/menu.xsd">
        <menu>
            <add
                id="Buhoo_ModuloBasico::buhoobackend"
                title="BuhooBackend"
                module="Buhoo_ModuloBasico"
                sortOrder="50"
                parent="Magento_Backend::marketing"
                resource="Buhoo_ModuloBasico::buhoobackend"
            />
            <add
                id="Buhoo_ModuloBasico::index"
                title="BuhooBackend Index"
                module="Buhoo_ModuloBasico"
                sortOrder="51"
                parent="Buhoo_ModuloBasico::buhoobackend"
                action="buhooadmin/index/"
                resource="Buhoo_ModuloBasico::index"
            />
        </menu>
    </config>
    ```
   
    > Lo que hicimos fue generar un item de menu dentro de la secci&oacute;n de **"Marketing"** de Magento llamada **"BuhooBackend"**, y colocamos un submenu 
   > debajo de &eacute;sta llamado **"BuhooBackend Index"**, que llevar&aacute; a la ruta **index** de nuestro m&oacute;dulo de backend. 

Una vez terminada la configuraci&oacute;n del men&uacute; ahora vamos a configurar los permisos de nuestro m&oacute;dulo de backend.

## ACL

Vamos ahora a configurar las Listas de Control de Acceso o (ACL) por sus siglas en ingl&eacute;s, de esta manera, podremos otorgar o quitar permisos a usuarios
para que naveguen en nuestro m&oacute;dulo. Para configurar los ACL vamos a hacer lo siguiente:

1. Dentro del directorio **/app/code/Buhoo/ModuloBasico/etc/** vamos a crear nuestro archivo de configuraci&oacute;n de ACL, y lo vamos a llamar **acl.xml**

    ```shell
    $ touch app/code/Buhoo/ModuloBasico/etc/acl.xml
    ```
    > No importa que este archivo no se encuentre dentro de **adminhtml** ya que los **acl** son archivos que sirven &uacute;nicamente para definir controles de acceso a usuarios en el admin de Magento, por esa razón, creamos este archivo unicamente dentro de **app/code/Buhoo/ModuloBasico/etc**, pero bien pudiera ir dentro de **app/code/Buhoo/ModuloBasico/etc/adminhtml**  

2. Ahora vamos a colocar la siguiente configuraci&oacute;n dentro de &eacute;ste archivo

    ```xml
    <?xml version="1.0"?>
    <config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:framework:Acl/etc/acl.xsd">
        <acl>
            <resources>
                <resource id="Magento_Backend::admin">
                    <resource id="Magento_Backend::marketing">
                        <resource
                            id="Buhoo_ModuloBasico::buhoobackend"
                            title="BuhooBackend" sortOrder="60">
                            <resource id="Buhoo_ModuloBasico::index" title="BuhooBackend Index" />
                        </resource>
                    </resource>
                </resource>
            </resources>
        </acl>
    </config>
    ```
    
3. Ahora, para conectar todo, vamos a generar un nuevo m&eacute;todo en el controlador, este m&eacute;todo tendr&aacute; el siguiente c&oacute;digo

    * **/app/code/Buhoo/ModuloBasico/Controller/Adminhtml/Index/Index.php**
    ```php
    public function _isAllowed()
    {
        return $this->_authorization->isAllowed('Buhoo_ModuloBasico::index');
    }
    ```

Una vez terminada esta configuraci&oacute;n, vamos a volver a renderizar, a limpiar cach&eacute;, y ya podremos ver el resultado

```shell
# Eliminamos los directorios /var/cache y /var/view_preprocessed/
$ rm -Rf var/cache var/view_preprocessed

# Ahora ejecutamos una serie de comandos que referscan y renderizan todo en el proyecto de Magento, para que podamos ver nuestro desarrollo
$ php bin/magento indexer:reindex && php bin/magento se:up && php bin/magento se:s:d -f && php bin/magento c:f
```
Ahora ya podemos ir a verificar el resultado final de estas configuraciones en nuestro Magento



## SYSTEM.XML
***

Básicamente, esto nos sirve para poder crear configuraciones personalizadas en Magento, y que estos parametros de configuraci&oacute;n que generamos, 
los podamos usar en cualquier parte del desarrollo que estemos haciendo, tanto para m&oacute;dulos de frontend como para m&oacute;dulos de backend.

Para esto, vamos a construir un archivo llamado **system.xml** donde generaremos toda la configuraci&oacute;n que necesitamos para hacer nuestra personalizaci&oacute;n


1. Creamos el archivo **system.xml**

    ```shell
    $ touch app/code/Buhoo/ModuloBasico/etc/adminhtml/system.xml
    ```

2. Colocamos el siguiente codigo en el archivo

    ```xml
    <?xml version="1.0"?>
    <config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:module:Magento_Config:etc/system_file.xsd">
        <system>
            <tab id="buhootab" translate="label" sortOrder="80">
                <label>Buhoo Tab</label>
            </tab>
            <section id="buhoosection" translate="label" sortOrder="70" showInDefault="1" showInWebsite="1" showInStore="1">
                <label>Buhoo Section</label>
                <tab>buhootab</tab>
                <resource>Buhoo_ModuloBasico::config_buhoo</resource>
                <group id="buhoogroup" translate="label" sortOrder="1" showInDefault="1" showInWebsite="1" showInStore="1">
                    <label>Config Page Group</label>
                    <field id="enable" translate="label" type="select" sortOrder="10" showInDefault="1" showInWebsite="1" showInStore="1">
                        <label>Is Enabled</label>
                        <source_model>Magento\Config\Model\Config\Source\Yesno</source_model>
                    </field>
                    <field id="title" translate="label" type="text" sortOrder="11" showInDefault="1" showInWebsite="1" showInStore="1">
                        <label>Title Buhoo</label>
                    </field>
                </group>
            </section>
        </system>
    </config>
    ```

3. Una vez que tenemos listo el archivo, vamos a renderizar nuestro proyecto, limpiar cache, etc.

    ```shell
    # Eliminamos los directorios /var/cache y /var/view_preprocessed/
    $ rm -Rf var/cache var/view_preprocessed
    
    # Ahora ejecutamos una serie de comandos que referscan y renderizan todo en el proyecto de Magento, para que podamos ver nuestro desarrollo
    $ php bin/magento se:up && php bin/magento indexer:reindex && php bin/magento se:s:d -f && php bin/magento c:f
    ```


## GRID
***

1. Lo primero que vamos a hacer es agregar un recurso más a nuestro ACL para poder configurarlo posteriormente.

   - **/app/code/Buhoo/ModuloBasico/etc/acl.xml**
    ```xml
    ...
    <resource id="Buhoo_ModuloBasico::index" title="BuhooBackend Index" />
    <resource id="Buhoo_ModuloBasico:subscription" title="ModuloBasico subscription" />
    ...
    ```

2. Lo siguiente es agregar un item al menu

   - **/app/code/Buhoo/ModuloBasico/etc/adminhtml/menu.xml**
    ```xml
    ...
    <add
        id="Buhoo_ModuloBasico::subscription"
        title="Subscription"
        module="Buhoo_ModuloBasico"
        sortOrder="52"
        parent="Buhoo_ModuloBasico::buhoobackend"
        action="buhooadmin/subscription/"
        resource="Buhoo_ModuloBasico::subscription"
    />
    ...
    ```

3. Ahora debemos agregar el controlador

    ```shell
    $ mkdir app/code/Buhoo/ModuloBasico/Controller/Adminhtml/Subscription
    $ touch app/code/Buhoo/ModuloBasico/Controller/Adminhtml/Subscription/Index.php
    ```

4. Ahora colocamos el siguiente codigo dentro de la clase **Index.php**

   - **/app/code/Buhoo/ModuloBasico/Controller/Adminhtml/Subscription/Index.php**
    ```php
    <?php
    
    namespace Buhoo\ModuloBasico\Controller\Adminhtml\Subscription;
    
    use Magento\Backend\App\Action\Context;
    use Magento\Framework\View\Result\PageFactory;
    
    use Magento\Backend\App\Action;
    
    class Index extends Action
    {
        protected PageFactory $resultPageFactory;
    
        public function __construct(Context $context, PageFactory $resultPageFactory)
        {
            parent::__construct($context);
            $this->resultPageFactory = $resultPageFactory;
        }
    
        public function execute()
        {
            $resultPage = $this->resultPageFactory->create();
            $resultPage->setActiveMenu('Marcgento_ModuloBasico::subscription');
            $resultPage->addBreadcrumb(__('Grid Subscription'), __('Grid Subscription'));
            $resultPage->addBreadcrumb(__('Manage Subscription'), __('Manage Subscription'));
            $resultPage->getConfig()->getTitle()->prepend(__('Subscriptions'));
            return $resultPage;
    
        }
    
        public function _isAllowed()
        {
            return $this->_authorization->isAllowed('Buhoo_ModuloBasico:subscription');
        }
    }
    
    ```

5. Lo siguiente que vamos a hacer es generar nuestra clase de bloque, para eso, vamos a generar la siguiente estructura de directorios

    ```
    ├── app 
        ├── code
            ├── Buhoo
                ├── ModuloBasico
                    ├── Block
                        ├── Adminhtml
                        |    ├── Subscription
                        |    |   ├── Grid.php
                        |    └── Subscription.php
                        └── Buhoo.php
    ```

    ```shell
    $ mkdir app/code/Buhoo/ModuloBasico/Block/Adminhtml
    $ mkdir app/code/Buhoo/ModuloBasico/Block/Adminhtml/Subscription
    $ touch app/code/Buhoo/ModuloBasico/Block/Adminhtml/Subscription.php
    $ touch app/code/Buhoo/ModuloBasico/Block/Adminhtml/Subscription/Grid.php
    ```

6. Vamos ahora a configurar la clase **Subscription.php**

   - **app/code/Buhoo/ModuloBasico/Block/Adminhtml/Subscription.php**
    ```php
    <?php
    
    namespace Buhoo\ModuloBasico\Block\Adminhtml;
    
    class Subscription extends \Magento\Backend\Block\Widget\Grid\Container
    {
        protected function _construct()
        {
            $this->_blockGroup = 'Buhoo_ModuloBasico';
            $this->_controller = 'adminhtml_subscription';
            parent::_construct();
        }
    }
    ```
   
7. Vamos a configurar ahora la clase personalizada **Grid.php**

   - **app/code/Buhoo/ModuloBasico/Block/Adminhtml/Subscription/Grid.php**
    ```php
    <?php
    
    namespace Buhoo\ModuloBasico\Block\Adminhtml\Subscription;
    
    use Magento\Backend\Block\Widget\Grid as WidgetGrid;
    
    
    class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
    {
        /**
         * @var \Buhoo\ModuloBasico\Model\Resource\Subscription\Collection
         */
        protected $_subscriptionCollection;
    
        /**
         * @param \Magento\Backend\Block\Template\Context $context
         * @param \Magento\Backend\Helper\Data $backendHelper
         * @param \Buhoo\ModuloBasico\Model\ResourceModel\Subscription\Collection $subscriptionCollection
         * @param array $data
         */
        public function __construct(
            \Magento\Backend\Block\Template\Context $context,
            \Magento\Backend\Helper\Data $backendHelper,
            \Buhoo\ModuloBasico\Model\ResourceModel\Subscription\Collection $subscriptionCollection,
            array $data = []
        ){
            $this->_subscriptionCollection = $subscriptionCollection;
            parent::__construct($context, $backendHelper, $data);
            $this->setEmptyText(__('No Subscription Found'));
        }
    
        /**
         * Initialize the subscription collection
         *
         * @return WidgetGrid
         */
        protected function _prepareCollection()
        {
            $this->setCollection($this->_subscriptionCollection);
            return parent::_prepareCollection();
        }
    }
    ```

8. Vamos a agregar los directorios para generar nuestras vistas:

    ```shell
    $ mkdir app/code/Buhoo/ModuloBasico/view/adminhtml
    $ mkdir app/code/Buhoo/ModuloBasico/view/adminhtml/layout
    ```

9. Vamos ahora a crear el layout cuyo nombre debe tener:
 
    - El valor del **frontname** de la ruta, en nuestro caso es: **"buhooadmin"**
    - Luego, el nombre del directorio donde esta el controlador, es decir: **"Subscription"**
    - Y por ultimo la accion, en nuestro caso es: **"Index"**

    ```shell
    $ touch app/code/Buhoo/ModuloBasico/view/adminhtml/layout/buhooadmin_subscription_index.xml
    ```

10. Ahora vamos a realizar la configuracion de nuestro layout

    ```xml
    <?xml version="1.0"?>
    <page xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:framework:View/Layout/etc/page_configuration.xsd">
        <body>
            <referenceContainer name="content">
                <block class="Buhoo\ModuloBasico\Block\Adminhtml\Subscription" name="adminhtml.block.buhooadmin.subscription.container">
                    <block class="Buhoo\ModuloBasico\Block\Adminhtml\Subscription\Grid" name="adminhtml.block.buhooadmin.subscription.grid" as="grid" />
                </block>
            </referenceContainer>
        </body>
    </page>
    ```

11. Ahora vamos a ejecutar los comandos necesarios para limpiar la cache y demas comandos para poder visualizar las configuraciones que hicimos en nuestro Magento

```shell
# Eliminamos los directorios /var/cache y /var/view_preprocessed/
$ rm -Rf var/cache var/view_preprocessed

# Ahora ejecutamos una serie de comandos que referscan y renderizan todo en el proyecto de Magento, para que podamos ver nuestro desarrollo
$ php bin/magento se:up && php bin/magento indexer:reindex && php bin/magento se:s:d -f && php bin/magento c:f
```


## Desarrollando el Backend Model
***

Ahora vamos a generar la configuraci&oacute;n y las clases necesarias para generar una nueva tabla que se llame buhoo_subscription que tendra varios campos y la vamos a leer, 
obtener sus datos y mostrarlos en el grid que construimos anteriormente.

Para esto, debemos crear 4 clases

1. Primero debemos crear la clase de la instacion del Schema que es el que se va a encargar de generar la tabla personalizada, sin datos, unicamente la tabla
2. Una clase de modelo
3. Una clase de recurso de modelo
4. Y una clase de colecciones

> Las 3 &uacute;ltimas tablas son con las cuales generaremos el ***CRUD*** de la tabla personalizada que vamos a crear

Vamos entonces a crear la tabla personalizada.

1. Dentro de nuestro directorio de modulo **/app/code/buhoo/ModuloBasico** vamos a crear el directorio **Setup**

    ```shell
    $ mkdir app/code/buhoo/ModuloBasico/Setup
    ```

2. Ahora vamos a crear la clase **UpgradeSchema.php** dentro del directorio **Setup** que acabamos de crear

```shell
$ touch app/code/buhoo/ModuloBasico/Setup/UpgradeSchema.php
```

3. En este archivo vamos a colocar el codigo necesario para generar la tabla personalizada que vamos a crear.

    ```php
    <?php
    
    namespace Buhoo\ModuloBasico\Setup;
    
    use Magento\Framework\Setup\UpgradeSchemaInterface;
    use Magento\Framework\Setup\ModuleContextInterface;
    use Magento\Framework\Setup\SchemaSetupInterface;
    
    class UpgradeSchema implements UpgradeSchemaInterface
    {
    
        public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
        {
            if(version_compare($context->getVersion(), '1.0.0') < 0){
                $installer = $setup;
    
                $installer->startSetup();
                $connection = $installer->getConnection();
    
                // Installing new table
                $table = $installer->getConnection()->newTable(
                    $installer->getTable('buhoo_subscription')
                )->addColumn(
                    'subscription_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'unsigned' => true,
                        'nullable' => false,
                        'primary' => true
                    ],
                    'Subscription Id'
                )->addColumn(
                    'created_at',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                    null,
                    [
                        'nullable' => false,
                        'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT
                    ],
                    'Created At'
                )->addColumn(
                    'updated_at',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                    null,
                    [],
                    'Updated At'
                )->addColumn(
                    'firstname',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    64,
                    [
                        'nullable' => false
                    ],
                    'First Name'
                )->addColumn(
                    'lastname',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    64,
                    [
                        'nullable' => false
                    ],
                    'Last Name'
                )->addColumn(
                    'email',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    [
                        'nullable' => false
                    ],
                    'E-Mail Address'
                )->addColumn(
                    'status',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    [
                        'nullable' => false,
                        'default' => 'pending'
                    ],
                    'Status'
                )->addColumn(
                    'message',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    '64k',
                    [
                        'unsigned' => true,
                        'nullable' => false
                    ],
                    'Subscription notes'
                )->addIndex(
                    $installer->getIdxName('buhoo_subscription', ['email']),
                    ['email']
                )->setComment('Table subscription');
    
                $installer->getConnection()->createTable($table);
    
                $installer->endSetup();
            }
        }
    }
    
    ```
   
    > **NOTA:** La version que se menciona al inicio de este archivo hace relación con la version que esta en el archivo **/app/code/Buhoo/ModuloBasico/etc/module.xml** que deberia verse asi:
       
    ```xml
        <?xml version="1.0"?>
        <config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:framework:Module/etc/module.xsd">
            <module name="Buhoo_ModuloBasico" setup_version="1.0.0">
                <sequence>
                    <module name="Magento_Backend" />
                </sequence>
            </module>
        </config>
    ```

4. Ahora vamos a proceder con el modelo, para eso, vamos a crear un directorio y una estructura de clases

    ```shell
    # Creamos el directorio del modelo
    $ mkdir app/code/buhoo/ModuloBasico/Model
    
    # Creamos la Clase del Modelo
    $ touch app/code/buhoo/ModuloBasico/Model/Subscription.php
    
    # Creamos ahora el directorio del recurso
    $ mkdir app/code/buhoo/ModuloBasico/Model/ResourceModel
    
    # Ahora creamos el recurso dentro del directorio que creamos, y debe tener exactamente el mismo nombre del modelo
    $ touch app/code/buhoo/ModuloBasico/Model/ResourceModel/Subscription.php
    
    # Ahora creamos el directorio para colocar nuestra clase de Coleccion, y debe tener exactamente el mismo nombre del modelo
    $ mkdir app/code/buhoo/ModuloBasico/Model/ResourceModel/Subscription
    
    # Y ahora creamos nuestra clase de Coleccion
    $ touch app/code/buhoo/ModuloBasico/Model/ResourceModel/Subscription/Collection.php
    ```

    > Esta estructura de clases nos permite generar una tabla personalizada en nuestro proyecto, cuando vamos a utilizar tablas nativas de Magento, simplemente. 
   > haremos la inyeccion de dependencias de lo que necesitemos.
   > Con esta estructura, nosotros podremos generar el **CRUD** de esta tabla personalizada que hemos creado.

5. Ahora vamos a colocar el codigo en cada una de estas clases, y vamos a iniciar con el modelo como tal

   - **/app/code/buhoo/ModuloBasico/Model/Subscription.php**

    ```php
    <?php
    
    namespace Buhoo\ModuloBasico\Model;
    
    class Subscription extends \Magento\Framework\Model\AbstractModel
    {
        const STATUS_PENDING = 'pending';
        const STATUS_APPROVED = 'approved';
        const STATUS_DECLINED = 'declined';
    
        public function __construct(
            \Magento\Framework\Model\Context $context,
            \Magento\Framework\Registry $registry,
            \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
            \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
            array $data = [])
        {
            parent::__construct($context, $registry, $resource, $resourceCollection, $data);
        }
    
        public function _construct()
        {
            $this->_init('Buhoo\ModuloBasico\Model\ResourceModel\Subscription');
        }
    }
    ```

6. La siguiente clase que vamos a completar es la clase **Subscription** del **ResourceModel**

  - **/app/code/buhoo/ModuloBasico/Model/ResourceModel/Subscription.php**
    ```php
    <?php
    
    namespace Buhoo\ModuloBasico\Model\ResourceModel;
    
    class Subscription extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
    {
    
        protected function _construct()
        {
            $this->_init('buhoo_subscription', 'subscription_id'); // Nombre de la tabla, identificador de la tabla
        }
    }
    ```

7. Por último. vamos a codificar la clase de Coleccion

   - **/app/code/buhoo/ModuloBasico/Model/ResourceModel/Subscription/Collection.php**
    ```php
    <?php
    
    namespace Buhoo\ModuloBasico\Model\ResourceModel\Subscription;
    
    class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
    {
        public function _construct()
        {
            $this->_init('Buhoo\ModuloBasico\Model\Subscription', 'Buhoo\ModuloBasico\Model\ResourceModel\Subscription'); // clase del modelo - clase del recurso
        }
    }
    ```
   
8. Antes de desplegar nuestros cambios, tenemos que hacer un pequeño cambio en las versiones del m&oacute;dulo, porque en nuestra clase de **UpgradeSchema.php**, en nuestro **module.xml** y en la BBDD en la tabla **setup_module** se encuentra la misma version, entonces el sistema no va a encontrar diferencias, por lo cual no va a hacer nada, no va a crear nuestra tabla, por lo que debemos colocar una nueva version tanto en el **module.xml** como en el **UpgradeSchema.php**

   - **/app/code/buhoo/ModuloBasico/Setup/UpgradeSchema.php**
    ```php
    ...
    if(version_compare($context->getVersion(), '1.0.1') < 0){
    ...
    }
    ```
   
    - **/app/code/Buhoo/ModuloBasico/etc/module.xml**
    ```xml
    ...
    <module name="Buhoo_ModuloBasico" setup_version="1.0.1">
    ...
    ```
   
9. Ahora si estamos listos para hacer el despliegue de nuestros cambios y que la configuraci&oacute;n quede implementada en nuestro proyecto.

```shell
$ php bin/magento setup:upgrade 
$ php bin/magento setup:static-content:deploy -f
```
