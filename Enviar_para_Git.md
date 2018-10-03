RESUMO:
# Pasta local ainda não configurada:
git init
git add --all
git commit -m "comentário"
git remote add origin https://github.com/medson01/dashboard_ipaseal.git
git push origin master

# Pasta local já configurada, apenas para atualizações:
git add --all
git commit -m "comentário"
git remote add origin https://github.com/medson01/dashboard_ipaseal.git
git push origin master

# Iniciar as configurações para o Git em uma pasta para repositório:
> git init
Atênção: Para ver se funcionou pasta digitar:
> Nova_Pasta\.git
Exibirá uma série de arquivos de configuração do Git.

# Adicionar o arquivo no stagearea, sala de espera dos arquivos que irão para o site do Git
Adiciona todos os arquivos, inclusive as alterações e excluções:
> git add --all 
Adiciona apenas um arquivo
> git add arquivo.txt

# Confirma as alterações feitas e fechar os arquivos que serão enviados:
> git commit -m "comentário"

# Após executar os passos anteriores e criar um repositório no site do GitHub.com e obter com isso a URL do repositorio no Git (Ex.: https://github.com/medson01/dashboard_ipaseal.git). Adicionar o repositório onde os arquivos serão gravados no site.
> git remote add origin https://github.com/medson01/dashboard_ipaseal.git
Atenção: 
Atrela o comite ao usuário do commit. É usado para identificar o commit, quem fez:
> git config --global user.name "medson01"
É usado para identificar o usuário do site do GitHub. Só é feito uma vez. 
> git config --global user.email "medson01@gmail.com"

# Finalmente enviar os arquivos ao site:
> git push origin master
Ele irá pedir o usuário e senha:
>Username for "http://github.com": Digite seu usuário do Github 
>Password for "http://github.com": Digite sua senha do Github
Após isso ele deverá enviar os arquivos para o site, só conferir acessando o siteno pasta do repositório.	 

# Clonar repositório: trás do conteúdo que está no site do github para a pasta local do computador.
1º Clica com o botão direito na pasta e escolhe Git Bash Here;
2ªº No promt digita a linha de comando abaixo:
> git clone https://github.com/medson01/dashboard_ipaseal.git
Atênção: Caso queira baixar colocando em uma pasta específica com um nome 
da sua escola só digitar:
> git clone https://github.com/medson01/dashboard_ipaseal.git Nova_pasta

# Para baixar do site e atualizar na pasta local
> git pull







