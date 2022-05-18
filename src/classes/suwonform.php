<?php
namespace App\Classes;
/**
* Base class to generate custom form fields and related elements
*
*/
class SUWONForm {
	/**
	 * Return an opening `<fieldset>` tag.
	 *
	 * @since 1.0.0
	 * @param array $args Array of arguments.
	 * @return string $value Opening `<fieldset>` tag.
	 */
	public static function get_fieldset_start( $args = [] ) {
		$fieldset = '<fieldset';

		if ( ! empty( $args['id'] ) ) {
			$fieldset .= ' id="' . htmlspecialchars( $args['id'] ) . '"';
		}

		if ( ! empty( $args['classes'] ) ) {
			$classes   = 'class="' . implode( ' ', $args['classes'] ) . '"';
			$fieldset .= ' ' . $classes;
		}

		if ( ! empty( $args['aria-expanded'] ) ) {
			$fieldset .= ' aria-expanded="' . $args['aria-expanded'] . '"';
		}

		$fieldset .= ' tabindex="0">';

		return $fieldset;
	}

	/**
	 * Return an closing `<fieldset>` tag.
	 *
	 * @since 1.0.0
	 *
	 * @return string $value Closing `<fieldset>` tag.
	 */
	public static function get_fieldset_end() {
		return '</fieldset>';
	}

	/**
	 * Return an opening `<legend>` tag.
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public static function get_legend_start() {
		return '<legend class="screen-reader-text">';
	}

	/**
	 * Return a closing `</legend>` tag.
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public static function get_legend_end() {
		return '</legend>';
	}

	/**
	 * Return string wrapped in a `<p>` tag.
	 *
	 * @since 1.0.0
	 *
	 * @param string $text Content to wrap in a `<p>` tag.
	 * @return string $value Content wrapped in a `<p>` tag.
	 */
	public static function get_p( $text = '' ) {
		return '<p>' . $text . '</p>';
	}

	/**
	 * Return a form <label> with for attribute.
	 *
	 * @since 1.0.0
	 *
	 * @param string $label_for  Form input to associate `<label>` with.
	 * @param string $label_text Text to display in the `<label>` tag.
	 * @return string $value `<label>` tag with filled out parts.
	 */
	public static function get_label( $label_for, $label_text = '' ) {
		if ( empty( $label_text ) ) {
			return '';
		}
		return '<label for="' . $label_for . '">' . $label_text . '</label>';
	}

	/**
	 * Return an html attribute denoting a required field.
	 *
	 * @since 1.0.0
	 *
	 * @param bool $required Whether or not the field is required.
	 * @return string `Required` attribute.
	 */
	public static function get_required_attribute( $required = false ) {
		return ( $required != false ) ? ' required' : '';
	}

	/**
	 * Return a `<span>` to indicate required status, with class attribute.
	 *
	 * @since 1.0.0
	 *
	 * @return string Span tag.
	 */
	public static function get_required_span() {
		return ' <span class="required">*</span>';
	}

	/**
	 * Return an aria-required attribute set to true.
	 *
	 * @since 1.0.0
	 *
	 * @param bool $required Whether or not the field is required.
	 * @return string Aria required attribute
	 */
	public static function get_aria_required( $required = false ) {
		return ( $required != false ) ? ' aria-required="true"' : '';
	}

	/**
	 * Return an `<a>` tag with title attribute holding help text.
	 *
	 * @since 1.0.0
	 *
	 * @param string $help_text Text to use in the title attribute.
	 * @return string <a> tag with filled out parts.
	 */
	public static function get_help( $help_text = '' ) {
		return '<a href="#" title="' . $help_text . '"></a>';
	}

	/**
	 * Return a `<span>` tag with the help text.
	 *
	 * @since 1.0.0
	 *
	 * @param string $help_text Text to display after the input.
	 * @return string
	 */
	public static function get_description( $help_text = '' ) {
		return '<span class="description">' . $help_text . '</span>';
	}

	/**
	 * Return a maxlength HTML attribute with a specified length.
	 *
	 * @since 1.0.0
	 *
	 * @param string $length How many characters the max length should be set to.
	 * @return string $value Maxlength HTML attribute.
	 */
	public static function get_maxlength( $length = '' ) {
		return 'maxlength="' . $length . '"';
	}

	/**
	 * Return a class input attribute with a specified class
	 *
	 * @since 1.0.0
	 *
	 * @param string $class_list What class user input should look like
	 * @return string $output class input attribute.
	 */
	public static function get_class_attr( $class_list = '' ) {

		$output = '';

		if ( ! empty( $class_list ) ) {

			$output = 'class="' . self::get_class_attr_value( $class_list ) . '"';
		}

		return $output;
	}

	/**
	 * Return a pattern input attribute with a specified pattern
	 *
	 * @since 1.0.0
	 *
	 * @param string $pattern What pattern user input should look like
	 * @return string $value pattern input attribute.
	 */
	public static function get_pattern_attr( $pattern = '' ) {
		return 'pattern="' . $pattern . '"';
	}

	/**
	 * Return a step input attribute with a specified step
	 *
	 * @since 1.0.0
	 *
	 * @param string $step 
	 * @return string $value step input attribute.
	 */
	public static function get_step_attr( $step = '' ) {
		if ( is_numeric( $step ) ) {
			return 'step="' . $step . '"';
		}
	}

	/**
	 * Return a min input attribute for number input types
	 *
	 * @since 1.0.0
	 *
	 * @param string $min 
	 * @return string $value min input attribute.
	 */
	public static function get_min_attr( $min = '' ) {
		if ( is_numeric( $min ) ) {
			return 'min="' . $min . '"';
		}
	}

	/**
	 * Return a max input attribute for number input types
	 *
	 * @since 1.0.0
	 *
	 * @param string $max 
	 * @return string $value max input attribute.
	 */
	public static function get_max_attr( $max = '' ) {
		if ( is_numeric( $max ) ) {
			return 'max="' . $max . '"';
		}
	}

	/**
	 * Return a src input attribute for image input types
	 *
	 * @since 1.0.0
	 *
	 * @param string $src 
	 * @return string src input attribute.
	 */
	public static function get_src_attr( $src = '' ) {
		return 'src="' .  $src . '"';
	}

	/**
	 * Return alt input attribute for image input types
	 *
	 * @since 1.0.0
	 *
	 * @param string $alt 
	 * @return string alt input attribute.
	 */
	public static function get_alt_attr( $alt = '' ) {
		return 'alt="' . $alt . '"';
	}

	/**
	 * Return width and height input attribute for image input types
	 *
	 * @since 1.0.0
	 *
	 * @param string $alt 
	 * @return string alt input attribute.
	 */
	public static function get_img_size_attr( $img_size = array() ) {
		if ( $img_size && is_array( $img_size ) ) {
			return 'width="' . absint( $img_size[0] ) . '" height="' . absint( $img_size[1] ) . '"';
		}
	}

	/**
	 * Return a title input attribute for number input types
	 *
	 * @since 1.0.0
	 *
	 * @param string $title 
	 * @return string $value title input attribute.
	 */
	public static function get_title_attr( $title = '' ) {
		return 'title="' . $title . '"';
	}

	/**
	 * Return attribute 'multiple' works for email and file input types
	 *
	 * @since 1.0.0
	 *
	 * @param string $multiple 
	 * @return string 'multiple' input attribute.
	 */
	public static function get_multiple_attr( $multiple = false ) {
		return 'multiple';
	}

	/**
	 * Return a onblur HTML attribute for a specified value.
	 *
	 * @since 1.0.0
	 *
	 * @param string $text Text to place in the onblur attribute.
	 * @return string $value Onblur HTML attribute.
	 */
	public static function get_onblur( $text = '' ) {
		return 'onblur="' . $text . '"';
	}

	/**
	 * Return a placeholder HTML attribtue for a specified value.
	 *
	 * @since 1.0.0
	 *
	 * @param string $placeholder Text to place in the placeholder attribute.
	 * @return string $value Placeholder HTML attribute.
	 */
	public static function get_placeholder( $placeholder = '' ) {
		return 'placeholder="' . $placeholder . '"';
	}

	/**
	 * Return a span that will only be visible for screenreaders.
	 *
	 * @since 1.0.0
	 *
	 * @param string $text Text to visually hide.
	 * @return html|string Visually hidden text meant for screen readers.
	 */
	public static function get_hidden_text( $text = '' ) {
		return '<span class="visuallyhidden">' . $text . '</span>';
	}

	/**
	* Return input group append 
	* 
	* @param array $append_args  Arguments to build input group append block
	* @return html|string 
	*/
	public static function get_input_group_append( $append_args = array() ) {
		$defaults	=	array(
			'has_link'	=>	false,
			'append_link'	=> '',
			'link_title'	=> '',
			'append_fa_icon'	=>	'',
			'append_text'	=>	'',
		);

		// parsing args using recurrsive parser custom function
		$append_args = array_merge( $defaults, $append_args );

		$appended_html = '';

		// input group append start
		$appended_html .= '<div class="input-group-append"><span class="input-group-text">';

		// if text has link
		if ( $append_args['has_link'] ) {
			// get link
			$append_link = ( ! empty( $append_args['append_link'] ) && ( $append_args['append_link'] !== '#' ) ) ? htmlspecialchars( urlencode( $append_args['append_link'] ) ) : '#';

			// open link element
			$appended_html .= '<a href="' . $append_link . '" class="link-secondary" data-bs-toggle="tooltip"';

			// link title
			if ( ! empty( $append_args['link_title'] ) ) {
				$appended_html .= ' ' . 'title="' . htmlspecialchars( $append_args['link_title'] ) . '"';
			}

			$appended_html .= '>';
		}

			// append fa icon
			if ( ! empty( $append_args['append_fa_icon'] ) ) {
				$appended_html .= self::get_fontawesome_icon( $append_args['append_fa_icon'] );
			}

			// append text
			if ( ! empty( $append_args['append_text'] ) ) {
				$appended_html .= htmlspecialchars( $append_args['append_text'] );
			}
		

		// if text has link
		if ( $append_args['has_link'] ) {
			$appended_html .= '</a>';	
		}

		$appended_html .= '</span></div>';

		return $appended_html;
	}

	/**
	 * Return link anchor element <a></a>
	 *
	 * @since 1.0.0
	 *
	 * @param array $link_args Arguments for link anchor element
	 * @return html|string Link with attributes, fontawesome icon, and text
	 */
	public static function get_link_element( $link_args = array() ) {
		$defaults = array(
			'id'	=>	'',
			'class'	=>	'',
			'href'	=>	'',
			'target'	=>	'',
			'hreflang'	=>	'',
			'title'	=>	'',
			'role'	=>	'',
			'data_attrs'	=>	array(),
			'aria_attrs'	=>	array(),
			'downloadable'	=>	false,
			'link_fa_icon'	=>	'',
			'link_text'	=>	'',
		);

		$link_args = array_merge( $defaults, $link_args );

		// open link
		$anchor_html = '<a';

		// id attribute
		if ( ! empty( $link_args['id'] ) ) {
			$anchor_html .= ' ' . 'id="' . htmlspecialchars( $link_args['id'] ) . '"';
		}

		// class attribute
		if ( ! empty( $link_args['class'] ) ) {
			$anchor_html .= ' ' . 'class="' . self::get_class_attr_value( $link_args['class'] ) . '"';
		}

		// href attribute
		if ( ! empty( $link_args['href'] ) && ( $link_args['href'] !== '#' ) ) {
			$anchor_html .= ' ' . 'href="' . htmlspecialchars( urlencode( $link_args['href'] ) ) . '"';
		} else {
			$anchor_html .= ' ' . 'href="#"';
		}

		// target attribute
		if ( ! empty( $link_args['target'] ) && in_array( strtolower( $link_args['target'] ), array( '_self', '_parent', '_top', '_blank' ) ) ) {
			$anchor_html .= ' ' . 'target="' . htmlspecialchars( $link_args['target'] ) . '"';
		}

		// hreflang attribute
		if ( ! empty( $link_args['hreflang'] ) ) {
			$anchor_html .= ' ' . 'hreflang="' . htmlspecialchars( $link_args['hreflang'] ) . '"';
		}

		// role attribute
		if ( ! empty( $link_args['role'] ) ) {
			$anchor_html .= ' ' . 'role="' . htmlspecialchars( $link_args['role'] ) . '"';
		}

		// data_attrs attribute
		if ( ! empty( $link_args['data_attrs'] ) && is_array( $link_args['data_attrs'] ) ) {
			foreach ( $link_args['data_attrs'] as $data_key => $data_value ) {
				$anchor_html .= ' ' . 'data-' . $data_key . '="' . htmlspecialchars( $data_value ) . '"';
			}
		}

		// aria_attrs attribute
		if ( ! empty( $link_args['aria_attrs'] ) && is_array( $link_args['aria_attrs'] ) ) {
			foreach ( $link_args['aria_attrs'] as $aria_key => $aria_value ) {
				$anchor_html .= ' ' . 'aria-' . $aria_key . '="' . htmlspecialchars( $aria_value ) . '"';
			}
		}

		// download attribute
		if ( $link_args['downloadable'] ) {
			$anchor_html .= ' ' . 'download';
		}

		$anchor_html .= '>';

		// fa icon
		if ( ! empty( $link_args['link_fa_icon'] ) ) {
			$anchor_html .= self::get_fontawesome_icon( $link_args['link_fa_icon'] );
		}

		// text
		if ( ! empty( $link_args['link_text'] ) ) {
			$anchor_html .= htmlspecialchars( $link_args['link_text'] );
		}

		$anchor_html .= '</a>';

		return $anchor_html;
	}

	/**
	 * Return some array_merged default arguments for all input types.
	 *
	 * @since 1.0.0
	 *
	 * @param array $additions Arguments array to merge with our defaults.
	 * @return array $value Merged arrays for our default parameters.
	 */
	public static function get_default_input_parameters( $additions = [] ) {
		return array_merge(
			[
				'field_name' 		=> '',
				'input_type'      	=> '',
				'id'      			=> '',
				'namearray'      	=> '',
				'name'           	=> '',
				'textvalue'      	=> '',
				'class_list'      	=> '',
				'labeltext'      	=> '',
				'placeholder'    	=> '',
				'aftertext'      	=> '',
				'helptext'       	=> '',
				'required'       	=> false,
				'wrap'           	=> false,
				'wrap_args'     	=> array(),
			],
			(array) $additions
		);
	}

	/**
	 * Return a checkbox `<input>`.
	 *
	 * @since 1.0.0
	 *
	 * @param array $args Arguments to use with the checkbox input.
	 * @return string $value Complete checkbox `<input>` with proper attributes.
	 */
	public static function get_check_input( $args = [] ) {
		$defaults = self::get_default_input_parameters(
			[
				'checkvalue'    => '',
				'checked'       => 'true',
				'checklisttext' => '',
				'default'       => false,
			]
		);
		$args     = array_merge( $defaults, $args );

		$field_html = '';

		// get wrapping block
		if ( $args['wrap'] ) {
			$field_html .= self::get_html_block_start( $args['wrap_args'] );
		}

		$field_html .= $args['checklisttext'];
		if ( $args['required'] ) {
			$field_html .= self::get_required_span();
		}

		$field_html .= '<input type="checkbox" id="' . $args['id'] . '" name="' . $args['name'] . '" value="' . $args['checkvalue'] . '"';

		if ( ! empty( $args['class_list'] ) ) {
			$field_html .= ' ' . self::get_class_attr( $args['class_list'] );
		}

		if ( isset( $args['checked'] ) && 'false' === $args['checked'] ) {
			$field_html .= ' />';
		} else {
			$field_html .= ' checked="checked" />';
		}
		// when labeltext not empty
		if ( ! empty( $args['labeltext'] ) ) {
			$field_html .= self::get_label( $args['name'], $args['labeltext'] );
		}

		// close wrapping block
		if ( $args['wrap'] ) {
			$field_html .= self::get_html_block_close();
		}

		return $field_html;
	}

	/**
	 * Return a populated input with list attribute
	 *
	 * @since 1.0.0
	 *
	 * @param array $args Arguments to use with the input.
	 * @return string $value Complete <select> input with options and selected attribute.
	 */
	public static function get_datalist_input( $args = [] ) {
		$defaults = self::get_default_input_parameters(
			[ 
				'datalist' => false,
				'selections' => [],
			]
		);

		$args = array_merge( $defaults, $args );

		$value = '';

		// get wrapping block
		if ( $args['wrap'] ) {
			$value .= self::get_html_block_start( $args['wrap_args'] );
		}

		// when labeltext not empty
		if ( ! empty( $args['labeltext'] ) ) {
			$value .= self::get_label( $args['name'], $args['labeltext'] );
		}

		if ( $args['required'] ) {
			$value .= self::get_required_span();
		}
		if ( ! empty( $args['helptext'] ) ) {
			$value .= self::get_help( $args['helptext'] );
		}

		$value .= '<input list="' . $args['id'] . '"';

		if ( ! empty( $args['class_list'] ) ) {
			$value .= ' ' . self::get_class_attr( $args['class_list'] );
		}

		$value .= '>';

		$value .= '<datalist id="' . $args['id'] . '" name="' . $args['name'] . '">';
		if ( ! empty( $args['selections']['options'] ) && is_array( $args['selections']['options'] ) ) {
			foreach ( $args['selections']['options'] as $val ) {

				$value .= '<option value="' . $val . '">';
			}
		}
		$value .= '</datalist>';

		if ( ! empty( $args['aftertext'] ) ) {
			$value .= ' ' . self::get_description( $args['aftertext'] );
		}

		// close wrapping block
		if ( $args['wrap'] ) {
			$value .= self::get_html_block_close();
		}

		return $value;
	}

	/**
	 * Returns boolean values converted to string
	 *
	 * @since 0.1.0
	 *
	 * @param string $check_val String boolean value.
	 * @return string Boolean converted to string
	 */
	public static function stringify_bool_val( $check_val ) {

		$check_val = (string) $check_val;

		$bool_checks = array( "false", "0" );

		if ( empty( $check_val ) || in_array( strtolower( $check_val ), $bool_checks ) ) {
			return 'false';
		}

		return 'true';
	}

	/**
	 * Returns bool values of a bool or stringified bool
	 *
	 * @since 0.1.0
	 *
	 * @param string $check_val String boolean value.
	 * @return string Standard boolean value
	 */
	public static function get_standard_bool( $check_val ) {

		$check_val = (string) $check_val;

		$bool_checks = array( "false", "0" );

		if ( empty( $check_val ) || in_array( strtolower( $check_val ), $bool_checks ) ) {
			return false;
		}

		return true;
	}

	/**
	 * Return a button `<input>`.
	 *
	 * @since 1.0.0
	 *
	 * @param array $args Arguments to use with the button input.
	 * @return string Complete button `<input>`.
	 */
	public static function get_button_input( $args = [] ) {
		// initialize output
		$output = '';

		// get wrapping block
		if ( $args['wrap'] ) {
			$output .= self::get_html_block_start( $args['wrap_args'] );
		}

		$output .= '<input';

		// add type attr
		if ( ! empty( $args['input_type'] ) ) {
			$output .= ' type="' . $args['input_type'] . '"';
		}

		// add id attr
		if ( ! empty( $args['id'] ) ) {
			$output .= ' id="' . $args['id'] . '"';
		}

		// add class attr
		if ( ! empty( $args['class_list'] ) ) {
			$output .= ' ' . self::get_class_attr( $args['class_list'] );
		}

		// add btns text
		if ( ! empty( $args['textvalue'] ) ) {
			$output .= ' value="' . $args['textvalue'] . '"';
		}

		$output .= ' />';

		// close wrapping block
		if ( $args['wrap'] ) {
			$output .= self::get_html_block_close();
		}

		return $output;
	}

	/**
	 * Returns an HTML block for previewing the menu icon.
	 *
	 * @param string $menu_icon URL or a name of the dashicons class.
	 *
	 * @return string $value HTML block with a layout of the menu icon preview.
	 * @since 1.8.1
	 */
	public static function get_menu_icon_preview( $menu_icon = '' ) {
		$content = '';
		if ( ! empty( $menu_icon ) ) {
			$content = '<img src="' . $menu_icon . '">';
			if ( 0 === strpos( $menu_icon, 'dashicons-' ) ) {
				$content = '<div class="dashicons-before ' . $menu_icon . '"></div>';
			}
		}

		return '<div id="menu_icon_preview">' . $content . '</div>';
	}

	/**
	 * Return a button with field name input and type 'button'
	 *			or 
	 * with field name button and type 'submit'
	 *
	 * @since 1.0.0
	 *
	 * @param array $args Arguments to use with the button input.
	 * @return string Complete button '<button>...</button>'
	 */
	public static function get_button_element( $args = array() ) {

		$defaults = self::get_default_input_parameters( array(
			'fa_class' => '',
		) );

		$args = array_merge( $defaults, $args );

		// initialize output
		$output = '';

		// get wrapping block
		if ( $args['wrap'] ) {
			$output .= self::get_html_block_start( $args['wrap_args'] );
		}

		$output .= '<' . $args['field_name'];

		// add type attr
		if ( ! empty( $args['input_type'] ) ) {
			$output .= ' type="' . $args['input_type'] . '"';
		}

		// add id attr
		if ( ! empty( $args['id'] ) ) {
			$output .= ' id="' . $args['id'] . '"';
		}

		// add class attr
		if ( ! empty( $args['class_list'] ) ) {
			$output .= ' ' . self::get_class_attr( $args['class_list'] );
		}

		$output .= '>';

		// fontawesome icon if given
		if ( ! empty( $args['fa_class'] ) ) {

			$output .= self::get_fontawesome_icon( $args['fa_class'] );
		}

		// add btns text
		if ( ! empty( $args['textvalue'] ) ) {

			$output .= $args['textvalue'];
		}

		$output .= '</' . $args['field_name'] . '>';

		// close wrapping block
		if ( $args['wrap'] ) {
			$output .= self::get_html_block_close();
		}

		return $output;
	}

    /**
	 * Return some array_merged default arguments for all html elements
	 *
	 * @since 1.0.0
	 *
	 * @param array $additional_attrs Arguments array to merge with our defaults.
	 * @return array  Merged arrays for parameters to generate element attributes
	 */
	public static function get_block_config_args( $additional_attrs = [] ) {
		return array_merge(
			[
				'id'      			=> '',
				'class'      		=> '',
				'tabindex'      	=> '',
				'role'      		=> '',
				'data_attrs'     	=> array(),
				'aria_attrs'     	=> array(),
			],
			(array) $additional_attrs
		);
	}
	/**
	* Filter function to get html attributes populated
	*
	* @param array $config_args argument to open/start html tag
	* @return string Html tag attributes
	*/
	public static function get_generated_block_attrs( $config_args = array() ) {

		// get first the defaults
		$defaults = self::get_block_config_args();

		$config_args = array_merge( $defaults, $config_args );

		// init output
		$attrs_output = '';

		// type attribute
		if ( ! empty( $config_args['type'] ) ) {
			$attrs_output .= ' ' . 'type="' . htmlspecialchars( $config_args['type'] ) . '"';
		}

		// id attribute
		if ( ! empty( $config_args['id'] ) ) {
			$attrs_output .= ' ' . 'id="' . htmlspecialchars( $config_args['id'] ) . '"';
		}

		// class attribute
		if ( ! empty( $config_args['class'] ) ) {
			$attrs_output .= ' ' . 'class="' . self::get_class_attr_value( $config_args['class'] ) . '"';
		}

		// tabindex attribute
		if ( ! empty( $config_args['tabindex'] ) ) {
			$attrs_output .= ' ' . 'tabindex="' . htmlspecialchars( $config_args['tabindex'] ) . '"';
		}

		// role attribute
		if ( ! empty( $config_args['role'] ) ) {
			$attrs_output .= ' ' . 'role="' . htmlspecialchars( $config_args['role'] ) . '"';
		}

		// data_attrs attribute
		if ( ! empty( $config_args['data_attrs'] ) && is_array( $config_args['data_attrs'] ) ) {
			foreach ( $config_args['data_attrs'] as $data_key => $data_value ) {
				$attrs_output .= ' ' . 'data-' . $data_key . '="' . htmlspecialchars( $data_value ) . '"';
			}
		}

		// aria attribute
		if ( ! empty( $config_args['aria_attrs'] ) && is_array( $config_args['aria_attrs'] ) ) {
			foreach ( $config_args['aria_attrs'] as $aria_key => $aria_value ) {
				$attrs_output .= ' ' . 'aria-' . $aria_key . '="' . htmlspecialchars( $aria_value ) . '"';
			}
		}

		return $attrs_output;
	}

	/**
	* prepare class attribute values of html tag and removes unwanted characters in the list
	*
	* @since 1.0.0
	* @param string $class_list One or more strings list to be cleaned and prepared for class attr
	* @return string Clean string of $class_list to be used as value for class attribute of html tags
	*/
	public static function get_class_attr_value( $class_list = '' ) {
		if ( empty( $class_list ) ) {
			$class_list = '';
		} else {

			// strip extra whitespaces
			$class_list = preg_replace( '/\s\s+/', ' ', trim( $class_list ) );

			// Strip out any %-encoded octets.
    		$sanitized = preg_replace( '|%[a-fA-F0-9][a-fA-F0-9]|', '', $class_list );

			// replacing unwanted chars with '' except alphanumeric, underscore, hyphen and space
			$class_list = preg_replace( '/[^A-Za-z0-9_\-\s]/', '', $class_list );
			$class_list = implode( ' ', (array) $class_list );
		}

		return rtrim( $class_list );
	}

    /**
	* open html element
	*
	* @param array $config_args argument to open/start html tag
	* @return string Html tag starter with attributes
	*/
	public static function get_html_block_start( $config_args = array() ) {

		$defaults = self::get_block_config_args(
			[
				'tag_name' => 'div',
			]
		);
		$config_args     = array_merge( $defaults, $config_args );

		$output = '';

		$output .= '<' . htmlspecialchars( $config_args['tag_name'] );

		$output .= self::get_generated_block_attrs( $config_args );

		$output .= '>';

		return $output;
	}
    /**
	* close html element
	*
	* @param string $tagName Name of html block tag to be closed
	* @return string Closing tag for the required block with specified tag name
	*/
	public static function get_html_block_close( $tagName = '' ) {
		if ( empty( $args ) ) {
			return '</div>';
		} else {
			return '</' . htmlspecialchars( $tagName ) . '>';
		}
	}

    /**
	* Get fontawesome icon
	* 
	* @param string $fa_class 	Class of fontawesome icon
	*/
	public static function get_fontawesome_icon( $fa_class = '' ) {

		$icon = '';

		// when icon class is given
		if ( ! empty( $fa_class ) ) {
			$icon .= '<i';
			$icon .= ' class="' . htmlspecialchars( self::get_class_attr_value( $fa_class ) ) . '"';
			$icon .= '></i>';
		}

		return $icon;
	}
	
} // ClassEnd