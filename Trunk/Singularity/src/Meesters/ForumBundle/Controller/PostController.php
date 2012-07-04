<?php

namespace Meesters\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of PostController
 *
 * @author Jurgen
 */
class PostController extends Controller {

    public function indexAction() {
        return new Response('Hello world!');
    }

}

?>