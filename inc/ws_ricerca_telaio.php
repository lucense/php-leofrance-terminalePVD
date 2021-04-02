 <?php

function getRicercaTelaio($userFornitore, $passFornitore, $telaio) {
require 'config/ws.php';
        
		

        $client = new SoapClient($urlErp);
        //init context
        $CContext["codeLang"] = $codeLang;
        $CContext["codeUser"] = $codeUser;
        $CContext["password"] = $password;
        $CContext["poolAlias"] = $poolAlias;
        $CContext["requestConfig"] = $requestConfig;
		//<FLD NAME=\"YUSER\">" . $userFornitore . "</FLD>
        //<FLD NAME=\"YPASS\">" . $passFornitore . "</FLD>
        //name method
        $subprog = $metodo_ricerca_telaio;
        $xmlInput = "<PARAM>
                    <GRP ID=\"GRP1\" >
                     	<FLD NAME=\"YTEL\">" . $telaio . "</FLD>
						<FLD NAME=\"YRES\"></FLD>
					</GRP>
                 </PARAM>";

        $result = $client->run($CContext, $subprog, $xmlInput);
        $xml = simplexml_load_string($result->resultXml);

//              file_put_contents("log.txt",$xmlInput . PHP_EOL, FILE_APPEND);
//              file_put_contents("log.txt",serialize($CContext).PHP_EOL, FILE_APPEND);
//              file_put_contents("log.txt",$subprog. PHP_EOL, FILE_APPEND);
//              file_put_contents("log.txt",serialize($result) . PHP_EOL, FILE_APPEND);
//              file_put_contents("log.txt",$result->resultXml . PHP_EOL, FILE_APPEND);

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
        return $yres;
  
    }
	
	

