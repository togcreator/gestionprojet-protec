<?php

namespace AppBundle\Entity\Classes;

/* final */ class Utils 
{
	// to extract array
	public static function Array_extract( $array, $key, $none = true ) 
	{
		$_array = $none ? ['global.none' => 0] : [];
		if( is_array($array) && count($array) )
            foreach( $array as $value ) {
                if( is_array($key['key']) ) {
                    $id = [];
                    foreach($key['key'] as $val) 
                        if( method_exists($value, $val) )
                            $id[] = $value->{$val}();
                    $_array[ implode(' ', $id) ] = $value->{$key['value']}();
                }else {
                    if( method_exists($value, $key['key']) )
                        $_array[ $value->{$key['key']}() ] = $value->{$key['value']}();
                }
            }
        return $_array;
	}

	// to updload file
	public static function Upload_file ($file, $dir)
	{
		if( !is_object($file) ) return null;
        // file name
        $fileName = $file->getClientOriginalName();
        // move file
        $file->move($dir, $fileName);
        // return filename
        return $fileName;
	}

	// pour code
    public static function setCode( $class ) 
    {
        /* si exite, on passe */
        if( ($code = $class->getCode()) && strlen($code) >= 20 ) return;

        /* sinon on crée un nouveau */
        $random = function ($car) {
            $string = '';
            $chaine = 'abcdefghijklmnpqrstuvwxy0123456789';
            /* décalage de plage de temps du cpu */
            srand( (double)microtime()*1000000 );
            /* itération de chiffre et de lettre */
            for($i=0; $i<$car; $i++)
                $string .= $chaine[rand()%strlen($chaine)];
            return $string;
        };

        $class->setCode( $random(20) );
    }
}