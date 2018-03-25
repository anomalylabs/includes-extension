<?php namespace Anomaly\IncludesExtension;

use Anomaly\IncludesExtension\Listener\RegisterIncludes;
use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Anomaly\Streams\Platform\Event\Ready;

/**
 * Class IncludesExtensionServiceProvider
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class IncludesExtensionServiceProvider extends AddonServiceProvider
{

    /**
     * The addon listeners.
     *
     * @var array
     */
    protected $listeners = [
        Ready::class => [
            RegisterIncludes::class,
        ],
    ];
}
