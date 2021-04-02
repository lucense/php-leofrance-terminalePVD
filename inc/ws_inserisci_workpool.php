 <?php
function getInserisciWorkPool($userFornitore, $passFornitore,$reparto,$macchina,$programma,$telai) {
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
	//<FLD NAME=\"YUSER\">" . $userFornitore . "</FLD>
        //<FLD NAME=\"YPASS\">" . $passFornitore . "</FLD>
        $subprog = $metodo_inserisci_workpool;
        $xmlInput = "<PARAM>
                    <GRP ID=\"GRP1\" >                    
				<FLD NAME=\"YREP\">" . $reparto . "</FLD>
				<FLD NAME=\"YMACH\">" . $macchina . "</FLD>
				<FLD NAME=\"YPRG\">" . $programma . "</FLD>
                    </GRP>
		    <TAB ID=\"GRP2\" >
				".$telai." 
		    </TAB>
		    <GRP ID=\"GRP3\" >
	                   	 <FLD NAME=\"YRES\"></FLD>
		    </GRP>
                 </PARAM>";

        $result = $client->run($CContext, $subprog, $xmlInput);     
		/*
		file_put_contents("log.txt",$xmlInput . PHP_EOL, FILE_APPEND);
		file_put_contents("log.txt",serialize($CContext).PHP_EOL, FILE_APPEND);
		file_put_contents("log.txt",$subprog. PHP_EOL, FILE_APPEND);
		file_put_contents("log.txt",serialize($result) . PHP_EOL, FILE_APPEND);
		file_put_contents("log.txt",$result->resultXml . PHP_EOL, FILE_APPEND);
		*/

        $xml = simplexml_load_string($result->resultXml);
        $stato = 0;
        foreach ($xml->GRP as $lin) {
            foreach ($lin->FLD as $name) {
                switch ((string) $name['NAME']) {
                    case 'YRES' :

                        $yres = $name;
                        break;
                }
            }
        }

	file_put_contents("log.txt","return:".$yres. PHP_EOL, FILE_APPEND);

        return $yres;
    }
