 <?php

function getListaReparti($userFornitore, $passFornitore) {
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
        $subprog = $metodo_lista_reparti;
        $xmlInput = '<PARAM>
         <TAB ID="GRP1" >
             <LIN>
                     <FLD NAME="YRES" ></FLD>
             </LIN>
      </TAB>
		</PARAM>';

        

        $result = $client->run($CContext, $subprog, $xmlInput);
        
		//echo "<pre>";
		//print_r($result);
		//echo "</pre>";

        $xml = simplexml_load_string($result->resultXml);
		 foreach ($xml->TAB as $lin) {
			
            foreach ($lin as $name) {
			
			 $tmp=explode(";",$name->FLD);
			 
			 $reparto=$tmp[0];
			 $macchina=$tmp[1];
			 $id_programma=$tmp[2];
			 $descrizione_programma=$tmp[3];
			 if ($descrizione_programma!="")
				$array[$reparto][$macchina][$id_programma]= $id_programma."#".$descrizione_programma;
             
            }
        }
	

	return json_encode($array);
		
	
    }