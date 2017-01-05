<?php
function id_clean($id,$size=11){
	return intval(substr($id,0,$size));
}

function db_clean($string,$size=255){
	return xss_clean(substr($string,0,$size));
}
function dohash($str, $type = 'sha1')
{
	
	if ($type == 'sha1')
	{
		if ( ! function_exists('sha1'))
		{
			if ( ! function_exists('mhash'))
			{
				require_once(BASEPATH.'libraries/Sha1'.EXT);
				$SH = new CI_SHA;
				return $SH->generate($str);
			}
			else
			{
				return bin2hex(mhash(MHASH_SHA1, $str));
			}
		}
		else
		{
			return sha1($str);
		}
	}
	else
	{
		return md5($str);
	}
}
?>