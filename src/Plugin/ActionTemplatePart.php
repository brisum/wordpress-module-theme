<?php

namespace Brisum\Wordpress\Theme\Plugin;

class ActionTemplatePart
{
    /**
     * Action constructor.
     */
    public function __construct()
    {
        add_action('template_redirect', [$this, 'actionTemplateRedirect'], 0);
    }

    /**
     * @return void
     */
    public function actionTemplateRedirect() {
        if (!empty($_REQUEST['tpl-part']) ) {
            header("X-Robots-Tag: noindex, nofollow", true);
            get_template_part($_REQUEST['tpl-part']);
            die;

        }
    }
}
