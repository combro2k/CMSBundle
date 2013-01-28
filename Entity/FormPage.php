<?php

namespace NoM\Bundle\CMSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\DependencyInjection\ContainerInterface;

use Kunstmaan\FormBundle\Entity\AbstractFormPage;
use NoM\Bundle\CMSBundle\Form\FormPageAdminType;
use NoM\Bundle\CMSBundle\PagePartAdmin\FormPagePagePartAdminConfigurator;
use NoM\Bundle\CMSBundle\PagePartAdmin\BannerPagePartAdminConfigurator;

/**
 * FormPage
 *
 * @ORM\Entity()
 * @ORM\Table(name="cms_form_pages")
 */
class FormPage extends AbstractFormPage
{

    /**
     * Returns the default backend form type for this form
     *
     * @return AbstractType
     */
    public function getDefaultAdminType()
    {
        return new FormPageAdminType();
    }

    /**
     * @return array
     */
    public function getPossibleChildTypes()
    {
        return array(
            array(
                'name' => 'ContentPage',
                'class' => "NoM\Bundle\CMSBundle\Entity\ContentPage"
            ),
            array (
                'name' => 'FormPage',
                'class' => "NoM\Bundle\CMSBundle\Entity\FormPage"
            )
        );
    }

    /**
     * @return array
     */
    public function getPagePartAdminConfigurations()
    {
        return array(
            new FormPagePagePartAdminConfigurator(),
            new BannerPagePartAdminConfigurator()
        );
    }

    /**
     * @return string
     */
    public function getDefaultView()
    {
        return "NoMCMSBundle:FormPage:view.html.twig";
    }
}
