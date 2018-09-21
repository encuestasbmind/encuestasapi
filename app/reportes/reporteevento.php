<?php 
	
	//Librerias 
	include_once '../../api/config/database.php';
	require_once('../../lib/pdf/mpdf.php');
	
	//Capturar el id del evento 
	$eventoid = isset($_GET['eventoid']) ? $_GET['eventoid'] : $eventoid=0;
	$tipo_encuesta = isset($_GET['tipo_encuesta']) ? $_GET['tipo_encuesta'] : $tipo_encuesta= 0; 


		$html = $html . '<div>Reporte Encuesta Final</div>';
if ($tipo_encuesta == 1){

		//Gestionar conexion base de datos 
		$database = new Database();
		$db = $database->getConnection();

				$query = "SELECT PREGUNTA_ID AS preguntaId , R.RESP3 AS respuesta , COUNT(1) AS cantidad , P. AS pregunta
					FROM `RESPUESTAS` R INNER JOIN PREGUNTA P
					     ON R.PREGUNTA_ID = P.ID
					WHERE R.EVENTO_ID = :eventoId AND 
					      R.RESP3 IN (1,2) 
					      AND
					       R.PREGUNTA_ID IN (1,2,3,4,5)

				  GROUP BY R.PREGUNTA_ID, 
		                   R.RESP3, 
						   P.NOMBRE_PREG
                  ORDER BY 1,2";	

			

               $query = "SELECT PREGUNTA_ID AS preguntaId, R.RESP3 AS respuesta, COUNT(1) AS cantidad, P. AS pregunta
					FROM `RESPUESTAS` R INNER JOIN PREGUNTA P
					     ON R.PREGUNTA_ID = P.ID
					WHERE R.EVENTO_ID = :eventoId AND 
					      R.RESP3 IN (1,2) 
					      AND
					      R.PREGUNTA_ID IN (6,7,8,9,10)

				  GROUP BY R.PREGUNTA_ID, 
		                   R.RESP3, 
						   P.NOMBRE_PREG
                  ORDER BY 1,2";					
		
		$stmt = $db->prepare($query);

		$stmt->bindParam(':eventoId', $eventoid);

		$stmt->execute();
		
		$num = $stmt->rowCount();
		
				
			$html = '<div>
				<H1>BUSINESS MIND </H1>
				<H2>REPORTE DE EVENTOS </H2>
				<H3>Evento/OPP No.'. $eventoid.'</H3>
				<H3>Reporte Encuesta Parcial. ' . $tipo_encuesta . '</H3>';
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
					WHERE EVENTO_ID = :eventoId AND 
					R.RESP3 = 2
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
					$html = $html . '<b>'. $preguntaid .' '.$pregunta .'</b> <br>
							<ul> ';

					foreach ($comentarios_array as $item) {
						
						$html = $html . '<li>' . $item .' </li>';
						
					}
					
					$html = $html.'</ul>';
                    
				}
			}
			
			$html = $html . '</div>';	

	}
	else if ($tipo_encuesta == 2){

$database = new Database();
		$db = $database->getConnection();

$query = "SELECT PREGUNTA_ID AS preguntaId, R.RESP3 AS respuesta, COUNT(1) AS cantidad, P. AS pregunta
					FROM `RESPUESTAS` R INNER JOIN PREGUNTA P
					     ON R.PREGUNTA_ID = P.ID
					WHERE R.EVENTO_ID = :eventoId AND 
					      R.RESP3 IN (1,2) 
					      AND
					      R.PREGUNTA_ID IN (6,7,8,9,10)

				  GROUP BY R.PREGUNTA_ID, 
		                   R.RESP3, 
						   P.NOMBRE_PREG
                  ORDER BY 1,2";					
		
		$stmt = $db->prepare($query);

		$stmt->bindParam(':eventoId', $eventoid);
		


		$stmt->execute();
		
		$num = $stmt->rowCount();
		
				
			$html = '<div>
				<H1>BUSINESS MIND </H1>
				<H2>REPORTE DE EVENTOS </H2>
				<H3>Evento/OPP No. ' . $eventoid . '</H3>
				<H3>Reporte Encuesta Final. ' . $tipo_encuesta . '</H3>';
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
					WHERE EVENTO_ID = :eventoId AND 
					R.RESP3 = 2
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
					$html = $html . '<b>'. $preguntaid .' '.$pregunta .'</b> <br>
							<ul> ';

					foreach ($comentarios_array as $item) {
						
						$html = $html . '<li>' . $item .' </li>';
						
					}
					
					$html = $html.'</ul>';
                    
				}
			}
			
			$html = $html . '</div>';


	} 

	echo $html;
	
	
?>