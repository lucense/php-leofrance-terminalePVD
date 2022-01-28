 <?php

function getVerificaTelaio($telaio,$macchina) {
		require 'config/ws.php';
		/*
        $client = new SoapClient($urlErp);
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
		
		//<FLD NAME=\"YUSER\">" . $userFornitore . "</FLD>
        //<FLD NAME=\"YPASS\">" . $passFornitore . "</FLD>
        //name method
        $subprog = $metodo_verifica_telaio;
		//$subprog='YGETID2';
        $xmlInput = "<PARAM><GRP ID=\"GRP1\" >
                     	<FLD NAME=\"YTEL\">" . $telaio . "</FLD>
						<FLD NAME=\"YMACHINE\">" . $macchina . "</FLD>						
						<FLD NAME=\"YRES\"></FLD>
					</GRP></PARAM>";
					
		
		//echo "Telaio:".$telaio;
		//echo "<br><br><br><br>---".$metodo_verifica_telaio."<hr>";
		//echo "Macchina:".$macchina;
		//echo "<pre>";
		//print_r($xmlInput);
		//echo "</pre>";


        $result = $client->run($CContext, $subprog, $xmlInput);
		
		
		//echo "subprog:".$subprog;
		//echo "<pre>";
		//print_r($CContext);
		//echo "</pre>";
		
        $xml = simplexml_load_string($result->resultXml);

//              file_put_contents("log.txt",$xmlInput . PHP_EOL, FILE_APPEND);
//              file_put_contents("log.txt",serialize($CContext).PHP_EOL, FILE_APPEND);
//              file_put_contents("log.txt",$subprog. PHP_EOL, FILE_APPEND);
//              file_put_contents("log.txt",serialize($result) . PHP_EOL, FILE_APPEND);
//              file_put_contents("log.txt",$result->resultXml . PHP_EOL, FILE_APPEND);


	//		echo "<pre>";
	//		print_r($result->resultXml);
	//		echo "</pre>";
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
		
		
		/*if ($yres==0)
			$yres="";*/
	
		
		//echo "---".$yres."---";
		
        return $yres;
  
    }
	
	

