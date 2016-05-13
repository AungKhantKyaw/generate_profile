<?php
class Directoryinfo {

	public function readDirectory($Directory,$Recursive = true,$level=0)
	{
		if(is_dir($Directory) === false)
		{
			return false;
		}
		$level++;
		try
		{
			$Resource = opendir($Directory);
			$Found = array();
			
			while(false !== ($Item = readdir($Resource)))
			{
				if($Item == "." || $Item == ".." || $Item == ".DS_Store")
				{
					continue;
				}
				if($Recursive === true && is_dir($Directory . $Item))
				{
					$Directoryname  = $Directory . $Item .'/';
					if($level == 2 && $Item != "controllers")
					{ 
						continue;
					}
					if($Item == 'controllers')
					{
						$Found = $this->readDirectory($Directoryname,true,$level);
					}
					else
					$Found[$Item] = $this->readDirectory($Directoryname,true,$level);
				}else
				{
					$filename = $Directory . $Item;
					$ext = pathinfo($filename, PATHINFO_EXTENSION);
					if($ext == "php")
					{
						$classname = ucfirst(str_replace('.php','',$Item));
						require_once($filename);
						$reflector = new ReflectionClass($classname);
						$methodNames = array();
						$lowerClassName = strtolower($classname);
						if ($lowerClassName!='login' && $lowerClassName!='logout' && $lowerClassName!='error_403'&& $lowerClassName!='dashboard'&& $lowerClassName!='settings') {
							foreach ($reflector->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
								if (strtolower($method->class) == $lowerClassName) {
									//echo $method->name . '<br/>';

									if($method->name != "__construct" && $method->name != "get_instance")
									{
										if($method->name != "__get")
										{
											$result = explode('_', $method->name);
											if($result[0] != 'aj' && $result[0] != 'check' && $result[0] != 'get'){
												$methodNames[$method->name] = $method->name;
											}
										}
									}

								}
							}
							$Found[$classname] =  $methodNames;
						}
						
					}
				}
			}
		}catch(Exception $e)
		{
			return false;
		}
	//pre($Found,true);
		return $Found;
	}	
}
?>