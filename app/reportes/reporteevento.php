<?php 
	
	//Librerias 
	include_once '../../api/config/database.php';
	require_once('../../lib/pdf/mpdf.php');
	
	//Capturar el id del evento 
	$eventoid = isset($_GET['eventoid']) ? $_GET['eventoid'] : $eventoid=0;
	$tipo_encuesta = isset($_GET['tipo_encuesta']) ? $_GET['tipo_encuesta'] : $tipo_encuesta= 0; 
	$fecha_inicial = isset($_GET['fecha_inicial']) ? $_GET['fecha_inicial'] : $fecha_inicial= ""; 
	$fecha_final = isset($_GET['fecha_final']) ? $_GET['fecha_final'] : $fecha_final= ""; 
    $flag = "";
	
	if(($fecha_inicial == "undefined") || (strlen($fecha_inicial) == 0)){
		$flag = "evento";
	}else{
		$flag = "fecha";
	}
	
	if($flag == "fecha"){
		$eventoid=0;
		if($fecha_final == "undefined"){
			$fecha_final="2999-12-31";
		}
	}
	
	//Encuesta parcial 
	if ($tipo_encuesta == 1){

		//Gestionar conexion base de datos 
		$database = new Database();
		$db = $database->getConnection();
		
				$query_eventos = "";
				if($fecha_inicial != "undefined"){
					$query_eventos = "SELECT E.ID FROM EVENTO E WHERE E.FECHA_INICIO >= '" . $fecha_inicial . "' AND E.FECHA_FINAL <= '" . $fecha_final . "'";
				}	

				$query = "SELECT PREGUNTA_ID AS preguntaId , R.RESP3 AS respuesta , COUNT(1) AS cantidad , P.NOMBRE_PREG AS pregunta
					FROM `RESPUESTAS` R INNER JOIN PREGUNTA P
					     ON R.PREGUNTA_ID = P.ID
					WHERE R.EVENTO_ID";
					
				if($eventoid==0){
					$query = $query . " IN (" . $query_eventos . ") ";
				}else{
					$query = $query . "=" . $eventoid;
				}	
				
				$query = $query . " AND 
					      R.RESP3 IN (1,2) 
					      AND
					       R.PREGUNTA_ID IN (1,2,3,4,5)

				  GROUP BY R.PREGUNTA_ID, 
		                   R.RESP3, 
						   P.NOMBRE_PREG
                  ORDER BY 1,2";	

		$stmt = $db->prepare($query);

		//$stmt->bindParam(':eventoId', $eventoid);

		$stmt->execute();
		
		$num = $stmt->rowCount();
		
				
		$html = $html . '<div>
				<H1>BUSINESS MIND </H1>
				<H2>REPORTE ENCUESTA PARCIAL </H2>';
		
		if($eventoid==0){
			$html = $html . '<H3>Eventos desde '. $fecha_inicial . ' hasta ' . $fecha_final . '</H3>';
		}else{
			$html = $html . '<H3>Evento/OPP No.'. $eventoid.'</H3>';
		}			
				
			if($num>0){
             
			$html = $html . '<table border="1">
					<thead>
						<tr>
							<th>Pregunta</th>
							<th>Respuesta</th>
							<th>Total</th>
						</tr>
					</thead>
					<tbody>';
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				extract($row);
				$rtaTexto = ($respuesta==1)? 'SI' : 'NO';
					
					$html = $html . '<tr>
							<td>'.
								$preguntaId.' '.$pregunta
							. '</td>
							<td>' .
								$rtaTexto
							. '</td>
							<td>' .
								$cantidad
							. '</td>
						</tr>';

				}
				
				$html = $html . '</tbody>
				</table>';

			}

			$html = $html . '</div>
			<div> 
				<H3>Observaciones</H3>';				
			
			$query_observaciones = "SELECT R.PREGUNTA_ID AS preguntaid, 
					P.NOMBRE_PREG AS pregunta, GROUP_CONCAT(R.RESP2 ORDER BY R.RESP2 ASC SEPARATOR '|') AS comentarios 
					FROM respuestas R INNER JOIN PREGUNTA P 
							ON R.PREGUNTA_ID = P.ID
					WHERE EVENTO_ID";

			if($eventoid==0){
				$query_observaciones = $query_observaciones . " IN (" . $query_eventos . ") ";
			}else{
				$query_observaciones = $query_observaciones . "=" . $eventoid;
			}	

			$query_observaciones = $query_observaciones . " AND	R.RESP3 = 2
					GROUP BY  P.NOMBRE_PREG, 
					R.PREGUNTA_ID
				ORDER BY 1";
				
			$stmt_observaciones = $db->prepare($query_observaciones);
			
			//$stmt_observaciones->bindParam(':eventoId', $eventoid);

			//$stmt->bindParam(':PREGUNTA_ID', $tipo_Ecuesta);
			
			$stmt_observaciones->execute();
			
			$num_observaciones = $stmt_observaciones->rowCount();
			
			if($num_observaciones>0){
				while ($row_observaciones = $stmt_observaciones->fetch(PDO::FETCH_ASSOC)){
					extract($row_observaciones);
					$comentarios_array = explode("|", $comentarios);
					$html = $html . '<b>'. $preguntaid .' '.$pregunta .'</b> <br>
							<ul> ';

					foreach ($comentarios_array as $item) {
						
						$html = $html . '<li>' . $item .' </li>';
						
					}
					
					$html = $html.'</ul>';
                    
				}
			}
			
			$html = $html . '</div>';	

	}else if ($tipo_encuesta == 2){     //Encuesta final 

		$database = new Database();
		$db = $database->getConnection();
		
		$query_eventos = "";
		if($fecha_inicial != "undefined"){
			$query_eventos = "SELECT E.ID FROM EVENTO E WHERE E.FECHA_INICIO >= '" . $fecha_inicial . "' AND E.FECHA_FINAL <= '" . $fecha_final . "'";
		}

		$query = "SELECT PREGUNTA_ID AS preguntaId, R.RESP1 AS respuesta, COUNT(1) AS cantidad, P.NOMBRE_PREG AS pregunta
					FROM `RESPUESTAS` R INNER JOIN PREGUNTA P
					     ON R.PREGUNTA_ID = P.ID
					WHERE R.EVENTO_ID";

				if($eventoid==0){
					$query = $query . " IN (" . $query_eventos . ") ";
				}else{
					$query = $query . "=" . $eventoid;
				}	

				$query = $query . " AND 
					      R.RESP1 IN (1,2,3,4,5) 
					      AND
					      R.PREGUNTA_ID IN (6,7,8,9,10,11,12,13,14,15,16,17,18)

				  GROUP BY R.PREGUNTA_ID, 
		                   R.RESP1, 
						   P.NOMBRE_PREG
                  ORDER BY 1,2";					
		
		$stmt = $db->prepare($query);

		$stmt->bindParam(':eventoId', $eventoid);
		


		$stmt->execute();
		
		$num = $stmt->rowCount();
		
				
			$html = '<div>
				<H1>BUSINESS MIND </H1>
				<H2>REPORTE ENCUESTA FINAL </H2>';

		if($eventoid==0){
			$html = $html . '<H3>Eventos desde '. $fecha_inicial . ' hasta ' . $fecha_final . '</H3>';
		}else{
			$html = $html . '<H3>Evento/OPP No.'. $eventoid.'</H3>';
		}
		
		if($num>0){
             
			$html = $html . '<table border="1">
					<thead>
						<tr>
							<th>Pregunta</th>
							<th>Respuesta</th>
							<th>Total</th>
						</tr>
					</thead>
					<tbody>';
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				extract($row);
				$rtaTexto = '';
				if($respuesta==1){
					$rtaTexto = 'Totalmente en Desacuerdo';
				}else if($respuesta==2){
					$rtaTexto = 'Desacuerdo';
				}else if($respuesta==3){
					$rtaTexto = 'Indeciso';
				}else if($respuesta==4){
					$rtaTexto = 'De Acuerdo';
				}else if($respuesta==5){
					$rtaTexto = 'Totalmente de Acuerdo';
				}	
					
					$html = $html . '<tr>
							<td>'.
								$preguntaId.' '.$pregunta
							. '</td>
							<td>' .
								$rtaTexto
							. '</td>
							<td>' .
								$cantidad
							. '</td>
						</tr>';

				}
				
				$html = $html . '</tbody>
				</table>';

			}

			$html = $html . '</div>
			<div> 
				<H3>Observaciones</H3>';				
			
			$query_observaciones = "SELECT R.PREGUNTA_ID AS preguntaid, 
					P.NOMBRE_PREG AS pregunta, GROUP_CONCAT(R.RESP2 ORDER BY R.RESP2 ASC SEPARATOR '|') AS comentarios 
					FROM respuestas R INNER JOIN PREGUNTA P 
							ON R.PREGUNTA_ID = P.ID
					WHERE EVENTO_ID";

			if($eventoid==0){
				$query_observaciones = $query_observaciones . " IN (" . $query_eventos . ") ";
			}else{
				$query_observaciones = $query_observaciones . "=" . $eventoid;
			}

			$query_observaciones = $query_observaciones . " AND 
					R.RESP1 IN (1,2,3,4,5) AND 
					R.PREGUNTA_ID IN (6,9,11,14,17,18,19)
					GROUP BY  P.NOMBRE_PREG, 
					R.PREGUNTA_ID
				ORDER BY 1";
				
			$stmt_observaciones = $db->prepare($query_observaciones);
			
			$stmt_observaciones->bindParam(':eventoId', $eventoid);

			$stmt->bindParam(':PREGUNTA_ID', $tipo_Ecuesta);
			
			$stmt_observaciones->execute();
			
			$num_observaciones = $stmt_observaciones->rowCount();
			
			if($num_observaciones>0){
				while ($row_observaciones = $stmt_observaciones->fetch(PDO::FETCH_ASSOC)){
					extract($row_observaciones);
					$comentarios_array = explode("|", $comentarios);
					
					$preguntaTexto = '';
					if($preguntaid==6){
						$preguntaTexto = 'Instructor';
					}else if($preguntaid==9){
						$preguntaTexto = 'Centro Educativo';
					}else if($preguntaid==11){
						$preguntaTexto = 'Ambiente Tecnico (Equipo Soporte Tecnico)';
					}else if($preguntaid==14){
						$preguntaTexto = 'Atencion y Servicio al Cliente(Cordinadora de Capacitacion)';
					}else if($preguntaid==17){
						$preguntaTexto = 'Refrigeraciones';
					}else if($preguntaid==18){
						$preguntaTexto = 'General';
					}else if($preguntaid==19){
						$preguntaTexto = 'General';
					}
					
					$html = $html . '<b>'. $preguntaTexto .'</b> <br>
							<ul> ';

					foreach ($comentarios_array as $item) {
						
						$html = $html . '<li>' . $item .' </li>';
						
					}
					
					$html = $html.'</ul>';
                    
				}
			}
			
			$html = $html . '</div>';


	} 

	$mpdf = new mPDF('c', 'LETTER'); 
    $mpdf->writeHTML($html);
    $mpdf->Output('reporte.pdf','I');
	
	
?>