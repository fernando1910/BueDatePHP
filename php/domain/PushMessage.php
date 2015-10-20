<?php

	require_once 'vendor/autoload.php';
	use Endroid\Gcm\Client;
		
	class PushMessage{
		
	
		function enviarNotificacao($title,$message, $registrationIds, $tipoNotificacao){
			$apiKey = 'AIzaSyA6zRqDYctHHthxLbJVpKOrnuZj5VNUlgk';
			$client = new Client($apiKey);
			
			
			$data = array(
				'title' => $title,
				'message' => $message,
			);
			
			$options = array(
                    'collapse_key'=>  $tipoNotificacao,
                    'delay_while_idle'=>false,
                    'time_to_live'=>(4 * 7 * 24 * 60 * 60),
                    'dry_run'=>false
                );
			
			$client->send($data, $registrationIds, $options);		
			$responses = $client->getResponses();
			
			foreach( $responses as $response ){
                    $response = json_decode( $response->getContent() );

                    // VERIFICA SE HÁ ALGUM CANONICAL_ID, QUE INDICA QUE AO MENOS UM REGISTRATION_ID DEVE SER ATUALIZADO
                    if( $response->canonical_ids > 0 || $response->failure > 0 ){

                        // PERCORRE TODOS OS RESULTADOS VERIFICANDO SE HÁ UM REGISTRATION_ID PARA SER ALTERADO
                        for( $i = 0, $tamI = count( $response->results ); $i < $tamI; $i++ ){

                            if( !empty( $response->results[$i]->canonical_id ) ){

                                // SE HÁ UM NOVO REGISTRATION_ID, ENTÃO ALTERANO BD

                            }
                            else if( strcasecmp( $response->results[$i]->error, "NotRegistered" ) == 0 ){

                                // DELETE REGISTRO DO BD
                                //CgdUser::deleteUser( $userArray[$i] );
                            }
                        }
                    }
                }
			
		}
	
	}
	
?>