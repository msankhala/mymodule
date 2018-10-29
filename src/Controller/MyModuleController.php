<?php

namespace Drupal\mymodule\Controller;

use Drupal\views\Views;

class MyModuleController {
  public function view() {
    $view = Views::getView('content_recent');
    $args = [];
    if (is_object($view)) {
      $view->setArguments($args);
      $view->setDisplay('block_1');
      $view->setShowAdminLinks(TRUE);
      $view->preExecute();
      $view->execute();
      $content = $view->buildRenderable('block_1', $args, FALSE);
    }

    $content['#view_id'] = $view->storage->id();
    $content['#view_display_show_admin_links'] = $view->getShowAdminLinks();
    $content['#view_display_plugin_id'] = $view->display_handler->getPluginId();
    views_add_contextual_links($content, 'block', 'block_1');
    return $content;
  }
}
