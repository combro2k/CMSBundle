<?php

namespace CMS\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Buzz\Client\ClientInterface;
use Buzz\Client\Curl;
use Buzz\Message\Request;
use Buzz\Message\RequestInterface;
use Buzz\Message\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @return array
     *
     * @Template("CMSBundle:Default:index.html.twig")
     */
    public function indexAction()
    {
        return array(
            'guild' => json_decode($this->getGuild('Turalyon', 'Non Omnis Moriar')->getContent()),
        );
    }

    public function getGuild($serverName, $guildName)
    {
        $this->client = new Curl();

        $request = new Request(RequestInterface::METHOD_GET);

        $url = sprintf(
            'http://eu.battle.net/api/wow/guild/%s/%s?fields=members',
            str_replace(' ', '%20', $serverName),
            str_replace(' ', '%20', $guildName)
        );

        $request->fromUrl($url);

        $request->addHeaders(array());
        $request->addHeader('Content-Type: application/json');

        $response = new Response();
        $this->client->send($request, $response);

        return $response;
    }
}
