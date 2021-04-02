 <?php

function getRicercaWorkPool($userFornitore, $passFornitore, $workpool) {
require 'config/ws.php';
        
		return "Ricerca workpool:122444".$urlErp;
        $client = new SoapClient($urlErp);
        //init context
        $CContext["codeLang"] = $codeLang;
        $CContext["codeUser"] = $codeUser;
        $CContext["password"] = $password;
        $CContext["poolAlias"] = $poolAlias;
        $CContext["requestConfig"] = $requestConfig;
        //name method
        $subprog = $metodo_ricerca_telaio;
        $xmlInput = "<PARAM>
                    <GRP ID=\"GRP1\" >
                        <FLD NAME=\"YUSER\">" . $userFornitore . "</FLD>
                        <FLD NAME=\"YPASS\">" . $passFornitore . "</FLD>
						<FLD NAME=\"YDATSTR\">" . $datainizio . "</FLD>
						<FLD NAME=\"YDATEND\">" . $datafine . "</FLD>
						<FLD NAME=\"YMFGNUM\">" . $ol . "</FLD>
                    </GRP>
                    <TAB ID=\"GRP2\" >
                        <LIN>
                             <FLD NAME=\"YINFOFOR\" ></FLD>
                        </LIN>
                    </TAB>
                 </PARAM>";

        $result = $client->run($CContext, $subprog, $xmlInput);
        

        $xml = simplexml_load_string($result->resultXml);
        $status = (int) $result->status;
        
        return status;
    }