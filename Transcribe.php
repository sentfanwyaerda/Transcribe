<?php

class Transcribe {
	public function Version($f=FALSE){ return '0.1.4'; }
	public function Product_url($u=FALSE){ return ($u === TRUE ? "https://github.com/sentfanwyaerda/Transcribe" : "http://sent.wyaerda.org/Transcribe/".'?version='.self::Version(TRUE).'&license='.str_replace(' ', '+', self::License()) );}
	public function Product($full=FALSE){ return "Transcribe".($full ? " ".self::version(TRUE) : NULL); }
	public function License($with_link=FALSE){ return ($with_link ? '<a href="'.self::License_url().'">' : NULL).'cc-by-nd 3.0'.($with_link ? '</a>' : NULL); }
	public function License_url(){ return 'http://creativecommons.org/licenses/by-nd/3.0/'; }
	public function Product_base(){ return dirname(__FILE__).DIRECTORY_SEPARATOR; }
	public function Product_file($full=FALSE){ return ($full ? self::Product_base() : NULL).basename(__FILE__); }
	
	
	/*string*/ function build_interface(){
		$globalvars = array(
			'product.name' => self::Product(),
			'product.version' => self::Version(),
		);
		$settingvars = array(
			'player' => self::parse_template('modules/player/video-js.html')
		);
		return self::parse_template('templates/interface.html', array_merge($globalvars, $settingvars));
	}
	private function parse_template($src, $set=array(), $prefix='{', $postfix='}'){
		$str = file_get_contents($src);
		foreach($set as $tag=>$value){
			$str = str_replace($prefix.$tag.$postfix, $value, $str);
		}
		if(preg_match_all("#".self::escape_preg_chars($prefix)."([^\?".self::escape_preg_chars($postfix)."]{0,})\?([^:]+)[:]([^".self::escape_preg_chars($postfix)."]{0,})".self::escape_preg_chars($postfix)."#i", $str, $buffer)){
			//*debug*/ print '<!-- '; print_r($buffer); print ' -->';
			if(isset($buffer[0]) && is_array($buffer[0])){foreach($buffer[0] as $i=>$original){
				$str = str_replace($original, $buffer[(isset($set[$buffer[1][$i]]) && ( is_bool($set[$buffer[1][$i]]) ? $set[$buffer[1][$i]] : TRUE) ? 2 : 3)][$i], $str);
			}}
		}
		if(preg_match_all("#".self::escape_preg_chars($prefix)."([^\|".self::escape_preg_chars($postfix)."]{0,})[\|]([^".self::escape_preg_chars($postfix)."]{0,})".self::escape_preg_chars($postfix)."#i", $str, $buffer)){
			if(isset($buffer[0]) && is_array($buffer[0])){foreach($buffer[0] as $i=>$original){
				$str = str_replace($original, (isset($set[$buffer[1][$i]]) ? $set[$buffer[1][$i]] : $buffer[2][$i]), $str);
			}}
		}
		return $str;
	}
	private function escape_preg_chars($str, $qout=array(), $merge=FALSE){
		if($merge !== FALSE){
			$qout = array_merge(array('\\'), (is_array($qout) ? $qout : array($qout)), array('[',']','(',')','{','}','$','+','^','-'));
			#/*debug*/ print_r($qout);
		}
		if(is_array($qout)){
			$i = 0;
			foreach($qout as $k=>$v){
				if($i == $k){
					$str = str_replace($v, '\\'.$v, $str);
				} else{
					$str = str_replace($k, $v, $str);	
				}
				$i++;
			}
		}
		else{ $str = str_replace($qout, '\\'.$qout, $str); }
		return $str;
	}
}
?>
