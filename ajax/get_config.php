<?php
  require_once('../includes/_init.php');
  
  $config = Config::findBy('type', 'active');
  
  $html = '<fieldset>
    <legend>' . Tools::translate('Edit config') . '</legend>
    <p class="infos" style="margin-bottom: 15px;">' . Tools::translate('The modifications you make will only be saved by pressing the "Save the configuration" button. Press "Reset" to load the default configuration, or "Close" to discard all changes.') . '</p>
    <div id="configForm" style="margin-top:10px;"><form action="/ajax/save_config.php" method="post"></form></div>
  </fieldset>';
  
  echo json_encode(array(
    'text' => $html,
    'json' => json_decode($config->value),
    'bottom' => '<p style="text-align: center">
      <input type="button" onclick="saveConfig()" value="' . Tools::translate('Save the configuration') . '" />
      <input type="button" onclick="loadConfigData()" value="' . Tools::translate('Reset') . '" />
      <input type="button" onclick="$.modal.close()" value="' . Tools::translate('Close') . '" />
    </p>'
  ));
?>