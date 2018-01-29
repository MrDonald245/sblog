<?php
/**
 * Created by PhpStorm.
 * User: eugene
 * Date: 24/01/18
 * Time: 22:28
 */

namespace App\Controller;


use App\Helpers\PostHelper;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends Controller
{
    /**
     * @Route("/{page}", name="home", requirements={"page"="\d+"})
     * @param int|null $page
     * @param PostHelper $helper
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(int $page = 1, PostHelper $helper) {
        $posts = $helper->getAll($page);

        return $this->render('home/index.html.twig', ['posts' => $helper->getAll($page)]);
    }
}