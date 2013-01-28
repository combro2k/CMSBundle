<?php

namespace NoM\Bundle\CMSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerInterface;

use Kunstmaan\NodeBundle\Entity\AbstractPage;
use Kunstmaan\PagePartBundle\Helper\HasPagePartsInterface;
use Kunstmaan\PagePartBundle\PagePartAdmin\AbstractPagePartAdminConfigurator;
use NoM\Bundle\CMSBundle\Form\ContentPageAdminType;
use NoM\Bundle\CMSBundle\PagePartAdmin\BannerPagePartAdminConfigurator;
use NoM\Bundle\CMSBundle\PagePartAdmin\ContentPagePagePartAdminConfigurator;

/**
 * ContentPage
 *
 * @ORM\Entity()
 * @ORM\Table(name="cms_content_pages")
 */
class ContentPage extends AbstractPage implements HasPagePartsInterface
{

    /**
     * Returns the default backend form type for this page
     *
     * @return AbstractType
     */
    public function getDefaultAdminType()
    {
        return new ContentPageAdminType();
    }

    /**
     * @return array
     */
    public function getPossibleChildTypes()
    {
        return array (
            array(
                'name' => 'ContentPage',
                'class'=> "NoM\Bundle\CMSBundle\Entity\ContentPage"
            ),
            array(
                'name' => 'FormPage',
                'class'=> "NoM\Bundle\CMSBundle\Entity\FormPage"
            )
        );
    }

    /**
     * @return AbstractPagePartAdminConfigurator[]
     */
    public function getPagePartAdminConfigurations()
    {
        return array(new ContentPagePagePartAdminConfigurator(), new BannerPagePartAdminConfigurator());
    }

    /**
     * return string
     */
    public function getDefaultView()
    {
        return "NoMCMSBundle:ContentPage:view.html.twig";
    }
}