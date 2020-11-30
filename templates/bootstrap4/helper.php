<?php
abstract class TemplateHelper  {
	
	/*
	 * Function to shorten Text (e.g. intro Text)
	 */
    protected static $optionDefaults = array(
		'option' => array(
			'option.attr' => null,
			'option.disable' => 'disable',
			'option.id' => null,
			'option.key' => 'value',
			'option.key.toHtml' => true,
			'option.label' => null,
			'option.label.toHtml' => true,
			'option.text' => 'text',
			'option.text.toHtml' => true,
			'option.class' => 'class',
			'option.onclick' => 'onclick',
		),
    );
    protected static $zones = array('Africa', 'America', 'Antarctica', 'Arctic', 'Asia', 'Atlantic', 'Australia', 'Europe', 'Indian', 'Pacific');

    public static function genericlist($data, $name, $attribs = null, $optKey = 'value', $optText = 'text', $selected = null, $idtag = false,
		$translate = false)
	{
		// Set default options
		$options = array_merge(JHtml::$formatOptions, array('format.depth' => 0, 'id' => false));
        // $options = [];
		if (is_array($attribs) && func_num_args() === 3)
		{
			// Assume we have an options array
			$options = array_merge($options, $attribs);
		}
		else
		{
			// Get options from the parameters
			$options['id'] = $idtag;
			$options['list.attr'] = $attribs;
			$options['list.translate'] = $translate;
			$options['option.key'] = $optKey;
			$options['option.text'] = $optText;
			$options['list.select'] = $selected;
		}

		$attribs = '';

		if (isset($options['list.attr']))
		{
			if (is_array($options['list.attr']))
			{
				$attribs = ArrayHelper::toString($options['list.attr']);
			}
			else
			{
				$attribs = $options['list.attr'];
			}

			if ($attribs !== '')
			{
				$attribs = ' ' . $attribs;
			}
		}

		$id = $options['id'] !== false ? $options['id'] : $name;
		$id = str_replace(array('[', ']', ' '), '', $id);

		$baseIndent = str_repeat($options['format.indent'], $options['format.depth']++);
		$html = $baseIndent . '<select' . ($id !== '' ? ' id="' . $id . '"' : '') . ' name="' . $name . '"' . $attribs . '>' . $options['format.eol']
			. static::options($data, $options) . $baseIndent . '</select>' . $options['format.eol'];

		return $html;
    }
    public static function option($value, $text = '', $optKey = 'value', $optText = 'text', $disable = false)
	{
		$options = array(
			'attr' => null,
			'disable' => false,
			'option.attr' => null,
			'option.disable' => 'disable',
			'option.key' => 'value',
			'option.label' => null,
			'option.text' => 'text',
		);

		if (is_array($optKey))
		{
			// Merge in caller's options
			$options = array_merge($options, $optKey);
		}
		else
		{
			// Get options from the parameters
			$options['option.key'] = $optKey;
			$options['option.text'] = $optText;
			$options['disable'] = $disable;
		}

		$obj = new stdClass;
		$obj->{$options['option.key']}  = $value;
		$obj->{$options['option.text']} = trim($text) ? $text : $value;

		/*
		 * If a label is provided, save it. If no label is provided and there is
		 * a label name, initialise to an empty string.
		 */
		$hasProperty = $options['option.label'] !== null;

		if (isset($options['label']))
		{
			$labelProperty = $hasProperty ? $options['option.label'] : 'label';
			$obj->$labelProperty = $options['label'];
		}
		elseif ($hasProperty)
		{
			$obj->{$options['option.label']} = '';
		}

		// Set attributes only if there is a property and a value
		if ($options['attr'] !== null)
		{
			$obj->{$options['option.attr']} = $options['attr'];
		}

		// Set disable only if it has a property and a value
		if ($options['disable'] !== null)
		{
			$obj->{$options['option.disable']} = $options['disable'];
		}

		return $obj;
    }
    public static function options($arr, $optKey = 'value', $optText = 'text', $selected = null, $translate = false)
	{
		$options = array_merge(
			JHtml::$formatOptions,
			static::$optionDefaults['option'],
			array('format.depth' => 0, 'groups' => true, 'list.select' => null, 'list.translate' => false)
		);

		if (is_array($optKey))
		{
			// Set default options and overwrite with anything passed in
			$options = array_merge($options, $optKey);
		}
		else
		{
			// Get options from the parameters
			$options['option.key'] = $optKey;
			$options['option.text'] = $optText;
			$options['list.select'] = $selected;
			$options['list.translate'] = $translate;
		}

		$html = '';
		$baseIndent = str_repeat($options['format.indent'], $options['format.depth']);

		foreach ($arr as $elementKey => &$element)
		{
			$attr = '';
			$extra = '';
			$label = '';
			$id = '';

			if (is_array($element))
			{
				$key = $options['option.key'] === null ? $elementKey : $element[$options['option.key']];
				$text = $element[$options['option.text']];

				if (isset($element[$options['option.attr']]))
				{
					$attr = $element[$options['option.attr']];
				}

				if (isset($element[$options['option.id']]))
				{
					$id = $element[$options['option.id']];
				}

				if (isset($element[$options['option.label']]))
				{
					$label = $element[$options['option.label']];
				}

				if (isset($element[$options['option.disable']]) && $element[$options['option.disable']])
				{
					$extra .= ' disabled="disabled"';
				}
			}
			elseif (is_object($element))
			{
				$key = $options['option.key'] === null ? $elementKey : $element->{$options['option.key']};
				$text = $element->{$options['option.text']};

				if (isset($element->{$options['option.attr']}))
				{
					$attr = $element->{$options['option.attr']};
				}

				if (isset($element->{$options['option.id']}))
				{
					$id = $element->{$options['option.id']};
				}

				if (isset($element->{$options['option.label']}))
				{
					$label = $element->{$options['option.label']};
				}

				if (isset($element->{$options['option.disable']}) && $element->{$options['option.disable']})
				{
					$extra .= ' disabled="disabled"';
				}

				if (isset($element->{$options['option.class']}) && $element->{$options['option.class']})
				{
					$extra .= ' class="' . $element->{$options['option.class']} . '"';
				}

				if (isset($element->{$options['option.onclick']}) && $element->{$options['option.onclick']})
				{
					$extra .= ' onclick="' . $element->{$options['option.onclick']} . '"';
				}
			}
			else
			{
				// This is a simple associative array
				$key = $elementKey;
				$text = $element;
			}

			/*
			 * The use of options that contain optgroup HTML elements was
			 * somewhat hacked for J1.5. J1.6 introduces the grouplist() method
			 * to handle this better. The old solution is retained through the
			 * "groups" option, which defaults true in J1.6, but should be
			 * deprecated at some point in the future.
			 */

			$key = (string) $key;

			if ($key === '<OPTGROUP>' && $options['groups'])
			{
				$html .= $baseIndent . '<optgroup label="' . ($options['list.translate'] ? JText::_($text) : $text) . '">' . $options['format.eol'];
				$baseIndent = str_repeat($options['format.indent'], ++$options['format.depth']);
			}
			elseif ($key === '</OPTGROUP>' && $options['groups'])
			{
				$baseIndent = str_repeat($options['format.indent'], --$options['format.depth']);
				$html .= $baseIndent . '</optgroup>' . $options['format.eol'];
			}
			else
			{
				// If no string after hyphen - take hyphen out
				$splitText = explode(' - ', $text, 2);
				$text = $splitText[0];

				if (isset($splitText[1]) && $splitText[1] !== '' && !preg_match('/^[\s]+$/', $splitText[1]))
				{
					$text .= ' - ' . $splitText[1];
				}

				if (!empty($label) && $options['list.translate'])
				{
					$label = JText::_($label);
				}

				if ($options['option.label.toHtml'])
				{
					$label = htmlentities($label);
				}

				if (is_array($attr))
				{
					$attr = ArrayHelper::toString($attr);
				}
				else
				{
					$attr = trim($attr);
				}

				$extra = ($id ? ' id="' . $id . '"' : '') . ($label ? ' label="' . $label . '"' : '') . ($attr ? ' ' . $attr : '') . $extra;

				if (is_array($options['list.select']))
				{
					foreach ($options['list.select'] as $val)
					{
						$key2 = is_object($val) ? $val->{$options['option.key']} : $val;

						if ($key == $key2)
						{
							$extra .= ' selected="selected"';
							break;
						}
					}
				}
				elseif ((string) $key === (string) $options['list.select'])
				{
					$extra .= ' selected="selected"';
				}

				if ($options['list.translate'])
				{
					$text = JText::_($text);
				}

				// Generate the option, encoding as required
				$html .= $baseIndent . '<option value="' . ($options['option.key.toHtml'] ? htmlspecialchars($key, ENT_COMPAT, 'UTF-8') : $key) . '"'
					. $extra . '>';
				$html .= $options['option.text.toHtml'] ? htmlentities(html_entity_decode($text, ENT_COMPAT, 'UTF-8'), ENT_COMPAT, 'UTF-8') : $text;
				$html .= '</option>' . $options['format.eol'];
			}
		}

		return $html;
    }
    
    public function getGroups()
	{
		$groups = array();

		// Get the list of time zones from the server.
		$zones = DateTimeZone::listIdentifiers();

		// Build the group lists.
		foreach ($zones as $zone)
		{
			// Time zones not in a group we will ignore.
			if (strpos($zone, '/') === false)
			{
				continue;
			}

			// Get the group/locale from the timezone.
			list ($group, $locale) = explode('/', $zone, 2);

			// Only use known groups.
			if (in_array($group, self::$zones))
			{
				// Initialize the group if necessary.
				if (!isset($groups[$group]))
				{
					$groups[$group] = array();
				}

				// Only add options where a locale exists.
				if (!empty($locale))
				{
					$groups[$group][$zone] = JHtml::_('select.option', $zone, str_replace('_', ' ', $locale), 'value', 'text', false);
				}
			}
		}

		// Sort the group lists.
		ksort($groups);

		foreach ($groups as &$location)
		{
			sort($location);
		}

		return $groups;
	}
}

?>