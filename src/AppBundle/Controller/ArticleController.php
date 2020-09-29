<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use FOS\RestBundle\Controller\Annotations as Rest;
use JMS\Serializer\SerializationContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class ArticleController extends Controller
{
    /**
     * @Route("/articles/{id}", name="article-show")
     */
    public function showAction (Article $article)
    {
//        $article = new Article();
//        $article
//            ->setTitle("Mon premier article")
//            ->setContent("Tuto API Rest JMSSerializer")
//        ;

        $data = $this->get("serializer")->serialize($article,"json",
            SerializationContext::create()->setGroups(array('detail')));

        $response = new Response($data);
        $response->headers->set("Content-Type", "application/json");

        return $response;
    }

    /**
     * @Route("/articles", name="article-create")
     * @Method({"POST"})
     */
    public function createAction(Request $request)
    {
        $data = $request->getContent();
        $article = $this->get('serializer')->deserialize($data, 'AppBundle\Entity\Article', 'json');

        $em = $this->getDoctrine()->getManager();
        $em->persist($article);
        $em->flush();

        return new Response('', Response::HTTP_CREATED);
    }

    /**
     * @Route("/articles-list", name="article-list")
     * @Method({"GET"})
     */
    public function listAction ()
    {
        $em = $this->getDoctrine()->getManager();
        $articles = $em->getRepository("AppBundle:Article")->findAll();

        $data = $this->get("serializer")->serialize($articles,"json",
            SerializationContext::create()->setGroups(array('list')));

        $response = new Response($data);
        $response->headers->set("Content-type", "application/json");

        return $response;
    }
}