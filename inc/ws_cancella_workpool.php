 <?php

function getCancellaWorkPool($userFornitore, $passFornitore, $workpool) {
		require 'config/ws.php';
        //return "Cancella workpool:".$workpool;
        /*$client = new SoapClient($urlErp);
        //init context
        $CContext["codeLang"] = $codeLang;
        $CContext["codeUser"] = $codeUser;
        $CContext["password"] = $password;
        $CContext["poolAlias"] = $poolAlias;
        $CContext["requestConfig"] = $requestConfig;*/
		//SAGE 11
		$optionsAuth = Array ('login' => $codeUser,'password' => $password);
		$client = new SoapClient($urlErp,$optionsAuth);
        //init context
        $CContext["codeLang"] = $codeLang;
        $CContext["poolAlias"] = $poolAlias;
        $CContext["requestConfig"] = $requestConfig;
		
        //name method
        $subprog = $metodo_cancella_workpool;
        $xmlInput = "<PARAM>
                    <GRP ID=\"GRP1\" >
						
							<FLD NAME=\"YWRK\">" . $workpool . "</FLD>
							<FLD NAME=\"YRES\" >0</FLD>
                        
                    </GRP>
					</PARAM>";
        $result = $client->run($CContext, $subprog, $xmlInput);
        




        $xml = simplexml_load_string($result->resultXml);
         $stato = 0;
        foreach ($xml->GRP as $lin) {
            foreach ($lin->FLD as $name) {
                switch ((string) $name['NAME']) {
                    case 'YRES' :

                        $yres =trim($name);
                        break;
                }
            }
        }
		
		if ($yres==0)
			$stato="Cancellato";
		else
			$stato="Non Cancellato";
        return $stato;
    }