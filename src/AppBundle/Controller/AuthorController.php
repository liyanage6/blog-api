<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Author;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class AuthorController extends Controller
{
    /**
     * @Route("/author/{id}", name="author_show")
     */
    public function showAction (Author $author)
    {
//        $article = $this->getDoctrine()->getRepository('AppBundle:Article')->findOneBy(array('id' => 1));
//
//        $author = new Author();
//        $author->setBiography('ma biographie');
//        $author->setFullname('Nicholas Liyanage');
//        $author->getArticles()->add($article);

        $data = $this->get('serializer')->serialize($author, 'json');

        $response = new Response($data);
        $response->headers->set('Content-type', 'application/json');

        return $response;
    }

    /**
     * @Route("/author", name="author_create")
     * @Method({"POST"})
     */
    public function createAction (Request $request)
    {
        $data = $request->getContent();
        $author = $this->get('serializer')->deserialize($data, 'AppBundle\Entity\Author', 'json');

        $em = $this->getDoctrine()->getManager();
        $em->persist($author);
        $em->flush();

        return new Response('', Response::HTTP_CREATED);
    }
}