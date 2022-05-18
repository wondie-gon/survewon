<?php
namespace App\Classes\Fields;

use App\Classes\SUWONForm;

/**
 * Class TextArea to display a textarea field
 */
class TextArea extends SUWONForm 
{
    /**
	 * Return a `<textarea>` input.
	 *
	 * @since 1.0.0
	 *
	 * @param array $args Arguments to use with the textarea input.
	 * @return string $value Complete <textarea> input with proper attributes.
	 */
	public static function get_textarea_input( $args = [] ) {
		$defaults = parent::get_default_input_parameters(
			[
				'rows' => '',
				'cols' => '',
			]
		);
		$args     = array_merge( $defaults, $args );

		$value = '';

		// get wrapping block
		if ( $args['wrap'] ) {
			$value .= parent::get_html_block_start( $args['wrap_args'] );
		}

		// when labeltext not empty
		if ( ! empty( $args['labeltext'] ) ) {
			$value .= parent::get_label( $args['name'], $args['labeltext'] );
		}

		if ( ! empty( $args['helptext'] ) ) {
			$value .= parent::get_description( $args['helptext'] );
		}

		if ( $args['required'] ) {
			$value .= parent::get_required_span();
		}

		$value .= '<textarea id="' . $args['id'] . '" name="' . $args['name'] . '"';

		if ( ! empty( $args['rows'] ) && is_numeric( $args['rows'] ) && (int) $args['rows'] > 0 ) {
			$value .= ' rows="' . $args['rows'] . '"';
		}

		if ( ! empty( $args['cols'] ) && is_numeric( $args['cols'] ) && (int) $args['cols'] > 30 ) {
			$value .= ' cols="' . $args['cols'] . '"';
		}

		if ( ! empty( $args['class_list'] ) ) {
			$value .= ' ' . parent::get_class_attr( $args['class_list'] );
		}

		if ( ! empty( $args['placeholder'] ) ) {
			$value .= ' ' . parent::get_placeholder( $args['placeholder'] );
		}

		$value .= '>' . $args['textvalue'] . '</textarea>';

		if ( ! empty( $args['aftertext'] ) ) {
			$value .= $args['aftertext'];
		}

		// close wrapping block
		if ( $args['wrap'] ) {
			$value .= parent::get_html_block_close();
		}

		return $value;
	}
}