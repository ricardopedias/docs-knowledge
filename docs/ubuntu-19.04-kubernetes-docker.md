[Voltar para Lista de Opções](../readme.md)

# Ubuntu 19.04 - Kubernetes + Docker

----------
## 1. Kubernetes

### 1.1. Verificando suporte

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




[Voltar para Lista de Opções](../readme.md)
