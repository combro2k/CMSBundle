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
        $html = $this->renderView('CMSBundle:Default:index.html.twig', array(
            'guild'  => $this->getGuild('Turalyon', 'Non Omnis Moriar')
        ));

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'attachment; filename="file.pdf"'
            )
        );
    }

    public function getGuild($serverName, $guildName)
    {
        $request = new Curl();
        $api = new Client();
        $api->setRequest($request);
        $api->setRegion('eu', 'en_GB');

        return $api->getGuildApi()->getGuild($serverName, $guildName, true);
    }
}
