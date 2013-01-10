<?php

namespace CMS\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Buzz\Client\ClientInterface;
use Buzz\Client\Curl;
use Buzz\Message\Request;
use Buzz\Message\RequestInterface;
use Buzz\Message\Response;

class DefaultController extends Controller
{
    /**
     * @var ClientInterface
     */
    protected $client;

    public function indexAction($name)
    {
        var_dump($this->getCharacter('', ''));
        return $this->render('CMSBundle:Default:index.html.twig', array('name' => $name));
    }

    public function getCharacter($server, $character)
    {
        $this->client = new Curl();

        $request = new Request(RequestInterface::METHOD_GET);
        $request->fromUrl('http://www.google.nl/');
        $request->addHeaders(array());
        $request->addHeader('Content-Type: application/json');

        $response = new Response();
        $this->client->send($request, $response);

        return $response;
    }
}
