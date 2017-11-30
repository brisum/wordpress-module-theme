<?php

namespace Brisum\Wordpress\Theme\Plugin;

use WP_Query;

class Action
{
    /**
     * Action constructor.
     */
    public function __construct()
    {
        add_action('template_redirect', [$this, 'actionTemplateRedirect'], 0);
        add_action('pre_get_posts', [$this, 'actionPreGetPosts']);
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

    /**
     * @param WP_Query $query
     * @return void
     */
    function actionPreGetPosts(WP_Query $query)
    {
        if (is_admin()) {
            return;
        }

        if (isset($_REQUEST['post_type'])) {
            $query->set('post_type', $_REQUEST['post_type']);
        }

        if (isset($_REQUEST['post__in'])) {
            $query->set('post__in', array_unique(array_filter(array_map('intval', explode(',', $_REQUEST['post__in'])))));
        }

        if (isset($_REQUEST['posts_per_page'])) {
            $query->set('posts_per_page', abs((int)$_REQUEST['posts_per_page']));
        }
    }
}
