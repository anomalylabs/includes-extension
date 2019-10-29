<?php

namespace Anomaly\IncludesExtension\Listener;

use Anomaly\EditorFieldType\EditorFieldType;
use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\Streams\Platform\Support\Template;
use Anomaly\Streams\Platform\View\ViewIncludes;
use Illuminate\Http\Request;

/**
 * Class RegisterIncludes
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class RegisterIncludes
{

    /**
     * The request object.
     *
     * @var Request
     */
    protected $request;

    /**
     * The template helper.
     *
     * @var Template
     */
    protected $template;

    /**
     * The view includes.
     *
     * @var ViewIncludes
     */
    protected $includes;

    /**
     * The settings repository.
     *
     * @var SettingRepositoryInterface
     */
    protected $settings;

    /**
     * Create a new RegisterIncludes instance.
     *
     * @param Request                    $request
     * @param Template                   $template
     * @param ViewIncludes               $includes
     * @param SettingRepositoryInterface $settings
     */
    public function __construct(
        Request $request,
        Template $template,
        ViewIncludes $includes,
        SettingRepositoryInterface $settings
    ) {
        $this->request  = $request;
        $this->template = $template;
        $this->includes = $includes;
        $this->settings = $settings;
    }

    /**
     * Handle the event.
     */
    public function handle()
    {
        if ($this->request->segment(1) == 'admin') {
            return;
        }

        /* @var EditorFieldType $head */
        /* @var EditorFieldType $scripts */
        $head    = $this->settings->value('anomaly.extension.includes::head');
        $scripts = $this->settings->value('anomaly.extension.includes::scripts');

        if (!$head && !$scripts) {
            return;
        }

        $this->includes->include('head', $this->template->make($head));
        $this->includes->include('scripts', $this->template->make($scripts));
    }
}
