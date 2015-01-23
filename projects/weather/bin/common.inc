<?
// function to build where clause from search string
function build_where( $field_name, $keywordstr ) {
	$where = "";
	$words = explode(" ", $keywordstr);
	$cnt = count($words);
	for ($i = 0; $i < $cnt; $i++) {
		$where .= "$field_name LIKE '%$words[$i]%'";
		if ($i < $cnt-1) {$where .= " AND ";}
	}
	return $where;
}

////////////////////////////////////////////////////////////////////////////////////
  function dump_array($var) 
  {
    switch (gettype($var)) {
      case 'integer':
      case 'double':
      case 'string':
        echo $var;
        break;
      case 'array':
        echo '<table border="1">';
        do {
          echo '<tr><td align="left" valign="top">';
          echo key($var);
          echo '</td><td>';
          dump_array($var[key($var)]);
          echo '</td></tr>';
        } while (next($var));
        echo '</table>';
        break;
      default:
        echo 'Unknown data type.';
        break;
    }
  }
  
/////////////////////////////////////////////////////////////////////////////////////

class File_type {
	var $name;
	var $value;
	
	function File_type ( $name ) {
		$this->name = $name;
	}
	
	function value ( $temp ) {
		$this->value = $temp;
	}
	
	function output () {
		return "<INPUT TYPE=file NAME=".$this->name." VALUE=".'"'.$this->value.'"'.">\n";
	}
}
  
/////////////////////////////////////////////////////////////////////////////////////

class Hidden {
	var $name;
	var $value;
	
	function Hidden ( $name ) {
		$this->name = $name;
	}
	
	function value ( $temp ) {
		$this->value = $temp;
	}
	
	function output () {
		return "<INPUT TYPE=hidden NAME=".$this->name." VALUE=".'"'.$this->value.'"'.">\n";
	}
}

/////////////////////////////////////////////////////////////////////////////////////

class Html {
	var $title = "this is the default title";
	var $meta = array();
	var $html_head = array();
	
	
	function html_start () {
		print '<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\"><html>';
		print "<HEAD>\n";
		print "<title>".$this->title."</title>\n";
		print "<LINK REL=\"stylesheet\" HREF=\"/styles/12npc.css\" TYPE=\"text/css\">\n";
		print "</HEAD>\n";
	}
		
	function set_title ( $temp ) {
		$this->title = $temp;
	}
}
	
/////////////////////////////////////////////////////////////////////////////////////////////

class Form {
	var $form_name = "default";
	var $form_action;
	var $form_method = "post";
	
	function Form ( $temp ) {
		$this->form_name = $temp;
	}
	
	function set_action ( $temp ) {
		$this->form_action = $temp;
	}
	
	function form_start () {
		return '<FORM ENCTYPE="multipart/form-data" NAME="'.$this->form_name.'" ACTION="'.$this->form_action.'" METHOD="'.$this->form_method.'">';
	}
	
	function form_end () {
		return "</form>\n";
	}
}

///////////////////////////////////////////////////////////////////////////////////

class Text {
	var $name;
	var $size = 15;
	var $text;
	
	function Text ( $name ) {
		$this->name = $name;
	}
	
	function value ( $temp ) {
		$this->text = $temp;
	}
	
	function width ( $width ) {
		$this->size = $width;
	}
	
	function output ( $temp=" " ) {
		if ($temp != " ") {
			$this->text = $temp;
		}
		return "<INPUT TYPE=text NAME=".$this->name." SIZE=".$this->size." VALUE=".'"'.$this->text.'"'.">\n";
	}
	
}
///////////////////////////////////////////////////////////////////////////////////

class Textarea {
	var $name;
	var $height = 5;
	var $width = 30;
	var $text;
	
	function Textarea ( $name ) {
		$this->name = $name;
	}
	
	function value ( $text ) {
		$this->text = $text;
	}
	
	function height ( $height ) {
		$this->height = $height;
	}
	
	function width ( $width ) {
		$this->width = $width;
	}
	
	function output ( $temp=" " ) {
		if ($temp != " ") {
			$this->text = $temp;
		}
		return "<TEXTAREA NAME=".$this->name." ROWS=".$this->height." COLS=".$this->width.">".$this->text."</TEXTAREA>\n";
	}
}
		

/////////////////////////////////////////////////////////////////////////////////////

class Select {
	var $name;
	var $multiple;
	var $ids = array();
	var $options = array();
	var $id_like = array();
	var $option_like = array();
	var $size = 1;
	
	function Select ( $name ) {
		if (isset($name)) {
			$this->name = $name;
		} else {
			print "you must enter a name for this select box";
			exit;
		}
	}
	
	function id_like ( $temp ) {
		$this->id_like[] = $temp;
	}
	
	function option_like ( $temp ) {
		$this->option_like[] = $temp;
	}
		
	
	function set_size ( $size ) {
		$this->size = $size;
	}
	
	function add ( $id, $option ) {
		$this->ids[] = $id;
		$this->options[] = $option;
	}
	
	function set_multiple ( $choice="" ) {
		$this->multiple = $choice;
	}
	
	function output () {
		//dump_array($this->option_like);
		$temp = "<SELECT $this->multiple name=$this->name[] SIZE=$this->size>\n";
		$cnt = count($this->ids);
		for ($i = 0; $i < $cnt; $i++) {
			//if ($this->selected == "SELECTED" && $i == 0) {
			if ((count($this->id_like)==0) && (count($this->option_like)==0) && $i == 0) {
				$temp .= '<OPTION value="'.$this->ids[$i].'" SELECTED >'.$this->options[$i].'</OPTION>';
			} else {
				
				// if array id_like contains id or array option_like contains option set selected
				if (in_array ($this->options[$i], $this->option_like)) {
					$temp .= '<OPTION value="'.$this->ids[$i].'" SELECTED >'.$this->options[$i].'</OPTION>';
				} else {
					$temp .= '<OPTION value="'.$this->ids[$i].'" >'.$this->options[$i].'</OPTION>';
				}
			}
			
		}
		$temp .= "</SELECT>\n";
		return $temp;
	}
}

///////////////////////////////////////////////////////////////////////////////////////////
		
class Db {
		var $result;
		var $link_id;
		var $error;
		var $num_rows;
		var $select_or_not;
		var $last_id;
		var $debug = 0;
		
		function Db ($base, $host = "default", $user = "default", $pass = "default" ) {
			include("/www/php.inc/mysql_connect.inc");
			mysql_select_db( $base ) or die("db select failed");
		}
		
		function query ( $query ) {
			if ($this->result = mysql_query( $query ) or die("<B>Invalid query: ".mysql_error()."</B><BR>".$query."<BR>")) {
				$query = trim($query);
				if (substr($query,0,6) == "SELECT" ) {
					$this->num_rows = mysql_num_rows ($this->result);
					$this->select_or_not = 1;
				}
				else {
					$this->num_rows = mysql_affected_rows();
					$this->select_or_not = 0;
					$this->last_id = mysql_insert_id();
				}
				if ($this->debug == 1) {
					print $query."<BR><BR>";
				}
				return 1;
			}
			$this->error = mysql_error();
			return 0;
		}
		
		function set_debug( $temp="0" ) {
			$this->debug = $temp;
		}
		
		function get_next () {
			if ($this->select_or_not) {
				$temp = mysql_fetch_array( $this->result );
				if ($this->debug == 1) {
					print_r($temp);
					print "<BR>";
				}
				return $temp;
			}
			$this->error = mysql_error();
			return 0;
		}
		
		function get_num_rows() {
			return $this->num_rows;
		}
		
		function get_last_id() {
			return $this->last_id;
		}
		
		function set_reset() {
			mysql_data_seek($this->result, 0);
		}
		
		function error() {
			echo $error."\n";
		}
	}


 
//////////////////////////////////////////////////////////////////////////////////////////////				

class File {
	var $file;
	
	function File($temp) {
		$this->file = $temp;
		if (!file_exists($temp)) {
			if (!$fp=fopen($temp, "a+")) {
				print "cannot open file!!";
			}
			else {
				fclose($fp);
			}
		}
	}
	
	function get_array() {
		clearstatcache();
		if (is_readable($this->file) && is_file($this->file)) {
			return file($this->file);
		}
		return 0;
	}
	
	function get_contents() {
		clearstatcache();
		if (is_readable($this->file)) {
			$temp = $this->get_array();
			$cnt = sizeof($temp);
			for ($i=0; $i < $cnt; $i++) {
				$contents .= $temp[$i];
			}
			return $contents;
		}
		return 0;
	}
	
	function get_lines() {
		$temp = $this->get_array();
		if ($temp != 0) {
			return sizeof($temp);
		}
		return 0;
	}
	

	
	function get_basename() {
		return basename($this->file);
	}
	
	function get_dirname() {
		return dirname($this->file);
	}
	
	function get_size() {
		clearstatcache();
		return filesize($this->file);
	}
	
	function get_mtime() {
		return filemtime($this->file);
	}
	
	function do_copy($to) {
		clearstatcache();
		if (!copy($this->file, $to)) {
                	return 0;
                }
		return 1;
	}
	
	function do_chgrp($group) {
		return chgrp($this->file, $group);
	}
	
	function do_chmod($mod) {
		return chmod($this->file, $mod);
	}
	
	function do_chown($own) {
		return chown($this->file, $own);
	}
	
	function do_append($string) {
		clearstatcache();
		if (is_writeable($this->file) && is_file($this->file)) {
			$fp = fopen($this->file, "a+");
			fputs($fp, $string);
			fclose($fp);
			return 1;
		}
		return 0;
	}
	
	function do_dump() {
		clearstatcache();
		if (is_readable($this->file) && is_file($this->file)) {
			readfile($this->file);
			return 1;
		}
		return 0;
	}
	
	function do_truncate() {
		clearstatcache();
		if (is_writeable($this->file) && is_file($this->file)) {
			$fp = fopen($this->file, "w");
			fclose($fp);
			return 1;
		}
		return 0;
	}
	
	function do_rename($new) {
		if (rename($this->file, $new)) {
			$this->file = $new;
			return 1;
		}
		return 0;
	}

	function do_delete() {
		if (unlink($this->file)) {
			return 1;
		}
		return 0;
	}
	
	function dir_is() {
		clearstatcache();
		return is_dir($this->file);
	}
	
	function file_is() {
		clearstatcache();
		return is_file($this->file);
	}
	
	function link_is() {
		clearstatcache();
		return is_link($this->file);
	}
	
	function executable_is() {
		clearstatcache();
		return is_executable($this->file);
	}
	
	function readable_is() {
		clearstatcache();
		return is_readable($this->file);
	}
	
	function writeable_is() {
		clearstatcache();
		return is_writeable($this->file);
	}

}
/////////////////////////////////////////////////////////////////////////////////////////
class html_table {
	var $cols = 0;
	var $rows = 0;
	var $cell = array();
	var $html = '';
	var $cell_content = '&nbsp;'; //default cell content.
	var $content_style = ''; //default content style. content is surrounded by <SPAN> tag.
  
	var $col_style = array(); // default style for table column. enclosed in <TD> tags.
  var $col_cell_style = array(); // default style for column cells. enclosed in <SPAN> tags.
  
	var $cell_style = ''; //  default cell style. enclosed in <TD> tags.
  var $table_style = ''; // default table style. enclosed in <TABLE> tags.
  
function cell_init() {
	return array(
		'content'   => $this->cell_content,	
		'style'     => '',	
		'cell_style'=> '');
}

	
function init($parameters) {
	if (isset($parameters['cols'])) $this->cols = $parameters['cols'];
	if (isset($parameters['rows']))$this->rows = $parameters['rows'];
	for ($row = 1; $row <= $this->rows; $row++) {
		for ($col = 1; $col <= $this->cols; $col++) {
			$this->cell[$row][$col] = $this->cell_init();
		}
	}
}

function add_rows($num_rows) {
	for ($row = 1; $row <= $num_rows; $row++) {
		for ($col = 1; $col <= $this->cols; $col++) {
			$this->cell[$row + $this->rows][$col] = $this->cell_init();
		}
	}
	$this->rows += $num_rows;
}

function add_cols($num_cols) {
	for ($row = 1; $row <= $this->rows; $row++) {
		for ($col = 1; $col <= $num_cols; $col++) {
			$this->cell[$row][$col+$this->cols] = $this->cell_init();
		}
	}
	$this->cols += $num_cols;
}

function code() {
	if (!empty($this->html)) return 1;
	$this->html = '<TABLE '.$this->table_style.'>'."\n";
	for ($row = 1; $row <= $this->rows; $row++) {
		$this->html .= '  <TR>'."\n";
		for ($col = 1; $col <= $this->cols; $col++) {
			$extra = '';
			//check if "colspan" defined. if so then hide cells that get merged.
			if (isset($this->cell[$row][$col]['colspan'])) {
				$extra .= 'COLSPAN="'.$this->cell[$row][$col]['colspan'].'"';
				for ($hidden_col = 1; $hidden_col < $this->cell[$row][$col]['colspan']; $hidden_col++) {
					$this->cell[$row][$col+$hidden_col]["hide"] = true;
					//check if "rowspan" defined. if so then propogate "colspan" into merged rows.
					if (isset($this->cell[$row][$col]["rowspan"])) {
						for ($hidden_row = 1; $hidden_row < $this->cell[$row][$col]['rowspan']; $hidden_row++) {
							$this->cell[$row+$hidden_row][$col]["colspan"] = $this->cell[$row][$col]['colspan'];
						}
					}					
				}
			}
			//check if "rowspan" defined. if so then hide cells that get merged.
			if (isset($this->cell[$row][$col]["rowspan"])) {
				$extra .= 'ROWSPAN="'.$this->cell[$row][$col]['rowspan'].'"';
				for ($hidden_row = 1; $hidden_row < $this->cell[$row][$col]['rowspan']; $hidden_row++) {
					$this->cell[$row+$hidden_row][$col]["hide"] = true;
				}
			}
			// code to draw cell html...
			if (isset($this->cell[$row][$col]['hide'])) continue; // if hide then skip this cell.
			
			// otherwise draw cell with style...
			if (!empty($this->cell[$row][$col]['cell_style'])) 
				$this->html .= '    <TD '.$this->cell[$row][$col]['cell_style'].' '.$extra.'>';
      else if (!empty($this->col_style[$col]))  
        $this->html .= '    <TD '.$this->col_style[$col].' '.$extra.'>';
			else 
				$this->html .= '    <TD '.$this->cell_style.' '.$extra.'>';
				
			// draw content of cell with style...
			if (!empty($this->cell[$row][$col]['style'])) $this->html .= '<SPAN '.$this->cell[$row][$col]['style'].'>';
      else if (!empty($this->col_cell_style[$col])) $this->html .= '<SPAN '.$this->col_cell_style[$col].'>';
			else if (!empty($this->content_style)) $this->html .= '<SPAN '.$this->content_style.'>';
			
			$this->html .= $this->cell[$row][$col]['content'];
			
			if (!empty($this->cell[$row][$col]['style']) or !empty($this->col_cell_style[$col]) or !empty($this->content_style))
        $this->html .= '</SPAN>';
			
			$this->html .= '</TD>'."\n";
			
		}
		$this->html .= '  </TR>'."\n";
	}
	$this->html .= '</TABLE>'."\n";
}

function display() {
  if (empty($this->html)) $this->code();
	print $this->html;
}

function return_code() {
  if (empty($this->html)) $this->code();
	return $this->html;
}

} // end of class html_table.

///////////////////////////////////////////////////////////////////////////////////////

?>
