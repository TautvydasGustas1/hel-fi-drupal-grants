<?php

namespace Drupal\grants_metadata\Plugin\DataType;

/**
 * Trait to handle generic value settings for implementing data.
 */
trait DataFormatTrait {

  /**
   * {@inheritdoc}
   */
  public function setValue($values, $notify = TRUE) {

    $formattedData = [];
    foreach ($this->getProperties() as $name => $property) {
      $definition = $property->getDataDefinition();

      $defaultValue = $definition->getSetting('defaultValue');
      $valueCallback = $definition->getSetting('valueCallback');

      if (array_key_exists($name, $values)) {
        $value = $values[$name];

        if ($value === NULL) {
          $value = $defaultValue;
        }

        if ($valueCallback) {
          $value = call_user_func($valueCallback, $value);
        }
        $formattedData[$name] = $value;
      }
    }

    // @todo Change the autogenerated stub
    parent::setValue($formattedData, $notify);
  }

  /**
   * Override getValue to be able to debug better.
   *
   * @return array
   *   The value.
   */
  public function getValue(): array {
    $retval = parent::getValue();
    return $retval;
  }

}
