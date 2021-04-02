 <?php

function getListaWorkPool() {
		require 'config/ws.php';
		/*		
        $client = new SoapClient($urlErp);
        //init context
        $CContext["codeLang"] = $codeLang;
        $CContext["codeUser"] = $codeUser;
        $CContext["password"] = $password;
        $CContext["poolAlias"] = $poolAlias;
        $CContext["requestConfig"] = $requestConfig;
		*/
		//SAGE 11
		$optionsAuth = Array ('login' => $codeUser,'password' => $password);
		$client = new SoapClient($urlErp,$optionsAuth);
        //init context
        $CContext["codeLang"] = $codeLang;
        $CContext["poolAlias"] = $poolAlias;
        $CContext["requestConfig"] = $requestConfig;
		
        //name method
        $subprog = $metodo_lista_workpool;
        $xmlInput = '<PARAM>
         <TAB ID="GRP1" >
             <LIN>
                     <FLD NAME="YRES" ></FLD>
             </LIN>
      </TAB>
		</PARAM>';

        

        $result = $client->run($CContext, $subprog, $xmlInput);
       
	   
	  
	   
        $xml = simplexml_load_string($result->resultXml);
		 foreach ($xml->TAB as $lin) {
			
            foreach ($lin as $name) {
			 if ($name->FLD!=""){
				$tmp=explode(";",$name->FLD);
				$workpool=$tmp[0];
				$reparto=$tmp[1];
				$macchina=$tmp[2];
				$array[$workpool]=$workpool."#".$reparto."#".$macchina;
             }
            }
        }
	
	return $array;
		
	
    }