<?php

namespace Hudson\ElRteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Hudson\ElRteBundle\Library\elFinder;

class DefaultController extends Controller
{
    
    public function indexAction($name)
    {
        return $this->render('HudsonElRteBundle:Default:index.html.twig', array('name' => $name));
    }
    
    /**
     * Коннектор
     * 
     * @Route("/elfinder/connector", name="elfinder_connector") 
     * @Secure(roles="ROLE_ADMIN")
     */
    public function connectorAction()
    {
        $opts = array(
            'root' => realpath(__DIR__ . '/../../../../../htdocs/files'), // path to root directory
            'URL' => 'http://' . $_SERVER['HTTP_HOST'] . '/files/', // root directory URL
            'rootAlias' => 'Home', // display this instead of root directory name
            //'uploadAllow'   => array('images/*'),
            //'uploadDeny'    => array('all'),
            //'uploadOrder'   => 'deny,allow'
            'disabled'     => array('archive', 'extract'),      // list of not allowed commands
            // 'dotFiles'     => false,        // display dot files
            // 'dirSize'      => true,         // count total directories sizes
            // 'fileMode'     => 0666,         // new files mode
            // 'dirMode'      => 0777,         // new folders mode
            // 'mimeDetect'   => 'internal',       // files mimetypes detection method (finfo, mime_content_type, linux (file -ib), bsd (file -Ib), internal (by extensions))
            // 'uploadAllow'  => array(),      // mimetypes which allowed to upload
            // 'uploadDeny'   => array(),      // mimetypes which not allowed to upload
            // 'uploadOrder'  => 'deny,allow', // order to proccess uploadAllow and uploadAllow options
            // 'imgLib'       => 'mogrify',       // image manipulation library (imagick, mogrify, gd)
            // 'tmbDir'       => '.tmb',       // directory name for image thumbnails. Set to "" to avoid thumbnails generation
            // 'tmbCleanProb' => 1,            // how frequiently clean thumbnails dir (0 - never, 100 - every init request)
            // 'tmbAtOnce'    => 5,            // number of thumbnails to generate per request
            // 'tmbSize'      => 48,           // images thumbnails size (px)
            // 'fileURL'      => true,         // display file URL in "get info"
            // 'dateFormat'   => 'j M Y H:i',  // file modification date format
            // 'logger'       => null,         // object logger
            // 'defaults'     => array(        // default permisions
            //     'read'   => true,
            //     'write'  => true,
            //     'rm'     => true
            //     ),
            // 'perms'        => array(),      // individual folders/files permisions
            // 'debug'        => true,         // send debug to client
            // 'archiveMimes' => array(),      // allowed archive's mimetypes to create. Leave empty for all available types.
            // 'archivers'    => array()       // info about archivers to use. See example below. Leave empty for auto detect
            // 'archivers' => array(
            //     'create' => array(
            //         'application/x-gzip' => array(
            //             'cmd' => 'tar',
            //             'argc' => '-czf',
            //             'ext'  => 'tar.gz'
            //             )
            //         ),
            //     'extract' => array(
            //         'application/x-gzip' => array(
            //             'cmd'  => 'tar',
            //             'argc' => '-xzf',
            //             'ext'  => 'tar.gz'
            //             ),
            //         'application/x-bzip2' => array(
            //             'cmd'  => 'tar',
            //             'argc' => '-xjf',
            //             'ext'  => 'tar.bz'
            //             )
            //         )
            //     )
        );

        $fm = new elFinder($opts);
        $fm->run();        
    }
}
