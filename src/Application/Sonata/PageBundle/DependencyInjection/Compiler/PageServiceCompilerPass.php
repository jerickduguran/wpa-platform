<?php

namespace Application\Sonata\PageBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Inject page services into page service manager.
 *
 * @author Olivier Paradis <paradis@ekino.com>
 */
class PageServiceCompilerPass implements CompilerPassInterface
{ 
    /**
     * @var string
     */
    protected $site_admin = 'sonata.page.admin.site';

    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {   
        $siteAdmin = $container->getDefinition($this->site_admin); 
		$siteAdmin->setClass('Application\Sonata\PageBundle\Admin\SiteAdmin');
    }
}
