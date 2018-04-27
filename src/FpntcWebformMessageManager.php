<?php
namespace Drupal\fpntc_webform;


use Drupal\webform\WebformMessageManager;
use function GuzzleHttp\Psr7\parse_header;

class FpntcWebformMessageManager extends WebformMessageManager implements FpntcWebformMessageManagerInterface {
  /**
   * {@inheritdoc}
   */
  public function display($key, $type = 'status') {
    drupal_set_message(json_encode($key).' -- '.$type);
    if ($key == 'submission_exception_message'){
      if ($build = $this->build($key)) {
        $build['#markup'] = 'A modified exception is thrown by fpntc module';
        drupal_set_message(json_encode($build));
        drupal_set_message($this->renderer->renderPlain($build), $type);
      }
    }
    else{
      parent::display($key, $type);
    }
  }
}