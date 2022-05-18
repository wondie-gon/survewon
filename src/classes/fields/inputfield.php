<?php
namespace App\Classes\Fields;

use App\Classes\SUWONForm;

/**
 * Class InputField to display fields of named input
 */
class InputField extends SUWONForm
{
    /**
     * Method to get field for display
     * @param array $args array of arguments for the input field
     * @return mixed/html an input field ready for print on browser
     */
    public static function get_field( $args = array() ) {
        $defaults = array(
            'field_name'        => 'input',
            'input_type'        => '',
            'id'                => '',
            'name'              => '',
            'textvalue'         => '',
            'class_list'        => '',
            'label_args'         => array( 
                'for'   =>  '',
                'text'  =>  'Label text'
             ),
            'placeholder'       => '',
            'wrap'              => true,
            'wrap_args'         => array(
                'class'     =>  '',
            ),
        );

        $args = array_merge( $defaults, $args );

        // returning field
        return self::get_input_field( $args );
    }

    /**
	 * Return input field with specified input type
	 *
	 * @since 1.0.0
	 *
	 * @param array $args Arguments to use with the input field
	 * @return string Complete `<input>` with specified type and proper attributes.
	 */
	public static function get_input_field( $args = [] ) {
		$defaults = parent::get_default_input_parameters(
			[
				'input_is_grouped' 	=> false,
				'input_appends'	=>	array(
					'has_link'	=>	false,
					'append_link'	=> '',
					'link_title'	=> '',
					'append_fa_icon'	=>	'',
					'append_text'	=>	'',
				),
				'min' 	=> '',
				'max' => '',
				'step' => '',
				'pattern' => '',
				'title' => '',
				'src' => '',
				'alt' => '',
				'img_size' => array(),
				'maxlength' => '',
				'onblur'    => '',
				'multiple' => false,
			]
		);
		$args     = array_merge( $defaults, $args );

		$html_out = '';

		// get wrapping block
		if ( $args['wrap'] ) {
			$html_out .= parent::get_html_block_start( $args['wrap_args'] );
		}

		// label
		$html_out .= self::get_field_label( $args['label_args'] );
		// helptext
		if ( $args['helptext'] ) {
			// $html_out .= parent::get_description( $args['helptext'] );
			$html_out .= '<span class="d-block text-info fw-semibold"><small><i class="fa fa-info-circle me-2"></i>' . $args['helptext'] . '</small></span>';
		}

		if ( $args['required'] ) {
			$html_out .= parent::get_required_span();
		}

		// for input groups
		if ( $args['input_is_grouped'] ) {
			// open input group
			$html_out .= '<div class="input-group">';
		}

			$html_out .= '<input type="' . $args['input_type'] . '" id="' . $args['id'] . '" name="' . $args['name'] . '" value="' . $args['textvalue'] . '"';

			if ( ! empty( $args['class_list'] ) ) {
				$html_out .= ' ' . parent::get_class_attr( $args['class_list'] );
			}

			// min and max attrs if type is in one of the stated array
			if ( in_array( strtolower( $args['input_type'] ), array( 'number', 'range', 'date', 'datetime-local', 'month', 'time', 'week' ) ) ) {
				if ( ! empty( $args['min'] ) ) {
					$html_out .= ' ' . parent::get_min_attr( $args['min'] );
				}

				if ( ! empty( $args['max'] ) ) {
					$html_out .= ' ' . parent::get_max_attr( $args['max'] );
				}

				if ( ! empty( $args['step'] ) ) {
					$html_out .= ' ' . parent::get_step_attr( $args['step'] );
				}
			}

			// pattern and title attrs if type is in one of the stated array
			if ( in_array( strtolower( $args['input_type'] ), array( 'text', 'date', 'search', 'url', 'tel', 'email', 'password' ) ) ) {

				if ( ! empty( $args['pattern'] ) ) {
					$html_out .= ' ' . parent::get_pattern_attr( $args['pattern'] );
				}

				if ( ! empty( $args['title'] ) ) {
					$html_out .= ' ' . parent::get_title_attr( $args['title'] );
				}
			}

			// if type is image
			if ( 'image' === $args['input_type'] ) {

				// src attribute
				if ( ! empty( $args['src'] ) ) {
					$html_out .= ' ' . parent::get_src_attr( $args['src'] );
				}

				// alt attribute
				if ( ! empty( $args['alt'] ) ) {
					$html_out .= ' ' . parent::get_alt_attr( $args['alt'] );
				}

				// image size attributes
				if ( ! empty( $args['img_size'] ) ) {
					$html_out .= ' ' . parent::get_img_size_attr( $args['img_size'] );
				}
			}
			

			if ( ! empty( $args['maxlength'] ) ) {
				$html_out .= ' ' . parent::get_maxlength( $args['maxlength'] );
			}

			if ( ! empty( $args['onblur'] ) ) {
				$html_out .= ' ' . parent::get_onblur( $args['onblur'] );
			}

			// required attributes if required is set true
			if ( in_array( strtolower( $args['input_type'] ), array( 'text', 'search', 'url', 'tel', 'email', 'password', 'date', 'month', 'week', 'time', 'datetime-local', 'number', 'checkbox', 'radio', 'file' ) ) ) {
				$html_out .= parent::get_aria_required( $args['required'] );

				$html_out .= parent::get_required_attribute( $args['required'] );
			}

			// if data-* attributes are needed
			if ( ! empty( $args['data'] ) ) {
				foreach ( $args['data'] as $dkey => $dvalue ) {
					// $html_out .= " data-{$dkey}=\"{$dvalue}\"";
					$html_out .= ' data-' . $dkey . '="' . $dvalue . '"';
				}
			}

			if ( ! empty( $args['placeholder'] ) ) {
				$html_out .= ' ' . parent::get_placeholder( $args['placeholder'] );
			}

			// multiple if type is in one of the stated array
			if ( in_array( strtolower( $args['input_type'] ), array( 'email', 'file' ) ) ) {
				if ( $args['multiple'] ) {
					$html_out .= ' ' . parent::get_multiple_attr( $args['multiple'] );
				}
			}
            // closing input element
			$html_out .= ' />';

		// open input append
		if ( $args['input_is_grouped'] && is_array( $args['input_appends'] ) ) {
			// get input group append
			$html_out .= parent::get_input_group_append( $args['input_appends'] );
			// close input group
			// $html_out .= parent::get_html_block_close( 'div' );
			$html_out .= '</div>';

		} // $input_grouped end

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
	 * Return input element <label> with for attribute.
	 *
	 * @since 1.0.0
	 *
	 * @param array $args  array of arguments for field label
	 * @return mixed/html html element 'label' with text
	 */
	public static function get_field_label( $args = array() ) {
        $defaults = array(
            'class' =>  'form-label h4 fw-bold',
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

} // class end
