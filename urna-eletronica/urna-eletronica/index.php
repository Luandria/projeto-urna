<!DOCTYPE html>
<?php
	if(isset($_GET['nTitEleitor']) && isset($_GET['nNum'])){
		$_dados = filter_input_array(INPUT_GET);

		if ((isset($_GET['nNum'])) && ($_GET['nNum'] != 13) && ($_GET['nNum'] != 22)) {
			$_dados['nNum'] = "00";
		}
		
		$id = array(
			'00' => 1,
			'13' => 2,
			'22' => 3
		);
		$nTitEleitor = $_dados['nTitEleitor'];
		$nNum = $id[$_dados['nNum']];

		file_get_contents("http://localhost/urna-eletronica/urna-eletronica-api/src/setVotos.php?nTitEleitor=$nTitEleitor&nNum=$nNum");

		$numTotalVotos = file_get_contents('http://localhost/urna-eletronica/urna-eletronica-api/src/getNumVotos.php'); 
		$numBolsonaro = file_get_contents('http://localhost/urna-eletronica/urna-eletronica-api/src/getBolsonaro.php');
		$numLula  = file_get_contents('http://localhost/urna-eletronica/urna-eletronica-api/src/getLula.php'); 
		$numBranco =  file_get_contents('http://localhost/urna-eletronica/urna-eletronica-api/src/getBranco.php');
		echo "Branco: ".$numBranco."<br/>";
		echo "Bolsonaro: ".$numBolsonaro."<br/>";
		echo "Lula: ".$numLula."<br/><br/>";
		echo "TOTAL: ".$numTotalVotos."<br/><br/>";
	}
?>
<html lang="pt-BR">
	<head>
		<meta charset="utf-8"/>
		<title>Vote agora</title>
		<style>
			html, body{
				width:100%;height:100%;
				padding:0;border:0;margin:0;
				background: #C1CFEC;
				font-family: arial;
			}
			.flex{
				display: flex;
			}
			
			input::-webkit-inner-spin-button {
			    	-webkit-appearance: none;
			   	margin: 0;
			}
			input{
				outline: none;
				height: 25px
			}
			.main{
				flex-direction: column;
				justify-content: center;
				align-items: center;
				width: 100%;
				height: 100%;
			}
			.urna{
				max-width:1100px;
			}
			.tela, .teclado{
				height:400px;
				margin: 20px;
				background: white;
			}
			.tela{
				flex: 8;
				padding: 40px;
				box-sizing: border-box;
				font-size: 20px;
				flex-direction: column;
				justify-content: space-between;
			}
			.input-foto{
				justify-content: space-between
			}
			
			.foto-nome{
				flex-direction: column;
				align-items: center
			}
			.foto-nome img{
				margin: 0 0 10px 0;
			}
			.info{
				justify-content: center;
				height: 60px;
				border-top: 0.5px solid #ddd;
				
			}
			.teclado{
				flex: 5;
				flex-direction: column;
				padding: 20px;
				box-sizing: border-box;
				justify-content: space-between;
			}
			.numeros{
				justify-content: center;
				flex-wrap:wrap;
			}
			 btn, .teclado div:nth-child(2) input{
				width: 75px;
				height: 47px;
				background-color: #15181C;
				text-align: left;
				color: #ddd;
				border-radius: 5px;
				border: none;
				cursor: pointer;
			    margin: 10px;
				padding: 1px 6px;
				box-sizing: border-box;
				line-height: 43px;
			}
			input:nth-child(2){
				height: 100px;
				width: 100px;
				text-align: center;
				font-size: 50px;
			}

			.numeros btn{
				font-size:30px;
			}
			.teclado div:nth-child(2){
				display: flex;
				justify-content: center
			}
			.teclado div:nth-child(2) btn, .teclado div:nth-child(2) input{
				flex: 1;
				display: flex;
				height: 61px;
				justify-content: center;
				align-items: center;
				font-weight: 700;
				color: #181818;
			}
			.teclado div:nth-child(2) btn:nth-child(1){
				background:#fff;
				border: .5px solid #ddd;
			}
			.teclado div:nth-child(2) btn:nth-child(2){
				background:#F58952;
			}
			.teclado div:nth-child(2) input{
				background: #2BB162;
			}
			.fim{
				font-size: 317px;
			}
		</style>
		<script>
			document.addEventListener('click', function(e){
				var input_candidato = document.getElementsByName('nNum')[0];
				var foto_candidato = document.querySelector('img');
				var nome_candidato = document.querySelector('#nome');

				var candidatos = {
					22:{
						src:'bolsonaro.jpg',
						nome: 'BOLSONARO',
						msg:'CONFIRMA SEU VOTO'
					},
					13:{
						src:'lula.jpg',
						nome: 'LULA',
						msg:'CONFIRMA SEU VOTO'
					},
					corrige:{
						src:'candidato.jpg',
						nome: '',
						msg:'DIGITE O NÚMERO'
					},
					'00':{
						src:'candidato.jpg',
						nome: 'BRANCO',
						msg:'CONFIRMA SEU VOTO'
					}
				};

				function source_candidato(num_candidato){
					foto_candidato.src = candidatos[num_candidato]['src'];
					nome_candidato.innerHTML = candidatos[num_candidato]['nome'];
					document.getElementsByTagName('h1')[0].innerHTML = candidatos[num_candidato]['msg'];
				}

				//BRANCO
				if(e.target.dataset.branco == 'branco' && input_candidato.value.length < 2){
					input_candidato.value='00';
					return source_candidato('00');
				}
				//LIMPAR
				if(e.target.dataset.limpar == 'corrige'){
					input_candidato.value="";
					return source_candidato('corrige');
				}
				if(e.target.dataset.value != null && input_candidato.value.length < 2){
					input_candidato.value = input_candidato.value + e.target.dataset.value;
					return source_candidato(input_candidato.value);
				}
			});
		</script>

		<script src="js/jquery-3.6.3.js"></script>
		<script>
			$(document).ready(function(){
				// $("button").click(function(){
				// 	$("p").slideToggle();
				// });
				
				$.ajax({
					url: "http://localhost/urna-eletronica/urna-eletronica-api/src/getBranco.php",
					context: document.body
				}).done(function(data) {
					// $( this ).addClass( "done" );
					alert('xx');
					alert(data);
					$("#dados_carregados").innerHTML = data;
				});
			});
			
		</script>
	</head>
	<body>

		<div id="dados_carregados">

		</div>

		<form method="get" class="main flex">
			<?php
				if(isset($_GET['nTitEleitor']) && isset($_GET['nNum'])){
					echo '<div>Nº título <input disabled type="number" name="nTitEleitor"/></div>';
				}else{
					echo '<div>Nº título <input type="number" name="nTitEleitor"/></div>';
				}
			?>
			
			<div class="flex urna">
				<div class="tela flex">
					<?php
						if(isset($_GET['nTitEleitor']) && isset($_GET['nNum'])){
							echo '<div class="fim">FIM</div>';
						}else{
							echo '
							<div class="input-foto flex">
							<div>
								<h3>PRESIDENTE</h3>
								<input type="number" name="nNum"/>
							</div>
							<div class="flex foto-nome">
								<img src="candidato.jpg" width="150px"/>
								<div id="nome"></div>
							</div>
							</div>
							
							<div class="info flex">
								<h1>DIGITE O NÚMERO</h1>
							</div>';
						}
					?>
				</div>
				<?php
					if(isset($_GET['nTitEleitor']) && isset($_GET['nNum'])){
						echo '
						<div class="teclado flex">
							<div class="numeros flex">
								<btn>1</btn>
								<btn>2</btn>
								<btn>3</btn>
								<btn>4</btn>
								<btn>5</btn>
								<btn>6</btn>
								<btn>7</btn>
								<btn>8</btn>
								<btn>9</btn>
								<btn>0</btn>
							</div>
							<div>
								<btn>BRANCO</btn>
								<btn >CORRIGE</btn>
								<input type="submit" disabled value="CONFIRMA"/>
							</div>
						</div>
						';
					}
					else{
						echo '
						<div class="teclado flex">
							<div class="numeros flex">
								<btn data-value="1">1</btn>
								<btn data-value="2">2</btn>
								<btn data-value="3">3</btn>
								<btn data-value="4">4</btn>
								<btn data-value="5">5</btn>
								<btn data-value="6">6</btn>
								<btn data-value="7">7</btn>
								<btn data-value="8">8</btn>
								<btn data-value="9">9</btn>
								<btn data-value="0">0</btn>
							</div>
							<div>
								<btn data-branco="branco">BRANCO</btn>
								<btn data-limpar="corrige">CORRIGE</btn>
								<input type="submit" value="CONFIRMA"/>
							</div>
						</div>
						';
					}
				?>
			</div>
		</form>
	</body>
</html>