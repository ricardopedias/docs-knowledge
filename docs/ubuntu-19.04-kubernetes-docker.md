[Voltar para Lista de Opções](../readme.md)

# Ubuntu 19.04 - Ansible + Kubernetes + Docker

----------
## 1. Verificando suporte

Para verificar se existe suporte para virtualização, execute o comando abaixo:

```
$ egrep --color 'vmx|svm' /proc/cpuinfo
```

Caso o resultado seja parecido com o abaixo, o suporte está disponível:

```
flags : fpu vme de pse tsc msr pae mce cx8 apic sep mtrr pebs bts 
rep_good nopl xtopology nonstop_tsc cpuid aperfmperf pni pclmulqdq 
dtes64 monitor ds_cpl vmx est tm2 ssse3 sdbg fma cx16 xtpr pdcm 
pcid sse4_1 sse4_2 movbe popcnt tsc_deadline_timer aes xsave avx 
f16c rdrand lahf_lm abm cpuid_fault epb invpcid_single pti ssbd ...
```

----------
## 2. Dependencias

```
$ sudo apt update && apt install -y apt-transport-https software-properties-common curl
```

----------
## 3. Ansible

Para configurar o Ansible, será necessário possui (no mínimo) o Python 3.5 instalado. Para verificar a versão instalada:

```
$ python3 --version
```

Se a versão for maior ou igual a 3.5, instale o Ansible com os comandos:

```
$ sudo apt-add-repository ppa:ansible/ansible
$ sudo apt install ansible
```


----------
## 3. Docker

O ubuntu disponibiliza um pacote do docker que pode ser instalado diretamente da distribuição. 

```
$ sudo apt install -y docker.io
```

Após a instalação, o doker deve estar executando. Para verificar, basta usar o comando abaixo:

```
$ sudo systemctl status docker

● docker.service - Docker Application Container Engine
   Loaded: loaded (/lib/systemd/system/docker.service; disabled; vendor preset: enabled)
   Active: active (running) since Thu 2019-05-16 10:34:14 -03; 1min 24s ago
     Docs: https://docs.docker.com
 Main PID: 5551 (dockerd)
    Tasks: 14
   Memory: 33.2M
   CGroup: /system.slice/docker.service
           └─5551 /usr/bin/dockerd -H fd:// --containerd=/run/containerd/containerd.sock

mai 16 10:34:13 ricardo-bnw dockerd[5551]: time="2019-05-16T10:34:13.909730839-03:00" level=warning msg="Your kernel does not support cgroup blkio weight"
mai 16 10:34:13 ricardo-bnw dockerd[5551]: time="2019-05-16T10:34:13.909755900-03:00" level=warning msg="Your kernel does not support cgroup blkio weight_device"
mai 16 10:34:13 ricardo-bnw dockerd[5551]: time="2019-05-16T10:34:13.910259370-03:00" level=info msg="Loading containers: start."
mai 16 10:34:14 ricardo-bnw dockerd[5551]: time="2019-05-16T10:34:14.110127204-03:00" level=info msg="Default bridge (docker0) is assigned with an IP address 172
mai 16 10:34:14 ricardo-bnw dockerd[5551]: time="2019-05-16T10:34:14.243889005-03:00" level=info msg="Loading containers: done."
mai 16 10:34:14 ricardo-bnw dockerd[5551]: time="2019-05-16T10:34:14.268679994-03:00" level=warning msg="failed to retrieve runc version: unknown output format: 
mai 16 10:34:14 ricardo-bnw dockerd[5551]: time="2019-05-16T10:34:14.314964980-03:00" level=info msg="Docker daemon" commit=e8ff056 graphdriver(s)=overlay2 versi
mai 16 10:34:14 ricardo-bnw dockerd[5551]: time="2019-05-16T10:34:14.315148460-03:00" level=info msg="Daemon has completed initialization"
mai 16 10:34:14 ricardo-bnw dockerd[5551]: time="2019-05-16T10:34:14.341152185-03:00" level=info msg="API listen on /var/run/docker.sock"
mai 16 10:34:14 ricardo-bnw systemd[1]: Started Docker Application Container Engine.
```

----------
## 34 Kubernetes

De acordo com a [documentação do Kubernetes](https://kubernetes.io/docs/getting-started-guides/ubuntu/), o Ubuntu disponibiliza uma versão mínima do Kubernetes, que pode ser instalada com o seguinte comando: 

```
snap install microk8s --classic
```

Outra opção é usando o [Conjure Up](https://tutorials.ubuntu.com/tutorial/install-kubernetes-with-conjure-up?_ga=2.25375934.2035833349.1504518498-2070601899.1473694436#0), um script que facilita a instalação de servidores para nuvem, mostrando opções e guiando o usuário durante a instalação. Para esta opção, será necessário instalar o pacote "conjure-up":

```
sudo snap install conjure-up --classic
```

Como nosso objetivo é implantar o Kubernetes na máquina local, será necessário instalar o clusterizador LXD:

```
sudo snap install lxd --classic
```

Em seguida, será necessário iniciar o serviço de clusterização. 
O comando abaixo precisa ser executado com `sudo` e as perguntas deverão ser respondidas de acordo com suas necessidades.
Na dúvida, basta pressionar Enter para aceitar o valor padrão de cada uma:

```
sudo /snap/bin/lxd init

Would you like to use LXD clustering? (yes/no) [default=no]: 
Do you want to configure a new storage pool? (yes/no) [default=yes]: 
Name of the new storage pool [default=default]: 
Name of the storage backend to use (btrfs, ceph, dir, lvm, zfs) [default=zfs]: 
Create a new ZFS pool? (yes/no) [default=yes]: 
Would you like to use an existing block device? (yes/no) [default=no]: 
Size in GB of the new loop device (1GB minimum) [default=43GB]: 
Would you like to connect to a MAAS server? (yes/no) [default=no]: 
Would you like to create a new local network bridge? (yes/no) [default=yes]: 
What should the new bridge be called? [default=lxdbr0]: 
What IPv4 address should be used? (CIDR subnet notation, “auto” or “none”) [default=auto]: 
What IPv6 address should be used? (CIDR subnet notation, “auto” or “none”) [default=auto]: 
Would you like LXD to be available over the network? (yes/no) [default=no]: 
Would you like stale cached images to be updated automatically? (yes/no) [default=yes] 
Would you like a YAML "lxd init" preseed to be printed? (yes/no) [default=no]: 
```

Com o serviço rodando, é preciso executar o Conjure UP. Porém ele não pode ser executado como root e nem mesmo através do sudo:

```
sudo conjure-up
  !! This should _not_ be run as root or with sudo. !!
```

Isso porque o ConjureUp precisa ter acesso ao LXD que se encontra no diretório "snap" do usuário (/home/ricardo/snap). Mas, por ser um pacote snap, o lxd não possui permissões suficientes. Poderíamos ter instalado o LXD através do apt, mas a documentação Conjure-up informa que "Snaps são o método de instalação recomendado. Nos próximos lançamentos do Ubuntu, a versão snap do LXD será a única maneira de instalá-lo e usá-lo". Portanto, é importante usar snap mesmo :);

Rodando o comando abaixo sem sudo, a seguinte mensagem aparecerá:

```
$ lxc list
Error: Get http://unix.socket/1.0: dial unix /var/snap/lxd/common/lxd/unix.socket: connect: permission denied
```

Com sudo tudo funciona normalmente:

```
$ sudo lxc list
+------+-------+------+------+------+-----------+
| NAME | STATE | IPV4 | IPV6 | TYPE | SNAPSHOTS |
+------+-------+------+------+------+-----------+
```

Para solucionar o problema de permissão é preciso que o usuário local (no caso ricardo) tenha permissão para executar as ferramentas do lxd como se fosse o dono ou como se fosse o root. Usando o comando abaixo é possível ver que existe um usuário chamado "lxd".

```
$ cut -d: -f1 /etc/passwd

root
daemon
bin
sys
[...]
www-data
avahi
gdm
ricardo
systemd-coredump
lxd
```

Porém, não existe um grupo correspondente:

```
$ groups

adm cdrom sudo dip plugdev lpadmin sambashare ricardo
```

A primeira coisa a fazer é criar o grupo "lxd":

```
$ newgrp lxd
$ groups

lxd adm cdrom sudo dip plugdev lpadmin sambashare ricardo
```

Em seguida, permitir que o usuário atual (ricardo) possa agir como "lxd". Isso é feito adicionando o grupo "lxd"
como um grupo secundário do usuário atual: 

```
$ sudo usermod -a -G lxd $USER
```

Agora o usuário atual (ricardo) pertence também ao grupo "ldx":

```
$ id
uid=1000(ricardo) gid=998(lxd) grupos=998(lxd),4(adm),24(cdrom),27(sudo),30(dip),46(plugdev),118(lpadmin),129(sambashare),1000(ricardo)
```

Executando o comando sem sudo, agora funciona:

```
$ lxc list
+------+-------+------+------+------+-----------+
| NAME | STATE | IPV4 | IPV6 | TYPE | SNAPSHOTS |
+------+-------+------+------+------+-----------+
```

Agora podemos invocar o Kubernetes pelo ConjureUP :


```
conjure-up kubernetes
```

> Nota: Executando o comando `conjure-up` sem a opção "kubernetes", todas as opções de virtualização serão exibidas para poderem ser selecionadas. Neste artigo optamos por exibiar apenas as opções que dizem respeito ao kubernetes.

Na lista, selecione "Canonical Distribution of Kubernetes" e pressione a tecla "Enter".

Na próxima tela, é possível seleciar componentes adicionais. Para selecionar, pressione a tecla "Espaço". Para finalizar e prosseguir para a próxima tela pressione "Enter".

Por fim, será perguntado sobre a nuvem desejada para implantar o kubernetes. Neste ponto escolha "localhost", pois usaremos o LXD local. 









[Voltar para Lista de Opções](../readme.md)
