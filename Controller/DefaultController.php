<?php

namespace CMS\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use WowApi\Client;
use WowApi\Request\Curl;


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
            'guild' => $this->getGuild('Turalyon', 'Non Omnis Moriar'),
        );
    }

    public function getGuild($serverName, $guildName)
    {
        $request = new Curl();
        $api = new Client();
        $api->setRequest($request);
        $api->setRegion('eu', 'en_EN');

        return $api->getGuildApi()->getGuild($serverName, $guildName, true);
    }
}
