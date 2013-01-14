<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
  CodeIgniter Template Library
	
	Author	: Yoeran Luteijn <contact@yoeran.nl>
	Date	: 14-01-2013
	URL		: http://github.com/CodeIgniter_Template_Library

	Original author	: Jérôme Jaglale (http://maestric.com/)
	URL				: http://maestric.com/doc/php/codeigniter_template
*/
class Template
{
	private $template_data = array();
	private $CI;

	function __construct(){
		$this->CI =& get_instance();		
	}

	/*
		Load a view into a template file. Don't load the template file if it was an ajax request.
	*/
	public function ajax($template, $view, $view_data = array(), $target = 'contents', $return = FALSE)
	{
		if( $this->CI->input->is_ajax_request() ){
			$newTarget = ( $target != 'contents' ) ? $target : 'contents';
			$this->partial( $view, $view_data, $newTarget, $return );
		} else {
			$this->load( $template, $view, $view_data, $target, $return );
		}
	}

	/*
		Load a view into a template file

	*/
	public function load($template, $view, $view_data = array(), $target = 'contents', $return = FALSE)
	{               
		$this->set($target, $this->CI->load->view($view, $view_data, TRUE));

		return $this->CI->load->view($template, $this->template_data, $return);
	}
	
	/*
		Load a partial/view without a template file
	*/
	public function partial($partial, $view_data = array(), $target = 'partial', $return = TRUE)
	{
		$this->set($target, $this->CI->load->view($partial, $view_data, TRUE));

		return $this->CI->load->view($partial, $this->template_data, $return);
	}

	/*
		Set a variable in the view you are about to load
	*/
	public function set($name, $value)
	{
		if( isset($this->template_data[$name] ) ){
			$this->template_data[$name] .= $value;
		} else {
			$this->template_data[$name] = $value;
		}
	}
}

/* End of file template.php */
/* Location: ./system/application/libraries/template.php */
