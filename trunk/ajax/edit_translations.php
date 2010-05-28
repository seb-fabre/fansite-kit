<?php
  require_once('../includes/_init.php');

  $select = '';
  foreach ($GLOBALS['LANGUAGES'] as $l)
    $select .= '<option value="' . $l . '">' . $l . '</option>';

  $html = '<fieldset>
    <legend>' . Tools::translate('Edit translations') . '</legend>
    <p class="infos" style="margin-bottom: 15px;">' . Tools::translate('The modifications you make will only be saved by pressing the "Save the translations" button. Press "Close" to discard all changes.') . '</p>
    <p style="margin-bottom: 15px;"><label>' . Tools::translate('Select the language') . '</label><select id="selectLanguage">' . $select . '</select><input type="button" onclick="changeLanguage()" value="Load the dictionary" style="margin-left:20px" /></p>
    <div id="translationsForm" style="margin-top:10px;"><form action="/ajax/save_translations.php" method="post"></form></div>
  </fieldset>';

  echo json_encode(array(
    'text' => $html,
    'bottom' => '<p style="text-align: center">
      <input type="button" onclick="saveTranslations()" value="' . Tools::translate('Save the translations') . '" />
      <input type="button" onclick="$.modal.close()" value="' . Tools::translate('Close') . '" />
    </p>'
  ));
