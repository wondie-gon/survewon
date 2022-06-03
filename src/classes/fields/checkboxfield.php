<?php
namespace App\Classes\Fields;

use App\Classes\SUWONForm;

/**
 * Class CheckBoxField to display fields of type checkbox
 */
class CheckBoxField extends SUWONForm
{
    /**
     * Static method to return input fields list of type checkbox
     * by setting field args from key, value pair options 
     * 
     * @param array $options array of options with key value pairs
     * @return html Block of text with list of checkbox inputs
     */
    public static function get_fields_list( $options = array() ) {
        // default options
        $default_opts = array(
            'name'              => NULL,
            'fields_title'      => 'Please click one option',
            'info_text'         => '', 
            'wrap'              => true,
            'is_inline'         => false,
            'value_text_pairs'  => array(),
            'last_activates_next'  => false,
        );
        // merged options
        $options = array_merge( $default_opts, $options );

        // set input wrapper class based on value of is_inline
        $wrapper_class = '';
        if ( $options['wrap'] ) {
            $wrapper_class = $options['is_inline'] ? 'form-check form-check-inline' : 'form-check';
        }

        // length or nmber of checkboxes
        $opts_length = count( $options['value_text_pairs'] );

        // field block title
        $title_args = array( 'text' => $options['fields_title'] );

        // start output
        $html = '';

        if ( isset( $options['name'] ) && $opts_length >= 1 ) {
            // start wrapper
            if ( $options['last_activates_next'] ) {
                $html .= parent::get_html_block_start( array( 
                        'id'      			=> $options['name'] . '_checkboxes',
                        'class'      		=> 'mb-3 checkbox-grp unhide-next'
                    ) );
            } else {
                $html .= parent::get_html_block_start( array( 
                        'id'      			=> $options['name'] . '_checkboxes',
                        'class'      		=> 'mb-3 checkbox-grp'
                    ) );
            }
            
            
            // outputing title
            $html .= self::field_block_label( $title_args );
            // info text
            if ( !empty( $options['info_text'] ) ) {
                $html .= '<span class="text-info fw-semibold"><small><i class="fa fa-info-circle me-2"></i>' . $options['info_text'] . '</small></span>';
            }
            // get keys to set new args for each input
            $keys_arr = array_keys( $options['value_text_pairs'] );
            /**
             * ---printing variable for internal use---
             * $html .= print_r( $keys_arr, true ) . '<br />';
             * $html .= $keys_arr[$opts_length - 1];
             */

            // iterating input outputs
            foreach ( $keys_arr as $key ) {
                /**
                 * if last checkbox is neede to activate 
                 * next hidden field when last option checked 
                 * last field's class adds 'unhide-check'
                 */
                $field_class = "form-check-input";
                if ( $options['last_activates_next'] && $key === $keys_arr[$opts_length - 1] ) {
                    $field_class = "form-check-input unhide-check";
                }

                // args array for each input field
                $new_arg = array(
                    'name'  => $options['name'], 
                    'id'    => $options['name'] . '_' . str_replace( "-", "", $key),
                    'value' =>  $key,
                    'class_list'        => $field_class,
                    'label_args'         => array(
                        'for'   =>  $options['name'] . '_' . str_replace( "-", "", $key),
                        'text'  =>  $options['value_text_pairs'][$key]
                    ), 
                    'wrap'              => $options['wrap'],
                    'wrap_args'         => array(
                        'class'     =>  $wrapper_class,
                    )
                );

                // output html
                $html .= self::get_checkbox_input( $new_arg );
            }
            // closing field block
            $html .= parent::get_html_block_close();

        }
        return $html;
    }
    /**
	 * Return input element <label> with for attribute.
	 *
	 * @since 1.0.0
	 *
	 * @param array $args  array of arguments for field label
	 * @return mixed/html html element 'label' with text
	 */
	public static function get_field_label( $args = array() ) {
        $defaults = array(
            'class' =>  'form-check-label fw-semibold',
            'for'   =>  '',
            'text'  =>  'Label text'
        );
        
        // merging defaults with param
        $args = array_merge( $defaults, $args );
        // initialize element
        $label_out = '<label';
        if ( '' !== $args['class'] ) {
            $label_out .= ' class="' . parent::get_class_attr_value( $args['class'] ) . '"';
        }

        // for attribute
        if ( '' !== $args['for'] ) {
            $label_out .= ' for="' . htmlspecialchars( $args['for'] ) . '"';
        }
        $label_out .= '>';
        // label text
        $label_out .= $args['text'];

        // closing label
        $label_out .= '</label>';
		return $label_out;
	}

    /**
	 * Return a checkbox input field
	 *
	 * @since 1.0.0
	 *
	 * @param array $args Arguments to use with the input field
	 * @return string Complete `<input>` with type checkbox
	 */
	public static function get_checkbox_input( $args = array() ) {
		$defaults = parent::get_default_input_parameters(
			[
                'field_name'        => 'input',
                'input_type'        => 'checkbox',
                'id'                => '',
                'name'              => '',
                'value'             => '',
                'class_list'        => 'form-check-input',
                'label_args'         => array(
                    'for'   =>  '',
                    'text'  =>  'Label text'
                ),
                'wrap'              => true,
                'wrap_args'         => array(
                    'class'     =>  'form-check',
                ),
				'input_is_grouped' 	=> false,
				'input_appends'	=>	array(
					'has_link'	=>	false,
					'append_link'	=> '',
					'link_title'	=> '',
					'append_fa_icon'	=>	'',
					'append_text'	=>	'',
				),
				'onblur'    => '', 
                // 'multiple' => true
			]
		);
		$args = array_merge( $defaults, $args );

        // start output
		$html_out = '';

		// get wrapping block
		if ( $args['wrap'] ) {
			$html_out .= parent::get_html_block_start( $args['wrap_args'] );
		}

        $html_out .= '<input type="' . $args['input_type'] . '" id="' . $args['id'] . '" name="' . $args['name'] . '[]" value="' . $args['value'] . '"';

        if ( ! empty( $args['class_list'] ) ) {
            $html_out .= ' ' . parent::get_class_attr( $args['class_list'] );
        }

        if ( ! empty( $args['onblur'] ) ) {
            $html_out .= ' ' . parent::get_onblur( $args['onblur'] );
        }

        // required attributes if required is set true
        if ( $args['required'] === true ) {
            $html_out .= parent::get_aria_required( $args['required'] );

            $html_out .= parent::get_required_attribute( $args['required'] );
        }

        // if data-* attributes are needed
        if ( ! empty( $args['data'] ) ) {
            foreach ( $args['data'] as $dkey => $dvalue ) {
                $html_out .= ' data-' . $dkey . '="' . $dvalue . '"';
            }
        }

        // multiple if type is in one of the stated array
        /*
        if ( in_array( $args['input_type'], array( 'email', 'file' ) ) ) {
            if ( $args['multiple'] ) {
                $html_out .= ' ' . parent::get_multiple_attr( $args['multiple'] );
            }
        }
        */

        // checked attribute
        $html_out .= self::checked_attr( $args['name'], $args['value'] );

        // closing input element
        $html_out .= ' />';

        // label element. Set input 'id' to 'for' attribute of label
        $args['label_args']['for'] = $args['id'];
        $html_out .= self::get_field_label( $args['label_args'] );

        // if field is required
		if ( $args['required'] ) {
			$html_out .= parent::get_required_span();
		}

		if ( ! empty( $args['aftertext'] ) ) {
			$html_out .= parent::get_hidden_text( $args['aftertext'] );
		}

		// close wrapping block
		if ( $args['wrap'] ) {
			$html_out .= parent::get_html_block_close();
		}

		return $html_out;
	}

    /**
     * Gets block text for list of options underneath
     * @param array $args  array of arguments for field label
     * @return mixed/html Text for block of radio or checkboxes list
     */
    public static function field_block_label( $args = array() ) {
        $defaults = array(
            'class' =>  'h4 fw-bold',
            'text'  =>  'Text description for list of options'
        );

        $args = array_merge( $defaults, $args );

        // initialize element
        $html = '<p';
        if ( '' !== $args['class'] ) {
            $html .= ' class="' . parent::get_class_attr_value( $args['class'] ) . '"';
        }

        $html .= '>';
        // label text
        $html .= $args['text'];

        // closing label
        $html .= '</p>';

        // return element
        return $html;
    }

    /**
	 * Adds 'checked' attribute when checkbox is checked
	 * 
	 * @param array $value 
	 * @param string $key
	 */
	public static function checked_attr( $value, $key ) {
		if ( isset( $value ) && is_array( $value ) ) {
            foreach ( $value as $item_key => $item_value ) {
                if ( (string)$item_value === (string)$key ) {
                    echo " checked";
                    break;
                }
            }
        }
		/*
		// if ( isset( $value ) && is_array( $value ) && isset( $value[$key] ) ) {
		if ( isset( $value ) && is_array( $value ) && in_array( $key, $value ) ) {
			echo " checked";
		} else {
			echo "";
		}
		*/
	}

} // class end
