# 🌿 Jungleon — Manuale Utente

> *Vivi avventure uniche in un dungeon nella giungla: esplora, livella, trova oggetti epici e salva i tuoi progressi online, per riprendere quando e dove vuoi!*

**Versione:** 1.0  
**Autore:** Pennetta Fabrizio  
**Tecnologie:** HTML · JavaScript · CSS · PHP  
**Web App:** [pennettafabrizio5ie.altervista.org](https://pennettafabrizio5ie.altervista.org/)  
**MockUp:** [jungleon.lovable.app](https://jungleon.lovable.app/)

---

## Indice

1. [Introduzione](#1-introduzione)
2. [Accesso alla piattaforma](#2-accesso-alla-piattaforma)
3. [Tipi di account e ruoli](#3-tipi-di-account-e-ruoli)
4. [Modalità di gioco](#4-modalità-di-gioco)
5. [Il personaggio](#5-il-personaggio)
6. [Oggetti e inventario](#6-oggetti-e-inventario)
7. [Mostri e combattimento](#7-mostri-e-combattimento)
8. [Stanze e dungeon](#8-stanze-e-dungeon)
9. [Storie e capitoli](#9-storie-e-capitoli)
10. [Sistema di chat](#10-sistema-di-chat)
11. [Gestione dei salvataggi](#11-gestione-dei-salvataggi)
12. [Leaderboard e teschi](#12-leaderboard-e-teschi)
13. [Pass a pagamento](#13-pass-a-pagamento)
14. [Pannello Moderatore e Master](#14-pannello-moderatore-e-master)
15. [Diagramma dei casi d'uso — riepilogo](#15-diagramma-dei-casi-duso--riepilogo)
16. [Architettura delle classi](#16-architettura-delle-classi)
17. [Struttura del database (Diagramma ER)](#17-struttura-del-database-diagramma-er)
18. [Domande frequenti (FAQ)](#18-domande-frequenti-faq)

---

## 1. Introduzione

**Jungleon** è un'avventura testuale *single player* ambientata in un dungeon nella giungla. Ogni partita è diversa grazie alla **generazione procedurale delle stanze**: nessun percorso sarà mai uguale al precedente.

Funzionalità principali:

- Esplorazione di dungeon generati proceduralmente con stanze, mostri e oggetti
- Sistema di combattimento a turni con statistiche dettagliate (vita, forza, resistenza, velocità, furtività, capacità)
- Raccolta di oggetti suddivisi in armi, armature, pozioni e reliquie — ognuno con rarità e usura
- Storie e capitoli narrativi integrati nel dungeon
- Salvataggio dei progressi online (fino a 2 slot per account)
- Modalità competitiva **Versus** (Scontri) contro altri giocatori
- Modalità creativa **Dungeon Forge** per costruire e condividere dungeon, stanze, mostri, oggetti e storie
- Chat integrata tra giocatori
- Sistema di restrizioni e moderazione

---

## 2. Accesso alla piattaforma

### 2.1 Registrazione

Per creare un account:

1. Apri la web app all'indirizzo [pennettafabrizio5ie.altervista.org](https://pennettafabrizio5ie.altervista.org/).
2. Clicca su **"Registrati"**.
3. Compila i campi: **username** (visibile agli altri giocatori), **password** ed **email**.
4. Conferma la registrazione.

> Lo username è pubblico e visibile durante le partite online. Una stessa email può essere associata a più account (il limite è applicato a livello applicativo).

### 2.2 Login

1. Clicca su **"Accedi"**.
2. Inserisci username e password.
3. Clicca su **"Login"**.

Il sistema genera un **token di sessione** per autenticare le operazioni successive (creazione contenuti, salvataggio, scontri, ecc.).

### 2.3 Modalità Ospite

Se non hai un account o vuoi provare prima di registrarti:

- Puoi avviare una **nuova partita** senza effettuare il login.
- Puoi accedere al **Tutorial** per imparare le meccaniche di base.
- I progressi **non vengono salvati**: alla chiusura della sessione la partita va persa.
- Non è possibile accedere alle modalità **Versus** e **Dungeon Forge**, né alla chat.

### 2.4 Logout

Sia gli utenti registrati che il Master possono effettuare il logout tramite la voce **"Esci dall'account"** nel menu utente.

---

## 3. Tipi di account e ruoli

| Ruolo | Descrizione |
|---|---|
| **Ospite** | Utente non registrato. Accesso limitato a nuova partita e tutorial. |
| **Utente registrato (Base)** | Accesso completo a Single Player, Versus, Dungeon Forge e chat. Può creare e pubblicare contenuti. |
| **Utente speciale (Pass)** | Utente con Pass Crafter o Creator. Campo `pass` che determina i limiti di creazione. |
| **Moderatore** | Può assegnare restrizioni e modificare i ruoli di altri utenti. Eredita tutte le funzionalità dell'utente registrato. |
| **Master** | Ruolo di amministrazione. Può modificare il Dungeon Base ufficiale. Eredita le funzionalità del Moderatore. |

> Il **Moderatore** è un ruolo intermedio tra utente registrato e Master, con poteri di gestione della community. Il ruolo viene assegnato tramite la funzione *modifica ruoli utenti*.

---

## 4. Modalità di gioco

### 4.1 Single Player — Dungeon Base

La modalità principale di Jungleon. Il dungeon ufficiale viene esplorato con stanze generate proceduralmente.

**Come iniziare:**

1. Dal menu principale, seleziona **"Gioca al Dungeon Base"**.
2. Scegli di creare una **nuova partita** oppure di **riprendere** un salvataggio esistente (max 2 slot).
3. Esplora le stanze, affronta i mostri e raccogli ricompense.

**Meccaniche principali:**

- Ogni stanza può contenere mostri, oggetti, dialoghi ed eventi narrativi.
- Sconfiggere i mostri fa guadagnare **esperienza (EXP)** e può far trovare **loot** (armi, armature, pozioni, reliquie).
- Salendo di livello il personaggio migliora le sue statistiche.
- Alcuni mostri sono **Boss** con fasi di combattimento multiple.
- Gli oggetti raccolti qui potranno essere usati nella modalità **Versus**.

> Gli oggetti e i livelli ottenuti nelle partite personalizzate (Dungeon Forge) **non contano** per il Versus.

### 4.2 Versus (Scontri)

Modalità competitiva online in cui affronti altri giocatori usando l'equipaggiamento guadagnato nel Single Player.

**Come accedere:**

1. Dal menu principale, seleziona **"Versus"** → **"Partecipa a scontro"**.
2. Scegli uno dei tuoi **due slot di salvataggio** come equipaggiamento di partenza.
3. Scegli tra:
   - **Casuale:** matchmaking automatico contro un avversario casuale.
   - **Con un amico:** cerca un giocatore tramite il suo **username** e sfidalo direttamente.

**Struttura di uno scontro:**

Ogni scontro registra data di inizio, data di fine e vincitore. Al termine la partita viene archiviata nello storico.

**Sistema di punteggio:**

- Ogni vittoria fa guadagnare **teschi 💀** che scalano la leaderboard globale.
- I teschi ottenuti nel Dungeon Forge non vengono conteggiati.

### 4.3 Dungeon Forge

La modalità sandbox di Jungleon. Crea, salva e condividi contenuti personalizzati.

**Cosa puoi creare:**

- **Dungeons** personalizzati (nome, descrizione, pubblico/privato)
- **Stanze** con dialoghi e descrizioni
- **Mostri** originali con statistiche personalizzate
- **Oggetti** (armi, armature, pozioni, reliquie) con rarità e valore
- **Storie e Capitoli** narrativi da allegare al dungeon

**Come giocare un dungeon altrui:**

Dal menu Dungeon Forge → **"Esplora Dungeon"** → seleziona un dungeon pubblico → clicca **"Gioca Dungeon (non Base)"**.

**Limiti per tipo di account:**

| Account | Dungeon personalizzati salvabili |
|---|---|
| Utente Base | 1 |
| Pass Crafter | 5 |
| Pass Creator | Illimitati |

---

## 5. Il personaggio

Ogni partita crea un **Personaggio** legato all'account e allo slot di salvataggio scelto.

| Statistica | Descrizione |
|---|---|
| **Vita** | Punti vita totali. A zero il personaggio muore. |
| **Resistenza** | Riduzione dei danni subiti. |
| **Esperienza** | Accumulata sconfiggendo mostri. Determina il livello. |
| **Livello** | Aumenta con l'esperienza e potenzia le statistiche. |
| **Capacità** | Dimensione massima dell'inventario. |
| **Velocità** | Influisce sull'ordine di attacco nel combattimento. |
| **Furtività** | Possibilità di evitare o sorprendere i nemici. |
| **Forza** | Danno base degli attacchi fisici. |

Il personaggio tiene traccia della **stanza attuale**, della **data di inizio partita** e della **posizione** nel dungeon.

**Metodi principali (da diagramma delle classi):**

- `attacca(Mostro.tipo): Attacco` — esegue un attacco tenendo conto del tipo di mostro
- `subisci(Attacco): void` — elabora un attacco in arrivo applicando resistenza e modificatori
- `salva(): bool` — salva lo stato corrente nel cloud

---

## 6. Oggetti e inventario

Gli oggetti si raccolgono esplorando il dungeon. Ogni oggetto ha: nome, rarità, tipo, valore, descrizione e **usura** (utilizzi rimanenti; se non definita, l'oggetto è a utilizzi infiniti).

### Tipi di oggetti

**Arma**

| Attributo | Descrizione |
|---|---|
| Tipo | Categoria dell'arma (spada, ascia, arco, ecc.) |
| Danno | Danno base inflitto |
| Usura Max | Utilizzi massimi prima della rottura |
| Velocità | Modifica alla velocità di attacco |
| A due mani | `true` se richiede entrambe le mani |

**Armatura**

| Attributo | Descrizione |
|---|---|
| Tipo | Parte del corpo protetta |
| Resistenza | Riduzione danni aggiuntiva |
| Usura Max | Utilizzi prima della rottura |
| Velocità | Penalità o bonus alla velocità |
| Furtività | Eventuale modifica alla furtività |

**Pozione**

Consumabile con un `tipo` che ne determina l'effetto (cura, aumento temporaneo di statistiche, ecc.).

**Reliquia**

Oggetto speciale con l'attributo `chiavePer`, che indica a quale evento, porta o segreto del dungeon è collegata.

### Effetti degli oggetti

Alcuni oggetti applicano **Effetti** temporanei o permanenti al personaggio: livello, tipo, modifica a esperienza/vita/resistenza/velocità/furtività/forza/danno, durata in round, durata in giorni.

### Modificatori

Il sistema usa **Modificatori** (istanze di Template Modificatori) per gestire bonus e malus in modo preciso:

- `0` = addizionatore (somma un valore fisso)
- `1` = moltiplicatore (moltiplica per un valore)
- `2` = moltiplicatore percentuale (da 0% a infinito%)

---

## 7. Mostri e combattimento

### Statistiche dei mostri

Ogni mostro ha: nome, utente creatore, tipo, livello, vita, resistenza, velocità, forza.

I **Boss** sono una sottoclasse speciale con l'attributo `fase` (numero di fasi di combattimento).

**Metodi del mostro:**

- `attacca(): Attacco` — genera un attacco
- `subisci(Attacco): void` — riceve un attacco
- `lasciaLoot(): list(Oggetto)` — rilascia oggetti alla morte

### Tipi di mostri e debolezze

Ogni mostro appartiene a uno o più **Tipi** (es. Non-Morti, Bestie, Elementali). I tipi definiscono resistenze e debolezze tramite il sistema **Forte o Debole Contro**, che usa la stessa logica dei Modificatori (tipo + valore).

> Esempio: Non-Morti forti contro veleno → tipo = 2, valore = 0.

### Flusso di combattimento

1. Personaggio e Mostro si alternano in base alla statistica **Velocità**.
2. Ogni turno genera un oggetto `Attacco` con danno base e lista di effetti.
3. Il difensore chiama `subisci(Attacco)` che applica resistenze e modificatori.
4. La battaglia termina quando i punti vita di uno dei due raggiungono zero.

---

## 8. Stanze e dungeon

### Stanze

Ogni stanza ha: nome, utente creatore, lista di dialoghi (testuale), descrizione, data di creazione, flag pubblico/privato.

Una stanza può contenere più mostri e più oggetti.

### Dungeon

Un dungeon è composto da più stanze. Attributi: nome, utente, descrizione, data creazione, flag pubblico.

- Un **Utente Base** può creare 1 dungeon personalizzato.
- Un **Utente Speciale** (con Pass) può crearne di più.
- La relazione è: 1 Dungeon contiene 1..* Stanze.

---

## 9. Storie e capitoli

Jungleon supporta narrazioni integrate nel dungeon tramite il sistema **Storie e Capitoli**.

**Storia:** titolo, utente creatore, descrizione, data creazione, flag pubblico.

**Capitolo:** nome, descrizione, testo completo, posizione ordinale, numero, data creazione.

Una storia contiene 1..* capitoli (composizione). Un dungeon può avere una storia che si svolge al suo interno.

Gli utenti registrati possono creare storie e capitoli nel Dungeon Forge e pubblicarli per renderli visibili a tutti.

---

## 10. Sistema di chat

Jungleon include una **chat integrata** tra giocatori.

- Gli utenti registrati possono **partecipare alla chat** durante le sessioni di gioco.
- Ogni messaggio ha: testo, data di invio, flag "visualizzato" (letto/non letto), mittente e destinatario.
- Il **Moderatore** può gestire la chat e assegnare restrizioni in caso di comportamenti scorretti.

---

## 11. Gestione dei salvataggi

Jungleon permette di salvare la partita in cloud e riprenderla in qualsiasi momento, da qualsiasi dispositivo.

- Sono disponibili **2 slot di salvataggio** per account.
- Per salvare manualmente: durante la partita → **"Salva"** nel menu di pausa.
- Per riprendere: menu principale → **"Riprendi partita"** → seleziona lo slot.
- Gli slot di salvataggio vengono usati anche come equipaggiamento per il Versus.

---

## 12. Leaderboard e teschi

- I **teschi 💀** sono la valuta competitiva di Jungleon.
- Si guadagnano **solo** vincendo partite nella modalità **Versus**.
- La **leaderboard globale** mostra i giocatori ordinati per teschi accumulati.
- I teschi del Dungeon Forge **non vengono conteggiati**.

---

## 13. Pass a pagamento

Jungleon offre due pass opzionali per espandere le funzionalità del Dungeon Forge. Sono acquistabili con carta di credito (il pagamento viene verificato dal **gestore carta di credito** tramite il caso d'uso *Verifica transazione*, che include *Registra carta di credito*).

### Pass Crafter
- Aumenta il limite di dungeon personalizzati da **1 a 5**.
- Ideale per chi vuole sperimentare più idee in parallelo.

### Pass Creator
- **Nessun limite** al numero di dungeon personalizzati.
- Guadagni una **percentuale di denaro** ogni volta che un altro giocatore gioca uno dei tuoi dungeon.

Il tipo di pass è memorizzato nel campo `pass: number` della classe **Utente speciale**.

---

## 14. Pannello Moderatore e Master

### Moderatore

Eredita tutte le funzionalità dell'utente registrato, con in più:

- **Assegna restrizione** a un utente (nome, tipo, descrizione, motivazione, assegnatore, assegnatario, data assegnazione, data fine).
- **Modifica ruoli utenti** (promozione/retrocessione di account).

### Master

Eredita tutte le funzionalità del Moderatore, con in più:

- **Modifica Dungeon Base** — aggiunge o modifica stanze, mostri, oggetti e storie del dungeon ufficiale accessibile a tutti in Single Player.

> **Precondizione di sistema:** il Master deve essersi registrato e aver creato il Dungeon Base prima che i giocatori possano avviare partite Single Player.

---

## 15. Diagramma dei casi d'uso — riepilogo

| Azione | Ospite | Utente Reg. | Moderatore | Master |
|---|:---:|:---:|:---:|:---:|
| Tutorial | ✅ | ✅ | ✅ | ✅ |
| Registrarsi | ✅ | — | — | — |
| Accedere / Uscire | ✅ | ✅ | ✅ | ✅ |
| Gioca Dungeon Base | ❌ | ✅ | ✅ | ✅ |
| Gioca Dungeon personalizzato | ❌ | ✅ | ✅ | ✅ |
| Salvare i progressi | ❌ | ✅ | ✅ | ✅ |
| Partecipa a scontro (Versus) | ❌ | ✅ | ✅ | ✅ |
| Partecipa a chat | ❌ | ✅ | ✅ | ✅ |
| Crea/Gestisci Dungeons | ❌ | ✅ | ✅ | ✅ |
| Crea/Gestisci Stanze | ❌ | ✅ | ✅ | ✅ |
| Crea/Gestisci Mostri | ❌ | ✅ | ✅ | ✅ |
| Crea/Gestisci Oggetti | ❌ | ✅ | ✅ | ✅ |
| Crea/Gestisci Storie e Capitoli | ❌ | ✅ | ✅ | ✅ |
| Pubblica contenuti | ❌ | ✅ | ✅ | ✅ |
| Acquisto Pass (carta) | ❌ | ✅ | ✅ | ✅ |
| Assegna restrizione | ❌ | ❌ | ✅ | ✅ |
| Modifica ruoli utenti | ❌ | ❌ | ✅ | ✅ |
| Modifica Dungeon Base | ❌ | ❌ | ❌ | ✅ |

**Attore esterno — Gestore carta di credito:**  
Interagisce con il sistema per *Registra carta di credito* e *Verifica transazione* (collegati tramite `<<include>>` al caso d'uso *Acquisto pass con carta*).

**Scenario: Utente registrato crea un Mostro**

| Fase | Dettaglio |
|---|---|
| Precondizioni | Utente registrato · token valido · permesso di creare mostri |
| Flusso | Compila il form → Validazione valori (tipo, oggetti equipaggiati) → Inserimento DB → Redirect alla lista mostri |
| Postcondizione | Il mostro è visibile nella raccolta personale dell'utente |

---

## 16. Architettura delle classi

### Gerarchia utenti

```
Ospite
  + accedi(): void
  + registrati(): void
  └── Utente  (username, password, nome)
        + esci(): void
        └── Utente Speciale  (pass: number)
              └── Admin/Master
                    + modificaDungeon(Dungeon): Dungeon
```

### Gerarchia oggetti

```
Oggetto  «interface»  (nome, utente, rarità, descrizione, tipo, valore)
  ├── Arma        (tipo, danno, usuraMax, velocità, aDueMani)
  ├── Armatura    (tipo, resistenza, usuraMax, velocità, furtività)
  ├── Pozione     (tipo)
  └── Reliquia    (chiavePer)
```

### Gerarchia mostri

```
Mostro  (nome, utente, tipo, livello, vita, resistenza, velocità, forza)
  + attacca(): Attacco
  + subisci(Attacco): void
  + lasciaLoot(): list(Oggetto)
  └── Boss  (fase: number)
```

### Relazioni principali

| Classe A | Relazione | Classe B | Cardinalità |
|---|---|---|---|
| Utente | crea | Stanza | 1 → * |
| Utente | crea | Oggetto | 1 → * |
| Utente | crea | Mostro | 1 → * |
| Utente | crea | Dungeon | 1 → 0..2 |
| Utente Speciale | crea | Dungeon | 1 → * |
| Utente | usa | Personaggio | 1 → * |
| Personaggio | possiede | Oggetto | * → * |
| Personaggio | esplora | Dungeon | * → * |
| Personaggio | possiede | Effetto | * → * |
| Stanza | contiene | Oggetto | * → * |
| Stanza | contiene | Mostro | * → * |
| Dungeon | contiene | Stanza | 1 → 1..* |
| Storia | composizione | Capitolo | 1..* → 1..* |
| Mostro | possiede | Personaggio | * → * |
| Effetto | applica | Arma | * → * |
| Utente | ha | Restrizioni | * → * |

---

## 17. Struttura del database (Diagramma ER)

### Utenti
`Username` · `Password` · `Email` · `Ultimo accesso` · `Token` · `Privilegi` · `Data Creazione`

### Personaggi
`Nome` · `Vita` · `Resistenza` · `Esperienza` · `Capacità` · `Velocità` · `Furtività` · `Forza` · `Livello` · `Stanza attuale` · `Data inizio`

### Dungeons
`Nome` · `Descrizione` · `Pubblico` · `Data Creazione`

### Stanze
`Nome` · `Descrizione` · `Dialoghi (0..n)` · `Pubblico` · `Data Creazione`

### Template Oggetti *(base per creare oggetti)*
`Nome` · `Rarità` · `Tipo` · `Valore` · `Pubblico` · `Data Creazione`  
Sottotipi: **Tipi Armi** (Velocità, Usura Max, A due mani) · **Tipi Armature** (Resistenza, Velocità, Furtività, Usura Max) · **Tipi Pozioni** · **Tipi Reliquie**

### Oggetti *(istanze possedute da un Personaggio)*
`Numero` · `Usura` · `Data Ottenimento` · `Livello`

### Mostri
`Nome` · `Vita` · `Velocità` · `Forza` · `Resistenza` · `Furtività` · `Descrizione` · `Pubblico` · `Data Creazione`

### Tipi Mostri
`Nome` · `Forte o Debole Contro` (tramite Modificatori)

### Effetti
`Esperienza` · `Resistenza` · `Velocità` · `Furtività` · `Forza` · `Danno` · `Durata in round` · `Durata in giorni` · `Livello`

### Modificatori / Template Modificatori
`Nome` · `Tipo` (0 = addizionatore · 1 = moltiplicatore · 2 = moltiplicatore %) · `Valore`

### Storie
`Titolo` · `Descrizione` · `Pubblico` · `Data Creazione`

### Capitoli
`Nome` · `Descrizione` · `Testo` · `Posizione` · `Numero` · `Ordine` · `Data Creazione`

### Scontri *(modalità Versus)*
`Data Inizio` · `Data Fine` · `Vincitore`  
*(Destrutturato in `Scontri-Personaggi` con ID chiave nell'implementazione)*

### Messaggi *(chat)*
`Testo` · `Data` · `Visualizzato` · Mittente (Manda) → Utente · Destinatario (Riceve) → Utente

### Ruoli
`Nome` · `Descrizione`

### Restrizioni
`Nome` · `Tipo` · `Descrizione` · `Motivazione` · `Assegnatore` · `Assegnatario` · `Data Assegnazione` · `Data Fine`

---

## 18. Domande frequenti (FAQ)

**Posso giocare senza registrarmi?**  
Sì, come Ospite puoi giocare e fare il tutorial, ma i progressi non vengono salvati e non hai accesso al Versus, alla Dungeon Forge o alla chat.

**Quante partite posso salvare?**  
Ogni account può mantenere fino a **2 slot di salvataggio** attivi.

**Gli oggetti trovati nei dungeon personalizzati contano per il Versus?**  
No. Solo oggetti e livelli guadagnati nel **Dungeon Base ufficiale** (Single Player) valgono nel Versus.

**Come sfido un amico?**  
Versus → "Partecipa a scontro" → "Con un amico" → inserisci il suo **username** → invia la sfida.

**Come pubblico un mio dungeon?**  
Dungeon Forge → apri il dungeon → clicca **"Pubblica"**. Diventerà visibile e giocabile da tutti.

**Cosa significa il "flag pubblico" su stanze, oggetti e mostri?**  
Quando crei contenuti puoi tenerli privati o renderli pubblici. Quelli pubblici possono essere usati da altri creatori nei loro dungeon.

**Cosa succede se raggiungo il limite di dungeon?**  
Con il piano Base puoi salvare 1 solo dungeon. Acquista il **Pass Crafter** (fino a 5) o il **Pass Creator** (illimitati).

**Come funziona l'usura degli oggetti?**  
Ogni oggetto ha un campo `Usura Max` che si decrementa a ogni utilizzo. Se non è definita, l'oggetto è a utilizzi infiniti.

**Cosa sono le Reliquie?**  
Oggetti speciali con un attributo `chiavePer` che sblocca porte, eventi o segreti specifici del dungeon.

**Come guadagno teschi?**  
I teschi si ottengono esclusivamente vincendo partite nella modalità **Versus**.

**Cosa fa un Moderatore?**  
Il Moderatore può assegnare restrizioni agli utenti (ban, avvisi, limitazioni) e modificare i ruoli degli account. È un ruolo intermedio tra utente e Master.

**Dove posso vedere il mockup dell'interfaccia?**  
Il mockup interattivo è disponibile su: [jungleon.lovable.app](https://jungleon.lovable.app/)

---

*Manuale redatto sulla base della documentazione di progetto (README.md, Jungleon_info.docx, Diagramma dei Casi d'uso, Diagramma delle Classi, Diagramma ER) — Jungleon © Pennetta Fabrizio*
