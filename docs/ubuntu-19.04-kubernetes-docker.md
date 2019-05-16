[Voltar para Lista de Opções](../readme.md)

# Ubuntu 19.04 - Kubernetes + Docker

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
$ sudo apt update && apt install -y apt-transport-https curl
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

Outra opção é usando o [Conjure Up](https://tutorials.ubuntu.com/tutorial/install-kubernetes-with-conjure-up?_ga=2.25375934.2035833349.1504518498-2070601899.1473694436#0), um script que facilita a instalação de servidores para nuvem, mostrando opções e guiando o usuário durante a instalação:

```
sudo snap install conjure-up --classic
conjure-up kubernetes
```

> Nota: Executando o comando `conjure-up` sem a opção "kubernetes", todas as opções de virtualização serão exibidas para poderem ser selecionadas. Neste artigo optamos por exibiar apenas as opções que dizem respeito ao kubernetes.

Na lista, selecione "Canonical Distribution of Kubernetes" e pressione a tecla "Enter".

Na próxima tela, é possível seleciar componentes adicionais. Para selecionar, pressione a tecla "Espaço". Para finalizar e prosseguir para a próxima tela pressione "Enter".

Por fim, será perguntado sobre a nuvem desejada para implantar o kubernetes. Nosso objetivo é implantar na máquina local, portanto, a opção deverá ser "localhost".

Para selecionar esta opção será necessário instalar o LXD:

```
sudo snap install lxd
```










[Voltar para Lista de Opções](../readme.md)
