<?php
namespace Drupal\fpntc_webform;

use Drupal\webform\WebformMessageManagerInterface;

interface FpntcWebformMessageManagerInterface extends WebformMessageManagerInterface {
  /**
   * FPNTC Submission exception.
   */
  const FPNTC_SUBMISSION_EXCEPTION = 'fpntc_submission_exception_message';
}