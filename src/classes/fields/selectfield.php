<?php
namespace App\Classes\Fields;

use App\Classes\SUWONForm;

/**
 * Class SelectField to display fields of type select
 */
class SelectField extends SUWONForm
{
    /**
     * Static method to return select field with options
     * by setting field args from key, value pair options 
     * 
     * @param array $options array of options with key value pairs
     * @return html Block of text with list of select inputs
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
        );
        // merged options
        $options = array_merge( $default_opts, $options );

        // set input wrapper class based on value of is_inline
        $wrapper_class = '';
        if ( $options['wrap'] ) {
            $wrapper_class = $options['is_inline'] ? 'form-check form-check-inline' : 'form-check';
        }

        // length
        $opts_length = count( $options['value_text_pairs'] );

        // field block title
        $title_args = array( 'text' => $options['fields_title'] );

        // start output
        $html = '';

        if ( isset( $options['name'] ) && $opts_length >= 1 ) {
            // start wrapper
            $html .= parent::get_html_block_start( array( 
                        'id'      			=> $options['name'] . '_selectes',
                        'class'      		=> 'mb-3'
                    ) );
            
            // outputing title
            $html .= self::field_block_label( $title_args );
            // info text
            if ( !empty( $options['info_text'] ) ) {
                $html .= '<span class="text-info fw-semibold"><small><i class="fa fa-info-circle me-2"></i>' . $options['info_text'] . '</small></span>';
            }
            // get keys to set new args for each input
            $keys_arr = array_keys( $options['value_text_pairs'] );
            // iterating input outputs
            foreach ( $keys_arr as $key ) {
                $new_arg = array(
                    'name'  => $options['name'], 
                    'id'    => $options['name'] . '_' . str_replace( "-", "", $key),
                    'value' =>  $key,
                    'class_list'        => 'form-check-input',
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
                $html .= self::get_select_input( $new_arg );
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
	 * Return a populated `<select>` input.
	 *
	 * @since 1.0.0
	 *
	 * @param array $args Arguments to use with the `<select>` input.
	 * @return string $value Complete <select> input with options and selected attribute.
	 */
	public static function get_select_input( $args = [] ) {
		$defaults = parent::get_default_input_parameters(
			[ 'selections' => [] ]
		);

		$args = array_merge( $defaults, $args );

		$value = '';

		// get wrapping block
		if ( $args['wrap'] ) {
			$value .= parent::get_html_block_start( $args['wrap_args'] );
		}

		// when labeltext not empty
		if ( ! empty( $args['labeltext'] ) ) {
			$value .= parent::get_label( $args['name'], $args['labeltext'] );
		}

		if ( $args['required'] ) {
			$value .= parent::get_required_span();
		}
		if ( ! empty( $args['helptext'] ) ) {
			$value .= parent::get_help( $args['helptext'] );
		}

		$value .= '<select id="' . $args['id'] . '" name="' . $args['name'] . '"';

		if ( ! empty( $args['class_list'] ) ) {
			$value .= ' ' . parent::get_class_attr( $args['class_list'] );
		}

		$value .= '>';
		if ( ! empty( $args['selections']['options'] ) && is_array( $args['selections']['options'] ) ) {
			foreach ( $args['selections']['options'] as $opt_key => $opt_value ) {

				$selected = selected( $args['selections']['selected'], $opt_key, true );

				$value .= '<option value="' . $opt_key . '"' . $selected . '>' . $opt_value . '</option>';
			}
		}
		$value .= '</select>';

		if ( ! empty( $args['aftertext'] ) ) {
			$value .= ' ' . parent::get_description( $args['aftertext'] );
		}

		// close wrapping block
		if ( $args['wrap'] ) {
			$value .= parent::get_html_block_close();
		}

		return $value;
	}

    /**
     * Gets block text for list of options underneath
     * @param array $args  array of arguments for field label
     * @return mixed/html Text for block of radio or selectes list
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
	* Returns selected attribute when value is selected 
	* @param null|string|array $value Existing value 
	* @param $current Value of an option

	*/
    /**
     * Returns selected attribute when value is selected
     * @param null|string|array $value Existing value
     * @param $current Value of an option
     * @return 'selected' attribute for select field
     */
	public static function selected_attr( $value = '', $current = '' ) {
        /*
        // $value = maybe_unserialize( $value );
        if ( is_array( $value ) && in_array( $current, $value ) ) {
            $result = ' ' . $type . '="' . $type . '"';
        } elseif ( is_numeric( $value ) && in_array( self::stringify_bool_val( $value ), [ 'true', 'false' ], true ) ) {
            $result = ' ' . $type . '="' . $type . '"';
        } else if ( $value == $current ) {
            $result = ' ' . $type . '="' . $type . '"';
        } else {
            $result = '';
        }

        if ( $echo ) {
            echo $result;
        }

        return $result;
*/
        $result = '';
        $bool   = parent::stringify_bool_val( $current );

        if ( is_numeric( $value ) ) {
            $selected = parent::stringify_bool_val( $value );

            if ( ! empty( $selected ) && $selected === $bool ) {
                $result = ' selected="selected"';
            }
        } elseif ( in_array( $value, [ 'true', 'false' ], true ) && $value === $current ) {
            $result = ' selected="selected"';
        }

        return $result;

    }

} // class end
