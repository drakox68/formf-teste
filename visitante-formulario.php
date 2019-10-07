<?php 
require_once('cabecalho.php'); 
require_once('visitante-banco.php'); 
require_once('conecta.php'); ?>

<h1 class="display-4">Cadastro de visitante</h1>

<form action="adiciona-visitante.php" method= "post">


<fieldset>

  <div class="form-row">
 
    <div class="form-group col-md-6">
      <label for="inputNome4">Nome</label>
      <input type="text" class="form-control" id="inputNome4" required type="text"  name="nome">
    </div>
    <div class="form-group col-md-6">
      <label for="inputSobrenome4">Sobrenome</label>
      <input type="text" class="form-control" id="inputSobrenome4" required type="text"  name="sobrenome">
    </div>
    
  </div>
  <div class="form-group">
    <label for="inputEmpresa">Empresa</label>
    <input type="text" class="form-control" id="inputEmpresa" required type="text"  name="empresa">
  </div>
  <div class="form-group">
    <label for="inputcpf">Cpf</label>
    <input type="text" class="form-control" id="cpf" required type="text"  name="cpf">
  </div>
  <div class="campo">
                        <label>Sexo</label>
                        <label>
                            <input type="radio" required type="text" name="sexo" value="masculino"> Masculino
                        </label>
                        <label>
                            <input type="radio" required type="text" name="sexo" value="feminino"> Feminino
                        </label>
                    </div> 
                    
  <div class="form-group">
    <label for="inputEmail">Email</label>
    <input type="Email" class="form-control" id="inputEmail" required type="text" name="email">
  </div>
  <div class="form-group">
    <label for="inputTelefone">Telefone</label>
    <input type="text" class="form-control" id="inputTelefone" required type="text"  name="telefone">
  </div>
  
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputCidade">Cidade</label>
      <input type="text" class="form-control" id="inputCidade" name="cidade" required type="text" >
    </div>
    <div class="form-group col-md-4">
      <label for="inputEstado">Estado</label>
      <select id="inputEstado" class="form-control" name="estado">
                                <option value="AC">SP - São paulo </option>
                                <option value="AL">AL - Alagoas</option>
                                <option value="AP">AP - Amapa</option>
                                <option value="AM">AM - Amazonas</option>
                                <option value="BA">BA - Bahia</option>
                                <option value="CE">CE - Ceara</option>
                                <option value="DF">DF - Distrito Federal</option>
                                <option value="ES">ES - Espirito Santo</option>
                                <option value="GO">GO - Goias</option>
                                <option value="MA">MA - Maranhao</option>
                                <option value="MT">MT - Mato Grosso</option>
                                <option value="MS">MS - Mato Grosso do Sul</option>
                                <option value="MG">MG - Minas Gerais</option>
                                <option value="PA">PA - Para</option>
                                <option value="PB">PB - Paraiba</option>
                                <option value="PR">PR - Parana</option>
                                <option value="PE">PE - Pernambuco</option>
                                <option value="PI">PI - Piaui</option>
                                <option value="RJ">RJ - Rio de Janeiro</option>
                                <option value="RN">RN - Rio Grande do Norte</option>
                                <option value="RS">RS - Rio Grande do Sul</option>
                                <option value="RO">RO - Rondnia</option>
                                <option value="RR">PR - Roraima</option>
                                <option value="SC">SC - Santa Catarina</option>
                                <option value="SP">AC - Acre</option>
                                <option value="SE">SE - Sergipe</option>
                                <option value="TO">TO - Tocantins</option>
      </select>
    </div>
  </div>
       

  <button type="submit" class="btn btn-primary" >Cadastrar</button>
  
  </fieldset>
 

</form>
<script>
function loadCamera(){
	//Captura elemento de vídeo
	var video = document.querySelector("#environment");
		//As opções abaixo são necessárias para o funcionamento correto no iOS
		video.setAttribute('autoplay', '');
	    video.setAttribute('muted', '');
	    video.setAttribute('playsinline', '');
	    //--
	
	//Verifica se o navegador pode capturar mídia
	if (navigator.mediaDevices.getUserMedia) {
		navigator.mediaDevices.getUserMedia({audio: false, video: {facingMode: 'environment'}})
		.then( function(stream) {
			//Definir o elemento víde a carregar o capturado pela webcam
			video.srcObject = stream;
		})
		.catch(function(error) {
			alert("Oooopps... Falhou :'(");
		});
	}
}

function takeSnapShot(){
	//Captura elemento de vídeo
	var video = document.querySelector("#environment");
	
	//Criando um canvas que vai guardar a imagem temporariamente
	var canvas = document.createElement('canvas');
	canvas.width = video.videoWidth;
	canvas.height = video.videoHeight;
	var ctx = canvas.getContext('2d');
	
	//Desnehando e convertendo as minensões
	ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
	
	//Criando o JPG
	var dataURI = canvas.toDataURL('image/jpeg'); //O resultado é um BASE64 de uma imagem.
	document.querySelector("#base_img").value = dataURI;
	
	sendSnapShot(dataURI); //Gerar Imagem e Salvar Caminho no Banco
}

function sendSnapShot(base64){	
	var request = new XMLHttpRequest();
		request.open('POST', 'save_photos.php', true);
		request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
		
		request.onload = function() {
			console.log(request);
			if (request.status >= 200 && request.status < 400) {
				//Colocar o caminho da imagem no SRC
				var data = JSON.parse(request.responseText);
				
				//verificar se houve erro
				if(data.error){
					alert(data.error);
					return false;
				}
				
				//Mostrar informações
				document.querySelector("#imagemConvertida").setAttribute("src", data.img);
				document.querySelector("#caminhoImagem a").setAttribute("href", data.img);
				document.querySelector("#caminhoImagem a").innerHTML = data.img.split("/")[1];
			} else {
				alert( "Erro ao salvar. Tipo:" + request.status );
			}
		};
		
		request.onerror = function() {
		 	alert("Erro ao salvar. Back-End inacessível.");
		}
		
		request.send("base_img="+base64); // Enviar dados
}


loadCamera();

</script>
   
<?php include('rodape.php') ?>