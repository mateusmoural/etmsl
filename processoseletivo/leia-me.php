#Às 23:59

#dia 06/07{
	index.html
		-90 retirar disabled
		-90 mudar de "#" para "./logon.php"
		-90 mudar de Em breve para Iniciar inscrição

		-98 retirar disabled
		-98 mudar de "#" para "./login.php"
		-98 mudar de Em breve para Entrar
}

#dia 12/07{
	index.html
		-94 retirar disabled
		-94 mudar de "#" para "./isencaologon.php"
		-94 mudar de Em breve para Solicitar isenção
}

#dia 15/07{
	index.html
		-94 inserir disabled depois da palavra block
		-94 mudar de "./isencaologon.php" para "#"
		-94 mudar de Solicitar isenção para Encerrado

	renomear arquivo isencaologon.php para _isencaologon.php
	renomear arquivo isencao.php para _isencao.php
	renomear arquivo isencaoregistrar.php para _isencaoregistrar.php

#dia 17/07{
	candidato.php
		-127 mudar de # para //link do formulario//
		-128 mudar de EM BREVE para Clique aqui
}

#dia 21/07{
	Banco de dados
		-inserir X no campo url dos indefiridos
		-rodar o programa registrarboleto_isenções indefiridas.php
}

#dia 27/07{
	index.html
		-90 inserir disabled depois da palavra block
		-90 mudar de "./logon.php" para "#"
		-90 mudar de Iniciar inscrição para Encerrado

	candidato.php
		-167 inserir disabled depois dda palavra default
		-167 mudar de "boleto.php" para "#"
		-167 mudar de Imprimir Boleto para Encerrado
		

	renomear arquivo logon.php para _logon.php
	renomear arquivo inscricaoregistrar.php para _inscricaoregistrar.php
	renomear arquivo inscricaoregistrar.php para _inscricao.php
	renomear arquivo WebserviceCaixa.php para _WebserviceCaixa.php

}

# dia 09/08 //NA HORA DA PROVA{
	candidato.php
		-140 mudar de # para //link da prova//
		-140 mudar de AGARDE O DIA DA PROVA para Clique aqui
		-150 inserir echo $chave depois da palavra php
		-150 mudar de AGARDE O DIA DA PROVA para Clique aqui
}


# etmsl.com.br/processoseletivo/admin/
	senhas
		$user0 = 'root';
		$pass0 = '42';

		$user1 = 'admin';
		$pass1 = 'r2d2';
		
		$user2 = 'coordenador';
		$pass2 = 'c3po';