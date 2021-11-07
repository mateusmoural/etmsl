
<!------ Include the above in your HEAD tag ---------->

<!doctype html>
<html lang="en" class="no-js">
<head>
<style>
/* -------------------------------- 

Primary style

-------------------------------- */


*, *:after, *:before {
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}

body {
  font-size: 100%;
  font-family: "Droid Serif", serif;
  color: #7f8c97;
  background-color: #edeff0;
}



/* -------------------------------- 

Modules - reusable parts of our design

-------------------------------- */
.cd-container {
  /* this class is used to give a max-width to the element it is applied to, and center it horizontally when it reaches that max-width */
  width: 90%;
  max-width: 920px;
  margin: 0 auto;
}
.cd-container::after {
  /* clearfix */
  content: '';
  display: table;
  clear: both;
}

/* -------------------------------- 

Main components 

-------------------------------- */


#cd-timeline {
  position: relative;
  padding: 2em 0;
  margin-top: 2em;
  margin-bottom: 2em;
}
#cd-timeline::before {
  /* this is the vertical line */
  content: '';
  position: absolute;
  top: 0;
  left: 18px;
  height: 100%;
  width: 4px;
  background: #d7e4ed;
}
@media only screen and (min-width: 1170px) {
  #cd-timeline {
    margin-top: 3em;
    margin-bottom: 3em;
  }
  #cd-timeline::before {
    left: 50%;
    margin-left: -2px;
  }
}

.cd-timeline-block {
  position: relative;
  margin: 2em 0;
}
.cd-timeline-block:after {
  content: "";
  display: table;
  clear: both;
}
.cd-timeline-block:first-child {
  margin-top: 0;
}
.cd-timeline-block:last-child {
  margin-bottom: 0;
}
@media only screen and (min-width: 1170px) {
  .cd-timeline-block {
    margin: 4em 0;
  }
  .cd-timeline-block:first-child {
    margin-top: 0;
  }
  .cd-timeline-block:last-child {
    margin-bottom: 0;
  }
}
.cd-left {
    float: left;
}

.cd-left::before {
	top: 24px;
	left: 100%!important;
    border-color: transparent!important;
    border-left-color: white!important;
}

.cd-right {
	float: right;
}

.cd-rigth::before {
	top: 24px;
    left: 100%;
    right: auto;
    border-color: transparent;
    border-right-color: white;
}

@media screen and (max-width: 1169px) and (min-width: 240px) {
	.cd-timeline-content::before{
		border: none!important;
	}
	,cd-timeline-content {
		display: block;
	}
	.cd-left, .cd-right {
		float: left;
	}
	.cd-left::before {
		top: 15px!important;
		right: 100%!important;
		left: auto !important;
		border: 7px solid transparent!important;
		border-color: transparent!important;
		border-right: 7px solid white !important
	}
	
	.cd-timeline-img strong {
		font-size: 15px!important;
	}
	
}


.cd-timeline-img strong {
	font-size: 15px;
}


.cd-timeline-img {
	font-size: 21px;
    position: absolute;
    top: 0;
    left: 0;
    width: 48px;
    height: 48px;
    -webkit-border-radius: 50%;
    border-radius: 50%;
    background-color: #f9c03b;
    color: #ffffff;
    text-align: center;
    line-height: 1;
    font-size: 12px;
    padding-top: 6px;
    -webkit-transform: translateZ(0);
    -webkit-backface-visibility: hidden;
}


.cd-timeline-img.cd-movie {
  background: #c03b44;
}
.cd-timeline-img.cd-location {
  background: #f0ca45;
}
@media only screen and (min-width: 1170px) {
  .cd-timeline-img {
    width: 60px;
    height: 60px;
    left: 50%;
    margin-left: -30px;
    /* Force Hardware Acceleration in WebKit */
    -webkit-transform: translateZ(0);
    -webkit-backface-visibility: hidden;
  }
  .cssanimations .cd-timeline-img.is-hidden {
    visibility: hidden;
  }
  .cssanimations .cd-timeline-img.bounce-in {
    visibility: visible;
    -webkit-animation: cd-bounce-1 0.6s;
    -moz-animation: cd-bounce-1 0.6s;
    animation: cd-bounce-1 0.6s;
  }
}

@-webkit-keyframes cd-bounce-1 {
  0% {
    opacity: 0;
    -webkit-transform: scale(0.5);
  }

  60% {
    opacity: 1;
    -webkit-transform: scale(1.2);
  }

  100% {
    -webkit-transform: scale(1);
  }
}
@-moz-keyframes cd-bounce-1 {
  0% {
    opacity: 0;
    -moz-transform: scale(0.5);
  }

  60% {
    opacity: 1;
    -moz-transform: scale(1.2);
  }

  100% {
    -moz-transform: scale(1);
  }
}
@keyframes cd-bounce-1 {
  0% {
    opacity: 0;
    -webkit-transform: scale(0.5);
    -moz-transform: scale(0.5);
    -ms-transform: scale(0.5);
    -o-transform: scale(0.5);
    transform: scale(0.5);
  }

  60% {
    opacity: 1;
    -webkit-transform: scale(1.2);
    -moz-transform: scale(1.2);
    -ms-transform: scale(1.2);
    -o-transform: scale(1.2);
    transform: scale(1.2);
  }

  100% {
    -webkit-transform: scale(1);
    -moz-transform: scale(1);
    -ms-transform: scale(1);
    -o-transform: scale(1);
    transform: scale(1);
  }
}
.cd-timeline-content {
  position: relative;
  margin-left: 60px;
  background: white;
  border-radius: 0.25em;
  padding: 1em;
  /*box-shadow: 0 3px 0 #d7e4ed;*/
  border: 1px solid #ddd;
}
.cd-timeline-content:after {
  content: "";
  display: table;
  clear: both;
}
.cd-timeline-content h2 {
  color: #303e49;
}
.cd-timeline-content p, .cd-timeline-content .cd-read-more, .cd-timeline-content .cd-date {
  font-size: 13px;
  font-size: 0.8125rem;
}
.cd-timeline-content .cd-read-more, .cd-timeline-content .cd-date {
  display: inline-block;
}
.cd-timeline-content p {
  margin: 1em 0;
  line-height: 1.6;
}
.cd-timeline-content .cd-read-more {
  float: right;
  padding: .8em 1em;
  background: #acb7c0;
  color: white;
  border-radius: 0.25em;
}
.no-touch .cd-timeline-content .cd-read-more:hover {
  background-color: #bac4cb;
}
.cd-timeline-content .cd-date {
  float: left;
  padding: .8em 0;
  opacity: .7;
}
.cd-timeline-content::before {
  content: '';
  position: absolute;
  top: 16px;
  right: 100%;
  height: 0;
  width: 0;
  border: 7px solid transparent;
  border-right: 7px solid white;
}
@media only screen and (min-width: 768px) {
  .cd-timeline-content h2 {
    font-size: 20px;
    font-size: 1.25rem;
  }
  .cd-timeline-content p {
    font-size: 16px;
    font-size: 1rem;
  }
  .cd-timeline-content .cd-read-more, .cd-timeline-content .cd-date {
    font-size: 14px;
    font-size: 0.875rem;
  }
}
@media only screen and (min-width: 1170px) {
  .cd-timeline-content {
    margin-left: 0;
    padding: 1.6em;
    width: 45%;
  }
  
  .cd-timeline-content .cd-read-more {
    float: left;
  }
  .cd-timeline-content .cd-date {
    position: absolute;
    width: 100%;
    left: 122%;
    top: 6px;
    font-size: 16px;
    font-size: 1rem;
  }
  
  .cd-timeline-block:nth-child(even) .cd-timeline-content .cd-date {
    left: auto;
    right: 122%;
    text-align: right;
  }
  .cssanimations .cd-timeline-content.is-hidden {
    visibility: hidden;
  }
  .cssanimations .cd-timeline-content.bounce-in {
    visibility: visible;
    -webkit-animation: cd-bounce-2 0.6s;
    -moz-animation: cd-bounce-2 0.6s;
    animation: cd-bounce-2 0.6s;
  }
}

@media only screen and (min-width: 1170px) {
  /* inverse bounce effect on even content blocks */
  .cssanimations .cd-timeline-block:nth-child(even) .cd-timeline-content.bounce-in {
    -webkit-animation: cd-bounce-2-inverse 0.6s;
    -moz-animation: cd-bounce-2-inverse 0.6s;
    animation: cd-bounce-2-inverse 0.6s;
  }
}
@-webkit-keyframes cd-bounce-2 {
  0% {
    opacity: 0;
    -webkit-transform: translateX(-100px);
  }

  60% {
    opacity: 1;
    -webkit-transform: translateX(20px);
  }

  100% {
    -webkit-transform: translateX(0);
  }
}
@-moz-keyframes cd-bounce-2 {
  0% {
    opacity: 0;
    -moz-transform: translateX(-100px);
  }

  60% {
    opacity: 1;
    -moz-transform: translateX(20px);
  }

  100% {
    -moz-transform: translateX(0);
  }
}
@keyframes cd-bounce-2 {
  0% {
    opacity: 0;
    -webkit-transform: translateX(-100px);
    -moz-transform: translateX(-100px);
    -ms-transform: translateX(-100px);
    -o-transform: translateX(-100px);
    transform: translateX(-100px);
  }

  60% {
    opacity: 1;
    -webkit-transform: translateX(20px);
    -moz-transform: translateX(20px);
    -ms-transform: translateX(20px);
    -o-transform: translateX(20px);
    transform: translateX(20px);
  }

  100% {
    -webkit-transform: translateX(0);
    -moz-transform: translateX(0);
    -ms-transform: translateX(0);
    -o-transform: translateX(0);
    transform: translateX(0);
  }
}
@-webkit-keyframes cd-bounce-2-inverse {
  0% {
    opacity: 0;
    -webkit-transform: translateX(100px);
  }

  60% {
    opacity: 1;
    -webkit-transform: translateX(-20px);
  }

  100% {
    -webkit-transform: translateX(0);
  }
}
@-moz-keyframes cd-bounce-2-inverse {
  0% {
    opacity: 0;
    -moz-transform: translateX(100px);
  }

  60% {
    opacity: 1;
    -moz-transform: translateX(-20px);
  }

  100% {
    -moz-transform: translateX(0);
  }
}
@keyframes cd-bounce-2-inverse {
  0% {
    opacity: 0;
    -webkit-transform: translateX(100px);
    -moz-transform: translateX(100px);
    -ms-transform: translateX(100px);
    -o-transform: translateX(100px);
    transform: translateX(100px);
  }

  60% {
    opacity: 1;
    -webkit-transform: translateX(-20px);
    -moz-transform: translateX(-20px);
    -ms-transform: translateX(-20px);
    -o-transform: translateX(-20px);
    transform: translateX(-20px);
  }

  100% {
    -webkit-transform: translateX(0);
    -moz-transform: translateX(0);
    -ms-transform: translateX(0);
    -o-transform: translateX(0);
    transform: translateX(0);
  }
}


</style>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="css/style.css"> <!-- Resource style -->
	
  	
	<title>Cronograma do Processo Seletivo</title>
</head>
<body>

  <div class="row" align="center">
  <a href="http://etmsl.com.br/processoseletivo/"><img style="width: 90%;
  max-width: 700px;" src="http://etmsl.com.br/processoseletivo/img/baner.jpeg" class="img-fluid"></a>
  </div>
	

	<section id="cd-timeline" class="cd-container">
		<div class="cd-timeline-block">
			<div class="cd-timeline-img cd-picture">
				<strong>
					17</br>
					Set
				</strong>
			</div> <!-- cd-timeline-img -->

			<div class="cd-timeline-content cd-right">
				<h2>Publicação do Edital nº 002/2021 – Processo Seletivo – 1º semestre 2022.</h2>
				<a href="http://www.etmsl.com.br/processoseletivo/docs/EDITAL_2-2021.pdf" class="cd-read-more">Leia o Edital</a>
				
			</div> <!-- cd-timeline-content -->			
		</div> <!-- cd-timeline-block -->


        <div class="cd-timeline-block">
			<div class="cd-timeline-img cd-picture">
				<strong>
					20</br>
					Set
				</strong>
			</div> <!-- cd-timeline-img -->
      
				
			<div class="cd-timeline-content cd-left">
				<h2>Início do período de solicitação de requerimento de isenção do pagamento da inscrição.</h2><!-- 
				<a href="http://www.etmsl.com.br/processoseletivo/isencao/" class="cd-read-more">Preencha o formulário</a>-->
				
			</div> <!-- cd-timeline-content -->
		</div> <!-- cd-timeline-block -->


        <div class="cd-timeline-block">
			<div class="cd-timeline-img cd-picture">
				<strong> 
					22</br>
					Set
				</strong>
			</div> <!-- cd-timeline-img -->
				
			<div class="cd-timeline-content cd-right">
				<h2>Encerramento do período de solicitação de requerimento de isenção do pagamento da inscrição.</h2>
			  <!--<a href="http://www.etmsl.com.br/processoseletivo/isencao/" class="cd-read-more" disabled>Preencha o formulário</a> -->
				
			</div> <!-- cd-timeline-content -->
		</div> <!-- cd-timeline-block -->

        <div class="cd-timeline-block">
			<div class="cd-timeline-img cd-picture">
				<strong>
					24</br>
					Set
				</strong>
			</div> <!-- cd-timeline-img -->
				
			<div class="cd-timeline-content cd-left">
				<h2>Início do período de inscrição dos candidatos que não solicitaram isenção ou tiveram seu pedido de isenção indeferido; impressão do boleto bancário para pagamento da inscrição.</h2>
				<!--<a href="http://www.etmsl.com.br/processoseletivo/inscricao/" class="cd-read-more" >Preencher formulário de inscrição</a>  -->
				
			</div> <!-- cd-timeline-content -->
		</div> <!-- cd-timeline-block -->


        <div class="cd-timeline-block">
			<div class="cd-timeline-img cd-picture">
				<strong>
					05</br>
					Out
				</strong>
			</div> <!-- cd-timeline-img -->
				
			<div class="cd-timeline-content cd-right">
				<h2>Resultado das solicitações de isenção do pagamento do valor da inscrição – disponibilizado no endereço eletrônico da FUMEP (a partir das 15h)</h2>
				<!-- <a href="http://www.etmsl.com.br/docs/ISENCOES_EDITAL_1-2021.pdf" class="cd-read-more" >Veja o resultado</a> -->
				
			</div> <!-- cd-timeline-content -->
		</div> <!-- cd-timeline-block -->


    <div class="cd-timeline-block">
			<div class="cd-timeline-img cd-picture">
				<strong>
					27</br>
					Out
				</strong>
			</div> <!-- cd-timeline-img -->
				
			<div class="cd-timeline-content cd-left">
				<h2>Data limite para pagamento da inscrição. O candidato deverá observar o horário limite para pagamento em qualquer agência bancária ou correspondente bancário ou por meio de Internet Banking, pois não será permitido o pagamento posterior a essa data. Somente até as 21h00min00s.</h2>
				
				<!--<a href="http://www.etmsl.com.br/processoseletivo/candidato/" class="cd-read-more" disabled>Breve</a>  -->
				
			</div> <!-- cd-timeline-content -->
		
				
			<div class="cd-timeline-content cd-right">
				<h2>Encerramento do período de inscrição dos candidatos que não solicitaram isenção ou tiveram seu pedido de isenção indeferido; impressão do boleto bancário para pagamento da inscrição.</h2>
				
				<!--<a href="http://www.etmsl.com.br/processoseletivo/inscricao/" class="cd-read-more" disabled>Breve</a>  -->
				
			</div> <!-- cd-timeline-content -->
		</div> <!-- cd-timeline-block -->




    <div class="cd-timeline-block">
			<div class="cd-timeline-img cd-picture">
				<strong>
					07</br>
					Nov
				</strong>
			</div> <!-- cd-timeline-img -->
				
			<div class="cd-timeline-content cd-left">
				<h2>Aplicação das provas on-line</h2>
				
				<!--<a href="http://www.etmsl.com.br/processoseletivo/candidato/" class="cd-read-more" disabled>Breve</a>  -->
				
			</div> <!-- cd-timeline-content -->
		
				
			<div class="cd-timeline-content cd-right">
				<h2>Publicação do gabarito provisório após às 21 horas no site</h2>
				
				<!-- <a href="http://www.etmsl.com.br/processoseletivo/inscricao/" class="cd-read-more" disabled>Breve</a> -->
				
			</div> <!-- cd-timeline-content -->
		</div> <!-- cd-timeline-block -->

			
        <div class="cd-timeline-block">
			<div class="cd-timeline-img cd-picture">
				<strong>
					08</br>
					Nov
				</strong>
			</div> <!-- cd-timeline-img -->
				
			<div class="cd-timeline-content cd-right">
				<h2>Início do prazo para envio de recursos relativos às questões da prova e do gabarito pelo e-mail.</h2>
	
				<!--<a href="http://www.etmsl.com.br/processoseletivo/inscricao/" class="cd-read-more" disabled>Breve</a>  -->
				
			</div> <!-- cd-timeline-content -->
		</div> <!-- cd-timeline-block -->


    <div class="cd-timeline-block">
			<div class="cd-timeline-img cd-picture">
				<strong>
					09</br>
					Nov
				</strong>
			</div> <!-- cd-timeline-img -->
				
			<div class="cd-timeline-content cd-left">
				<h2>Encerramento do prazo para envio de recursos relativos às questões da prova e do gabarito pelo e-mail.</h2>
		
				<!--<a href="http://www.etmsl.com.br/processoseletivo/candidato/" class="cd-read-more" disabled>Breve</a>  -->
				
			</div> <!-- cd-timeline-content -->
		</div> <!-- cd-timeline-block -->


     <div class="cd-timeline-block">
			<div class="cd-timeline-img cd-picture">
				<strong>
					11</br>
					Nov
				</strong>
			</div> <!-- cd-timeline-img -->
				
			<div class="cd-timeline-content cd-right">
				<h2>Divulgação do julgamento dos recursos no site, a partir das 14 h.</h2>
	
				<!--<a href="http://www.etmsl.com.br/processoseletivo/inscricao/" class="cd-read-more" disabled>Breve</a>  -->
				
			</div> <!-- cd-timeline-content -->
		</div> <!-- cd-timeline-block -->


    <div class="cd-timeline-block">
			<div class="cd-timeline-img cd-picture">
				<strong>
					22</br>
					Nov
				</strong>
			</div> <!-- cd-timeline-img -->
				
			<div class="cd-timeline-content cd-left">
				<h2>Divulgação do resultado final e lista da ordem de classificação, a partir das 15h.</h2>
		
				<!--<a href="http://www.etmsl.com.br/processoseletivo/candidato/" class="cd-read-more" disabled>Breve</a>  -->
				
			</div> <!-- cd-timeline-content -->
		</div> <!-- cd-timeline-block -->


        <div class="cd-timeline-block">
			<div class="cd-timeline-img cd-picture">
				<strong>
					24</br>
					Nov
				</strong>
			</div> <!-- cd-timeline-img -->
				
			<div class="cd-timeline-content cd-right">
				<h2>1ª chamada e matrícula para TODOS os Cursos: ANÁLISES CLÍNICAS, ENFERMAGEM, EDIFICAÇÕES, MECÂNICA, QUÍMICA</h2>

				<!--<a href="http://www.etmsl.com.br/processoseletivo/inscricao/" class="cd-read-more" disabled>Breve</a>  -->
				
			</div> <!-- cd-timeline-content -->
		</div> <!-- cd-timeline-block -->


    <div class="cd-timeline-block">
			<div class="cd-timeline-img cd-picture">
				<strong>
					26</br>
					Nov
				</strong>
			</div> <!-- cd-timeline-img -->
				
			<div class="cd-timeline-content cd-left">
        <h2>Encerramento do prazo para matrícula da 1ª chamada para TODOS os Cursos: ADMINISTRAÇÃO - EDIFICAÇÕES - ELETRÔNICA - ELETROTÉCNICA - ENFERMAGEM - MEIO AMBIENTE - METALURGIA - QUÍMICA</h2>
			
				<!-- <a href="http://www.etmsl.com.br/processoseletivo/candidato/" class="cd-read-more" disabled>Breve</a> -->
				
			</div> <!-- cd-timeline-content -->
		</div> <!-- cd-timeline-block -->

    <div class="cd-timeline-block">
			<div class="cd-timeline-img cd-picture">
				<strong>
					06</br>
					Dez
				</strong>
			</div> <!-- cd-timeline-img -->
				
			<div class="cd-timeline-content cd-right">
        <h2>2ª chamada e matrícula (caso haja desistência) PARA TODOS OS CURSOS</h2>
	
				<!--<a href="http://www.etmsl.com.br/processoseletivo/candidato/" class="cd-read-more" disabled>Breve</a>  -->
				
			</div> <!-- cd-timeline-content -->
		</div> <!-- cd-timeline-block -->


        <div class="cd-timeline-block">
			<div class="cd-timeline-img cd-picture">
				<strong>
					07</br>
					Dez
				</strong>
			</div> <!-- cd-timeline-img -->
				
			<div class="cd-timeline-content cd-left">
        <h2>3ª chamada e matrícula (caso haja desistência) PARA TODOS OS CURSOS</h2>

				<!--<a href="http://www.etmsl.com.br/processoseletivo/inscricao/" class="cd-read-more" disabled>Breve</a>  -->
				
			</div> <!-- cd-timeline-content -->
		</div> <!-- cd-timeline-block -->


    <div class="cd-timeline-block">
			<div class="cd-timeline-img cd-picture">
				<strong>
					8</br>
					Dez
				</strong>
			</div> <!-- cd-timeline-img -->
				
			<div class="cd-timeline-content cd-right">
				<h2>4ª chamada e matrícula (caso haja desistência) PARA TODOS OS CURSOS</h2>

				<!--<a href="http://www.etmsl.com.br/processoseletivo/candidato/" class="cd-read-more" disabled>Breve</a>  -->
				
			</div> <!-- cd-timeline-content -->
		</div> <!-- cd-timeline-block -->







		</section> <!-- cd-timeline -->

</body>
</html>