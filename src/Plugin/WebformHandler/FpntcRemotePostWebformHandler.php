<?php
namespace Drupal\fpntc_webform\Plugin\WebformHandler;

use Drupal\fpntc_webform\FpntcWebformMessageManagerInterface;
use Drupal\webform\Plugin\WebformHandler\RemotePostWebformHandler;
use Drupal\webform\WebformMessageManagerInterface;



class FpntcRemotePostWebformHandler extends RemotePostWebformHandler{
  /**
   * The webform message manager.
   *
   * @var \Drupal\fpntc_webform\FpntcWebformMessageManager
   */
  protected $messageManager;

  /*public function __construct(array $configuration, $plugin_id, $plugin_definition, \Drupal\Core\Logger\LoggerChannelFactoryInterface $logger_factory, \Drupal\Core\Config\ConfigFactoryInterface $config_factory, \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager, \Drupal\webform\WebformSubmissionConditionsValidatorInterface $conditions_validator, \Drupal\Core\Extension\ModuleHandlerInterface $module_handler, \GuzzleHttp\ClientInterface $http_client, \Drupal\webform\WebformTokenManagerInterface $token_manager, \Drupal\webform\WebformMessageManagerInterface $message_manager) {
    parent::__construct($configuration, $plugin_id, $plugin_definition, $logger_factory, $config_factory, $entity_type_manager, $conditions_validator, $module_handler, $http_client, $token_manager, $message_manager);

  }*/

  protected function handleError($state, $message, $request_url, $request_method, $request_type, $request_options, $response) {
    // If debugging is enabled, display the error message on screen.
    $this->debug($message, $state, $request_url, $request_method, $request_type, $request_options, $response, 'error');

    // Log error message.
    $context = [
      '@form' => $this->getWebform()->label(),
      '@state' => $state,
      '@type' => $request_type,
      '@url' => $request_url,
      '@message' => $message,
      'link' => $this->getWebform()
        ->toLink($this->t('Edit'), 'handlers')
        ->toString(),
    ];
    $this->getLogger()
      ->error('@form webform remote @type post (@state) to @url failed. @message', $context);
    \Drupal::logger('webform error: ')->notice('Error my friend********');
    // Display submission exception message.
    //$this->messageManager->display(WebformMessageManagerInterface::SUBMISSION_EXCEPTION, 'error');
    drupal_set_message('Unable to process message but', 'error');
  }
}