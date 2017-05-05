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
        add_action('pre_get_posts', [$this, 'actionPreGetPosts']);
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

        if (isset($_REQUEST['posts_per_page'])) {
            $query->set('posts_per_page', abs((int)$_REQUEST['posts_per_page']));
        }
    }
}
