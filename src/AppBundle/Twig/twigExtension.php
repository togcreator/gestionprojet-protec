<?php

namespace AppBundle\Twig;

use Symfony\Component\DependencyInjection\ContainerInterface;

class twigExtension extends \Twig_Extension
{
    /**
    * @var ContainerInterface
    * @value $container
    */
    private $container; 

    /**
    * @value $request
    */
    private $request;

    /**
    * @value $em
    */
    private $em; 

    /**
     * @var array
     */
    private $params = ['user', 'users', 'userclient', 'roles', 'usersparamrelationsfonctions',  'usersparamrelationsprofessionnelles'];
    
    public function __construct(ContainerInterface $container = null) {
        $this->container = $container;
        $this->request = $this->container != null ? $this->container->get('request_stack')->getCurrentRequest() : null;
        
        // doctiner an entity manager:
        $this->em = $this->container->get('doctrine')->getManager();
    }

    // this is for Filters
	public function getFilters()
    {
        return array(
            'lang' => new \Twig_SimpleFilter('lang', array($this, '_lang')),
            'mime' => new \Twig_SimpleFilter('mime', array($this, '_mime')),
            'breadcrumb' => new \Twig_SimpleFilter('breadcrumb', array($this, '_breadcrumb')),
            'date' => new \Twig_SimpleFilter('date', array($this, 'date')),
        );
    }

    // this is for Functions
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('getBreadCrumb', array($this, 'getBreadCrumb')),
            new \Twig_SimpleFunction('getLang', array($this, 'getLang')),
            new \Twig_SimpleFunction('userConnect', array($this, 'getUserConnect')),
            new \Twig_SimpleFunction('ET', array($this, 'ET')),
            new \Twig_SimpleFunction('getCookieLogin', array($this, 'getCookie')),
            new \Twig_SimpleFunction('getRouteParam', array($this, 'getRouteParam')),
            new \Twig_SimpleFunction('getUser', array($this, 'getUser')),
            new \Twig_SimpleFunction('getCurrentUsers', array($this, 'getCurrentUsers')),
            new \Twig_SimpleFunction('setMenuActive', array($this, 'setMenuActive')),
            new \Twig_SimpleFunction('in_object', array($this, 'in_objects')),
            new \Twig_SimpleFunction('getCookieLife', array($this, 'getCookieLife')),
            new \Twig_SimpleFunction('loadContent', array($this, 'loadContent')),
            new \Twig_SimpleFunction('notify', array($this, 'notify')),
            new \Twig_SimpleFunction('doc_file', array($this, 'type_file')),
            new \Twig_SimpleFunction('getIdUser', array($this, 'getIdUser')),
        );
    }

    /** === Function === **/
    public function getBreadCrumb( $route, $_route = null ) 
    {
        $return = [];
        $route = explode('::', $route);
        $translator = $this->container->get('translator');

        // class controller with path
        $controller = $route[0];
        $controller = explode('\\', $controller);
        $controller = $controller[count($controller)-1];
        $controller = str_replace('Controller', '', $controller);

        $controller = $translator->trans('global.' . strtolower($controller));

        if( strtolower($controller) != 'param' )
            $return['controller'] = sprintf('<li><a href="#">%s</a></li>', ucfirst($controller));

        // method
        $method = $route[count($route)-1];
        $method = str_replace('Action', '', $method);

        // routes
        $routes = explode('_', $_route);

        if( preg_match('/fos_user/i', $routes[0]) == 0 ) {
        
            $type = $routes[0];
            if( preg_match('/proje/i', $route[0]) && $routes[0] != "project" )
                $type = $translator->trans('global.project');
            if( preg_match('/crm/i', $route[0]) && $routes[0] != "crm" )
                $type = $translator->trans('global.crmdossier');

            if( $type ) {
                if( in_array(strtolower($type), $this->params) ) $return['method'] = sprintf('<li>%s</li>', $translator->trans('menu.param'));
                else $return['method'] = sprintf('<li>%s</li>', ucfirst($type));
            }

        } else
            $c = $_route;

        $returns = '';
        if( array_key_exists('method', $return) )
            $returns .= $return['method'];

        // for controller
        if( array_key_exists('controller', $return) )
            $returns .= $return['controller'];

        if( strpos(strtolower($route[0]), 'back') !== false )
            $returns = sprintf('<li>%s</li>', ucfirst($translator->trans('global.edit')));

        // dump($returns);

        return $returns;
    }

    public function getIdUser($user_id) {
        $user = $this->em->getRepository('UsersBundle:UserClient')->findOneBy(['id' => $user_id]);
        if( $user )
            return $user->getId();
        return null;
    }

    /**
    * Getting all users susceptible to connected
    *
    * @return null
    */
    public function getUserConnect($url, $sess = false) {

        //===================================
        $session = $this->container->get('session');
        $token = $this->container->get('security.token_storage')->getToken();

        if( $token !== null ) {
            $user_id = $token->getUser()->getId();

            // l'user connecté via user_compte
            $users = $this->em->getRepository('UsersBundle:UserClient')->findOneBy(['iDCompte' => $user_id]);

            $user = [$users];
            $bus = $this->em->getRepository('UsersBundle:UserClient')->findBU($user_id);

            //===================================
            if($sess) {
                if (($bu = $session->get('BU'))) {
                    $id = $session->get('log');

                    $bu = $this->em->getRepository('UsersBundle:BusinessUnit')->findOneBy(['id' => $bu]);
                    if( !$bu ) {
                        $user = $this->em->getRepository('UsersBundle:Users')->findOneBy(['id' => $id]);
                        return ucfirst($user->getUsername());
                    }

                    return ucfirst($bu->getNomBusinessUnit());
                }
                else {
                    //==== session ====
                    $id = $user[0]->getId();
                    $session->set('log', $id);
                    
                    $idLang = !method_exists($user[0], 'getLangage') || !$user[0]->getLangage() ? 1 : $user[0]->getLangage();
                    $lang = $this->em->getRepository('AppBundle:Common\Langage')->findOneBy(['id' => $idLang]);
                    $session->set('_locale', $lang->getAbr());

                    $bu = $this->em->getRepository('UsersBundle:UserClient')->findBU($id);
                    
                    if(count($bu)) {
                        $session->set('BU', $bu[0]->getId());
                        return ucfirst($bu[0]->getNomBusinessUnit());
                    }

                    return ucfirst($user[0]->getFirstname());
                }
            }

            if( !count($bus) && $user[0]->getLogin() == 'admins')
                $bus = $this->em->getRepository('UsersBundle:BusinessUnit')->findAll();

            if( count($bus) > 1 ):
            ob_start();
        ?>
            <ul class="dropdown-menu">
                <?php if($user[0]->getLogin() == 'admins'): ?>
                <li>
                    <a href="<?php echo $url ?>?bu=0">
                        <?php echo ucfirst($user[0]->getFirstname()) ?>
                    </a>
                </li>
                <?php endif ?>
                
                <?php foreach( $bus as $bu ): ?>
                    <li>
                        <a href="<?php echo $url ?>?bu=<?php echo $bu->getId() ?>">
                            <?php echo $bu->getNomBusinessUnit() ?>
                        </a>
                    </li>
                <?php endforeach ?>
            </ul>
        <?php
            $ul = ob_get_contents();
            ob_end_clean();
            return $ul;
            endif;

            return;
        }
    }

    // locale
    public function getLang ( $asset, $url ) 
    {
        // getting all langage
        $langages = $this->em->getRepository('AppBundle:Common\Langage')->findAll();
        ob_start();
    ?>
        <ul class="dropdown-menu">
            <?php foreach( $langages as $lang ): $img = $lang->getAbr() == 'en'? 'gb' : $lang->getAbr() ?>
                <li>
                    <a href="<?php echo $url ?>?lang=<?php echo $lang->getAbr() ?>" data-id="<?php echo $lang->getAbr() ?>">
                        <img src="<?php echo $asset ?>images/flags/<?php echo $img ?>.png" /><?php echo $lang->getAbr() ?>
                    </a>
                </li>
            <?php endforeach ?>
        </ul>
    <?php
        $ul = ob_get_contents();
        ob_end_clean();
        return $ul;
    }

    // cookie
    public function ET ($string) 
    {
        return str_replace('-', ' ', $string);
    }

    // cookie
    public function getCookie () 
    {
        $login = array_key_exists('login', $_COOKIE)?$_COOKIE['login']:0;
        return $login?1:0;
    }

    // route param
    public function getRouteParam ($route, $params)
    {
        $params = array_merge($params, $_GET);
        $params = serialize($params);
        return base64_encode($route . '__' . $params);
    }

    // getting current users
    public function getUser ($user_id, $criteria = null)
    {
        // user
        $user = $this->em->getRepository('UsersBundle:Users')->findBy(['id' => $user_id], null, null, 0);
        if( !$user ) return '';

        if( method_exists($user[0], "get$criteria") )
            return ucfirst($user[0]->{"get$criteria"}());
    }

    // getting current users
    public function getCurrentUsers ($key)
    {
        $request = $this->container->get('request_stack')->getCurrentRequest();

        // getting from users
        $users = \UsersBundle\Entity\Users::getCurrentUsers($key);
        return $users;
    }

    // menu active
    public function setMenuActive ($_controller, $controller)
    {
        $path = explode('::', $_controller);
        if(!$path) return;
        
        $array = explode('\\', $path[0]);
        $path = array_map(function($value){
            $return = strtolower($value);
            $return = str_replace('controller', '', $return);
            return $return;
        }, $array);

        if( is_array($controller) )
            foreach($controller as $val)
                if(in_array($val, $path))
                    return ' active ';                

        if(in_array($controller, $path))
            return ' active ';
    }

    // in_object or in_array
    public function in_objects ($needle, $object, $key)
    {
        // object is a array of object
        if( is_array($object) )
            foreach($object as $ob)
            {
                if(method_exists($ob, $key)){
                    if( $ob->$key() == $needle )
                        return $ob;
                }
            }
        else {
            if(method_exists($object, $key))
                if( $object->$key() == $needle )
                    return true;
        }

        return;
    }

    // in_object or in_array
    public function getCookieLife ()
    {
        if( array_key_exists('cookie_lifetime', $_COOKIE) )
            return $_COOKIE['cookie_lifetime'];
        return 3600;
    }

    // to load content
    public function loadContent($default_content, $no_content = '', $charset = 'utf-8') 
    {
        if( $default_content )
            return $default_content;
        return $no_content;
    }

    // notify
    public function notify() 
    {
        if( $this->request == null) return;
        if( $this->request->hasSession() == null ) return;

        $session = $this->request->getSession();
        $notify = $session->get('notify');
        $session->set('notify', ''); // unset

       // dump($notify); // exit;
        return $notify;
    }

    // type of file
    public function type_file( $collection ) 
    {
        // dump($collection);  exit;
        // for return
        $return = ['pop' => [], 'image' => []];

        if( count($collection) ) 
            foreach( $collection as $docs ) {
                if( !is_object($docs) ) continue; /** skip **/

                /** file **/
                $file = $this->container->getParameter('upload_dir') . DIRECTORY_SEPARATOR . $docs->getNomdoc();
                if( is_file($file) ) {
                    /** type mime **/
                    $type_mime = mime_content_type($file);
                    if( strpos($type_mime, 'image') !== false )
                        $return['image'] = $docs->getNomdoc();
                    $return['pop'][] = $docs->getNomdoc();
                }
            }

        /* returning */
        return $return;
    }
    
    /* === Filters === */
    // render filters breadcrumb
    public function _breadcrumb( $value = '' )
    {
        $value = explode('::', $value);
        $translator = $this->container->get('translator');

        // class controller with path
        $controller = $value[0];
        $controller = explode('\\', $controller);
        $controller = $controller[count($controller)-1];
        $controller = str_replace('Controller', '', $controller);
        
            
        
        if( in_array(strtolower($controller), $this->params) )
            return 'param.' . strtolower($controller);

        if( strtolower($controller) != 'param' )
            return $controller;

        return 'menu.homepage';
    }
    
    // render filters breadcrumb
    public function _lang( $value = '', $current = '' )
    {
        $html = '';

        // current lang
        if( $current )
            $html = ucfirst(str_replace('lang', '', $current));

        // here all lang list

        return $html;
    }

    /**
     * type mime
     */
    public function _mime ($file) {
        // if( is_file($file) )
        return mime_content_type($file);
    }

    // name of filter
    public function getName()
    {
        return 'twig_extension';
    }

    // filter date
    public function date($date, $format) 
    {
        if( !is_object($date) ) return;

        /* formattage de la date */
        $date = $date->format($format);
        
        /* les cas échéant */
        if( strpos($date, '0000') !== FALSE || strpos($date, '0001') !== FALSE  ) return;
        return str_replace('--', '-', $date);
    }
}